<?php

namespace App\Livewire\Admin\Configuration;

use App\Models\Person;
use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class Usuarios extends Component
{
    use WithPagination;

    public $search = '';
    public $isOpen = false;
    public $showDeleteModal = false;
    public $showPasswordModal = false;
    public $item_id;

    // Fields
    public $nombre, $apellido, $INE, $CURP, $RFC;
    public $email, $role_id, $password;
    public $new_password;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::with(['person', 'role', 'status'])
            ->whereHas('person', function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('apellido', 'like', '%' . $this->search . '%');
            })
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        $roles = Role::all();

        return view('livewire.admin.configuration.usuarios', compact('users', 'roles'));
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
        $this->resetValidation();
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->showPasswordModal = false;
        $this->resetValidation();
    }

    private function resetInputFields()
    {
        $this->item_id = null;
        $this->nombre = '';
        $this->apellido = '';
        $this->INE = '';
        $this->CURP = '';
        $this->RFC = '';
        $this->email = '';
        $this->role_id = '';
        $this->password = '';
        $this->new_password = '';
    }

    public function store()
    {
        $rules = [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'INE' => 'nullable|string|max:255',
            'CURP' => 'nullable|string|max:255',
            'RFC' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->item_id,
            'role_id' => 'required|integer|exists:roles,id',
        ];

        if (!$this->item_id) {
            $rules['password'] = 'required|string|min:6';
        }

        $this->validate($rules);

        DB::beginTransaction();

        try {
            if ($this->item_id) {
                $user = User::findOrFail($this->item_id);
                $person = Person::findOrFail($user->person_id);
                
                $person->update([
                    'nombre' => $this->nombre,
                    'apellido' => $this->apellido,
                    'INE' => $this->INE,
                    'CURP' => $this->CURP,
                    'RFC' => $this->RFC,
                ]);

                $user->update([
                    'email' => $this->email,
                    'role_id' => $this->role_id,
                ]);
            } else {
                $person = Person::create([
                    'nombre' => $this->nombre,
                    'apellido' => $this->apellido,
                    'INE' => $this->INE,
                    'CURP' => $this->CURP,
                    'RFC' => $this->RFC,
                ]);

                User::create([
                    'email' => $this->email,
                    'password' => Hash::make($this->password),
                    'status_id' => 1,
                    'role_id' => $this->role_id,
                    'person_id' => $person->id,
                ]);
            }

            DB::commit();

            session()->flash('message', $this->item_id ? 'Usuario actualizado correctamente.' : 'Usuario creado correctamente.');
            $this->closeModal();
            $this->resetInputFields();

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Ocurrió un error al guardar la información: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $user = User::with('person')->findOrFail($id);
        $this->item_id = $id;
        $this->nombre = $user->person->nombre;
        $this->apellido = $user->person->apellido;
        $this->INE = $user->person->INE;
        $this->CURP = $user->person->CURP;
        $this->RFC = $user->person->RFC;
        $this->email = $user->email;
        $this->role_id = $user->role_id;
        
        $this->openModal();
    }

    public function confirmDelete($id)
    {
        $this->item_id = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        User::find($this->item_id)->update([
            'status_id' => 3, // Estado Eliminado
        ]);
        session()->flash('message', 'Usuario eliminado correctamente.');
        $this->showDeleteModal = false;
        $this->item_id = null;
    }

    public function openPasswordModal($id)
    {
        $this->item_id = $id;
        $this->new_password = '';
        $this->showPasswordModal = true;
        $this->resetValidation();
    }

    public function updatePassword()
    {
        $this->validate([
            'new_password' => 'required|string|min:6',
        ]);

        User::findOrFail($this->item_id)->update([
            'password' => Hash::make($this->new_password),
        ]);

        session()->flash('message', 'Contraseña actualizada correctamente.');
        $this->showPasswordModal = false;
        $this->item_id = null;
        $this->new_password = '';
    }
}
