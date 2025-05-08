<?php
require_once __DIR__ . '/../Models/CreateModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    
    $modelo = new CreateModel();
    $resultado = $modelo->crearCurso($nombre, $descripcion);

    if ($resultado) {
        header("Location: ../Views/cursos/create.php?mensaje=Producto creado con éxito");
    } else {
        header("Location: ../Views/cursos/create.php?mensaje=Error al crear el producto");
    }
}
?>