<?php
  $temperatura_min = $_POST['temperatura_min'];
  $temperatura_max = $_POST['temperatura_max'];
  $temperatura_media = $_POST['temperatura_media'];
  $temperatura_critica = $_POST['temperatura_critica'];
  $mysqli = new mysqli("localhost","admin","admin","db_arduino");
  $sql = "UPDATE configuracion SET temperatura_min = $temperatura_min,temperatura_max = $temperatura_max,temperatura_media = $temperatura_media,temperatura_critica = $temperatura_critica";
  if ($mysqli->query($sql) === TRUE) {
    header ("Location: ../../index.php");
  } else {
        echo "Error updating record: " . $mysqli->error;
    }

$mysqli->close();
?>