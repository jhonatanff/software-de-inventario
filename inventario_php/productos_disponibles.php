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

// Preparar la consulta SQL
$sql = "SELECT * FROM inventario";
$stmt = $conn->prepare($sql);

// Ejecutar la consulta SQL
$stmt->execute();
$result = $stmt->get_result();

// Construir la tabla HTML con todos los productos
$tabla = "";
while ($row = $result->fetch_assoc()) {
  $tabla .= "<tr>";
  $tabla .= "<td>" . $row['producto'] . "</td>";
  $tabla .= "<td>" . $row['cantidad'] . "</td>";
  $tabla .= "<td>" . $row['precio'] . "</td>";
  $tabla .= "<td><button onclick='eliminarProducto(" . $row['id'] . ")'>Eliminar</button></td>";
  $tabla .= "</tr>";
}

// Devolver la tabla HTML como respuesta
echo $tabla;

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
