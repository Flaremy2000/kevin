<?php

include_once "conexion.php";

class reportero extends conexion{

    function obtener_periodo_comedero($micro, $fecha_inicio, $fecha_fin){
        $query = $this->conexion->prepare("SELECT co.*, mi.Nombre FROM `comedero` co INNER JOIN microcontrolador mi ON co.Id_micro= mi.Id_micro WHERE co.`Id_micro` = :mic AND co.`fecha_lectura` BETWEEN :fecha AND :fecha_fin ");
        $query->bindParam(':fecha', $fecha_inicio);
        $query->bindParam(':fecha_fin', $fecha_fin);
        $query->bindParam(':mic', $micro);
        $query->execute();

        return $query;
    }

    function obtener_periodo_bebedero($micro, $fecha_inicio, $fecha_fin){
        $query = $this->conexion->prepare("SELECT be.*, mi.Nombre FROM `bebedero` be INNER JOIN microcontrolador mi ON be.Id_micro= mi.Id_micro WHERE be.`Id_micro` = :mic AND be.`fecha_lectura` BETWEEN :fecha AND :fecha_fin");
        $query->bindParam(':fecha', $fecha_inicio, PDO::PARAM_STR);
        $query->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);
        $query->bindParam(':mic', $micro, PDO::PARAM_STR);
        $query->execute();

        return $query;
    }

    function obtener_periodo_temperatura($fecha_inicio, $fecha_fin){
        $query = $this->conexion->prepare("SELECT * FROM `temperatura` WHERE `fecha_lectura` BETWEEN :fecha AND :fecha_fin");
        $query->bindParam(':fecha', $fecha_inicio, PDO::PARAM_STR);
        $query->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);
        $query->execute();

        return $query;
    }

    function obtener_camada($id){
        $query = $this->conexion->prepare("SELECT * FROM `camadas` WHERE Id_camada= :id");
        $query->bindParam(':id', $id);
        $query->execute();

        return $query;
    }

}