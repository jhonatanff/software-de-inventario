<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "software_inventario";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    //die("Conexión fallida: " . $conn->connect_error);
    header("location: http://localhost/programacion/configuracion/error404.php");
}

// Verificar si los datos del formulario están presentes
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $codigo = isset($_POST['codigo']) ? $_POST['codigo'] : '';
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $proveedor = isset($_POST['proveedor']) ? $_POST['proveedor'] : '';
    $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : '';
    $precio_unitario = isset($_POST['precio_unitario']) ? $_POST['precio_unitario'] : '';
    $estado_almacen = isset($_POST['estado_almacen']) ? $_POST['estado_almacen'] : '';
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
    $fecha_ingreso = isset($_POST['fecha_ingreso']) ? $_POST['fecha_ingreso'] : '';
    $bodega = isset($_POST['bodega']) ? $_POST['bodega'] : '';

    // Verificar si todos los datos están presentes
    if (empty($codigo) || empty($nombre) || empty($proveedor) || empty($cantidad) || empty($precio_unitario) || empty($estado_almacen) || empty($descripcion) || empty($fecha_ingreso) || empty($bodega)) {
        echo json_encode(["status" => "error", "message" => "Faltan datos del formulario."]);
        exit;
    }

    // Preparar consulta SQL
    $sql = "INSERT INTO ingreso_mercancia (codigo, nombre, proveedor, cantidad, precio_unitario, estado_almacen, descripcion, fecha_ingreso, bodega)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo json_encode(["status" => "error", "message" => "Error en la preparación de la consulta: " . $conn->error]);
        exit;
    }

    // Vincular parámetros
    $stmt->bind_param("ssssissss", $codigo, $nombre, $proveedor, $cantidad, $precio_unitario, $estado_almacen, $descripcion, $fecha_ingreso, $bodega);

    // Ejecutar la consulta SQL
    if ($stmt->execute()) {
        header("Location: http://localhost/programacion/historial_ingreso.html");
        // Devolver los datos del nuevo registro en formato JSON
        echo json_encode(["status" => "success", "data" => [
            "codigo" => $codigo,
            "nombre" => $nombre,
            "proveedor" => $proveedor,
            "cantidad" => $cantidad,
            "precio_unitario" => $precio_unitario,
            "estado_almacen" => $estado_almacen,
            "descripcion" => $descripcion,
            "fecha_ingreso" => $fecha_ingreso,
            "bodega" => $bodega

        ]]);
    } else {
        if ($stmt->errno == 1062) {
            echo json_encode(["status" => "error", "message" => "El valor del codigo  ya existe en la base de datos."]);
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
