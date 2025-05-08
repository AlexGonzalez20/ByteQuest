<?php

//pide los datos de usuario.php solo una vez
require_once __DIR__ . '/../Models/Usuarios.php';

//se crea la clase Usuariocontrolador, el cual tiene la funicion login
class UsuarioControlador {
    public function login($correo, $password) {
        //modelo es el nuevo objeto que es creado con usuariomodel que pertenece a usuario.php
        $modelo = new UsuarioModelo();
        //aqui usa la funcion que pertenece a la clase usuario modelo
        $usuario = $modelo->obtenerUsuarioPorCorreo($correo);

// se hace una validacion de usuario y de contraseña y los valida con la clase
        if ($usuario && $usuario['password'] === $password) {
            // Aquí puedes usar sesiones si deseas mantener al usuario conectado
            //si es correcto entra y si no manda error 

            header("Location: /bytequest/Views/cursos/index.php");
            exit();
        } else {
            header("Location: /bytequest/Views/login.php?error=1");
            exit();
        }
    }
}
