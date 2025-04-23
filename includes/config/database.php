
<?php 


function conectarDB(): mysqli{

    $db = new mysqli('localhost', 'root', 'admin$dsDe158', 'carritoCompras');

    if (!$db) {
        echo "Error: No se pudo conectar a MySQL";
        echo "Error de depuracion: ". mysqli_connect_errno();
        echo "Error de depuracion: ". mysqli_connect_error();
        exit;
    }  

    return $db;
}





?>
















