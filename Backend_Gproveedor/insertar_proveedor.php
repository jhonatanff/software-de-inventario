<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "software_inventario";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nit = $_POST['nit'];
$nombre_empresa = $_POST['nombre_empresa'];
$direccion = $_POST['direccion'];
$correo_electronico = $_POST['correo_electronico'];

// Insertar los datos en la base de datos
$sql = "INSERT INTO gestion_proveedor1 (nit, nombre_empresa, direccion, correo_electronico)
        VALUES ('$nit', '$nombre_empresa', '$direccion', '$correo_electronico')";

if ($conn->query($sql) === TRUE) {
    echo "Registro insertado correctamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


?>


