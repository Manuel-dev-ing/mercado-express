    <?php 
        if (!isset($_SESSION)) {
            session_start();
        }

        $auth = $_SESSION['login'] ?? null;

    ?>
    <header class="header">

        <nav class="navbar">
            <div class="navbar-logotipo">
                <a class="logotipo" href="/">MercadoExpress</a>
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
        
        <div class="header-slider">
            <div class="header-slider-iner">
                <img src="/build/img/samsung_desk.jpg" alt="banner xiaomi">
                
            </div>
        </div>

    </header>

    <main class="contenedor">
        
        <h4 class="contenedor__titulo">Categorias</h4>
        
        <div class="swiper">
        
            <div class="card-wrapper">
                
                <section class="contenedor-categorias swiper-wrapper">
                    
                    <?php foreach ($categories as $contendor): ?>
                        <div class="categorias swiper-slide ">
                            <?php foreach ($contendor as $categoria): ?>
                                
                                <div class="categorias-card">
                                    <img class="card-img" src="/imagenes/<?php echo $categoria->imagen; ?>" alt="<?php echo $categoria->nombre; ?>">
                                    <a href="/productos/mostrarProductos?resultado=<?php echo $categoria->id ?>" class="card-title"><?php echo $categoria->nombre; ?></a>
                                </div>

                            <?php endforeach; ?>
                        </div>

                    <?php endforeach; ?>
                           
                
                
                </section>

            </div>

             <!-- If we need pagination -->
             <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->

            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>    
        </div>


        <section class="contenedor-informacion-compras">
            
            <div class="informacion-compras">
                <div class="informacion-compra-pagar">
                    <img class="img-pagar" src="/build/img/payment.svg" alt="informacion compra pagar">
                    <h2 class="titulo">Elige cómo pagar</h2>
                    <p class="descripcion">Puedes pagar con tarjeta, débito, efectivo o con Meses sin Tarjeta.</p>
                </div>

                <div class="informacion-compra-pagar">
                    <img class="img-pagar" src="/build/img/shipping.svg" alt="informacion compra">
                    <h2 class="titulo">Envío gratis por ser tu primera compra</h2>
                    <p class="descripcion">Aprovecha este beneficio en millones de productos.</p>
                </div>

                <div class="informacion-compra-pagar">
                    <img class="img-pagar" src="/build/img/protected.svg" alt="informacion seguridad">
                    <h2 class="titulo">Seguridad, de principio a fin</h2>
                    <p class="descripcion">¿No te gusta? ¡Devuélvelo! En MercadoExpress, no hay nada que no puedas hacer, porque estás siempre protegido.</p>
                </div>

            </div>   
          



        </section>

    </main>

    <footer class="footer-container">
        <div class="footer-acercade">
            <h3 class="footer-title text-white">Acerca de</h3>
            <p class="text-white footer-parrafo">MercadoExpress</p>
            <p class="text-white footer-parrafo">Sustentabilidad</p>
            <p class="text-white footer-parrafo">Blog</p>
        </div>

        <div class="footer-micuenta">
            <h3 class="footer-title text-white">Mi cuenta</h3>
            <p class="text-white footer-parrafo">Ingresa</p>
            <p class="text-white footer-parrafo">Registrate</p>
        </div>
        
        <div class="footer-ayuda">
            <h3 class="footer-title text-white">Ayuda</h3>
            <p class="text-white footer-parrafo">Resolución de problemas</p>
            <p class="text-white footer-parrafo">Centro de seguridad</p>
        </div>


    </footer>

    <?php 
        $script = "
            <script src='/build/js/home.js'></script>
            <script src='/build/js/cantidadItemsCarrito.js'></script>
        ";
    ?>










