<?php

include_once "visualizador.php";
date_default_timezone_set("America/Guayaquil");
$date = date("Y-m-d H:i:s");
header('Content-type: application/json');

$visual = new visualizador();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['micro'])){

    $micro =$_GET['micro'];

    $parametros = array();
    $tem = $visual->obtener_temperatura();
    $comi = $visual->obtener_comida($micro);
    $beb = $visual->obtener_agua($micro);

    $temperatura = 0;
    $comida = 0;
    $bebida = 0;
    if ($tem->rowCount()){
        while ($row = $tem->fetch(PDO::FETCH_ASSOC)){
                $temperatura = $row['temperatura_promedio'];
        }
    }else{
        $temperatura = 0;
    }

    if ($comi->rowCount()){
        while ($row = $comi->fetch(PDO::FETCH_ASSOC)){
                $comida = $row['peso'];
        }
    }else{
        $comida = 0;
    }

    if ($beb->rowCount()){
        while ($row = $beb->fetch(PDO::FETCH_ASSOC)){
                $bebida= $row['estado'];
        }
    }else{
        $bebida = 0;
    }
    $item = array(
        'temperatura' => $temperatura,
        'comida' => $comida,
        'bebida' => $bebida
    );

    array_push($parametros, $item);

    printJSON($parametros);
}

function error($mensaje){
    print_r(json_encode(array('mensaje' => $mensaje)));
}

function printJSON($array){
    print_r(json_encode($array));
}