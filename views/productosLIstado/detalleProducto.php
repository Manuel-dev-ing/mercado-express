<?php include_once __DIR__ . "/../templates/header.php"; ?>

<main class="main">
    
    <section class="main_secction">
        <div class="container-detail-product ">

            <div class="container-product ">
                <div class="product-image" id="imagen">
                    <!-- <img src="/imagenes/f05a06d3b4f50e2546900d70c2a134cd.jpg" id=""> -->
                </div>
                <div class="producto-info">
                    <input type="hidden" id="id-producto">
                    <p class="producto-info_vendidos">Nuevo <span>|</span> +100 vendidos</p>
                    <p class="producto-info_nombre" id="nombre-producto">Apple iPhone 13 mini (256 GB) - Verde</p>
                    <p class="producto-info_precio">$<span id="precio-producto"></span> </p>
                    <p class="producto-info_msi">en <span>15 meses sin intereses de $933</span></p>
                    <p class="producto-info_iva">IVA incluido</p>
                </div>
            </div>
            <div class="container-info">
                <p class="parrafo-regular"><span class="span-green">Llega gratis manaña</span> por ser tu primera compra</p>
                <p class="stock" id="pStock">Stock disponible</p>
                <div class="container-cantidad" id="contenedor-select-cantidad">
                    <label class="label-cantidad" for="cantidad">Cantidad:</label>
                    <select class="select-cantidad" id="cantidadStock">
                     
                    </select>
                    <span class="span-disponibles" id="disponibles"></span>
                </div>
                <div class="conatainer-actions">
                    <a class="btn btn-primary" href="/productos/pago" id="btnComprarAhora">Comparar ahora</a>
                    <button class="btn btn-secondary" id="btnAgregar" disabled>Agregar al carrito</button>
                </div>

            </div>
        </div>

      
    </section>
    
    <section class="section-caract">
        <h2 class="section-titulo">Características del producto</h2>

        <div class="section-caract_container-info-adicional" id="container-info-adicional">
            
        </div>

    </section>

    <section class="section-descripcion" id="descripcion">
     
      
    </section>

</main>

<?php include_once __DIR__ . "/../templates/footer.php"; ?>

<?php 

    $script = "
        <script src='/build/js/home.js'></script>
        <script src='/build/js/detalle-producto.js'></script>
        <script src='/build/js/cantidadItemsCarrito.js'></script>

    ";

?>

