<?php
// Incluir el controlador de usuarios
require_once __DIR__ . '/Controllers/UsuariosController.php';

// Verificar que la petición venga por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Validar campos vacíos
    if (empty($email) || empty($password)) {
        header('Location: /bytequest/login.php?error=1'); // Campos vacíos
        exit;
    }

    // Validar formato de email (opción simple)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: /bytequest/views/login.php?error=2'); // Email inválido
        exit;
    }

    // Alternativa: Validación estricta con tu regex
    /*
    $regex = "/^[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/i";
    if (!preg_match($regex, $email)) {
        header('Location: /bytequest/login.php?error=2');
        exit;
    }
    */

    // Crear instancia del controlador y procesar login
    $controlador = new UsuarioControlador();
    $controlador->login($email, $password);
} else {
    // Si se accede directamente sin POST, redirigir
    header('Location: /bytequest/login.php');
    exit;
}
