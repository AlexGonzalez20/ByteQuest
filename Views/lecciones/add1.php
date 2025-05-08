<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/Css/create.css?v123">
    <title>Document</title>
</head>

<body>
    <form action="../../controllers/add.php" method="post">
        Usuario ID: <input type="number" name="usuario"><br>
        Historial ID: <input type="number" name="historial"><br>
        Curso ID: <input type="number" name="curso"><br>
        Pregunta: <input type="text" name="pregunta"><br>
        Opciones (separadas por coma): <input type="text" name="opciones[]"><br>
        Nivel: <input type="number" name="nivel"><br>
        <button type="submit">Guardar</button>
    </form>

</body>

</html>