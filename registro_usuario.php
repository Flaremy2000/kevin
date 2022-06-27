<?php

include_once 'usuario.php';
date_default_timezone_set("America/Guayaquil");
header('Content-type: application/json');
$usuario = new usuario();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['cedula'])){
    $cedula = $_GET['cedula'];
    $nombre = $_GET['nombre'];
    $apellido = $_GET['apellido'];
    $nacimiento = $_GET['cumple'];
    $contrasenia = password_hash($_GET['contrasena'], PASSWORD_DEFAULT);
    $cargo = $_GET['cargo'];

    $resp = $usuario->registrar_usuario($cedula, $nombre, $apellido, $nacimiento, $contrasenia, $cargo);

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