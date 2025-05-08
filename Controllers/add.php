<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $historial = $_POST['historial'];
    $curso = $_POST['curso'];
    $pregunta = $_POST['pregunta'];
    $opciones = json_encode($_POST['opciones']);
    $nivel = $_POST['nivel'];

    $sql = "INSERT INTO t_prueba (id_usuario, id_historial, id_curso, pregunta, opciones, nivel)
            VALUES ('$usuario', '$historial', '$curso', '$pregunta', '$opciones', '$nivel')";
    $conn->query($sql);

    header("Location: ../views/cursos/index.php");
    exit();
}
?>
    