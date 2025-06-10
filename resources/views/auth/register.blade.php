<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registro - ByteQuest</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Tu CSS personalizado -->
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playwrite+GB+S:ital,wght@0,100..400;1,100..400&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap");

        * {
            padding: 0;
            margin: 0;
        }

        html {
            font-family: Montserrat, Arial;
            font-size: 20px;
            height: auto;
        }

        body,
        .container {
            height: 100vh;
        }

        .container {
            width: 100%;
            display: flex;
            justify-content: center;
            flex-direction: column;
            background: fixed linear-gradient(to left bottom, #46f0e4, #40c8d7, #54a0ba, #5d7a91, #545863);
            align-items: center;
        }

        .header {
            color: whitesmoke;
            border: none;
            text-align: center;
            justify-content: center;
            background: fixed linear-gradient(to left bottom, #46f0e4, #40c8d7, #54a0ba, #5d7a91, #545863);
        }

        .header h2 {
            text-shadow: #46f0e4 1px 0 10px;
            padding-bottom: 20px;
        }

        .formulario {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .card-form {
            display: flex;
            flex-direction: column;
            padding: 2rem;
            border-radius: 15px;
            width: 400px;
            height: 520px;
            background: fixed linear-gradient(to left bottom, #46f0e4, #40c8d7, #54a0ba, #5d7a91, #545863);
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
            grid-area: card-f;
        }

        .card-form label {
            color: whitesmoke;
            font-size: 20px;
            float: left;
            margin-top: 15px;
        }

        .card-form input {
            text-align: center;
            float: inline-end;
            inline-size: 100%;
            padding: 0.4rem;
            border: none;
            margin-top: 20px;
            border-bottom: 2px solid #000;
            border-radius: 15px;
        }

        .card-form button {
            inline-size: 80%;
            border: none;
            padding: 15px;
            margin-left: 2rem;
            margin-top: 30px;
            border-radius: 15px;
            padding: 1rem;
            cursor: pointer;
            background-color: #007bff;
            color: white;
            font-weight: 600;
            transition: all 0.5s ease-in-out;
        }

        .card-form button:hover {
            color: white;
            background-color: #5d7a91;
            opacity: 1;
        }

        .card-form a {
            color: whitesmoke;
            margin-left: 2rem;
            text-shadow: #46f0e4 1px 0 10px;
            margin-top: 15px;
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="header">
            <h2>Registrarse</h2>
        </header>

        <div class="formulario">
            <div class="card-form">
                @if ($errors->any())
                <div style="color:red;font-size: 12px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="/register">
                    @csrf
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" required placeholder="Nombre">

                    <label for="apellido">Apellido:</label>
                    <input type="text" name="apellido" id="apellido" required placeholder="Apellido">

                    <label for="correo">Correo:</label>
                    <input type="email" name="correo" id="correo" placeholder="Correo" required>

                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password" placeholder="Contraseña" required>

                    <label for="password_confirmation">Confirmar Contraseña:</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        placeholder="Confirmar Contraseña">

                    <button type="submit">Registrarse</button>
                </form>
                <a href="/login">¿Ya tienes cuenta? Inicia sesión</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
