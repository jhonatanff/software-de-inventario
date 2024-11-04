<?php
include 'conexion.php';

if ($conn->connect_error) {
    //die("Conexion fallida: ". $conn->connect_error);
    header("location: http://localhost/programacion/configuracion/error404.php");
}

$nombre_apellido = $_POST['nombre'];
$email = $_POST['email'];
$contrasena = $_POST['contrasena'];

// Consulta para obtener el usuario por nombre y correo electrónico
$sql = "SELECT * FROM login_register WHERE nombre_apellido = ? AND email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $nombre_apellido, $email);
$stmt->execute();
$resultado = $stmt->get_result();

if (!$resultado) {
    die("Error en la consulta: " . $conn->error);
}

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
    // Verificar la contraseña hasheada
    if (password_verify($contrasena, $usuario['contrasena'])) {
        header("Location: http://localhost/programacion/inicio_2.0.html");
    } else {
        echo "<script>
        alert('Correo o Contraseña Incorrecta.');
        window.location.href = 'http://localhost/programacion/iniciar_sesion.html';
      </script>";
    }
} else {
    echo "<script>
    alert('Correo o Contraseña Incorrecta.');
    window.location.href = 'http://localhost/programacion/iniciar_sesion.html';
  </script>";
}

$stmt->close();
$conn->close();
?>
