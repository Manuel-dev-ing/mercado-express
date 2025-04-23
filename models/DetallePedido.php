<?php

namespace Model;

use Model\ActiveRecord;

class DetallePedido extends ActiveRecord
{

    public static $tabla = 'detalle_pedido';

    public static $columnasDB = ['id', 'id_pedido', 'id_producto', 'producto', 'cantidad', 'precio'];

    public $id;
    public $id_pedido;
    public $id_producto;
    public $producto;
    public $cantidad;
    public $precio;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->id_pedido = $args['id_pedido'] ?? null;
        $this->id_producto = $args['id_producto'] ?? null;
        $this->producto = $args['producto'] ?? null;
        $this->cantidad = $args['cantidad'] ?? null;
        $this->precio = $args['precio'] ?? null;
    }
    
}




?>