<?php 

namespace Controllers;

use Classes\Paginacion;
use InternalIterator;
use Model\Categorias;
use Model\InformacionAdicional;
use Model\Marcas;
use Model\Productos;
use MVC\Router;

class ProductosController
{

    public static function Index(Router $router){
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        
        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /dashboard/productos?page=1');
        }

        $registros_por_pagina = 5;

        $total_registros = Productos::total();
        
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total_registros);

        $productos = Productos::paginar($registros_por_pagina, $paginacion->offset());
        
        // debuguear($productos);
        $resultado = $_GET['resultado'] ?? null;
    
        foreach ($productos as $producto) {
            $producto->categoria = Categorias::find($producto->id_categoria);
            $producto->marca = Marcas::find($producto->id_marca);
        }  
        
        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /dashboard/productos?page=1');
        }
        // debuguear($productos);

        $titulo = "Productos";
        $router->render('productos/index', [
            'productos'=> $productos,
            'resultado'=>$resultado,
            'titulo'=>$titulo,
            'paginacion'=>$paginacion->paginacion()

        ]);
    }

    public static function Crear(Router $router){

        
        $marcas = Marcas::all(); 
        $categorias = Categorias::all();
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $productos = new Productos($_POST);
            // debuguear($productos);
            $infoAdicional = array_slice($_POST, 5);
            
            $imagen = $_FILES['imagen'];
            $nombreImagen = md5( uniqid( rand(), true )) . ".jpg";

            // debuguear($_FILES['imagen']['tmp_name'] === "");

            if ($_FILES['imagen']['tmp_name'] === "") {
                
                Productos::setAlerta('error', 'La imagen es obligatoria');
                
                
            }else {
                
                $productos->setImagen($nombreImagen);

            }

            $alertas = $productos->validarProductos();
            if (empty($alertas)) {
                
                $carpetaImagenes = $_SERVER['DOCUMENT_ROOT'] . '/' .'imagenes/';
                

                if (!is_dir($carpetaImagenes)) {
                    mkdir($carpetaImagenes);
                }

                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
                
                $resultado_crear = $productos->crear();
                // debuguear($resultado_crear);
                $id_produc = $resultado_crear['id'];

                $resultado = $productos->guardarInformacioAdicional($id_produc, $infoAdicional);
                
                // debuguear($resultado);

                if ($resultado) {

                    header('Location: /dashboard/productos?resultado=1');

                }else{

                    Productos::setAlerta('error', 'Error ocurrio un error al guardar el producto');

                }

            }

            // debuguear($salida);
            

        }

        $alertas = Productos::getAlertas();
        $titulo = "Productos";
        $router->render('productos/crear', [
            'titulo'=>$titulo,
            'marcas'=>$marcas,
            'categorias'=>$categorias,
            'productos'=>$productos,
            'alertas'=>$alertas
        ]);
    }

    public static function actualizar(Router $router){

        $id = validarOredireccionar('/dashboard/categorias');
        $marcas = Marcas::all(); 
        $categorias = Categorias::all();
        $productos = Productos::find($id);
        $productos->informacionAdicional = InformacionAdicional::buscarInformacionAdicional($id); 

        debuguear($productos);

        $infoAdicional = InformacionAdicional::buscarInformacionAdicional($id);
        $alertas = [];
        // debuguear($infoAdicional);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $args = [];
            $args['nombre'] = $_POST['nombre'] ?? null;
            $args['precio'] = $_POST['precio'] ?? null;
            $args['id_marca'] = $_POST['id_marca'] ?? null;
            $args['id_categoria'] = $_POST['id_categoria'] ?? null;
            $args['descripcion'] = $_POST['descripcion'] ?? null;
            $args['imagen'] = $_POST['imagen'] ?? null;


            $productos->sincronizar($args);

            // $infoAdicional->sincronizar();
            $infoAdic = array_slice($_POST, 5);
            // debuguear($infoAdic);
            // debuguear($productos);    

            $imagen = $_FILES['imagen'];
            $nombreImagen = md5( uniqid( rand(), true )) . ".jpg";

            if ($_FILES['imagen']['tmp_name']) {
    
                $productos->setImagen($nombreImagen);
                
            }

            $alertas = $productos->validarProductos();

            if (empty($alertas)) {
                
                $carpetaImagenes = $_SERVER['DOCUMENT_ROOT'] . '/' .'imagenes/';

                if (!is_dir($carpetaImagenes)) {
                    mkdir($carpetaImagenes);
                }

                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);                

                $resultado_act = $productos->actualizar();


                if ($resultado_act) {
                    $prod = new Productos();    

                    $resultado = $prod->actualizarInformacionAdicional($id, $infoAdic);
                    
                    if ($resultado) {

                        header('Location: /dashboard/productos?resultado=2');
    
                    }else{
                        Productos::setAlerta('error', 'Error ocurrio un error al actualizar la informacion del producto');
    
                    }

                }else {
                    Productos::setAlerta('error', 'Error ocurrio un error al actualizar el producto');

                }
                
               


            }

        }

        // debuguear($infoAdicional);
        $alertas = Productos::getAlertas();
        $titulo = "Actualizar";
        $router->render('/productos/actualizar', [
            'titulo'=>$titulo,
            'productos'=>$productos,
            'informacionAdicional'=>$infoAdicional,
            'marcas'=>$marcas,
            'categorias'=>$categorias,
            'alertas'=>$alertas

        ]);


    }

    public static function eliminar(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // debuguear($_POST);
            $id = $_POST['id'];

            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                
                $productos = Productos::find($id);
                $resultado = $productos->eliminar();

                if ($resultado) {

                    $result = InformacionAdicional::eliminarInformacionAdicional($id);

                    if ($result) {
                        header('Location: /dashboard/productos?resultado=3');
                    }
                }
            }
        }

    }

     //vista listado de productos 
    public static function mostrarProductos(Router $router){

        // debuguear($productos);
        $titulo = "Resultados Productos";
        $router->render('productosLIstado/index',[
            "titulo"=>$titulo
        ]);
    }

    //vista Detalle de producto
    public static function mostrarDetalleProducto(Router $router){
        $id = validarOredireccionar('/');

        // debuguear($id);

        $titulo = "Detalle Producto";
        $router->render('productosLIstado/detalleProducto', [
            "titulo"=>$titulo
        ]);

    }

    //Vista carrito
    public static function carrito(Router $router){
        
        $titulo = "carrito";
        $router->render('carrito/index', [
            "titulo"=>$titulo
        ]);

    }
    
    public static function pago(Router $router){
        
        session_start();

        if (!isset($_SESSION['login'])) {
            
            header('Location: /login?resultado=1');
            
        }

        $titulo = "Mercado Express";
        $router->render('carrito/comprar',[
            "titulo"=>$titulo

        ]);
    }


}


















?>