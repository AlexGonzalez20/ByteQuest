<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $pregunta = $_POST['pregunta'];
    $nivel = $_POST['nivel'];
    $opciones = json_encode($_POST['opciones']);

    $sql = "UPDATE t_prueba SET pregunta='$pregunta', opciones='$opciones', nivel='$nivel' WHERE id_prueba=$id";
    $conn->query($sql);

    header("Location: ../views/cursos/index.php");
    exit();
}
?>
