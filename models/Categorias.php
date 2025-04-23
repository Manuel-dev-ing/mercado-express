<?php
namespace Model;

use Model\ActiveRecord;

class Categorias extends ActiveRecord{

    public static $tabla = 'categorias';

    public static $columnasDB = ['id', 'nombre', 'imagen', 'fecha_registro'];

    public $id;
    public $nombre;
    public $imagen;
    public $fecha_registro;

    public function __construct($args = []) {
        
        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->fecha_registro = date("Y-m-d H:i:s") ?? null;

    }


    public function validarCategorias()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = "El nombre es obligatorio";
        }
        if (!$this->imagen) {
            self::$alertas['error'][] = "La imagen es obligatoria";
        }

        return self::$alertas;
    }


}
    







?>

