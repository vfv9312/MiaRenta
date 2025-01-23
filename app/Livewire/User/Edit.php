<?php

namespace App\Livewire\User;

use App\Helpers\Utility;
use App\Mail\NewUserMail;
use App\Models\Person;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;

class Edit extends Component
{
    public $user, $roles, $names, $surnames, $roleId, $email;

    public function render()
    {
        return view('livewire.user.edit');
    }

    public function mount()
    {
        $this->roles = Role::all();
        $this->roleId = $this->roles->first()->id;
        $this->names = $this->user->person->names;
        $this->surnames = $this->user->person->surnames;
        $this->email = $this->user->email;
        $this->roleId = $this->user->role_id;
    }

    public function store()
    {
        $this->validate([
            'names'     => 'required|string|max:100',
            'surnames'  => 'required|string|max:100',
            'email'     => 'required|string|email|max:200|unique:users,email',
            'role_id'   => 'required|integer|exists:roles,id',
            // 'sales_point_id'    => $this->role_id == 2 ? 'required|integer|exists:sales_points,id' : ''
        ]);
        
        DB::beginTransaction();
        try {
            $employee = Person::create([
                'names'     => $this->names,
                'surnames'  => $this->surnames,
                'status_id' => 4,
                'person_type_id' => 1
            ]);
            $password = Str::random(10);
            $user = User::create([
                'email'     => $this->email,
                'password'  => Hash::make($password),
                'status_id' => 1,
                'role_id'   => $this->role_id,
                'person_id' => $employee->id,
            ]);

            Utility::sendEmail($this->email, new NewUserMail($user, $password));

            DB::commit();
            session()->flash('success', 'Los datos se guardaron correctamente.');
            return redirect()->route('usuarios.index');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
