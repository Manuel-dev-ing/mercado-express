<?php
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');

function incluirTemplate(string $nombre){
    
    include TEMPLATES_URL . "/$nombre.php";

}


function estAutenticado(){
   
    session_start();
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    
    if (!$_SESSION['login']) {
        
        header('Location: /carrito_compras/public/');
        
    }
}

function debuguear($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function sanitizar($html) : string{
    $s = htmlspecialchars($html);
    return $s;

}

function validarParametro(){

    $id = $_GET['resultado'] ?? null;
    
    $resultado = filter_var(intval($id), FILTER_VALIDATE_INT);
    

    return $resultado;
}

function validarOredireccionar(string $url){

    $id = $_GET['resultado'] ?? null;
    
    $resultado = filter_var(intval($id), FILTER_VALIDATE_INT);
    
    if (!$resultado) {
        header("Location: {$url}");
    }

    return $resultado;
}

// function mostrarNotidicacion($codigo){
//     $mensaje = "";

//     switch ($codigo) {
//         case 1:
//             $mensaje = "Creada Correctamente";
//             break;
//         case 2:
//             $mensaje = "Actualizada Correctamente";
//             break;
//         case 2:
//             $mensaje = "Eliminada Correctamente";
//             break;
//         default:
//             $mensaje = false;
//             break;
//     }
//     return $mensaje;

// }






