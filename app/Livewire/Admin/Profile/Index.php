<?php

namespace App\Livewire\Admin\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class Index extends Component
{
    use WithFileUploads;

    public $photo;
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public function render()
    {
        return view('livewire.admin.profile.index');
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:10024', // 10MB Max
        ]);

        $user = User::find(Auth::id());
        $path = $this->photo->store('profile-photos', 'public');

        $user->forceFill([
            'profile_photo_path' => $path,
        ])->save();

        session()->flash('message', 'Foto de perfil actualizada exitosamente.');
    }

    public function removePhoto()
    {
        $user = User::find(Auth::id());
        
        $user->forceFill([
            'profile_photo_path' => null,
        ])->save();

        session()->flash('message', 'Foto de perfil eliminada.');
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed', // expects new_password_confirmation
        ]);

        $user = User::find(Auth::id());

        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'La contraseña actual es incorrecta.');
            return;
        }

        $user->forceFill([
            'password' => Hash::make($this->new_password),
        ])->save();

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        session()->flash('message_password', 'Tu contraseña ha sido actualizada exitosamente.');
    }
}
