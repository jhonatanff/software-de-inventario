<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "software_inventario";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM gestion_proveedor1";
$result = $conn->query($sql);

$providers = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $providers[] = $row;
    }
}

// Establecer el tipo de contenido a JSON
header('Content-Type: application/json');
echo json_encode($providers);

$conn->close();

?>
