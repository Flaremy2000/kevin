<?php

include "visualizador.php";

date_default_timezone_set("America/Guayaquil");
$date = date("Y-m-d H:i:s");

$registrador = new visualizador();

$temp_max = 0;
$temp_min = 0;
$ventilador = 0;
$luces = 0;
$c = $registrador->configuracion_temperatura();


if($c->rowCount()){
    while($row = $c->fetch(PDO::FETCH_ASSOC)){
        $temp_max = $row['temp_max'];
        $temp_min = $row['temp_min'];
        $ventilador = $row['ventiladores'];
        $luces = $row['luces'];
    }
}

echo "v=".$temp_max.",".$temp_min.",".$ventilador.",".$luces;

$temp1 = $_GET['tempp'];
$hum1 = $_GET['hump'];
$vent = $_GET['vent'];
$luz = $_GET['luces'];


$registrador->registrar_temperatura($temp1, $hum1, $vent, $luz, $date);



?>