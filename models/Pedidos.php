<?php

namespace Model;

use Model\ActiveRecord;

class Pedidos extends ActiveRecord
{
 
    public static $tabla = 'pedidos';

    public static $columnasDB = ['id', 'id_usuario', 'id_pedido', 'nombre', 'apellidos', 'correo_electronico', 'codigo_pais', 'fecha'];

    public $id;
    public $id_pedido;
    public $id_usuario;
    public $nombre;
    public $apellidos;
    public $correo_electronico;
    public $codigo_pais;
    public $fecha;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->id_pedido = $args['id_pedido'] ?? null;
        $this->id_usuario = $args['id_usuario'] ?? null;
        $this->nombre = $args['nombre'] ?? null;
        $this->apellidos = $args['apellidos'] ?? null;
        $this->correo_electronico = $args['correo_electronico'] ?? null;
        $this->codigo_pais = $args['codigo_pais'] ?? null;
        $this->fecha = $args['fecha'] ?? null;
    }


}








?>