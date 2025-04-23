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
            <h2 class="titulo-login">Llena el siguiente formulario para crear una cuenta</h2>

        </div>

        <div class="contenedor-formulario-login">
            <?php include_once __DIR__ . "/../templates/alertas.php"; ?>

            <form method="POST" class="formulario" action="/crear-cuenta">

                <div class="formulario-campo">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" placeholder="Tu nombre" id="email" value="<?php echo sanitizar($usuario->nombre); ?>">
                </div>

                <div class="formulario-campo">
                    <label for="apellido">Apellidos</label>
                    <input type="text" name="apellido" placeholder="Tu apellidos" id="apellido" value="<?php echo sanitizar($usuario->apellido); ?>">
                </div>

                <div class="formulario-campo">
                    <label for="telefono">Telefono</label>
                    <input type="tel" name="telefono" placeholder="Tu telefono" id="telefono" value="<?php echo sanitizar($usuario->telefono); ?>">
                </div>

                <div class="formulario-campo">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Tu email" id="email" value="<?php echo sanitizar($usuario->email); ?>">
                </div>
                
                <div class="formulario-campo">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Tu password" id="password">
                </div>

                <input type="submit" value="crear cuenta" class="boton boton-azul">
            
            </form>

            <div class="contenedor-formulario-acciones">
                <a href="/login">Ya tienes una cuenta? Inicia Sesion</a>
                <!-- <a href="/olvide-password">Olvidaste tu password?</a> -->
            </div>


        </div>

    </section>    


   
</main>