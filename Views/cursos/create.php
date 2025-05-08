
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/Css/create.css?vs123">
    <title>Crear cursos</title>
</head>

<body>
    <h1>Crear cursos</h1>
    <!-- menu de navegacion -->
    <nav class="navbar">
        <a href="index.php">Inicio</a>
        <a href="create.php">Crear producto</a>
        <a href="../login.php">Salir</a>
    </nav>

    <div class="container">
        <div class="cont_form">
            <form class="formulario" action="../../Controllers/CreateController.php" method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="descripcion">Descripcion:</label>
                <input type="text" id="descripcion" name="descripcion" required>
                <input id="submit"type="submit" value="Crear Curso">
            </form>
        </div>
    </div>
</body>

</html>