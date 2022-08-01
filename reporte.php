<?php

include_once 'reportero.php';
header('Content-type: application/json');
$report = new reportero();

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['reporte'])){

    $id_camada = $_GET['id_camada'];
    $id_micro = $_GET['id_micro'];
    $fecha_inicio = $_GET['inicio'];
    $fecha_fin = $_GET['fin'];

    $parametros = array();

    $respc = $report->obtener_periodo_comedero($id_micro,$fecha_inicio, $fecha_fin);
    $respb = $report->obtener_periodo_bebedero($id_micro, $fecha_inicio, $fecha_fin);
    $respt = $report->obtener_periodo_temperatura($fecha_inicio, $fecha_fin);
    $respca = $report->obtener_camada($id_camada);

    $comida_total = 0;
    $bebida_total = 0;
    $temp_prom = 0;
    $hum_prom = 0;
    $registro_th = 0;
    $pollos_vivos = 0;
    $pollos_muertos = 0;

    $metroscubicos = 69120;

    if ($respc->rowCount()){
        while ($row = $respc->fetch(PDO::FETCH_ASSOC)) {
                $comida_total = $comida_total + $row['peso'];
        }
    }else {
        $comida_total = 0;
    }

    if ($respb->rowCount()){
        $total_encendidas = 0;
        while ($row = $respb->fetch(PDO::FETCH_ASSOC)) {
            if ($row['estado'] == '1'){
                $total_encendidas = $total_encendidas + 1;
            }
        }
        $bebida_total = $metroscubicos * $total_encendidas;
    }else {
        $bebida_total = 0;
    }

    if ($respt->rowCount()){
        $temp_sum = 0;
        $hum_sum = 0;
        while ($row = $respt->fetch(PDO::FETCH_ASSOC)) {
                $temp_sum = $temp_sum + $row['temperatura_promedio'];
                 $hum_sum= $hum_sum + $row['humedad_promedio'];
                 $registro_th = $registro_th + 1;
        }
        $temp_prom = $temp_sum / $registro_th;
        $hum_prom = $hum_sum / $registro_th;
    }else {
        $temp_prom = 0;
        $hum_prom = 0;
    }

    if ($respca->rowCount()){
        while ($row = $respca->fetch(PDO::FETCH_ASSOC)) {
                $pollos_vivos =  $row['cantidad_final'];
                $pollos_muertos = $row['cantidad_final']  - $row['cantidad_inicial'];
        }
    }else {
        $pollos_vivos = 0;
        $pollos_muertos = 0;
    }

    $item = array(
        'peso' => intval(abs($comida_total)),
        'litro' => $bebida_total,
        'temp' => intval($temp_prom),
        'hum' => intval($hum_prom),
        'vivos' => $pollos_vivos,
        'muertos' => abs($pollos_muertos)
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
?>