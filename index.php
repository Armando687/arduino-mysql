<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./src/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <title>Home-COM460</title>
</head>
<body>
    <h1>Home</h1>
    <table >
        <tr>
            <th class="title" colspan="2" >Temperatura</th>
        </tr>
        <tr>
            <th class="subtitle">Accion</th>
            <th class="subtitle">Estado</th>
        </tr>
        <tr>    
            <td class="title-content">Temperatura Promedio</td>
            <td  class="content" id = "temperatura">12</td>
        </tr>
        <tr>    
            <td class="title-content" >Humedad Promedio</td>
            <td class="content" id = "humedad">30</td>
        </tr>
        <tr>    
            <td class="title-content">Fecha de Registro </td>
            <td class="content" id = "fecha">2019-06-30</td>
        </tr>
        <tr>    
            <th class="subtitle" colspan="2" >Conexion electrica</th>
        </tr>
        <tr>
            <td class="title-content" >Estado</td>
            <td class="content"  id="estadoLed">..........</td>
        </tr>
        <tr>    
            <th  class="subtitle" colspan="2">Calefacción</th>
        </tr>
        <tr>
            <td class="title-content">Estado</td>
            <td class="content" id="estadoVt">-------</td>
        </tr>
        <tr>    
            <th  class="subtitle" colspan="2">Extintores</th>
        </tr>
        <tr>
            <td class="title-content">Estado</td>
            <td class="content" id="estadoMt">..........</td>
        </tr>
    </table>
    <button><a href="./src/php/config.php">Configuraciones</a></button>

    <script src="./src/js/dht.js"></script>
    <script src="./src/js/led.js"></script>
    <script src="./src/js/ventilador.js"></script>
    <script src="./src/js/extintor.js"></script>
</body>
</html>