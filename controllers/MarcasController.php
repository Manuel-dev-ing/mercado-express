<?php 

namespace Controllers;

use Classes\Paginacion;
use Model\Marcas;
use MVC\Router;

class MarcasController
{
    public static function index(Router $router){
        
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        
        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /dashboard/marcas?page=1');
        }

        $registros_por_pagina = 5;

        $total_registros = Marcas::total();
        
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total_registros);

        $marcas = Marcas::paginar($registros_por_pagina, $paginacion->offset());

        // $marcas = Marcas::all();  
        $resultado = $_GET['resultado'] ?? null;

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /dashboard/narcas?page=1');
        }

        // titulo de la pagina
        $titulo = 'Marcas';
        $router->render('marcas/index', [
            'titulo'=>$titulo,
            'marcas'=>$marcas,
            'resultado'=>$resultado,
            'paginacion'=>$paginacion->paginacion()
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





