<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ticket de Orden #{{ $alquiler->id }}</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 11px; margin: 0; padding: 0; color: #000; }
        .ticket { width: 100%; text-align: left; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .bold { font-weight: bold; }
        .title { font-size: 16px; margin-bottom: 5px; }
        .divider { border-bottom: 1px dashed #000; margin: 5px 0; }
        .logo { font-size: 18px; font-weight: bold; text-align: center; margin-bottom: 5px; }
        p { margin: 2px 0; }
        table { width: 100%; border-collapse: collapse; margin: 5px 0; }
        th, td { padding: 3px 0; font-size: 11px; text-align: left; vertical-align: top; }
        th { border-bottom: 1px dashed #000; }
        .col-cant { width: 15%; text-align: center; }
        .col-desc { width: 55%; }
        .col-sub  { width: 30%; text-align: right; }
        
        .totals { width: 100%; margin-top: 10px; }
        .totals td { padding: 3px 0; }
        .totals .lbl { width: 60%; text-align: right; padding-right: 10px; }
        .totals .val { width: 40%; text-align: right; }
        
        .footer { text-align: center; margin-top: 10px; font-size: 10px; }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="header text-center">
            <div class="logo">MIA RENTA</div>
            <p class="bold title">TICKET #{{ $alquiler->id }}</p>
            <p>Emisión: {{ now()->format('d/m/Y H:i') }}</p>
            <p>Estatus: {{ $alquiler->status->name ?? 'N/A' }}</p>
        </div>

        <div class="divider"></div>

        <div class="section">
            <p class="bold">CLIENTE</p>
            <p>{{ $alquiler->cliente->persona->nombre ?? '' }} {{ $alquiler->cliente->persona->apellido ?? '' }}</p>
            <p>CEL: {{ $alquiler->cliente->telefonos->first()->telefono ?? 'N/A' }}</p>
        </div>

        <div class="divider"></div>

        <div class="section">
            <p class="bold">DATOS DEL EVENTO</p>
            <p>FECHA: {{ $alquiler->fecha_solicitada ? \Carbon\Carbon::parse($alquiler->fecha_solicitada)->format('d/m/Y H:i') : 'N/A' }}</p>
            <p>RECIBE: {{ $alquiler->recibe }}</p>
            <p>ENTREGA: {{ $alquiler->entrega }}</p>
            <p>DIR: {{ $catalago_cliente->direccion->calle ?? '' }}, {{ $catalago_cliente->direccion->colonia->localidad ?? '' }}</p>
        </div>

        <div class="divider"></div>

        <div class="section">
            <p class="bold">MOBILIARIO</p>
            <table>
                <thead>
                    <tr>
                        <th class="col-cant">CANT</th>
                        <th class="col-desc">DESCRIPCION</th>
                        <th class="col-sub">IMPORTE</th>
                    </tr>
                </thead>
                <tbody>
                    @php $acumulado = 0; @endphp
                    @forelse($alquiler->productos as $item)
                        @php 
                            $sub = $item->cantidad * ($item->catalogoPrecio->precio ?? 0);
                            $acumulado += $sub;
                        @endphp
                        <tr>
                            <td class="col-cant">{{ $item->cantidad }}</td>
                            <td class="col-desc">
                                {{ \Illuminate\Support\Str::limit($item->catalogoPrecio->producto->nombre ?? 'N/A', 20) }}
                                <br><span style="font-size: 9px;">P.U: ${{ number_format($item->catalogoPrecio->precio ?? 0, 2) }}</span>
                            </td>
                            <td class="col-sub">${{ number_format($sub, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Sin mobiliario</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="divider"></div>

        <table class="totals">
            <tr>
                <td class="lbl">SUBTOTAL:</td>
                <td class="val">${{ number_format($acumulado, 2) }}</td>
            </tr>
            <tr>
                <td class="lbl bold">TOTAL ORDEN:</td>
                <td class="val bold">${{ number_format($alquiler->total, 2) }}</td>
            </tr>
            <tr>
                <td class="lbl">ABONADO:</td>
                <td class="val">${{ number_format($alquiler->monto_pagado, 2) }}</td>
            </tr>
            <tr>
                <td class="lbl bold">RESTA:</td>
                <td class="val bold">${{ number_format(max(0, $alquiler->total - $alquiler->monto_pagado), 2) }}</td>
            </tr>
        </table>

        <div class="divider"></div>

        <div class="footer">
            <p>Gracias por su preferencia.</p>
            <p>Documento de control interno de alquileres.</p>
        </div>
    </div>
</body>
</html>
