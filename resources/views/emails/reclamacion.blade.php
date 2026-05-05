<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { padding: 20px; max-width: 600px; margin: 0 auto; background-color: #f9f9f9; border-radius: 8px; border: 1px solid #eee; }
        .header { font-size: 20px; font-weight: bold; margin-bottom: 20px; color: #dc2626; border-bottom: 2px solid #dc2626; padding-bottom: 10px; }
        .item { margin-bottom: 10px; }
        .label { font-weight: bold; color: #555; }
        .message-box { background-color: #fff; padding: 15px; border-radius: 4px; border: 1px solid #ddd; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            Nueva {{ $data['asunto'] }}
        </div>

        <p>Se ha recibido un nuevo registro desde el formulario de Libro de Reclamaciones:</p>

        <div class="item"><span class="label">Nombre:</span> {{ $data['nombre'] }}</div>
        <div class="item"><span class="label">Email:</span> {{ $data['email'] }}</div>
        <div class="item"><span class="label">Teléfono:</span> {{ $data['telefono'] }}</div>
        
        @if(!empty($data['pedido']))
        <div class="item"><span class="label">Pedido relacionado:</span> {{ $data['pedido'] }}</div>
        @endif

        <div class="item"><span class="label">Tipo/Asunto:</span> {{ $data['asunto'] }}</div>
        
        <div class="item">
            <span class="label">Detalle/Mensaje:</span>
            <div class="message-box">
                {!! nl2br(e($data['mensaje'])) !!}
            </div>
        </div>

        @if(!empty($data['tiene_evidencia']))
        <p style="margin-top: 30px; font-style: italic; color: #666;">
            Se ha adjuntado evidencia a este correo.
        </p>
        @endif
    </div>
</body>
</html>
