<?php

namespace App\Livewire\Admin\Pages\Politica;

use App\Models\PagePolitica;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public $item_id;

    // Sección: Pagos
    public $pagos_intro;
    public $pagos_item_1;
    public $pagos_item_2;
    public $pagos_item_3;
    public $pagos_item_4;

    // Sección: Reservaciones
    public $reservaciones_intro;
    public $reservacion_estandar_titulo;
    public $reservacion_estandar_texto;
    public $reservacion_urgente_titulo;
    public $reservacion_urgente_texto;

    // Sección: Entregas
    public $entregas_texto;

    // Sección: Cancelaciones
    public $cancelaciones_texto;

    // Sección: Cuidado
    public $cuidado_texto;

    // Footer
    public $footer_nota;

    protected $rules = [
        'pagos_intro'                   => 'required|string',
        'pagos_item_1'                  => 'required|string|max:500',
        'pagos_item_2'                  => 'required|string|max:500',
        'pagos_item_3'                  => 'required|string|max:500',
        'pagos_item_4'                  => 'required|string|max:500',
        'reservaciones_intro'           => 'required|string',
        'reservacion_estandar_titulo'   => 'required|string|max:255',
        'reservacion_estandar_texto'    => 'required|string',
        'reservacion_urgente_titulo'    => 'required|string|max:255',
        'reservacion_urgente_texto'     => 'required|string',
        'entregas_texto'                => 'required|string',
        'cancelaciones_texto'           => 'required|string',
        'cuidado_texto'                 => 'required|string',
        'footer_nota'                   => 'required|string|max:500',
    ];

    public function mount()
    {
        $page = PagePolitica::first();

        if ($page) {
            $this->item_id = $page->id;

            $this->pagos_intro   = $page->pagos_intro;
            $this->pagos_item_1  = $page->pagos_item_1;
            $this->pagos_item_2  = $page->pagos_item_2;
            $this->pagos_item_3  = $page->pagos_item_3;
            $this->pagos_item_4  = $page->pagos_item_4;

            $this->reservaciones_intro          = $page->reservaciones_intro;
            $this->reservacion_estandar_titulo  = $page->reservacion_estandar_titulo;
            $this->reservacion_estandar_texto   = $page->reservacion_estandar_texto;
            $this->reservacion_urgente_titulo   = $page->reservacion_urgente_titulo;
            $this->reservacion_urgente_texto    = $page->reservacion_urgente_texto;

            $this->entregas_texto      = $page->entregas_texto;
            $this->cancelaciones_texto = $page->cancelaciones_texto;
            $this->cuidado_texto       = $page->cuidado_texto;
            $this->footer_nota         = $page->footer_nota;
        } else {
            // Defaults matching the current hardcoded content
            $this->pagos_intro  = 'En Mia Renta, buscamos facilitar tu experiencia. Las condiciones de pago son las siguientes:';
            $this->pagos_item_1 = 'El pago total del servicio debe realizarse antes o durante la entrega del mobiliario.';
            $this->pagos_item_2 = 'Aceptamos pagos en efectivo y transferencia bancaria.';
            $this->pagos_item_3 = 'Pago con Tarjeta: En caso de requerir pago físico con terminal, es obligatorio avisar con anticipación.';
            $this->pagos_item_4 = 'Pagos en Línea: Deberán efectuarse con al menos 24 horas de antelación.';

            $this->reservaciones_intro          = 'Para garantizar la disponibilidad y puntualidad del servicio, solicitamos:';
            $this->reservacion_estandar_titulo  = 'Anticipación Estándar';
            $this->reservacion_estandar_texto   = 'Realizar su pedido con al menos 1 día de anticipación.';
            $this->reservacion_urgente_titulo   = 'Pedidos Urgentes';
            $this->reservacion_urgente_texto    = 'Sujeto a disponibilidad, mínimo 6 horas antes del evento.';

            $this->entregas_texto      = 'En caso de que el cliente entregue el mobiliario después del día asignado para su recolección, se cobrará automáticamente un día adicional de renta por cada día de retraso.';
            $this->cancelaciones_texto = 'Es importante considerar que no se realizan devoluciones de dinero una vez confirmada la reservación o entregado el servicio.';
            $this->cuidado_texto       = 'El cliente es responsable del equipo. Cualquier daño, mancha irreparable o pérdida será cobrado al valor de reposición actual.';
            $this->footer_nota         = 'Al contratar nuestros servicios, el cliente acepta tácitamente los términos aquí descritos.';
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'pagos_intro'                 => $this->pagos_intro,
            'pagos_item_1'                => $this->pagos_item_1,
            'pagos_item_2'                => $this->pagos_item_2,
            'pagos_item_3'                => $this->pagos_item_3,
            'pagos_item_4'                => $this->pagos_item_4,
            'reservaciones_intro'         => $this->reservaciones_intro,
            'reservacion_estandar_titulo' => $this->reservacion_estandar_titulo,
            'reservacion_estandar_texto'  => $this->reservacion_estandar_texto,
            'reservacion_urgente_titulo'  => $this->reservacion_urgente_titulo,
            'reservacion_urgente_texto'   => $this->reservacion_urgente_texto,
            'entregas_texto'              => $this->entregas_texto,
            'cancelaciones_texto'         => $this->cancelaciones_texto,
            'cuidado_texto'               => $this->cuidado_texto,
            'footer_nota'                 => $this->footer_nota,
        ];

        DB::beginTransaction();
        try {
            $page = PagePolitica::updateOrCreate(
                ['id' => $this->item_id],
                $data
            );

            $this->item_id = $page->id;

            DB::commit();
            session()->flash('message', 'Políticas actualizadas correctamente.');
        } catch (\Throwable $th) {
            DB::rollBack();
            info($th->getMessage());
            session()->flash('error', 'Ocurrió un error al actualizar las políticas.');
        }
    }

    public function render()
    {
        return view('livewire.admin.pages.politica.index');
    }
}
