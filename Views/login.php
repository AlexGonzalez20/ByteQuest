<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../Public/Css/login.css?v123">
    <title>Login</title>
</head>

<body>
    <h1>Iniciar Sesión</h1>
    <div class="container">
        <div class="card">
            <div class="img">
                <img src="" alt="holi">
            </div>
            <!-- un html sencillo y el codigo es una validacion por si el otro documento manda un error -->
            <?php if (isset($_GET['error'])): ?>
                <p style="color: red;">Email o contraseña incorrectos</p>
            <?php endif; ?>
            <form class="formulario" action="/bytequest/validar.php" method="POST">
                <input type="email" name="email" placeholder="Email" required>
                <!-- recuerde que este formulario tiene el metodo de post el cual es para conseguir informacion, de este login la informacion va hacia validar.php -->
                <input type="password" name="password" placeholder="Contraseña" required>
                <button type="submit">Iniciar Sesión</button>
            </form>
        </div>
    </div>
</body>

</html>