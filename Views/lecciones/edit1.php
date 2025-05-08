<?php
include '../../conexion.php';
$id = $_GET['id'];
$sql = "SELECT * FROM t_prueba WHERE id_prueba = $id";
$result = $conn->query($sql)->fetch_assoc();
$opciones = json_decode($result['opciones'], true);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/Css/edit.css?v123">

    <title>Document</title>
</head>

<body>
    <form action="../../controllers/edit.php" method="post">
        <input type="hidden" name="id" value="<?= $result['id_prueba'] ?>">
        Pregunta: <input type="text" name="pregunta" value="<?= $result['pregunta'] ?>"><br>
        Opciones: <input type="text" name="opciones[]" value="<?= implode(',', $opciones) ?>"><br>
        Nivel: <input type="number" name="nivel" value="<?= $result['nivel'] ?>"><br>
        <button type="submit">Actualizar</button>
    </form>

</body>

</html>