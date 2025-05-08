<?php
include '../conexion.php';

$id = $_GET['id'];
$sql = "DELETE FROM t_prueba WHERE id_prueba = $id";
$conn->query($sql);

header("Location: ../views/cursos/index.php");
exit();
?>
