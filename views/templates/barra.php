<div class="barra-mobile">
    <a href="/dashboard">MercadoExpress</a>

    <div class="menu">
        <img id="mobile-menu" src="/build/img/menu.svg" alt="imagen menu">
    </div>

</div>


<div class="barra">
    <a href="/dashboard">MercadoExpress</a>
    <?php
        
        session_start();
        // debuguear($_SESSION);
    ?>
    <p class="parrafo-usuario">Hola, <span class="nombre-usuario"> <?php echo $_SESSION['nombre']; ?> </span></p>
</div>


