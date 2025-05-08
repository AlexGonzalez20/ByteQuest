<?php
require_once __DIR__ . '/../Models/CursoModel.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_curso = $_POST['id'];
    $nombre_curso = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    $modelo = new CursoModel();
    $modelo->actualizarCurso($id_curso, $nombre_curso, $descripcion);

    header("Location: ../Views/cursos/index.php");
    exit;
}
