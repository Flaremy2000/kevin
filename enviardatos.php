<?php
$mysqli = new mysqli("localhost", "flaremyn_flaremy", "Jeremy2000", "flaremyn_avicola", "3306");
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
echo $mysqli->host_info . "\n";

if(isset($_GET['chipid']) && isset($_GET['temperatura'])){
    $chipid = $_GET['chipid'];
    $temperatura = $_GET['temperatura'];

    $res = $mysqli->query("INSERT INTO `temperatura` (`Id_temperatura`, `Id_micro`, `fecha_lectura`, `temperatura_promedio`) VALUES (NULL, '$chipid', CURRENT_TIMESTAMP, '$temperatura')");

    if ($res){
        echo "Datos ingresados correctamente.";
    }else{
        echo 'Error'.$mysqli->errno;
    }
}

?>
