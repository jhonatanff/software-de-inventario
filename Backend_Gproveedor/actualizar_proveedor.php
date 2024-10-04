<?php
// Configuración de conexión a la base de datos
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

// Obtener datos del formulario
$id = isset($_POST['id']) ? $_POST['id'] : '';
$nit = isset($_POST['nit']) ? $_POST['nit'] : '';
$nombre_empresa = isset($_POST['nombre_empresa']) ? $_POST['nombre_empresa'] : '';
$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
$correo_electronico = isset($_POST['correo_electronico']) ? $_POST['correo_electronico'] : '';

// Verificar que todos los datos están presentes
if (empty($id) || empty($nit) || empty($nombre_empresa) || empty($direccion) || empty($correo_electronico)) {
    echo json_encode(["error" => "Todos los campos son requeridos."]);
    exit;
}

// Preparar la consulta SQL
$sql = "UPDATE gestion_proveedor1 
        SET nit = ?, nombre_empresa = ?, direccion = ?, correo_electronico = ? 
        WHERE id = ?";

// Preparar declaración
if ($stmt = $conn->prepare($sql)) {
    // Vincular parámetros
    $stmt->bind_param("ssssi", $nit, $nombre_empresa, $direccion, $correo_electronico, $id);

    // Ejecutar la declaración
    if ($stmt->execute()) {
        header("Location: http://localhost/programacion/gestion_provedor.html");
    } else {
        echo json_encode(["error" => "Error al actualizar el proveedor."]);
    }

    // Cerrar declaración
    $stmt->close();
} else {
    echo json_encode(["error" => "Error al preparar la consulta."]);
}

// Cerrar conexión
$conn->close();


?>

