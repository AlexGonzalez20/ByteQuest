<?php
require_once __DIR__ . '/../../Models/CursoModel.php';

$modelo = new CursoModel();
$cursos = $modelo->obtenerCursos();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../Public/Css/index.css?vs123">
    <title>cursos</title>
</head>

<body>
    <h1>Cursos Registrados</h1>
    <!-- menu de navegacion -->
    <nav class="navbar">
        <a href="index.php">Inicio</a>
        <a href="create.php">Crear curso</a>
        <a href="../login.php">Salir</a>
    </nav>

    <div class="container">

        <table class="tabla">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripcion</th>
            </tr>
            <?php if (!empty($cursos)): ?>
                <?php foreach ($cursos as $curso): ?>
                    <tr>
                        <td><?= $curso['id_curso'] ?></td>
                        <td><?= $curso['nombre_curso'] ?></td>
                        <td><?= $curso['descripcion'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $curso['id_curso'] ?>" id="edit"><i class="bi bi-pencil-square"></i></a>
                            <a href="../../Controllers/DeleteController.php?id=<?= $curso['id_curso'] ?>" id="delete"><i
                                    class="bi bi-trash-fill"></i></a>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No hay cursos registrados</td>
                <?php endif; ?>
        </table>
    </div>
    <?php

    include '../../conexion.php';
    include '../../Metodos.php';
    $pruebas = obtenerPruebas($conn);
    ?>

    <h1>Lista de Pruebas</h1>
    <a href="../lecciones/add1.php">Agregar nueva prueba</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Pregunta</th>
            <th>Nivel</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $pruebas->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id_prueba'] ?></td>
                <td><?= $row['pregunta'] ?></td>
                <td><?= $row['nivel'] ?></td>
                <td>
                    <a href="../lecciones/edit1.php?id=<?= $row['id_prueba'] ?>">Editar</a> |
                    <a href="../lecciones/delete1.php?id=<?= $row['id_prueba'] ?>">Eliminar</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>