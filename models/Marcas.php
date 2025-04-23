<?php
namespace Model;

use Model\ActiveRecord;

class Marcas extends ActiveRecord
{
    public static $tabla = 'marcas';

    public static $columnasDB = ['id', 'nombre', 'fecha_registro'];

    public $id;    
    public $nombre;    
    public $fecha_registro;    

    public function __construct($args = []) {

        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->fecha_registro = date("Y-m-d H:i:s") ?? null;
    
    }


    public function validarMarcas()
    {
        
        if (!$this->nombre) {
            
            self::$alertas['error'][] = "El nombre es obligatorio";
        }

        return self::$alertas;
    }




}






















?>













