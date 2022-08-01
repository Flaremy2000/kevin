<?php



include "visualizador.php";



date_default_timezone_set("America/Guayaquil");

$date = date("Y-m-d H:i:s");



$registrador = new visualizador();

$ventilador = 0;

$luces = 0;

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['luz'])){

    $c = $registrador->configuracion_temperatura();


    if($c->rowCount()){

        while($row = $c->fetch(PDO::FETCH_ASSOC)){
            $luces = $row['luces'];
        }

        if ($luces == '1'){
            $registrador->editar_luces(0);
        }elseif ($luces == '0'){
            $registrador->editar_luces(1);
        }

    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['ventilador'])){

    $c = $registrador->configuracion_temperatura();


    if($c->rowCount()){

        while($row = $c->fetch(PDO::FETCH_ASSOC)){
            $ventilador = $row['vent'];
        }

        if ($ventilador == '1'){
            $registrador->editar_ventiladores(0);
        }elseif ($ventilador == '0'){
            $registrador->editar_ventiladores(1);
        }

    }
}