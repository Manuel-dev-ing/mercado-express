<?php 

namespace Controllers;

use Classes\Paginacion;
use Model\Categorias;
use Model\DetallePedido;
use Model\InformacionAdicional;
use Model\Marcas;
use Model\MarcasCategorias;
use Model\Pedidos;
use Model\Productos;
use Model\ProductosInformacion;
use Model\StockProductos;
use MVC\Router;
use PDO;

class ApiController
{
    public static function consultar(){
        
        $id = $_POST['id'];
        // consultar producto por id
        $consulta = "SELECT productos.id, productos.nombre, productos.precio, productos.imagen, categorias.nombre as categoria, marcas.nombre as marca";
        $consulta .= " FROM productos";
        $consulta .= " LEFT JOIN categorias ON categorias.id = productos.id_categoria";
        $consulta .= " LEFT JOIN marcas ON marcas.id = productos.id_marca";
        $consulta .= " WHERE productos.id = '$id' ";
        
        $productos = ProductosInformacion::SQL($consulta);
        // debuguear($productos);
        // debuguear($productos);
        $respuesta = [
            'datos'=> $productos
        ];

        echo json_encode($respuesta);

    }    

    public static function obtenerProductos(){
        $productos = Productos::all();
        $respuesta = [
            'datos'=> $productos
        ];

        echo json_encode($respuesta);

    }

    //vista Productos Listado    

    public static function obtenerResultadosBusqueda(){

        $id = $_POST['id'];
        $pagina_actual = $_POST['pagina'];
        $resultadoId = filter_var(intval($id), FILTER_VALIDATE_INT);
        
        //paginacion
        $registros_por_pagina = 5;
        $total_registros = Productos::totalByColumn('id_categoria', $resultadoId);
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total_registros);


        $productos = Productos::paginarPorColumna($registros_por_pagina, $paginacion->offset(), 'id_categoria', $resultadoId);

        // obtener las marcas por categoria
        $marcas = MarcasCategorias::whereAll('id_categoria', $resultadoId);

        $arrayMarcas = [];
        foreach ($marcas as $marca) {
            $resultado = Marcas::find($marca->id_marca);
            array_push($arrayMarcas, $resultado);
        }

        $respuesta = [
            'datos'=> $productos,
            'marcas' => $arrayMarcas,
            'total_paginas' => $paginacion->total_paginas(),
            'pagina_siguiente' => $paginacion->pagina_siguiente(),
            'pagina_anterior' => $paginacion->pagina_anterior()
        ];

        echo json_encode($respuesta);
    
    }

    public static function obtenerProductoPorId(){
        $id = $_POST['id'];
        $resultadoId = filter_var(intval($id), FILTER_VALIDATE_INT);
        $producto = Productos::where('id', $resultadoId);
        $producto->informacionAdicional = InformacionAdicional::whereAll('producto_id', $resultadoId);
        $producto->stock = StockProductos::where('id_producto', $resultadoId);

        // debuguear($id);
        $respuesta = [
            'datos'=> $producto
        ];

        echo json_encode($respuesta);

    }

    //Guardar Pedido 
    public static function guardarPedido(){
        session_start();
        $array = array(
            "id_pedido"=>$_POST["id_pedido"],
            "id_usuario"=>$_SESSION['id'],
            "nombre"=>$_POST["nombre"],
            "apellidos"=>$_POST["apellidos"],
            "correo_electronico"=>$_POST["correo_electronico"],
            "codigo_pais"=>$_POST["codigo_pais"],
            "fecha"=>$_POST["fecha"]
        );

        $resultadoStock = '';
        $pedidos = new Pedidos($array);
        $resultado = $pedidos->crear();

        if ($resultado) {
            
            $productos = isset($_POST["productos"]) ? json_decode($_POST["productos"], true) : [];

            $ProductosArr = $productos;
            foreach ($ProductosArr as $value) {
                
                $id_producto = $value['id_producto'];
                $stock = $value['cantidad'];

                $stockProductos = StockProductos::where('id_producto', $id_producto);
                
                $stockProductos->stock -= $stock;
                $stockProductos->actualizar(); 
            }
            
            foreach ($productos as $value) {
                    $detallePedido = new DetallePedido($value);
                
                    $resultadoDetallePedido = $detallePedido->crear();
                
            }            
        }
            
        // debuguear($resultadoDetallePedido);
        $respuesta = [
            'datos' => $resultadoDetallePedido
        ];

        echo json_encode($respuesta);
    }


}

?>