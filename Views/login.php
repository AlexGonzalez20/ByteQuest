<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../Public/Css/login.css?v123">
    <title>Login</title>
</head>

<body>
    <h1>Bienvenido a ByteQuest</h1>
    <div class="container">
        <div class="img">
            <img src="../Public/img/robot-preview.png" alt="robot">
        </div>
        <div class="card">


            <form class="formulario" action="/bytequest/validar.php" method="POST">

                <h2>INGRESA TUS DATOS PARA CONTINUAR</h2>

                <input type="email" name="email" placeholder="Email" required>
                <script>
                    function validarEmail() {
                        const email = document.getElementById('email').value;
                        const regex = /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/i;

                        if (!regex.test(email)) {
                            alert("Correo inválido. Por favor ingresa un email válido.");
                            return false; // Evita que se envíe el formulario
                        }

                        return true; // El email es válido, se envía el formulario
                    }
                </script>

                <input type="password" name="password" placeholder="Contraseña" required>
                <button type="submit">Iniciar Sesión</button>

            </form>
        </div>

        <footer class="footer">
            <h5>Derechos reservados ByteQuest&copy2025</h5>
        </footer>

    </div>

    <?php if (isset($_GET['error'])): ?>
        <script>
            const errorCode = <?= json_encode($_GET['error']) ?>;
            switch (errorCode) {
                case "1":
                    alert("Por favor, completa todos los campos.");
                    break;
                case "2":
                    alert("El formato del correo es inválido.");
                    break;
                case "3":
                    alert("Email o contraseña incorrectos.");
                    break;
                default:
                    alert("Ha ocurrido un error desconocido.");
            }
        </script>
    <?php endif; ?>
</body>

</html>