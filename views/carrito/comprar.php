
<header class="header">

    <nav class="header_navbar">
        <div class="navbar-logotipo">
            <a href="/">MercadoExpress</a>
        </div>

        <form class="navbar-buscar">
           

        </form>

        <div class="navbar-iniciosesion">
            
           
        </div>
    </nav>


</header>


<body class="body-carrito">

 
    <main class="container">

        <section class="card-list ">
            <div class="card-list__titulo ">
                <h4>Elige como pagar</h4>
            </div>

            <div id="paypal-button-container">
                


            </div>

        </section>
        <section class="card-resumen">
            <div class="card-resumen__titulo">
                <h4>Resumen de compra</h4>

            </div>

            <div class="card-resumen_cantidad-productos">
                <p class="producto-subtotal">Productos <span id="productos-cantidad">(0)</span></p>
                <p class="producto-precio" id="subtotal">$ 0</p>
            </div>

            <div class="card-resumen_total">
                <p class="producto-total">Total</p>
                <p class="producto-total-precio" id="total">$ 0</p>
            </div>


        </section>

    </main>

</body>

<?php include_once __DIR__ . "/../templates/footer.php"; ?>
<?php 

    $script = "
        <script src='/build/js/pago.js'></script>
        <script src='https://www.paypal.com/sdk/js?client-id=AXRXxnt2lypx3QSTFFTG_iwYe3X6CHmadmSttw4tO7_wFGSbXISGiT2dIcPWqpUZh9KjoqyI70rk_QWh&components=buttons&currency=MXN'></script>
    
    ";

?>