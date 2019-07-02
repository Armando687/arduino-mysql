<?php
    include('./connection.php');
    $temperatura;
    $humedad;
    $fecha;
    $mysqli->real_query("SELECT id,temperatura,humedad,fecha FROM temperatura_humedad ORDER BY id DESC LIMIT 1");
    $resultado = $mysqli->use_result();

    //echo "Orden del conjunto de resultados...\n";
    while ($fila = $resultado->fetch_assoc()) {
        $temperatura = $fila['temperatura'];
        $humedad = $fila['humedad'];
        $fecha = $fila['fecha'];
    }
    $json = [
        'temperatura' => $temperatura,
        'humedad' => $humedad,
        'fecha' => $fecha
    ];
    print(json_encode($json));

?>