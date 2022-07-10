<?php

include_once "visualizador.php";
$visual = new visualizador();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['config'])){

    $conf = $visual->obtener_configuracion();

    $tem_max = 0;
    $tem_min = 0;
    $peso_max = 0;
    $peso_min = 0;

    if ($conf->rowCount()){
        while ($row = $conf->fetch(PDO::FETCH_ASSOC)){
            $tem_max = $row['temp_max'];
            $tem_min = $row['temp_min'];
            $peso_max = $row['peso_max'];
            $peso_min = $row['peso_min'];
        }
    }
    echo $tem_max.",".$tem_min.",".$peso_max.",".$peso_min;
}
