<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    //
    public function home()
    {
        $section = 1;
        return view('pages.dashboard', compact('section'));
    }

    public function ubicanos()
    {
        $section = 2;
        return view('pages.dashboard', compact('section'));
    }
    public function lista()
    {
        $section = 3;
        return view('pages.dashboard', compact('section'));
    }
    public function orden()
    {
        $section = 4;
        return view('pages.dashboard', compact('section'));
    }
    public function nosotros()
    {
        $section = 5;
        return view('pages.dashboard', compact('section'));
    }
    public function politica()
    {
        $section = 6;
        return view('pages.dashboard', compact('section'));
    }
    public function reclamacion()
    {
        $section = 7;
        return view('pages.dashboard', compact('section'));
    }
    public function factura()
    {
        $section = 8;
        return view('pages.dashboard', compact('section'));
    }
    public function ticket($id)
    {
        $alquiler = \App\Models\Alquiler::with([
            'cliente.persona',
            'cliente.telefonos',
            'status',
            'productos.catalogoPrecio.producto',
            'metodoPago'
        ])->findOrFail($id);

        $catalago_cliente = \App\Models\CatalagoCliente::with('direccion.colonia')
            ->find($alquiler->direcciónes_clientes_id);

        $html = view('livewire.admin.order.ticket', [
            'alquiler' => $alquiler,
            'catalago_cliente' => $catalago_cliente
        ])->render();

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);

        // 58mm = ~164.41 points. Long height for thermal roll.
        $customPaper = array(0, 0, 164.41, 841.89);
        $dompdf->setPaper($customPaper);

        $dompdf->render();

        return response($dompdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="Ticket_Orden_' . $alquiler->id . '.pdf"');
    }

    public function noencontrado()
    {
        $section = 0;
        return view('pages.dashboard', compact('section'));
    }
}
