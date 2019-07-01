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
    <table >
        <tr>
            <th colspan="2" >Temperatura</th>
        </tr>
        <tr>
            <th>Accion</th>
            <th>Estado</th>
        </tr>
        <tr>    
            <td>Temperatura Promedio</td>
            <td id = "temperatura">12</td>
        </tr>
        <tr>    
            <td>Humedad Promedio</td>
            <td id = "humedad">30</td>
        </tr>
        <tr>    
            <td>Fecha de Registro </td>
            <td id = "fecha">2019-06-30</td>
        </tr>
        <tr>    
            <th colspan="2" >Conexion electrica</th>
        </tr>
        <tr>
            <td>Estado</td>
            <td id="estadoLed">..........</td>
        </tr>
        <tr>    
            <th colspan="2">Calefacción</th>
        </tr>
        <tr>
            <td>Estado</td>
            <td id="estadoVt">-------</td>
        </tr>
        <tr>    
            <th colspan="2">Extintores</th>
        </tr>
        <tr>
            <td>Estado</td>
            <td id="estadoMt">..........</td>
        </tr>
    </table>
    <!-- <script type="text/javascript">
     $.getJSON('http://localhost/arduino-mysql/src/php/dht.php',function(datos){
        //  $.each(datos,function(i,value){
        //      console.log(i + " " + value );
        //  });
        console.log(datos.temperatura);
     });
    </script> -->
    <script src="./src/js/dht.js"></script>
    <script src="./src/js/led.js"></script>
    <script src="./src/js/ventilador.js"></script>
    <script src="./src/js/extintor.js"></script>
</body>
</html>