<?php include_once __DIR__ . "/../templates/header.php"; ?>

<body class="body-carrito">
    <main class="container">
        <section class="card-list ">
            <div class="card-list__titulo ">
                <h4>Productos</h4>
            </div>

            <div id="lists-items">
                


            </div>

        </section>
        <section class="card-resumen">
            <div class="card-resumen__titulo">
                <h4>Resumen de compra</h4>

            </div>

            <div class="card-resumen_cantidad-productos">
                <p class="producto-subtotal">Productos <span id="productos-cantidad">(0)</span></p>
                <p class="producto-precio">$<span id="subtotal"></span></p>
            </div>

            <div class="card-resumen_total">
                <p class="producto-total">Total</p>
                <p class="producto-total-precio">$<span id="total"></span></p>
            </div>

            <a type="button" href="/productos/pago" id="btnComprar" class="btn btn-primary" disabled>Comparar ahora</a>

        </section>

    </main>

</body>

<?php include_once __DIR__ . "/../templates/footer.php"; ?>
<?php 

    $script = "
        <script src='/build/js/carrito.js'></script>
        <script src='/build/js/home.js'></script>

    ";

?>