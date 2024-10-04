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

// Verificar si los datos del formulario están presentes
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $cedula = isset($_POST['cedula']) ? $_POST['cedula'] : '';
    $nombre_conductor = isset($_POST['nombre_conductor']) ? $_POST['nombre_conductor'] : '';
    $nombre_empresa = isset($_POST['nombre_empresa']) ? $_POST['nombre_empresa'] : '';
    $nit = isset($_POST['nit']) ? $_POST['nit'] : '';
    $cantidad_productos = isset($_POST['cantidad_productos']) ? $_POST['cantidad_productos'] : '';
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
    $destinario = isset($_POST['destinario']) ? $_POST['destinario'] : '';

    // Verificar si todos los datos están presentes
    if (empty($cedula) || empty($nombre_conductor) || empty($nombre_empresa) || empty($nit) || empty($cantidad_productos) || empty($fecha) || empty($destinario)) {
        echo json_encode(["status" => "error", "message" => "Faltan datos del formulario."]);
        exit;
    }

    // Preparar consulta SQL
    $sql = "INSERT INTO despachos (cedula, nombre_conductor, nombre_empresa, nit, cantidad_productos, fecha, destinario)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo json_encode(["status" => "error", "message" => "Error en la preparación de la consulta: " . $conn->error]);
        exit;
    }

    // Vincular parámetros
    $stmt->bind_param("ssssiss", $cedula, $nombre_conductor, $nombre_empresa, $nit, $cantidad_productos, $fecha, $destinario);

    // Ejecutar la consulta SQL
    if ($stmt->execute()) {
        header("Location: http://localhost/programacion/historial_despachos.html");
        // Devolver los datos del nuevo registro en formato JSON
        echo json_encode(["status" => "success", "data" => [
            "cedula" => $cedula,
            "nombre_conductor" => $nombre_conductor,
            "nombre_empresa" => $nombre_empresa,
            "nit" => $nit,
            "cantidad_productos" => $cantidad_productos,
            "fecha" => $fecha,
            "destinario" => $destinario
        ]]);
    } else {
        if ($stmt->errno == 1062) {
            echo json_encode(["status" => "error", "message" => "El valor de la cédula ya existe en la base de datos."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
        }
    }

    // Cerrar la consulta y la conexión
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "No se recibieron datos del formulario."]);
}
?>





