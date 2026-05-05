<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ticket de Orden #{{ $alquiler->id }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 9px;
            margin: 0;
            padding: 0;
            color: #000;
            line-height: 1.2;
        }

        .ticket {
            width: 100%;
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .bold {
            font-weight: bold;
        }

        .title {
            font-size: 12px;
            margin-bottom: 3px;
        }

        .divider {
            border-bottom: 1px dashed #000;
            margin: 4px 0;
        }

        .logo {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 3px;
        }

        p {
            margin: 1px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 4px 0;
        }

        th,
        td {
            padding: 2px 0;
            font-size: 9px;
            text-align: left;
            vertical-align: top;
        }

        th {
            border-bottom: 1px dashed #000;
        }

        .col-cant {
            width: 12%;
            text-align: center;
        }

        .col-desc {
            width: 53%;
        }

        .col-sub {
            width: 35%;
            text-align: right;
        }

        .totals {
            width: 100%;
            margin-top: 6px;
        }

        .totals td {
            padding: 2px 0;
            font-size: 9px;
        }

        .totals .lbl {
            width: 55%;
            text-align: right;
            padding-right: 5px;
        }

        .totals .val {
            width: 45%;
            text-align: right;
        }

        .footer {
            text-align: center;
            margin-top: 8px;
            font-size: 8px;
        }
    </style>
</head>

<body>
    <div class="ticket">
        <div class="header text-center">
            @php
                $logo_path = storage_path('app/public/Login/logo.jpeg');
                $logo_base64 = '';
                if (file_exists($logo_path)) {
                    $logo_data = file_get_contents($logo_path);
                    $logo_base64 = 'data:image/jpeg;base64,' . base64_encode($logo_data);
                }
            @endphp

            @if ($logo_base64)
                <div style="text-align: center; margin-bottom: 10px;">
                    <img src="{{ $logo_base64 }}" alt="Logo" style="max-height: 70px; max-width: 100%;">
                </div>
            @else
                <div class="logo">MIA RENTA</div>
            @endif

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
            <p>FECHA:
                {{ $alquiler->fecha_solicitada ? \Carbon\Carbon::parse($alquiler->fecha_solicitada)->format('d/m/Y H:i') : 'N/A' }}
            </p>
            <p>RECIBE: {{ $alquiler->recibe }}</p>
            <p>ENTREGA: {{ $alquiler->entrega }}</p>
            <p>DIR: {{ $catalago_cliente->direccion->calle ?? '' }},
                {{ $catalago_cliente->direccion->colonia->localidad ?? '' }}</p>
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
                    @php
                        $dias_alquiler = 1;
                        if ($alquiler && $alquiler->fecha_entrega && $alquiler->fecha_recepcion) {
                            try {
                                $f_inicio = \Carbon\Carbon::parse($alquiler->fecha_entrega)->startOfDay();
                                $f_fin = \Carbon\Carbon::parse($alquiler->fecha_recepcion)->startOfDay();
                                if (!$f_fin->lt($f_inicio)) {
                                    $dias_diff = $f_inicio->diffInDays($f_fin);
                                    $dias_alquiler = $dias_diff == 0 ? 1 : $dias_diff;
                                }
                            } catch (\Exception $e) {
                            }
                        }
                        $acumulado = 0;
                    @endphp
                    @forelse($alquiler->productos as $item)
                        @php
                            $sub = $item->cantidad * ($item->catalogoPrecio->precio ?? 0) * $dias_alquiler;
                            $acumulado += $sub;
                        @endphp
                        <tr>
                            <td class="col-cant">{{ $item->cantidad }}</td>
                            <td class="col-desc">
                                {{ \Illuminate\Support\Str::limit($item->catalogoPrecio->producto->nombre ?? 'N/A', 15) }}
                                <br><span style="font-size: 7px;">P.U:
                                    ${{ number_format($item->catalogoPrecio->precio ?? 0, 2) }}
                                    {{ $dias_alquiler > 0 ? ' x ' . $dias_alquiler . 'd' : '' }}</span>
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
            @php
                $costos_adicionales = $alquiler->costos_adicionales ? json_decode($alquiler->costos_adicionales, true) : [];
            @endphp
            @if(is_array($costos_adicionales) && count($costos_adicionales) > 0)
                @foreach($costos_adicionales as $costo)
                    <tr>
                        <td class="lbl">EXTRA ({{ $costo['concepto'] ?? 'Costo' }}):</td>
                        <td class="val">${{ number_format((float)($costo['monto'] ?? 0), 2) }}</td>
                    </tr>
                @endforeach
            @endif
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

            @php
                $telefonoAtencion = \App\Models\PageDetalleContacto::where('contacto_data_tipo_id', 10)->first()->recurso ?? null;
                $correoAtencion = \App\Models\PageDetalleContacto::where('contacto_data_tipo_id', 8)->first()->recurso ?? null;
            @endphp

            @if($telefonoAtencion || $correoAtencion)
                <div style="margin-top: 5px; margin-bottom: 5px;">
                    <p class="bold">Atención a Clientes</p>
                    @if($telefonoAtencion)<p>Tel: {{ $telefonoAtencion }}</p>@endif
                    @if($correoAtencion)<p>Correo: {{ $correoAtencion }}</p>@endif
                </div>
            @endif
            <div style="margin-top: 8px;">
                <p style="font-weight: bold; margin-bottom: 2px;">Si de sea generar factura, escanee el código QR</p>
                <img src="data:image/png;base64,{{ \DNS2D::getBarcodePNG(route('factura'), 'QRCODE', 3, 3) }}"
                    alt="QR Factura" />
            </div>
        </div>
    </div>
</body>

</html>
