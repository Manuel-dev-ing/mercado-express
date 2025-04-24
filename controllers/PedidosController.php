<?php 

namespace Controllers;

use Classes\Paginacion;
use Model\DetallePedido;
use Model\Pedidos;
use Model\Usuarios;
use MVC\Router;

class PedidosController
{

    public static function index(Router $router){
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        
        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /dashboard/pedidos?page=1');
        }

        $registros_por_pagina = 5;

        $total_registros = Pedidos::total();
        
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total_registros);

        $pedidos = Pedidos::paginar($registros_por_pagina, $paginacion->offset());

        // $pedidos = Pedidos::all();
        foreach ($pedidos as $pedido) {
            $pedido->usuario = Usuarios::find($pedido->id_usuario);
        }

        if ($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /dashboard/pedidos?page=1');
        }

        // debuguear($pedidos);
        $titulo = "Pedidos";
        $router->render('pedidos/index', [
            "titulo"=>$titulo,
            "pedidos"=>$pedidos,
            "paginacion"=>$paginacion->paginacion()
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