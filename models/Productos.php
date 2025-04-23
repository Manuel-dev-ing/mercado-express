<?php
namespace Model;

use Model\ActiveRecord;

class Productos extends ActiveRecord
{
    public static $tabla = 'productos';

    public static $columnasDB = ['id', 'nombre', 'precio', 'descripcion', 'imagen', 'fecha_creacion', 'id_marca', 'id_categoria'];

    public $id;    
    public $nombre;    
    public $precio; 
    public $descripcion; 
    public $imagen; 
    public $fecha_creacion; 
    public $id_marca; 
    public $id_categoria; 

    public function __construct($args = []) {
        
        $this->id = $args['id'] ?? null; 
        $this->nombre = $args['nombre'] ?? null; 
        $this->precio = $args['precio'] ?? 0.00; 
        $this->descripcion = $args['descripcion'] ?? null; 
        $this->imagen = $args['imagen'] ?? 'imagen no disponible'; 
        $this->id_marca = $args['id_marca'] ?? null; 
        $this->id_categoria = $args['id_categoria'] ?? null; 
        $this->fecha_creacion = date("Y-m-d H:i:s") ?? null; 
        
    }
    
    public function validarProductos(){

        if ($this->nombre == '') {
            self::$alertas['error'][] = "El Nombre es obligatorio";    

        }
        if ($this->precio == '') {
            self::$alertas['error'][] = "El Precio es obligatorio";    

        }
        if ($this->descripcion == '') {
            self::$alertas['error'][] = "La Descripcion es obligatorio";    

        }
      
        if ($this->id_marca == '') {
            self::$alertas['error'][] = "Seleccione una Marca";    

        }
        if ($this->id_categoria == '') {
            self::$alertas['error'][] = "Seleccione una Categoria";    

        }

        return self::$alertas;
    }

    // public static function obetenerProductos(){

    //     $query = "SELECT productos.id, productos.nombre as producto, marcas.nombre as marca, categorias.nombre as categoria, productos.precio 
    //     FROM productos
    //     INNER JOIN marcas ON productos.id_marca = marcas.id
    //     INNER JOIN categorias ON productos.id_categoria = categorias.id";

    //     $resultado = self::$db->query($query);
    //     // $result = $resultado->fetch_assoc();

    //     return $resultado;

    // }

    public function guardarInformacioAdicional($id_producto, $array = []){
        $newArray = array_values($array);
        $cantidadArray = ceil(count($array) / 2);
        // debuguear($cantidadArray);
        $cantidad = 1;
        $key = 0;
        $a = 1;

        $arr = [];
        while ($a <= $cantidadArray) {

            $atributo = $newArray[$key];
            $valor = $newArray[$cantidad];
            // array_push($arr, $newArray[$key]. ' '. $newArray[$cantidad]); 

            $query = "INSERT INTO informacion_productos(producto_id, atributo, valor) VALUES ($id_producto, '$atributo', '$valor')";

            $resultado = self::$db->query($query);

            $cantidad = $cantidad + 2;
            $key = $key + 2;                
            
            if ($a == $cantidadArray) {
                return $resultado;

                break;
            }

            $a++;
        }

    }

    public static function actualizarInformacionAdicional($id_producto, $array = [])
    {
        $newArray = array_values($array);
        $cantidadArray = count($array) / 3;
        // debuguear($cantidadArray);
        $key1 = 0;
        $key2 = 1;
        $key3 = 2;
        $a = 1;

        $arr = [];
        while ($a <= $cantidadArray) {

            $id = $newArray[$key1];
            $atributo = $newArray[$key2];
            $valor = $newArray[$key3];
            // debuguear($id.' '.$atributo. ' '. $valor);

            // array_push($arr, $newArray[$key]. ' '. $newArray[$cantidad]); 

            $query = "UPDATE informacion_productos SET atributo='$atributo', valor='$valor' WHERE id='$id'";
            // debuguear($query);


            $resultado = self::$db->query($query);

            $key1 = $key1 + 3;
            $key2 = $key2 + 3;
            $key3 = $key3 + 3;
            
            if ($a == $cantidadArray) {
                return $resultado;

                break;
            }

            $a++;
        }


        
    }

   
}

?>



