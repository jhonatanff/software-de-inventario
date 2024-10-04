<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "software_inventario";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(array("status" => "error", "message" => "Conexión fallida: " . $conn->connect_error)));
}

  // Obtener el ID del registro a eliminar
  $cedula = $_POST['cedula'];

  // Consulta para eliminar el registro
  $sql = "DELETE FROM despachos WHERE cedula = $cedula";

  if ($conn->query($sql) === TRUE) {
    $response = array("status" => "success", "message" => "Registro eliminado correctamente");
  } else {
    $response = array("status" => "error", "message" => "Error eliminando el registro: " . $conn->error);
  }

  // Cerrar la conexión
  $conn->close();

  // Enviar respuesta como JSON
  echo json_encode($response);
?>


