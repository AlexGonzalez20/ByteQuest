<?php
require_once __DIR__ . '/../Config/db.php';

class UsuarioModelo {
    private $db;

    public function __construct() {
        $conexion = new Database();
        $this->db = $conexion->conectar();
    }

    public function obtenerUsuarioPorCorreo($correo) {
        $stmt = $this->db->prepare("SELECT * FROM t_usuario WHERE correo = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }
}
