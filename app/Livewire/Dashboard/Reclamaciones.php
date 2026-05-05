<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReclamacionMail;

class Reclamaciones extends Component
{
    use WithFileUploads;

    public $nombre;
    public $email;
    public $telefono;
    public $pedido;
    public $asunto = 'Queja';
    public $mensaje;
    public $evidencia;

    protected $rules = [
        'nombre'   => 'required|string|max:255',
        'email'    => 'required|email|max:255',
        'telefono' => 'required|string|max:20',
        'pedido'   => 'nullable|string|max:255',
        'asunto'   => 'required|string',
        'mensaje'  => 'required|string',
        'evidencia'=> 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
    ];

    public function save()
    {
        $this->validate();

        $evidenciaPath = null;
        $evidenciaName = null;

        if ($this->evidencia) {
            $evidenciaPath = $this->evidencia->store('reclamaciones', 'public');
            $evidenciaName = $this->evidencia->getClientOriginalName();
        }

        $data = [
            'nombre'   => $this->nombre,
            'email'    => $this->email,
            'telefono' => $this->telefono,
            'pedido'   => $this->pedido,
            'asunto'   => $this->asunto,
            'mensaje'  => $this->mensaje,
            'tiene_evidencia' => $evidenciaPath ? true : false,
        ];

        $adminEmail = DB::table('_detalles_contacto')
            ->where('contacto_data_tipo_id', 7)
            ->value('recurso');

        if ($adminEmail) {
            Mail::to($adminEmail)->send(new ReclamacionMail($data, $evidenciaPath, $evidenciaName));
        }

        $this->reset(['nombre', 'email', 'telefono', 'pedido', 'asunto', 'mensaje', 'evidencia']);
        
        session()->flash('success', 'Tu solicitud ha sido enviada con éxito. Nuestro equipo la revisará y se pondrá en contacto pronto.');
    }

    public function render()
    {
        return view('livewire.dashboard.reclamaciones');
    }
}
