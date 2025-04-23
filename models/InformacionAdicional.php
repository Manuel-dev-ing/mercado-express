<?php
namespace Model;

use Model\ActiveRecord;

class InformacionAdicional extends ActiveRecord
{
    
    public static $tabla = 'informacion_productos';

    public static $columnasDB = ['id', 'producto_id', 'atributo', 'valor'];

    public $id;
    public $producto_id;
    public $atributo;
    public $valor;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? '';
        $this->producto_id = $args['producto_id'] ?? '';
        $this->atributo = $args['atributo'] ?? '';
        $this->valor = $args['valor'] ?? '';
    }


    public static function buscarInformacionAdicional($id) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE producto_id = {$id}";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function contar($id){
        $query = "SELECT COUNT(*) as total FROM " . static::$tabla . " WHERE producto_id = {$id}";
        $resultado = self::$db->query($query);
        $fila = $resultado->fetch_assoc();
        return $fila;
    }

    public static function eliminarInformacionAdicional($id){
        $query = "DELETE FROM " . static::$tabla ." WHERE producto_id = {$id}";
        $resultado = self::$db->query($query);

        return $resultado;
    }


}

















?>