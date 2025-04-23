<?php 

    if (!isset($_SESSION)) {
        session_start();
    }

    $auth = $_SESSION['login'] ?? null;

?>
<header class="header">

    <nav class="header_navbar">
        <div class="navbar-logotipo">
            <a href="/">MercadoExpress</a>
        </div>

        <form class="navbar-buscar">
            <div class="navbar-buscar_div-search">
                <input class="nav-search-input" type="text" name="" id="search-input">
                
                <button type="submit" class="nav-search-btn">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
            
            <ul class="list-group rounded-3 lista-ul" id="lista">
                
            
            </ul>

        </form>

        <div class="navbar-iniciosesion">
            
            <div class="div-carrito">
                <a href="/productos/carrito"><i class="fa-solid fa-cart-shopping"> </i></a>     
                <span class="badge" id="badge-cantidad">99+</span> 
            </div>
            <ul class="div-auth">
                <?php if ($auth == false): ?>
                    <li><a href="/login">Iniciar Sesion</a></li>
                <?php endif ?>
                <?php if ($auth): ?>
                    <li class="li-usuario">
                        <a href="#" class="usuario">Hola, <span class=""> <?php echo $_SESSION['nombre']; ?> </span></a>
                        <ul>
                            <li class="cerrar-sesion"><a href="#">Cerrar Sesion</a></li>
                        </ul>
                    </li>

                   
                <?php endif ?>
            </ul>
        </div>
    </nav>


</header>