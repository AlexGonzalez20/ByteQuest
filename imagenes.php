<?php



for ($i = 0; $i < 5; $i++) {
    echo $i . "\n";
}


$nombre = "Luis";
$saludo = "Hola " . $nombre . "!";
echo $saludo;


$edad = 25;
$nombre = "Ana";
$isActive = true;


$usuario = [
    "nombre" => "Luis",
    "edad" => 25,
    "activo" => true
];


function saludar($nombre)
{
    return "Hola " . $nombre;
}

echo saludar("Ana");
