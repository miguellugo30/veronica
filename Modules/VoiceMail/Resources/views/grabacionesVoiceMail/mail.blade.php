<!doctype html>
<html lang="es">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Grabación de buzón de voz</title>
</head>
<body>
    <p>Hola! Se ha enviado una grabación desde la plataforma.</p>
    <p>Estos son los datos de la grabación:</p>
    <ul>
        <li>Nombre buzón: {{ $grabacion->buzon }}</li>
        <li>Fecha: {{ date('d-m-Y',strtotime($grabacion->fecha_inicio)) }}</li>
        <li>Numero: {{ $grabacion->callerid }}</li>
    </ul>
</body>
</html>
