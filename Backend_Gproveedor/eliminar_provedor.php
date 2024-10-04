<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "software_inventario";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

  // Obtener el ID del registro a eliminar
  $id = $_POST['id'];

  // Consulta para eliminar el registro
  $sql = "DELETE FROM gestion_proveedor1 WHERE id = $id";

  if ($conn->query($sql) === TRUE) {
    $response = array("Registro eliminado correctamente");
  } else {
    $response = array("status" => "error", "message" => "Error eliminando el registro: " . $conn->error);
  }

  // Cerrar la conexión
  $conn->close();

  // Enviar respuesta como JSON
  echo json_encode($response);
?>