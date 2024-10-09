<?php
    include 'conexion.php';

    if($conn -> connect_error){
        //die("Conexion fallida: ". $conn->connect_error);
        header("location: http://localhost/programacion/configuracion/error404.php");
    }
    $nombre_apellido = $_POST['nombre'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT * FROM login_register WHERE nombre_apellido ='$nombre_apellido' AND email = '$email' AND contrasena = '$contrasena'";
    $resultado = $conn->query($sql);

    $resultado = mysqli_query($conn, $sql);

if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conn));
}

if (mysqli_num_rows($resultado) > 0) {
    header("Location: http://localhost/programacion/inicio_2.0.html");
} else {
    //Modificacion de alerta al colocar datos incorrectos 07/09/20024
    echo "<script>
    alert('Correo o Contraseña Incorrecta.');
    window.location.href = 'http://localhost/programacion/iniciar_sesion.html';
  </script>";
}
    $conn->close();
?>