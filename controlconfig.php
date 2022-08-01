<?php

include "visualizador.php";



date_default_timezone_set("America/Guayaquil");

$date = date("Y-m-d H:i:s");



$registrador = new visualizador();

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['config'])){
    $parametros = array();

$tem = $registrador->configuracion_temperatura();
$conf = $registrador->obtener_configuracion();

$peso_max = 0;
$peso_min = 0;
$temp_max = 0;
$temp_min = 0;

if ($conf->rowCount()){
    while ($row = $conf->fetch(PDO::FETCH_ASSOC)){
        $peso_max = $row['peso_max'];
        $peso_min = $row['peso_min'];
    }
}else{
    $peso_max = 0;
    $peso_min = 0;
}

if($tem->rowCount()){
    while($row = $tem->fetch(PDO::FETCH_ASSOC)){
        $temp_max = $row['temp_max'];
        $temp_min = $row['temp_min'];
    }
}else{
    $temp_max = 0;
    $temp_min = 0;
}
    $item = array(
        'tempmax' =>$temp_max,
        'tempmin' => $temp_min,
        'pesomax' => $peso_max,
        'pesomin' => $peso_min
    );
    array_push($parametros, $item);

    printJSON($parametros);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['save'])){
    $pesomax = $_GET['pesomax'];
    $pesomin = $_GET['pesomin'];
    $tempmax = $_GET['tempmax'];
    $temmin = $_GET['tempmin'];
    $estadot = 0;
    $estadop = 0;

    $resptem = $registrador->editartemp($tempmax, $temmin);

    if ($resptem){
        $estadot = 1;
    }else {
        $estadot = 0;
    }

    $respconf = $registrador->editarconfig($pesomax, $pesomin);
    if ($respconf){
        $estadop = 1;
    }else {
        $estadop = 0;
    }

    if ($estadop = 1 && $estadot = 1){
        error("1");
    }else{
        error("0");
    }

}


function error($mensaje){
    print_r(json_encode(array('mensaje' => $mensaje)));
}

function printJSON($array){
    print_r(json_encode($array));
}
