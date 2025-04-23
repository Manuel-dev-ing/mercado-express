<?php include_once __DIR__ . '/../dashboard/header-dashboard.php'; ?>

<a href="/dashboard/stock" class="boton-azul-sm">Regresar</a>

    <form class="contenedor-formulario" method="POST">
        <?php include_once __DIR__ . "/../templates/alertas.php"; ?>

        <input type="hidden" name="id_producto" value="<?php echo sanitizar($stockProducto->id_producto); ?>">

        <div class="contenedor-sm">
            <label for="imagen">Imagen Producto</label>
            <img src="/imagenes/<?php echo sanitizar($productoInformacion[0]->imagen); ?>" alt="producto" class="rounded-circle" id="imagen">
            <!-- <input type="file" name="imagen" id="img"> -->
            
        </div>
        <div class="contenedor-md">
            
            <div class="forms-fields-md">
                <label for="nombre">Producto</label>
                <input type="text" id="nombre" value="<?php echo sanitizar($productoInformacion[0]->nombre) ?>" readonly>
            </div>

            <div class="forms-fields-md">
                <label for="categoria">Categoria</label>
                <input type="text" id="categoria" value="<?php echo sanitizar($productoInformacion[0]->categoria) ?>" readonly>
            </div>
            <div class="forms-fields-md">
                <label for="marca">Marca</label>
                <input type="text" id="marca" value="<?php echo sanitizar($productoInformacion[0]->marca) ?>" readonly>
            </div>

            <div class="forms-fields-md">
                <label for="precio">Precio</label>
                <input type="number" id="precio" value="<?php echo sanitizar($productoInformacion[0]->precio) ?>" readonly>
            </div>
       
            <div class="forms-fields-gl">
                <label for="stock">Stock producto</label>
                <input type="number" min="0" name="stock" id="stock" value="<?php echo sanitizar($stockProducto->stock); ?>">
            </div>
            

        </div>

        <input type="submit" value="Guardar" class="boton boton-azul-md">

    </form>



<?php include_once __DIR__ . '/../dashboard/footer-dashboard.php'; ?>

    <?php 
        $script = "
            <script src='/build/js/alerta.js'></script>
        ";
    ?>


