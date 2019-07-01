<?php
    $estado;
    $fecha;
	$mysqli = new mysqli("localhost","admin","admin","db_arduino");

    $mysqli->real_query("SELECT estado,fecha FROM conexion_electrica");
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