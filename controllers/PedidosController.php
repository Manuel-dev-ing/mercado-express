<?php 

namespace Controllers;

use Model\DetallePedido;
use Model\Pedidos;
use Model\Usuarios;
use MVC\Router;

class PedidosController
{

    public static function index(Router $router){


        $pedidos = Pedidos::all();
        foreach ($pedidos as $pedido) {
            $pedido->usuario = Usuarios::find($pedido->id_usuario);
        }

        // debuguear($pedidos);
        $titulo = "Pedidos";
        $router->render('pedidos/index', [
            "titulo"=>$titulo,
            "pedidos"=>$pedidos
        ]);
    }


    public static function detalle(Router $router){

        $id = $_GET['resultado'];
        $id_pedido = htmlspecialchars($id);
        $detalle_pedido = DetallePedido::whereAll('id_pedido', $id_pedido);

        foreach ($detalle_pedido as $pedido) {
            $pedido->cliente = Pedidos::where('id_pedido', $pedido->id_pedido);

        }
        $detalle_pedido[0]->cliente->nombreCompleto = $detalle_pedido[0]->cliente->nombre. " " . $detalle_pedido[0]->cliente->apellidos;

        $detalle_pedido[0]->usuario = Usuarios::find($detalle_pedido[0]->cliente->id_usuario);  

        // foreach ($detalle_pedido as $value) {
        //     debuguear($value);
        //     # code...
        // }

        $titulo = "Detalle Pedido";
        $router->render('pedidos/detalle',[
            "titulo"=>$titulo,
            "detalle_pedido"=>$detalle_pedido
        ]);
    }
    
}








?>