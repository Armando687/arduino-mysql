<?php
    include('./connection.php');
    $estado;
    $fecha;
    $mysqli->real_query("SELECT estado,fecha FROM bomba_hidraulica ORDER BY id DESC LIMIT 1");
    $resultado = $mysqli->use_result();

    //echo "Orden del conjunto de resultados...\n";
    while ($fila = $resultado->fetch_assoc()) {
        $estado = $fila['estado'];
        $fecha = $fila['fecha'];
    }
    $json = [
        'estado' => $estado,
        'fecha' => $fecha
    ];
    print(json_encode($json));

?>