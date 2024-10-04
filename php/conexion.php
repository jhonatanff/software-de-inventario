<?php   

    $sername = "localhost";
    $user = "root";
    $password = "";
    $bdname = "software_inventario";

    $conn = new mysqli($sername, $user, $password, $bdname);

    if($conn -> connect_error ){
        die("Conexion fallida". $conn->connect_error);
    }

?>