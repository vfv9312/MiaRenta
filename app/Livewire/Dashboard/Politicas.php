<?php

namespace App\Livewire\Dashboard;

use App\Models\PagePolitica;
use Livewire\Component;

class Politicas extends Component
{
    public $pagos_intro;
    public $pagos_item_1;
    public $pagos_item_2;
    public $pagos_item_3;
    public $pagos_item_4;

    public $reservaciones_intro;
    public $reservacion_estandar_titulo;
    public $reservacion_estandar_texto;
    public $reservacion_urgente_titulo;
    public $reservacion_urgente_texto;

    public $entregas_texto;
    public $cancelaciones_texto;
    public $cuidado_texto;
    public $footer_nota;

    public function mount()
    {
        $page = PagePolitica::first();

        $this->pagos_intro  = $page->pagos_intro  ?? 'En Mia Renta, buscamos facilitar tu experiencia. Las condiciones de pago son las siguientes:';
        $this->pagos_item_1 = $page->pagos_item_1 ?? 'El pago total del servicio debe realizarse antes o durante la entrega del mobiliario.';
        $this->pagos_item_2 = $page->pagos_item_2 ?? 'Aceptamos pagos en efectivo y transferencia bancaria.';
        $this->pagos_item_3 = $page->pagos_item_3 ?? 'Pago con Tarjeta: En caso de requerir pago físico con terminal, es obligatorio avisar con anticipación.';
        $this->pagos_item_4 = $page->pagos_item_4 ?? 'Pagos en Línea: Deberán efectuarse con al menos 24 horas de antelación.';

        $this->reservaciones_intro          = $page->reservaciones_intro          ?? 'Para garantizar la disponibilidad y puntualidad del servicio, solicitamos:';
        $this->reservacion_estandar_titulo  = $page->reservacion_estandar_titulo  ?? 'Anticipación Estándar';
        $this->reservacion_estandar_texto   = $page->reservacion_estandar_texto   ?? 'Realizar su pedido con al menos 1 día de anticipación.';
        $this->reservacion_urgente_titulo   = $page->reservacion_urgente_titulo   ?? 'Pedidos Urgentes';
        $this->reservacion_urgente_texto    = $page->reservacion_urgente_texto    ?? 'Sujeto a disponibilidad, mínimo 6 horas antes del evento.';

        $this->entregas_texto      = $page->entregas_texto      ?? 'En caso de que el cliente entregue el mobiliario después del día asignado para su recolección, se cobrará automáticamente un día adicional de renta por cada día de retraso.';
        $this->cancelaciones_texto = $page->cancelaciones_texto ?? 'Es importante considerar que no se realizan devoluciones de dinero una vez confirmada la reservación o entregado el servicio.';
        $this->cuidado_texto       = $page->cuidado_texto       ?? 'El cliente es responsable del equipo. Cualquier daño, mancha irreparable o pérdida será cobrado al valor de reposición actual.';
        $this->footer_nota         = $page->footer_nota         ?? 'Al contratar nuestros servicios, el cliente acepta tácitamente los términos aquí descritos.';
    }

    public function render()
    {
        return view('livewire.dashboard.politicas');
    }
}
