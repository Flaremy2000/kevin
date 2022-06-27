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
    $ilum = $visual->obtener_iluminacion();

    $temperatura = 0;
    $comida = 0;
    $bebida = 0;
    $ventilador = 0;
    $luz = 0;
    $humedad = 0;
    $luz_il = 0;

    if ($ilum->rowCount()){
        while ($row = $ilum->fetch(PDO::FETCH_ASSOC)){
            $luz_il = $row['estado_luz'];

        }
    }else{
        $luz_il = 0;
    }

    if ($tem->rowCount()){
        while ($row = $tem->fetch(PDO::FETCH_ASSOC)){
                $temperatura = $row['temperatura_promedio'];
                $humedad = $row['humedad_promedio'];
                $ventilador = $row['estado_ventilador'];
                $luz = $row['estado_luz'];

        }
    }else{
        $temperatura = 0;
        $humedad = 0;
        $ventilador =0;
        $luz=0;
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
        'bebida' => $bebida,
        'ventilador' => $ventilador,
        'luz_calor' => $luz,
        'humedad' => $humedad,
        'luz_ilum' => $luz_il
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