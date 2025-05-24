<?php 

namespace Controllers;

use Model\DetallePedido;
use Model\Pedidos;
use Model\Productos;
use Model\StockProductos;
use MVC\Router;


class DashboardController
{
    public static function index(Router $router){
        
        $total_pedidos = Pedidos::total();
        $total_ingresos =  number_format(DetallePedido::sumar_precio('precio')) ;

        $top_productos = StockProductos::ordenarLimite('stock', 'ASC', 5);
        foreach ($top_productos as $item) {
            $item->producto = Productos::find($item->id_producto);
        }

        // debuguear($top_productos);

        // titulo de la pagina
        $titulo = 'Dashboard';

        $router->render('dashboard/index', [
            'titulo'=> $titulo,
            'total_pedidos'=>$total_pedidos,
            'total_ingresos'=>$total_ingresos,
            'top_productos'=>$top_productos
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













