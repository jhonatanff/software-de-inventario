<?php
include 'conexion.php';

$nombre_apellido = $_POST['nombre_apellido'];
$numero_identificacion = $_POST['numero_identificacion'];
$cargo = $_POST['cargo'];
$email = $_POST['email'];
$contrasena = $_POST['contrasena'];

// Generar un hash seguro de la contraseña
$contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

// Preparar la consulta SQL para insertar el nuevo usuario
$sql = "INSERT INTO login_register (nombre_apellido, numero_identificacion, cargo, email, contrasena)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $nombre_apellido, $numero_identificacion, $cargo, $email, $contrasena_hash);

if ($stmt->execute()) {
    header("Location: http://localhost/programacion/iniciar_sesion.html");
} else {
    echo '<script type="text/javascript"> alert("Error: Email o contraseña incorrectos");</script>';
}

$stmt->close();
$conn->close();
?>


