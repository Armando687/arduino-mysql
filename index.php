<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./src/css/style.css?v=1.0.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Home-COM460</title>
</head>

<body class="">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-8 main-container">
                <h3 class="text-center text-dark title">Control de Temperatura</h3>
                <table class="table table-striped table-hover table-bordered">
                    <tr class="bg-info">
                        <th class="subtitle">
                            <span>Accion</span>
                        </th>
                        <th class="subtitle">
                            <span>Estado</span>
                        </th>
                    </tr>
                    <tr>
                        <td class="title-content">Temperatura Promedio</td>
                        <td class="content" id="temperatura">12</td>
                    </tr>
                    <tr>
                        <td class="title-content">Humedad Promedio</td>
                        <td class="content" id="humedad">30</td>
                    </tr>
                    <tr>
                        <td class="title-content">Fecha de Registro </td>
                        <td class="content" id="fecha">2019-06-30</td>
                    </tr>
                    <tr>
                        <th class="subtitle text-center bg-info" colspan="2">Conexion electrica</th>
                    </tr>
                    <tr>
                        <td class="title-content">Estado</td>
                        <td class="content" id="estadoLed">..........</td>
                    </tr>
                    <tr>
                        <th class="subtitle text-center bg-info" colspan="2">Calefacción</th>
                    </tr>
                    <tr>
                        <td class="title-content">Estado</td>
                        <td class="content" id="estadoVt">-------</td>
                    </tr>
                    <tr>
                        <th class="subtitle text-center bg-info" colspan="2">Extintores</th>
                    </tr>
                    <tr>
                        <td class="title-content">Estado</td>
                        <td class="content" id="estadoMt">..........</td>
                    </tr>
                </table>
                <a class="btn btn-info float-right" href="./src/php/config.php">Configuraciones</a>
            </div>

        </div>

    </div>


    <script src="./src/js/dht.js"></script>
    <script src="./src/js/led.js"></script>
    <script src="./src/js/ventilador.js"></script>
    <script src="./src/js/extintor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>