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

// Consulta SQL para obtener los datos
$sql = "SELECT cedula, nombre_conductor, nombre_empresa, nit, cantidad_productos, fecha, destinario FROM despachos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = [];
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode(["status" => "success", "data" => $data]);
} else {
    echo json_encode(["status" => "error", "message" => "No se encontraron datos."]);
}

// Cerrar la conexión
$conn->close();
?>

