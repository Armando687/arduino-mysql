<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Configuraciones</title>
</head>

<body>
    <?php
    include('./connection.php');
    $temperatura_min;
    $temperatura_max;
    $temperatura_media;
    $temperatura_critica;
    $mysqli->real_query("SELECT * FROM configuracion");
    $resultado = $mysqli->use_result();
    while ($fila = $resultado->fetch_assoc()) {
        $temperatura_min = $fila['temperatura_min'];
        $temperatura_max = $fila['temperatura_max'];
        $temperatura_media = $fila['temperatura_media'];
        $temperatura_critica = $fila['temperatura_critica'];
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-8 main-container">
                <h3 class="text-center text-dark title">Configuraciones</h3>
                <form action="saveconfig.php" method="post">
                    <div class="form-group">
                        <label for="">Temperatura Minima:</label>
                        <br>
                        <input class="form-control" type="text" name="temperatura_min" id="temperatura_min" value="<?= $temperatura_min ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Temperatura Maxima:</label><br>
                        <input class="form-control" type="text" name="temperatura_max" id="temperatura_max" value="<?= $temperatura_max ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Temperatura Media:</label><br>
                        <input class="form-control" type="text" name="temperatura_media" id="temperatura_media" value="<?= $temperatura_media ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Temperatura Critica:</label><br>
                        <input class="form-control" type="text" name="temperatura_critica" id="temperatura_critica" value="<?= $temperatura_critica ?>">
                    </div>
                    <div class="actions float-right">
                        <a class="btn btn-secondary" href="../../index.php">Cancelar</a>
                        <button type="submit" class="btn btn-info">Guardar</button>
                        <!-- <input class="btn btn-info" type="submit" value="Guardar"> -->
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>