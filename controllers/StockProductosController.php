<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Productos;
use Model\ProductosInformacion;
use Model\StockProductos;
use MVC\Router;

class StockProductosController
{
    public static function index(Router $router){
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        
        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /dashboard/stock?page=1');
        }

        $registros_por_pagina = 5;

        $total_registros = StockProductos::total();
        
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total_registros);

        $stock = StockProductos::paginar($registros_por_pagina, $paginacion->offset());


        // $stock = StockProductos::all();
        $resultado = $_GET['resultado'] ?? null;

        foreach ($stock as $stocks) {
            $stocks->producto = Productos::find($stocks->id_producto);        

        }

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /dashboard/stock?page=1');
        }

        // debuguear($stock);

        $titulo = "Stock Productos";
        $router->render('productosStock/index', [
            'titulo'=>$titulo,
            'stock'=>$stock,
            'resultado'=>$resultado,
            'paginacion'=>$paginacion->paginacion()
        ]);

    }

    public static function crear(Router $router){

        $productos = Productos::all();
        $stockProductos = Productos::all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // debuguear($_POST);
            $stockProductos = new StockProductos($_POST);
            $alertas = $stockProductos->validarStockProductos();

            $columna = "id_producto";
            $valor = $stockProductos->id_producto;
            $existeProducto = StockProductos::where($columna, $valor);

            if ($existeProducto) {
                // debuguear('Ya existe un stock para este producto');
                StockProductos::setAlerta('error', 'Ya existe un stock para este producto, Selecciona otro');
                
            }else {
                if (empty($alertas)) {
                
                    $resultado = $stockProductos->crear();
    
                    if ($resultado) {
                        header('Location: /dashboard/stock?resultado=1'); 
                    }
    
                }
            }
 

        }

        $alertas = StockProductos::getAlertas();
        $titulo = "Crea el stock para el producto";
        $router->render('productosStock/crear', [
            'titulo'=>$titulo,
            'productos'=>$productos,
            'stockProductos'=>$stockProductos,
            'alertas'=>$alertas

        ]);
    }

    public static function actualizar(Router $router){

        $id = validarOredireccionar('/dashboard/stock');
        $stockProducto = StockProductos::find($id);

        $consulta = "SELECT productos.id, productos.nombre, productos.precio, productos.imagen, categorias.nombre as categoria, marcas.nombre as marca";
        $consulta .= " FROM productos";
        $consulta .= " LEFT JOIN stock_productos ON stock_productos.id_producto = productos.id";
        $consulta .= " LEFT JOIN categorias ON categorias.id = productos.id_categoria";
        $consulta .= " LEFT JOIN marcas ON marcas.id = productos.id_marca";
        $consulta .= " WHERE stock_productos.id = '$id'";

        $productoInformacion = ProductosInformacion::SQL($consulta);
        // debuguear($stockProducto);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = [];
            $args['id_producto'] = $_POST['id_producto'] ?? null;
            $args['stock'] = $_POST['stock'] ?? null;
            $stockProducto->sincronizar($args);
            debuguear($stockProducto);
            
            $alertas = $stockProducto->validarStockProductos();
            
            if (empty($alertas)) {
                
                $resultado = $stockProducto->actualizar();

                if ($resultado) {
                    
                    header('Location: /dashboard/stock?resultado=2');

                }
            }

        }
       
        $alertas = StockProductos::getAlertas();
        $titulo = "Actualiza el stock para el producto";
        $router->render('/productosStock/actualizar', [
            'titulo'=>$titulo,
            'stockProducto'=>$stockProducto,
            'productoInformacion'=>$productoInformacion,
            'alertas'=>$alertas

        ]);

    }

    public static function eliminar(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $id = $_POST['id'];

            $id = filter_var($id, FILTER_VALIDATE_INT);
            // debuguear($id);
            if ($id) {
                
                $stockProducto = StockProductos::find($id);
                $resultado = $stockProducto->eliminar();

                if ($resultado) {
                    header('Location: /dashboard/stock?resultado=3'); 
                }

            }

        }
    }

}






?>