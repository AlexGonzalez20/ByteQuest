<?php
require_once __DIR__ . '/../Config/db.php';

class CursoModel {
    private $conexion;

    public function __construct() {
        $db = new Database();
        $this->conexion = $db->conectar();
    }

    public function obtenerCursos() {
        $resultado = $this->conexion->query("SELECT * FROM t_curso");
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
    public function eliminarCursos($id_curso) {
        $stmt = $this->conexion->prepare("DELETE FROM t_curso WHERE id_curso = ?");
        $stmt->bind_param("i", $id_curso);
        return $stmt->execute();
    }
    // Metodos para editar cursos
    public function obtenerCursoId($id_curso) {
        $stmt = $this->conexion->prepare("SELECT * FROM t_curso WHERE id_curso = ?");
        $stmt->bind_param("i", $id_curso);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }
    
    public function actualizarCurso($id_curso, $nombre_curso, $descripcion) {
        $stmt = $this->conexion->prepare("UPDATE t_curso SET nombre_curso=?, descripcion=? WHERE id_curso=?");
        $stmt->bind_param("ssi", $nombre_curso, $descripcion, $id_curso);
        $stmt->execute();
    }
    

}
