<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "software_inventario";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$cedula = $_POST['cedula'];
$conductor = $_POST['conductor'];
$nombre_empresa = $_POST['nombre_empresa'];
$nit = $_POST['nit'];
$cantidad_productos = $_POST['cantidad_productos'];
$fecha = $_POST['fecha'];
$destinario = $_POST['destinario'];

// Insertar los datos en la base de datos
$sql = "INSERT INTO historial_despachos (cedula, conductor, nombre_empresa, nit, cantidad_productos, fecha, destinario)
VALUES ('$cedula', '$conductor', '$nombre_empresa', '$nit', '$cantidad_productos', '$fecha', '$destinario')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['status' => 'success', 'message' => 'Datos guardados correctamente']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . $sql . '<br>' . $conn->error]);
}

$conn->close();
?>
