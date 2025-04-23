<?php 

namespace Controllers;

use MVC\Router;


class DashboardController
{
    public static function index(Router $router){
        
        // titulo de la pagina
        $titulo = 'Dashboard';

        $router->render('dashboard/index', [
            'titulo'=> $titulo
        ]);

    }

    public static function productos(Router $router){
        
        // titulo de la pagina
        $titulo = 'Productos';

        $router->render('dashboard/productos', [
            'titulo'=> $titulo
        ]);

    }

    public static function stock(Router $router){
        
        // titulo de la pagina
        $titulo = 'Stock Productos';

        $router->render('dashboard/stock', [
            'titulo'=> $titulo
        ]);

    }

   

    public static function marcas(Router $router){
        
        // titulo de la pagina
        $titulo = 'Marcas';

        $router->render('dashboard/marcas', [
            'titulo'=> $titulo
        ]);

    }


}
















?>













