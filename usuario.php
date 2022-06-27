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

    function registrar_usuario($cedula, $nombre, $apellido, $fecha, $contrasenia, $cargo){
        $query = $this->conexion->prepare("INSERT INTO usuario (`cedula`, `nombre`, `apellido`, `fecha_nacimiento`, `contrasenia`, `estado`) VALUES (:ced, :nombre, :apellido, :nacimiento, :contrasenia, :cargo)");
        $query->bindParam(':ced', $cedula, PDO::PARAM_STR);
        $query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $query->bindParam(':apellido', $apellido, PDO::PARAM_STR);
        $query->bindParam(':nacimiento', $fecha, PDO::PARAM_STR);
        $query->bindParam(':contrasenia', $contrasenia, PDO::PARAM_STR);
        $query->bindParam(':cargo', $cargo, PDO::PARAM_STR);
        $query->execute();
        if ($query){
            return true;
        }else{
            return false;
        }
    }
}

?>