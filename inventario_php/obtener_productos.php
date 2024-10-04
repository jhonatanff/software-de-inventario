<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "software_inventario";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos de la base de datos
$sql = "SELECT * FROM inventario";
$result = $conn->query($sql);

// Convertir los datos a formato JSON
$productos = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
}
echo json_encode($productos);

// Cerrar la conexión
$conn->close();
?>
