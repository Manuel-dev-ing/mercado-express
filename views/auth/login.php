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
            <h2 class="titulo-login">Ingresa tu e-mail y password para iniciar sesión</h2>

        </div>

        <div class="contenedor-formulario-login">
            
            <?php include_once __DIR__ . "/../templates/alertas.php"; ?>
            
            <form method="POST" class="formulario" novalidate>
                <div class="formulario-campo">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Tu Email" id="email">
                </div>
         

                <div class="formulario-campo">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Tu Password" id="password">
                </div>
      

                <input type="submit" value="Iniciar Sesión" class="boton boton-azul">
            </form>

            <div class="contenedor-formulario-acciones">
                <a href="/crear-cuenta">Aun no tienes una cuenta? Crear una</a>
                <a href="/olvide-password">Olvidaste tu password?</a>
            </div>


        </div>

    </section>    


   
</main>