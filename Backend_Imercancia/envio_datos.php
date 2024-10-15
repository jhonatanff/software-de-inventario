<?php
// Conexion de base de datos 
$sername = "localhost";
$user = "root";
$password = "";
$bdname = "software_inventario";

$conn = new mysqli($sername, $user, $password, $bdname);

if($conn -> connect_error){
    echo "error de conexion";
}else{
    echo "conexion exitosa";
}

// Envio de datos a la base de datos 

$codigo = $_POST['codigo'];
$nombre = $_POST['nombre'];
$proveedor = $_POST['proveedor'];
$cantidad = $_POST['cantidad'];
$precio_unitario = $_POST['precio_unitario'];
$estado_almacen = $_POST['estado_almacen'];
$descripcion = $_POST['descripcion'];
$fecha_ingreso = $_POST['fecha_ingreso'];
$bodega = $_POST['bodega'];

$sql = "INSERT INTO ingreso_mercancia (codigo, nombre, proveedor, cantidad, precio_unitario, estado_almacen, descripcion, fecha_ingreso, bodega )
 VALUES (?,?,?,?,?,?,?,?,?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param('sssssssss',$codigo, $nombre, $proveedor, $cantidad, $precio_unitario, $estado_almacen, $descripcion, $fecha_ingreso, $bodega);

//ejecutar consulta
if($stmt->execute()){
    "<br>";
    echo "datos guardados correctamente";
}else{
    echo "Error" . $sql . "<br>" . $conn->error;
}
$stmt->close();
$conn->close();
?>