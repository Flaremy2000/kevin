<?php

include_once 'conexion.php';

class visualizador extends conexion{

    function  obtener_comida($microchip){
        $query = $this->conexion->prepare("SELECT * FROM comedero WHERE Id_micro = :id ORDER BY Id_comedero desc limit 1");
        $query->execute(['id' => $microchip]);
        return $query;
    }

    function obtener_agua($microchip){
        $query = $this->conexion->prepare("SELECT * FROM bebedero WHERE Id_micro = :id ORDER BY Id_bebedero desc limit 1");
        $query->execute(['id' => $microchip]);
        return $query;
    }

    function obtener_temperatura(){
        $query = $this->conexion->prepare("SELECT * FROM temperatura ORDER BY Id_temperatura desc limit 1");
        $query->execute();
        return $query;
    }

    function obtener_iluminacion(){
        $query = $this->conexion->prepare("SELECT * FROM Configuracion_temperatura ORDER BY Id_temperatura desc limit 1");
        $query->execute();
        return $query;
    }

    function obtener_configuracion(){
        $query = $this->conexion->prepare("SELECT * FROM configuraciones ORDER BY id_config desc limit 1");
        $query->execute();
        return $query;
    }

    function registrar_comida($chipid, $comida, $fecha){
        $query = $this->conexion->prepare("INSERT INTO `comedero` (`Id_micro`, `peso`, `fecha_lectura`) VALUES (:micro, :pesas, :fecha)");
        $query->bindParam(':micro', $chipid, PDO::PARAM_STR);
        $query->bindParam(':pesas', $comida, PDO::PARAM_STR);
        $query->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $query->execute();
        if ($query){
            return true;
        }else{
            return false;
        }
    }

    function registrar_agua($chipid, $agua, $fecha){
        $query = $this->conexion->prepare("INSERT INTO `bebedero` (`Id_micro`, `estado`, `fecha_lectura`) VALUES (:micro, :pesas, :fecha)");
        $query->bindParam(':micro', $chipid, PDO::PARAM_STR);
        $query->bindParam(':pesas', $agua, PDO::PARAM_STR);
        $query->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $query->execute();
        if ($query){
            return true;
        }else{
            return false;
        }
    }
}