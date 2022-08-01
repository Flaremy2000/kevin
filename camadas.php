<?php

include_once 'conexion.php';

class camadas extends conexion{

    function obtener_bandada($id){
        $query = $this->conexion->prepare("SELECT * FROM `camadas` WHERE `Id_camada` = :id");
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        return $query;
    }

    function lista_bandada(){
        $query = $this->conexion->prepare("SELECT * FROM `camadas`");
        $query->execute();
        return $query;
    }

    function nueva_camada($nombre, $camada_inicial, $fecha){
        $query = $this->conexion->prepare("INSERT INTO `camadas` (`nombre`, `cantidad_inicial`, `cantidad_final`, `fecha`) VALUES (:nombre, :inicial, :inicial, :fecha)");
        $query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $query->bindParam(':inicial', $camada_inicial, PDO::PARAM_STR);
        $query->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $query->execute();

        return $query;
    }

    function editar_actual($id, $actual){
        $query = $this->conexion->prepare("UPDATE `camadas` SET `cantidad_final`= :actual WHERE `Id_camada` = :id");
        $query->bindParam(':actual', $actual, PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();

        return $query;
    }

}