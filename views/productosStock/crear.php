<?php include_once __DIR__ . '/../dashboard/header-dashboard.php'; ?>

<a href="/dashboard/stock" class="boton-azul-sm">Regresar</a>



    <form class="contenedor-formulario" method="POST">
        <?php include_once __DIR__ . "/../templates/alertas.php"; ?>
        
        <div class="contenedor-sm">
            <label for="imagen">Imagen Producto</label>
            <img src="/imagenes/no-image.jpg" alt="producto" class="rounded-circle" id="imagen">
            <!-- <input type="file" name="imagen" id="img"> -->
            
        </div>
        <div class="contenedor-md">
            
            <div class="forms-fields-md">
                <label for="id_producto">Producto</label>
                <select name="id_producto" id="id_producto">
                    <option value="" selected>-- Selecciona una Opcion --</option>
                    <?php foreach ($productos as $producto) {?>
                        
                        <option <?php $stockProductos->id_producto === $producto->id ? 'selected' : ''; ?> 
                            value="<?php echo sanitizar($producto->id); ?>"> <?php echo sanitizar($producto->nombre); ?> </option>
                    
                    <?php } ?>

                </select>
                <span class="validacion">Seleccione una opcion valida</span>
            </div>

            <div class="forms-fields-md">
                <label for="categoria">Categoria</label>
                <input type="text" id="categoria" readonly>
            </div>
            <div class="forms-fields-md">
                <label for="marca">Marca</label>
                <input type="text" id="marca" readonly>
            </div>

            <div class="forms-fields-md">
                <label for="precio">Precio</label>
                <input type="number" id="precio" readonly>
            </div>
       
            <div class="forms-fields-gl">
                <label for="stock">Agrega stock al producto</label>
                <input type="number" name="stock" id="stock" placeholder="escribe la cantidad de stock para el producto">
            </div>
            

        </div>


       

        <input type="submit" value="Guardar" class="boton boton-azul-md">

    </form>



<?php include_once __DIR__ . '/../dashboard/footer-dashboard.php'; ?>

    <?php 
        $script = "
            <script src='/build/js/crear-stockProductos.js'></script>
            <script src='/build/js/alerta.js'></script>
        ";
    ?>


