<?php

include_once "min.php";

header('Content-type: application/json');
$mi = new min();
// Se retoma la informacion del usuario y se procesa el acceso a sus datos
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['micros'])){
    $micros = array();
    $resp = $mi->obtener_micros();

    if($resp->rowCount()){
        while ($row = $resp->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    'id' => $row['Id_micro'],
                    'nombre' => $row['Nombre']
                );
                array_push($micros, $item);
        }
        printJSON($micros);
    }else{
        error("0"); // No hay microcontroladores
    }
}

function error($mensaje){
    print_r(json_encode(array('mensaje' => $mensaje)));
}

function printJSON($array){
    print_r(json_encode($array));
}

?>