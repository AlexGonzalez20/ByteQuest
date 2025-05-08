<?php
require_once __DIR__ . '/../../Models/CursoModel.php';

$modelo = new CursoModel();

if (isset($_GET['id'])) {
    $curso= $modelo->obtenerCursoId($_GET['id']);
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
    <title>Editar curso</title>
    <link rel="stylesheet" href="../../Public/Css/edit.css?vs123">
</head>
<body>
    <h1>Editar curso</h1>
    <form action="../../Controllers/UpdateController.php" method="POST">
        <input type="hidden" name="id" value="<?= $curso['id_curso'] ?>">

        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= $curso['nombre_curso'] ?>" required>

        <label>Descripción:</label>
        <input type="text" name="descripcion" value="<?= $curso['descripcion'] ?>" required>

        <input type="submit" value="Actualizar">
    </form>

    <div class="volver">
        <a href="index.php">Volver a los de cursos</a>
    </div>
</body>
</html>
