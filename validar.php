
<?php
// require once es para traer info de un documento y pues se pone la ruta para encontrarlo
require_once __DIR__ . '/Controllers/UsuariosController.php';
// pide los datos del form y los valida con los que estan es server(la base de datos)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
       // new usuario controlador es una clase que se creo en el domcumento usuario controller 
    $controlador = new UsuarioControlador();
    $controlador->login($email, $password);
    //la variable controlador ahora es un objeto, y procede a usar la funcion login
    //ahora vamos al usuario controller
}
