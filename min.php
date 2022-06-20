<?php

include_once "conexion.php";

class min extends conexion{

    function obtener_micros(){
        $query = $this->conexion->prepare("SELECT * FROM microcontrolador");
        $query->execute();
        return $query;
    }
}