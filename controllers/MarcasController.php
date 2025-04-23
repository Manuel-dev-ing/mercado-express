<?php 

namespace Controllers;

use Model\Marcas;
use MVC\Router;

class MarcasController
{
    public static function index(Router $router){
        
        $marcas = Marcas::all();  
        $resultado = $_GET['resultado'] ?? null;

        // titulo de la pagina
        $titulo = 'Marcas';
        $router->render('marcas/index', [
            'titulo'=>$titulo,
            'marcas'=>$marcas,
            'resultado'=>$resultado
        ]);
    }    

    public static function crear(Router $router){

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $marcas = new Marcas($_POST);
            $alertas = $marcas->validarMarcas();

            if (empty($alertas)) {
                
                $resultado = $marcas->crear();
                if ($resultado) {

                    header('Location: /dashboard/marcas?resultado=1');                    
                }
            }

        }
        
        $titulo = 'Crear Marcas';

        $router->render('marcas/crear', [
            'alertas'=>$alertas,
            'titulo'=>$titulo

        ]);

    }

    public static function actualizar(Router $router){
        $id = validarOredireccionar('/dashboard/marcas');
        $marcas = Marcas::find($id);
        
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $args = [];
            $args['nombre'] = $_POST['nombre'] ?? null;

            $marcas->sincronizar($args);
            $alertas = $marcas->validarMarcas();

            if (empty($alertas)) {
                
                $resultado = $marcas->actualizar();

                if ($resultado) {
                    header('Location: /dashboard/marcas?resultado=2');
                }
            }

        }



        $titulo = 'Actualizar Marcas';
        $router->render('marcas/actualizar',[
            'alertas'=>$alertas,
            'titulo'=>$titulo,
            'marcas'=>$marcas

        ]);
    }

    public static function eliminar(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $id = $_POST['id'];

            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {

                $marca = Marcas::find($id);
                $resultado = $marca->eliminar();
                
                if ($resultado) {
                    
                    header('Location: /dashboard/marcas?resultado=3');

                }

            }


        }

    }



}


?>





