<?php 

class conexion extends PDO{

    private $server;
    private $user;
    private $password;
    private $database;
    private $port;
    private $charset;
    function __construct(){
        $listadatos = $this->datosconexion();
        foreach ($listadatos as $value) {
            $this->server = $value['server'];
            $this->user = $value['user'];
            $this->password = $value['password'];
            $this->database = $value['database'];
            $this->charset = $value['charset'];
            $this->port = $value['port'];
        }
        try {
            $connect = 'mysql:host='.$this->server.';dbname='.$this->database;
            $this->conexion = new PDO($connect, $this->user, $this->password);
            //$this->conexion = new mysqli($this->server, $this->user, $this->password, $this->database, $this->port);
        }catch (PDOException $e){
            
            print_r('Error de Conexion: '. $e->getMessage());
        }
    }

    private function datosconexion(){
        $direccion = dirname(__DIR__);
        $jsondata = file_get_contents($direccion."/chicken/secure/config");
        return json_decode($jsondata, true);
    }

}
?>