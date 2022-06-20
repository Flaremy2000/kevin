<?php 

include_once 'conexion.php';

class usuario extends conexion{

    function obtener_usuario($cedula){
        $query = $this->conexion->prepare("SELECT * FROM usuario WHERE cedula = :id");
        $query->execute(['id' => $cedula]);
        return $query;
    }
    function obtener_usuarios(){
        $query = $this->conexion->prepare("SELECT * FROM usuario");
        $query->execute();
        return $query;
    }
}

?>