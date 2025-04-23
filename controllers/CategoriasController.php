<?php

namespace Controllers;

use Model\Categorias;
use Model\ProductosInformacion;
use MVC\Router;

class CategoriasController
{
    
    public static function index(Router $router){
        
        $categorias = Categorias::all();
        
        $resultado = $_GET['resultado'] ?? null;
      
        // titulo de la pagina
        $titulo = 'Categorias';
        
        $router->render('/categorias/index', [
            'categorias' => $categorias,
            'titulo'=> $titulo,
            'resultado'=>$resultado
        
        ]);
    }


    public static function crear(Router $router){

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $categorias = new Categorias($_POST);
            $imagen = $_FILES['imagen'];

            $nombreImagen = md5( uniqid( rand(), true )) . ".jpg";
            if ($_FILES['imagen']['tmp_name']) {
    
                $categorias->setImagen($nombreImagen);
                
            }

            $alertas = $categorias->validarCategorias();

            if (empty($alertas)) {
                
                $carpetaImagenes = $_SERVER['DOCUMENT_ROOT'] . '/' .'imagenes/';

                if (!is_dir($carpetaImagenes)) {
                    mkdir($carpetaImagenes);
                }

                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

                $resultado = $categorias->crear();
                if ($resultado) {
                    header('Location: /dashboard/categorias?resultado=1');
                }else{
                    Categorias::setAlerta('error', 'Error ocurrio un error al guardar la categoria');

                }
            }
        }


        $alertas = Categorias::getAlertas();

        $titulo = 'Categorias';
        $router->render('categorias/crear', [
            'alertas'=>$alertas,
            'titulo'=> $titulo
            //'categorias'=>$categorias
        
        ]);
    }


    public static function eliminar(){

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            
            $id = $_POST['id'];

            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                
                $categoria = Categorias::find($id);
                $resultado = $categoria->eliminar();

                if ($resultado) {
                    header('Location: /dashboard/categorias?resultado=3');
                }
            }
        }
    }

    public static function actualizar(Router $router){
        $id = validarOredireccionar('/dashboard/categorias');
        $categorias = Categorias::find($id);
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $args = [];
            $args['nombre'] = $_POST['nombre'] ?? null;
            $args['imagen'] = $_POST['imagen'] ?? null;

            $categorias->sincronizar($args);
            $alertas = $categorias->validarCategorias();

            $imagen = $_FILES['imagen'];

            $nombreImagen = md5( uniqid( rand(), true )) . ".jpg";

            if ($_FILES['imagen']['tmp_name']) {

                $categorias->setImagen($nombreImagen);

            }else{
                Categorias::setAlerta('error', 'La imagen es obligatoria');
            }

            if (empty($alertas)) {
                $carpetaImagenes = $_SERVER['DOCUMENT_ROOT'] . '/' .'imagenes/';

                if (!is_dir($carpetaImagenes)) {
                    mkdir($carpetaImagenes);
                }

                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

                $resultado = $categorias->actualizar();
                if ($resultado) {

                    header('Location: /dashboard/categorias?resultado=2');
                }
            }
        }

        $alertas = Categorias::getAlertas();
        $titulo = 'Actualizar Categoria';
        $router->render('categorias/actualizar', [
            'titulo' => $titulo,
            'alertas' => $alertas,
            'categorias' => $categorias

        ]);
    }


}














?>
