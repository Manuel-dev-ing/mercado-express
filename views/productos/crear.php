<?php include_once __DIR__ . '/../dashboard/header-dashboard.php'; ?>

    <a href="/dashboard/productos" class="boton-azul-sm">Regresar</a>

    <form class="contenedor-formulario" method="POST" enctype="multipart/form-data">
        <?php include_once __DIR__ . "/../templates/alertas.php"; ?>

        <div class="contenedor-sm">
            <img src="" alt="producto" class="rounded-circle" id="previmg">
            <!-- <p>Selecciona una imagen para el producto</p> -->
            <label for="imagen">Imagen Producto</label>
            <input type="file" name="imagen" id="img">
            
        </div>
        
        <div class="contenedor-md">
            
            <div class="forms-fields-md">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" placeholder="nombre del producto" id="nombre" value="<?php echo sanitizar($productos->nombre); ?>">
            </div>
            <div class="forms-fields-md">
                <label for="precio">Precio</label>
                <input type="number" name="precio" placeholder="precio del producto" id="precio" value="<?php echo sanitizar($productos->precio); ?>">
            </div>
            <div class="forms-fields-md">
                <label for="marca">Marca</label>
                <select name="id_marca" id="marca">
                    <option value="" selected>-- Selecciona una Opcion --</option>
                <?php foreach ($marcas as $marca) {?>
                        
                        <option <?php $productos->id_marca === $marca->id ? 'selected' : ''; ?> 
                            value="<?php echo sanitizar($marca->id); ?>"> <?php echo sanitizar($marca->nombre); ?> </option>
                    
                    <?php } ?>

                </select>
            </div>
            <div class="forms-fields-md">
                <label for="categoria">Categoria</label>
                <select name="id_categoria" id="categoria">
                    <option value="" selected>-- Selecciona una Opcion --</option>
                    <?php foreach ($categorias as $categoria) {?>
                        
                        <option <?php $productos->id_categoria === $categoria->id ? 'selected' : ''; ?> value="<?php echo sanitizar($categoria->id); ?>"> <?php echo sanitizar($categoria->nombre); ?> </option>

                    <?php }?> 
                
                </select>
            </div>
            <div class="forms-fields-gl">
                <label for="descripcion">Descripcion del Producto</label>
                <textarea name="descripcion" id="descripcion" value="<?php echo sanitizar($productos->descripcion); ?>"></textarea>
            </div>
            
            <div class="forms-fields-md-informacion-adicional">
                <p class="informacion-adicional">Agrega Informacion Adicional del Producto.</p>            
                <p class="informacion-adicional">Pulza en Agregar para para añadir informacion especifica para Producto.</p>            
            </div>            
            <div class="forms-fields-md_btn-agragar">
                <a class="boton-azul-sm btn-agregar-informacion">Agregar</a>           
            </div>            
            <div class="contenedor-informacion-adicional">
                        
            </div>

        </div>

        <input type="submit" value="Guardar" class="boton boton-azul-md">
    </form>    

<?php include_once __DIR__ . '/../dashboard/footer-dashboard.php'; ?>


    <?php 
        $script = "
            <script src='/build/js/app.js'></script>
        ";
    ?>