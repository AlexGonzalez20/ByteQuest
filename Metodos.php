<?php
include 'conexion.php';

function obtenerPruebas($conn) {
    $sql = "SELECT * FROM t_prueba";
    return $conn->query($sql);
}
?>
