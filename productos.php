<?php
require 'backproductos.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        .section-title {
            color: #333;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
        }

        .product-card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }

        .product-card .product-image {
            height: 220px;
            object-fit: cover;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .product-card .card-body {
            background-color: #fff;
            padding: 20px;
        }

        .card-title {
            font-size: 1.25rem;
            color: #333;
        }

        .card-text {
            color: #777;
            font-size: 0.9rem;
        }

        .price {
            font-size: 1.2rem;
            font-weight: bold;
            color: #28a745;
        }

        .btn-add, .btn-delete, .btn-edit {
            padding: 8px 16px;
            font-size: 0.9rem;
            border-radius: 8px;
        }

        .btn-add {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .btn-add:hover {
            background-color: #0056b3;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
            border: none;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .btn-edit {
            background-color: #66b3ff; /* Azul claro */
            color: white;
            border: none;
        }

        .btn-edit:hover {
            background-color: #3399ff;
        }

        .modal-header {
            background-color: #007bff;
            color: white;
        }

        .modal-footer button {
            border-radius: 8px;
        }

        .modal-body input, .modal-body textarea {
            border-radius: 8px;
            padding: 12px;
        }

        .card-text small {
            font-size: 0.8rem;
        }

        .card-footer {
            background-color: #f8f9fa;
        }

        /* Custom media queries for better responsiveness */
        @media (max-width: 768px) {
            .product-card {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>

<!-- Navbar con el Título, Botón de Agregar Producto, Botón de Inicio y Formulario de Búsqueda -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #007bff;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Gestión de Productos</a>
        <div class="ms-auto d-flex">
            <!-- Formulario de Búsqueda -->
            <form class="d-flex me-2" action="" method="GET">
                <input class="form-control" type="search" placeholder="Buscar productos" aria-label="Buscar" name="search" value="<?= htmlspecialchars($searchTerm) ?>">
                <button class="btn btn-outline-light ms-2" type="submit">Buscar</button>
            </form>
            <button class="btn btn-add me-2" data-bs-toggle="modal" data-bs-target="#addProductModal">Agregar Producto</button>
            <a class="btn btn-add" href="inicio_2.0.html">Inicio</a>
        </div>
    </div>
</nav>

<div class="container my-5">
    <!-- Listado de Productos -->
    <div class="row">
        <?php while ($row = $result->fetch_assoc()): ?>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="product-card card shadow-lg">
                <img src="<?= $row['imagen'] ?>" alt="<?= $row['nombre'] ?>" class="product-image card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?= $row['nombre'] ?></h5>
                    <p class="card-text"><?= $row['descripcion'] ?></p>
                    <p class="price">$<?= number_format($row['precio'], 2) ?></p>
                </div>
                <div class="card-footer text-center">
                    <form method="POST" class="d-inline">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button type="submit" name="delete" class="btn btn-delete btn-sm">Eliminar</button>
                    </form>
                    <button class="btn btn-edit btn-sm" data-bs-toggle="modal" data-bs-target="#editProductModal-<?= $row['id'] ?>">Editar</button>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- Modal para Agregar Producto -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Agregar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" id="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control" id="descripcion" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" name="precio" class="form-control" id="precio" required>
                    </div>
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Imagen</label>
                        <input type="file" name="imagen" class="form-control" id="imagen">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="add" class="btn btn-primary">Agregar Producto</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modales para Editar Producto -->
<?php
// Re-fetch the results to ensure the modals are generated correctly
$result->data_seek(0);
while ($row = $result->fetch_assoc()): ?>
<div class="modal fade" id="editProductModal-<?= $row['id'] ?>" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Editar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario de Edición de Producto -->
                <form action="productos.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <div class="mb-3">
                        <label for="nombre-<?= $row['id'] ?>" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre-<?= $row['id'] ?>" name="nombre" value="<?= $row['nombre'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion-<?= $row['id'] ?>" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion-<?= $row['id'] ?>" name="descripcion" rows="3" required><?= $row['descripcion'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="precio-<?= $row['id'] ?>" class="form-label">Precio</label>
                        <input type="number" class="form-control" id="precio-<?= $row['id'] ?>" name="precio" value="<?= $row['precio'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="imagen-<?= $row['id'] ?>" class="form-label">Imagen</label>
                        <input type="file" class="form-control" id="imagen-<?= $row['id'] ?>" name="imagen">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" name="edit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endwhile; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
