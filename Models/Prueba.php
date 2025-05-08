<?php
class Prueba {
    public $id;
    public $usuario_id;
    public $historial_id;
    public $curso_id;
    public $pregunta;
    public $opciones;
    public $nivel;

    public function __construct($id, $usuario_id, $historial_id, $curso_id, $pregunta, $opciones, $nivel) {
        $this->id = $id;
        $this->usuario_id = $usuario_id;
        $this->historial_id = $historial_id;
        $this->curso_id = $curso_id;
        $this->pregunta = $pregunta;
        $this->opciones = $opciones;
        $this->nivel = $nivel;
    }
}
?>
