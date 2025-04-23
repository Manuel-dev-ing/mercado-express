<header class="header">

        <nav class="navbar-login">
            <div class="navbar-logotipo">
                <p>MercadoExpress</p>
            </div>
        </nav>
</header>

<main class="contenedor">

    <section class="section-login">
        <div class="contenedor-titulo-login">
            <h2>Recuperar tu Password</h2>
            <h3 class="titulo-login">Coloca tu nuevo password a continuacion</h3>
        </div>

        <div class="contenedor-formulario-login">
            
            <?php include_once __DIR__ . "/../templates/alertas.php"; ?>

            <?php if ($error) return; ?>
            
            <form method="POST" class="formulario">
                <div class="formulario-campo">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Tu password" id="password">
                </div>

                <input type="submit" value="Guardar nuevo password" class="boton boton-azul">
            </form>

            <div class="contenedor-formulario-acciones">
                <a href="/login">Ya tienes una cuenta? Inicia Sesion</a>

                <a href="/crear-cuenta">Aun no tienes una cuenta? Crear una</a>
            </div>


        </div>

    </section>    


   
</main>