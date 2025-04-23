<?php

namespace Controllers;

use Classes\Email;
use Model\Usuarios;
use MVC\Router;

class LoginController
{

    public static function Login(Router $router)
    {
        $titulo = "inicia sesion";
        $alertas = [];
        session_start();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuarios($_POST);
            $alertas = $auth->validar_Login();

           
            if (empty($alertas)) {
                //comprobar que exista el usuario por su email
                $usuario = Usuarios::where('email', $auth->email);

                if ($usuario) {
                    
                    if ($usuario->comprobarPasswodEstaVerificado($auth->password)) {
                        
                        
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre ." ". $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        $res = validarParametro();
                        
                        if ($res !== 0) {

                            header('Location: /productos/carrito');

                        }else{

                            if ($usuario->admin === "1") {

                                $_SESSION['admin'] = $usuario->admin ?? null;
                                
                                header('Location: /dashboard');
    
                            } else {
    
                                header('Location: /');
    
                            }
                            
                        }

                        


                    }

                } else {

                    Usuarios::setAlerta('error', 'Usuario no encontrado');
                }
            }
        }

        $alertas = Usuarios::getAlertas();

        $router->render('auth/login', [
            "titulo" => $titulo,
            'alertas' => $alertas
        ]);
    }

    public static function Logout(){

        echo "Desde Logout Controller";
    }

    public static function olvidePassword(Router $router){
        
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $auth = new Usuarios($_POST);

            $alertas = $auth->validarEmail();

            if (empty($alertas)) {
                
                $usuario = Usuarios::where('email', $auth->email);


                if ($usuario && $usuario->confirmado === "1") {
                    
                    $usuario->crearToken();
                    $usuario->guardar();

                    
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();

                    Usuarios::setAlerta('exito', 'Revisa tu email');

                }else{

                    Usuarios::setAlerta('error', 'El usuario no existe o no esta confirmado');
                }

            }


        }

        $alertas = Usuarios::getAlertas();

        $titulo = 'olvidaste password';
        $router->render('auth/olvide-password', [
            'titulo' => $titulo,
            'alertas'=>$alertas
        ]);

    }

    public static function recuperarPassword(Router $router) {
        $alertas = [];
        $error = false;

        $token = sanitizar($_GET['token']);

        $usuario = Usuarios::where('token', $token);

        if (empty($usuario)) {
            Usuarios::setAlerta('error', 'Token No Valido');
            $error = true;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $password = new Usuarios($_POST);

            $alertas = $password->ValidarPassword();

            if (empty($alertas)) {
                
                $usuario->password = null;

                $usuario->password = $password->password;
                $usuario->hashearPassword();
                $usuario->token = null;

                $resultado = $usuario->guardar();
                
                if ($resultado) {
                    header('Location: /');
                }    

                

            }


        }


        $alertas = Usuarios::getAlertas();
        $titulo = 'restablecer password';
        $router->render('auth/restablecer-password', [
            'titulo' => $titulo,
            'alertas'=>$alertas,
            'error'=>$error
        ]);



    }

    public static function crearCuenta(Router $router)
    {
        $usuario = new Usuarios;

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario->sincronizar($_POST);

            $alertas = $usuario->validarNuevaCuenta();

            if (empty($alertas)) {

                $resultado = $usuario->existeUsuario();

                if ($resultado->num_rows) {

                    $alertas = Usuarios::getAlertas();
                } else {

                    $usuario->hashearPassword();

                    $usuario->crearToken();

                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);

                    $email->enviarConfirmacion();

                    $resultado = $usuario->guardar();


                    if ($resultado) {

                        header('Location: /mensaje');
                    }
                }
            }
        }

        $titulo = 'crear cuenta';
        $router->render('auth/crear-cuenta', [
            'titulo' => $titulo,
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router)
    {


        $titulo = "Confirma tu cuenta";
        $router->render('auth/mensaje', [
            'titulo' => $titulo

        ]);
    }

    public static function confirmar(Router $router)
    {

        $alertas = [];

        $token = sanitizar($_GET['token']);
        $usuario = Usuarios::where('token', $token);

        if (empty($usuario)) {

            Usuarios::setAlerta('error', 'Token no Valido');
        } else {
            $usuario->confirmado = "1";
            $usuario->token = null;
            $usuario->guardar();
            Usuarios::setAlerta('exito', 'Cuenta Comprobada Correctamente');
        }

        $alertas = Usuarios::getAlertas();
        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }
}
