<?php

include_once 'camadas.php';
date_default_timezone_set("America/Guayaquil");
header('Content-type: application/json');
$camada = new camadas();
$date = date("Y-m-d H:i:s");

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['camadas'])){

    $camadas = array();

    $resp = $camada->lista_bandada();

    if ($resp->rowCount()){
        while ($row = $resp->fetch(PDO::FETCH_ASSOC)) {
            $item = array(
                'id' => $row['Id_camada'],
                'nombre' => $row['nombre'],
                'inicial' => $row['cantidad_inicial'],
                'final' => $row['cantidad_final'],
                'fecha' => $row['fecha']
            );
            array_push($camadas, $item);
        }
        printJSON($camadas);
    }else {
        error("0");
    }

}


if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['bandada'])){

    $camadas = array();
    $id = $_GET['id'];

    $resp = $camada->obtener_bandada($id);

    if ($resp->rowCount()){
        while ($row = $resp->fetch(PDO::FETCH_ASSOC)) {
            $item = array(
                'id' => $row['Id_camada'],
                'final' => $row['cantidad_final']
            );
            array_push($camadas, $item);
        }
        printJSON($camadas);
    }else {
        error("0");
    }

}


if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['camada'])){
    $nombre = $_GET['nombre'];
    $cantidad_inicial = $_GET['inicial'];

    $resp = $camada->nueva_camada($nombre, $cantidad_inicial, $date);

    if ($resp){
        error("1");
    }else {
        error("0");
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['banda'])){
    $id = $_GET['id'];
    $actual = $_GET['actual'];

    $resp = $camada->editar_actual($id, $actual);

    if ($resp){
        error("1");
    }else {
        error("0");
    }
}

function error($mensaje){
    print_r(json_encode(array('mensaje' => $mensaje)));
}

function printJSON($array){
    print_r(json_encode($array));
}
?>