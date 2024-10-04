<?php

include 'conexion.php';

$nombre_apellido = $_POST['nombre_apellido'];
$numero_identificacion = $_POST['numero_identificacion'];
$cargo = $_POST['cargo'];
$email = $_POST['email'];
$contrasena = $_POST['contrasena']; // Agregar punto y coma aquí
$list = "INSERT INTO login_register (nombre_apellido,numero_identificacion,cargo,email, contrasena) 
    VALUES('$nombre_apellido','$numero_identificacion','$cargo','$email', '$contrasena')";

    // Generar un hash seguro de la contraseña
$contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

if ($conn->query($list) === TRUE) {
    header("Location: http://localhost/programacion/iniciar_sesion.html");
    
} else {
    
    echo '<script type="text/javascript"> alert("Error: Email o contraseña incorrectos");</script>'; 
    
}

mysqli_close($conn);
?>


