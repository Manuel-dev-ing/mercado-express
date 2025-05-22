<?php include_once __DIR__ . "/../templates/header.php"; ?>

<main>
    <section class="secction">
        <aside class="sidebar-filtros">
            <h5 class="m-0">Marcas</h5>

            <div class="marcas" id="contenedor-marcas">
             
            </div>

            <h5 class="m-0">Precio</h5>
            <div class="">
                <a class="label-filter" id="linkOne-precio">Hasta $ 5,000</a>
                <a class="label-filter" id="linkTwo-precio">$5,000 a $9,000 </a>
                <a class="label-filter" id="linkThree-precio">Mas de $ 9,000</a>
                
                <div class="contenedor-precio-filtro">
                    <!-- <p class="alerta-error-precio"></p> -->
                    <div class="precios-filtros">
                        <input class="input-minimo" type="number" id="minimo" min="0" value="5000"> - 
                        <input class="input-maximo" type="number" id="maximo" min="0" value="9000">
                        <button class="boton-filtrar-precio" id="btn-filtrar-precio" title="buscar"> > </button>
                    </div>
                </div>

            </div>

        </aside>
      
        <section class="resultados">

            <!-- resultados busqueda -->
            <div class="secction-container" id="secctionContainer">

            </div>


            <!-- paginacion -->
            <div class="paginacion">
                

            </div>
        </section>
      

    </section>

</main>

<?php include_once __DIR__ . "/../templates/footer.php"; ?>

<?php 
$script = "
    <script src='/build/js/home.js'></script>
    <script src='/build/js/resultado-productos.js'></script>
    <script src='/build/js/cantidadItemsCarrito.js'></script>
";

?>

