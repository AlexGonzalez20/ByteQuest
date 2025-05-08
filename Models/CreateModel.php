<?php
require_once __DIR__ . '/../Config/db.php';

class CreateModel {
    private $conexion;

    public function __construct() {
        $db = new Database();
        $this->conexion = $db->conectar();
    }

    public function crearCurso($nombre_curso, $descripcion) {
        $stmt = $this->conexion->prepare("INSERT INTO t_curso (nombre_curso, descripcion) VALUES (?, ?)");
        $stmt->bind_param("ss", $nombre_curso, $descripcion);
        return $stmt->execute();
    }

}



?>