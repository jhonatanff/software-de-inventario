<?php
require './php/conexion.php';

// Función para subir imágenes
function subirImagen($archivo) {
    $directorio = "imagenes/";
    $nombreArchivo = basename($archivo["name"]);
    $rutaCompleta = $directorio . uniqid() . "_" . $nombreArchivo;

    if (move_uploaded_file($archivo["tmp_name"], $rutaCompleta)) {
        return $rutaCompleta;
    }
    return null;
}

// Procesamiento de formularios (Agregar, Editar, Eliminar)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $imagen = isset($_FILES['imagen']) ? subirImagen($_FILES['imagen']) : null;

        $sql = "INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES ('$nombre', '$descripcion', '$precio', '$imagen')";
        $conn->query($sql);
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];

        // Eliminar la imagen del servidor
        $resultado = $conn->query("SELECT imagen FROM productos WHERE id = $id");

        // Verifica si el resultado de la consulta es válido
        if ($resultado && $resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            if ($fila['imagen'] && file_exists($fila['imagen'])) {
                unlink($fila['imagen']);
            }
        }
        

        // Eliminar el producto de la base de datos
        $sql = "DELETE FROM productos WHERE id = $id";
        $conn->query($sql);
    } elseif (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];

        // Actualizar la imagen si se carga una nueva
        $imagen = isset($_FILES['imagen']) && $_FILES['imagen']['size'] > 0 ? subirImagen($_FILES['imagen']) : null;

        if ($imagen) {
            // Eliminar la imagen anterior
            $resultado = $conn->query("SELECT imagen FROM productos WHERE id = $id");
            if ($resultado && $resultado->num_rows > 0) {
                $fila = $resultado->fetch_assoc();
                if ($fila['imagen'] && file_exists($fila['imagen'])) {
                    unlink($fila['imagen']);
                }
            }
            $sql = "UPDATE productos SET nombre = '$nombre', descripcion = '$descripcion', precio = '$precio', imagen = '$imagen' WHERE id = $id";
        } else {
            $sql = "UPDATE productos SET nombre = '$nombre', descripcion = '$descripcion', precio = '$precio' WHERE id = $id";
        }

        $conn->query($sql);
    }
}

// Lógica para el filtro de búsqueda
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Modificar la consulta SQL para incluir el filtro de búsqueda por nombre
$sql = "SELECT * FROM productos WHERE nombre LIKE '%$searchTerm%'";
$result = $conn->query($sql);