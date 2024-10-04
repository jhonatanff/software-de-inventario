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
echo "conexion exitosa";

// Obtener datos del producto
$producto = $_POST['producto'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];

// Preparar la consulta SQL
$sql = "INSERT INTO inventario (producto, cantidad, precio) VALUES (?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sis", $producto, $cantidad, $precio);

// Ejecutar la consulta SQL
if ($stmt->execute()) {
    echo "El producto se ha agregado correctamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
