<?php

include_once "usuario.php";
date_default_timezone_set("America/Guayaquil");
$date = date("Y-m-d H:i:s");
header('Content-type: application/json');
$user = new usuario();
// Se retoma la informacion del usuario y se procesa el acceso a sus datos
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['loguin'])){

    $ced = $_GET['user'];
    $pass = $_GET['pass'];

    $usuario = array();
    $resp = $user->obtener_usuario($ced);

    if($resp->rowCount()){
        while ($row = $resp->fetch(PDO::FETCH_ASSOC)) {
            if(password_verify($pass, $row['contrasenia'])){
                $item = array(
                    'id' => $row['Id_user'],
                    'cedula' => $row['cedula'],
                    'nombre' => $row['nombre'],
                    'apellido' => $row['apellido'],
                    'nacimiento' => $row['fecha_nacimiento'],
                    'estado' => $row['estado'],
                );
                array_push($usuario, $item);
            }else{
                error("1"); //Error 1, contrasenia incorrecta
            }
        }
        printJSON($usuario);
    }else{
        error("0"); // No existe el usuario
    }
}


if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['cedula'])){

    $ced = $_GET['cedula'];

    $usuario = array();
    $resp = $user->obtener_usuario($ced);

    if($resp->rowCount()){
        error("1"); // Existe un usuario
    }else{
        error("0"); // No existe el usuario
    }
}
    
function error($mensaje){
    print_r(json_encode(array('mensaje' => $mensaje)));
}

function printJSON($array){
    print_r(json_encode($array));
}

?>