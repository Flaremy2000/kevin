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
        $query = $this->conexion->prepare("SELECT * FROM iluminacion ORDER BY Id_temperatura desc limit 1");
        $query->execute();
        return $query;
    }
}