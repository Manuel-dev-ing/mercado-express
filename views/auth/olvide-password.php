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
            <h2 class="titulo-login">Restablece tu password escribiendo tu email a continuacion</h2>

        </div>

        <div class="contenedor-formulario-login">
            
            <?php include_once __DIR__ . "/../templates/alertas.php"; ?>

            <form method="POST" class="formulario" action="/olvide-password">
                <div class="formulario-campo">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Tu Email" id="email">
                </div>

                <input type="submit" value="Iniciar Sesión" class="boton boton-azul">
            </form>

            <div class="contenedor-formulario-acciones">
                <a href="/login">Ya tienes una cuenta? Inicia Sesion</a>

                <a href="/crear-cuenta">Aun no tienes una cuenta? Crear una</a>
            </div>


        </div>

    </section>    


   
</main>