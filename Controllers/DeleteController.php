<?php
require_once __DIR__ .  '/../Models/CursoModel.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $modelo = new CursoModel();
    $resultado = $modelo->eliminarCursos($id);

    if ($resultado) {
        header("Location: ../Views/cursos/index.php?mensaje=Producto eliminado con éxito");
    } else {
        header("Location: ../Views/cursos/index.php?mensaje=Error al eliminar el producto");
    }
} else {
    header("Location: ../Views/cursos/index.php?mensaje=ID no proporcionado");
}

?>