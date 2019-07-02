<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
<h1>Configuraciones :</h1>
<form action="saveconfig.php" method="post">
    <label for="">temperatura_min</label> <br>
    <input type="text" name="temperatura_min" id="temperatura_min" value="<?= $temperatura_min?>" ><br>
    <label for="">temperatura_max</label><br>
    <input type="text" name="temperatura_max" id="temperatura_max" value="<?= $temperatura_max?>" ><br>
    <label for="">temperatura_media</label><br>
    <input type="text" name="temperatura_media" id="temperatura_media" value="<?= $temperatura_media?>" ><br>
    <label for="">temperatura_critica</label><br>
    <input type="text" name="temperatura_critica" id="temperatura_critica" value="<?= $temperatura_critica?>" ><br>
    <button><a href="../../index.php">Cancelar</a></button>
    <input type="submit" value="Guardar">
</form>
    
</body>
</html>