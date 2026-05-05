<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { padding: 20px; max-width: 600px; margin: 0 auto; background-color: #f9f9f9; border-radius: 8px; border: 1px solid #eee; }
        .header { font-size: 20px; font-weight: bold; margin-bottom: 20px; color: #dc2626; border-bottom: 2px solid #dc2626; padding-bottom: 10px; }
        .item { margin-bottom: 10px; }
        .label { font-weight: bold; color: #555; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            Nueva Solicitud de Factura
        </div>

        <p>Se ha recibido una nueva solicitud de factura con los siguientes datos:</p>

        <div class="item"><span class="label">Número de Ticket:</span> {{ $facturaSolicitada->numero_ticket }}</div>
        <div class="item"><span class="label">RFC:</span> {{ $facturaSolicitada->rfc }}</div>
        <div class="item"><span class="label">Razón Social:</span> {{ $facturaSolicitada->razon_social }}</div>
        <div class="item"><span class="label">Régimen Fiscal:</span> {{ $facturaSolicitada->regimen }}</div>
        <div class="item"><span class="label">Uso de CFDI:</span> {{ $facturaSolicitada->uso_cfdi }}</div>
        <div class="item"><span class="label">C.P. Fiscal:</span> {{ $facturaSolicitada->cp }}</div>
        <div class="item"><span class="label">Email para envío:</span> {{ $facturaSolicitada->email }}</div>

        <p style="margin-top: 30px;">
            Los archivos de <strong>Constancia de Situación Fiscal</strong> y <strong>Nota / Ticket de Renta</strong> han sido adjuntados a este correo.
        </p>
    </div>
</body>
</html>
