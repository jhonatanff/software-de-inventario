<?php 
//ESTABLECER CONEXION AL SERVIDOR 
$sername = "localhost";
$user = "root";
$password = "";
$bdname = "software_inventario";

$conn = new mysqli($sername, $user, $password, $bdname);

//REALIZAR QUERY SQL 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $new_password = $_POST['contrasena'];

    echo "Correo electrónico recibido: " . htmlspecialchars($email) . "<br>";
    echo "Nueva contraseña recibida: " . htmlspecialchars($new_password) . "<br>";

    // Hashear la nueva contraseña (usando password_hash para mayor seguridad)
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Preparar la consulta SQL para actualizar la contraseña
    $stmt = $conn->prepare("UPDATE login_register SET contrasena = ? WHERE email = ?");

    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("ss", $hashed_password, $email);

    if ($stmt->execute()) {
        echo "<script>
    alert('Cambio de contraseña exitoso');
    window.location.href = 'http://localhost/programacion/iniciar_sesion.html';
  </script>";
    } else {
        echo "Error al actualizar la contraseña: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Método de solicitud no válido.";
}

$conn->close();
?>




