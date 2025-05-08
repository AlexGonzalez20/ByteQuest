<?php
require_once __DIR__ . '/../../Models/CursoModel.php';

$modelo = new CursoModel();

if (isset($_GET['id_curso'])) {
    $curso= $modelo->obtenerCursoId($_GET['id_curso']);
}

if (!$curso) {
    echo "curso no encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="../../Public/Css/edit.css">
</head>
<body>
    <h1>Editar Producto</h1>
    <form action="../../Controllers/UpdateController.php" method="POST">
        <input type="hidden" name="id" value="<?= $producto['id'] ?>">

        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= $producto['nombre'] ?>" required>

        <label>Descripción:</label>
        <input type="text" name="descripcion" value="<?= $producto['descripcion'] ?>" required>

        <input type="submit" value="Actualizar">
    </form>

    <div class="volver">
        <a href="index.php">Volver a los de cursos</a>
    </div>
</body>
</html>
