<?php

include "visualizador.php";

date_default_timezone_set("America/Guayaquil");
$date = date("Y-m-d H:i:s");

$registrador = new visualizador();

$peso = $_GET['peso'];
$agua = $_GET['agua'];
$micro = $_GET['chipid'];

$registrador->registrar_comida($micro, $peso, $date);
$registrador->registrar_agua($micro, $agua, $date);
