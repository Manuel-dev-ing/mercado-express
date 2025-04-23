<?php
namespace Model;

use Model\ActiveRecord;

class StockProductos extends ActiveRecord
{
    public static $tabla = 'stock_productos';

    public static $columnasDB = ['id', 'id_producto', 'stock'];

    public $id;    
    public $id_producto;    
    public $stock; 

    public function __construct($args = []) {
        $this->id = $args['id'] ?? '';
        $this->id_producto = $args['id_producto'] ?? '';
        // debuguear($this);
        $this->stock = $args['stock'] ?? '';
    }

    public function validarStockProductos(){
        if (!$this->id_producto) {
            self::$alertas['error'][] = "El Seleccione un producto";

        }

        if (!$this->stock) {

            self::$alertas['error'][] = "El stock es obligatorio";
        }

        return self::$alertas;

    }



}







?>