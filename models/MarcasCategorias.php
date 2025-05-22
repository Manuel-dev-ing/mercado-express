<?php 

namespace Model;

class MarcasCategorias extends ActiveRecord 
{
    public static $tabla = 'marcas_categorias';

    public static $columnasDB = ['id', 'id_marca', 'id_categoria'];

    public $id;
    public $id_marca;
    public $id_categoria;

    public function __construct($args = []) {
        
        $this->id = $args['id'] ?? '';
        $this->id_marca = $args['id_marca'] ?? '';
        $this->id_categoria = $args['id_categoria'] ?? '';

    }


}










?>
