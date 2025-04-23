<?php


namespace Classes;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token) {

        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;

    }

    public function enviarConfirmacion(){

        $phpmailer = new PHPMailer(true);


        try {
            
            $phpmailer->isSMTP();
            $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = 2525;
            $phpmailer->Username = '7204a447927cd2';
            $phpmailer->Password = 'e44d9d2ccf5594';
            

            $phpmailer->setFrom('cuentas@mercadoexpress.com');
            $phpmailer->addAddress('al15020032@itsa.edu.mx'); //A quien le enviamos el email
            $phpmailer->Subject = 'Confirma tu cuenta';

            $phpmailer->isHTML(true);
            $phpmailer->CharSet = 'UTF-8';

            $contenido = "<html>";
            $contenido .= "<p> <strong>Hola ". $this->nombre ."</strong> Has creado tu cuenta en MercadoExpress, solo debes confirmala presionando el siguiente enlace</p>";
            $contenido .= "<p> Presiona Aqui: <a href='http://localhost/confirmar-cuenta?token=". $this->token ."'>Confirmar Cuenta</a></p>";
            $contenido .= "<p>Si tu no solicitaste esta cuenta, pueddes ignorar el mensaje</p>";
            $contenido .= "</html>";

            $phpmailer->Body = $contenido;

            $phpmailer->send();


        } catch (Exception $e) {


            echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
        }


    }

    public function enviarInstrucciones(){
        $phpmailer = new PHPMailer(true);


        try {
            
            $phpmailer->isSMTP();
            $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = 2525;
            $phpmailer->Username = '7204a447927cd2';
            $phpmailer->Password = 'e44d9d2ccf5594';
            

            $phpmailer->setFrom('cuentas@mercadoexpress.com');
            $phpmailer->addAddress('al15020032@itsa.edu.mx'); //A quien le enviamos el email
            $phpmailer->Subject = 'Restablece tu Password';

            $phpmailer->isHTML(true);
            $phpmailer->CharSet = 'UTF-8';

            $contenido = "<html>";
            $contenido .= "<p> <strong>Hola ". $this->nombre ."</strong> Has solicitado restablecer tu password, sigue el siguiente enlace para hacerlo.</p>";
            $contenido .= "<p> Presiona Aqui: <a href='http://localhost/recuperar-password?token=". $this->token ."'>Restablecer Password</a></p>";
            $contenido .= "<p>Si tu no solicitaste esta cuenta, pueddes ignorar el mensaje</p>";
            $contenido .= "</html>";

            $phpmailer->Body = $contenido;

            $phpmailer->send();


        } catch (Exception $e) {


            echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
        }


    }


}




?>














