<?php
require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["create"])) {
        if (!empty($_POST["nombre"]) && !empty($_POST["descripcion"]) && !empty($_POST["precio"])) {
            createProduct($_POST["nombre"], $_POST["descripcion"], $_POST["precio"]);
        } else {
            echo "<script>alert('Nombre, descripción y precio son requeridos');</script>";
        }
    } elseif (isset($_POST["update"])) {
        if (!empty($_POST["id"]) && !empty($_POST["nombre"]) && !empty($_POST["descripcion"]) && !empty($_POST["precio"])) {
            updateProduct($_POST["id"], $_POST["nombre"], $_POST["descripcion"], $_POST["precio"]);
        } else {
            echo "<script>alert('ID, nombre, descripción y precio son requeridos');</script>";
        }
    } elseif (isset($_POST["delete"])) {
        if (!empty($_POST["id"])) {
            deleteProduct($_POST["id"]);
        } else {
            echo "<script>alert('ID es requerido');</script>";
        }
    }
}

$productos = getProducts();
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Gestión de Productos</h1>
        <form method="POST" class="mb-3">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion">
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio">
            </div>
            <button type="submit" name="create" class="btn btn-primary">Crear</button>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto) : ?>
                <tr>
                    <td><?php echo $producto['id']; ?></td>
                    <td><?php echo $producto['nombre']; ?></td>
                    <td><?php echo $producto['descripcion']; ?></td>
                    <td><?php echo $producto['precio']; ?></td>
                    <td>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                            <input type="hidden" name="nombre" value="<?php echo $producto['nombre']; ?>">
                            <input type="hidden" name="descripcion" value="<?php echo $producto['descripcion']; ?>">
                            <input type="hidden" name="precio" value="<?php echo $producto['precio']; ?>">
                            <button type="submit" name="update" class="btn btn-warning">Actualizar</button>
                        </form>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                            <button type="submit" name="delete" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
