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

// Obtener el ID del producto a eliminar
$id = $_POST['id'];

// Ejecutar la consulta SQL
$sql = "DELETE FROM inventario WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    echo "El producto se ha eliminado correctamente";
} else {
    echo "Error al eliminar el producto: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
