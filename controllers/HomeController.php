<?php 

namespace Controllers;

use Model\Categorias;
use MVC\Router;

class HomeController
{

    public static function index(Router $router){

        $categorias = Categorias::all();
        // debuguear($categorias);
        $newCategorias = [];
        $a = 0;
        $categories= [];

        while (count($categorias)) {
            $newCategorias = [];
            
            for ($i=0; $i <= 7; $i++) { 
                
                $cat = array_shift($categorias);
                if ($cat !== null) {
                    array_push($newCategorias, $cat);
                }
            }
            
            $categories[$a] = $newCategorias;
            // array_push($category, $newCategorias);
            $a++;

            
        }
        // debuguear($categories);
        
        // debuguear(is_array($categorias[1]));
        
        $titulo = 'Home'; 
        $router->render("home/index", [
                'titulo'=> $titulo,
                'categories'=> $categories
        ]);


    }




    
}











?>










