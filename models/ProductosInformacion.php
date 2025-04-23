<?php

namespace Model;

use Model\ActiveRecord;

class ProductosInformacion extends ActiveRecord
{
    public static $tabla = 'ProductosInformacion';

    public static $columnasDB = ['id', 'nombre', 'precio', 'imagen', 'categoria', 'marca'];

    public $id;
    public $nombre;
    public $precio;
    public $imagen;
    public $categoria;
    public $marca;


    public function __construct($args = []) {
        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->categoria = $args['categoria'] ?? '';
        $this->marca = $args['marca'] ?? '';
    }



}







?>

