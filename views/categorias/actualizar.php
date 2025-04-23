<?php include_once __DIR__ . '/../dashboard/header-dashboard.php'; ?>

    <a href="/dashboard/categorias" class="boton-azul-md">Regresar</a>

    <div class="contenedor-formulario">
        
        
        <form class="form" method="POST" enctype="multipart/form-data">

            <?php include_once __DIR__ . "/../templates/alertas.php"; ?>
            
            <div class="forms-fields">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" placeholder="nombre de la categoria" id="nombre" value="<?php echo sanitizar($categorias->nombre); ?>">
            </div>

            <div class="forms-fields">
                <label for="imagen">Imagen categoria</label>
                <input type="file" name="imagen" id="imagen">
                <img class="imagen-tabla" src="/imagenes/<?php echo $categorias->imagen; ?>" alt="imagen categoria">
            </div>

            <input type="submit" value="Guardar" class="boton boton-azul-md">

        </form>
    </div>
    


<?php include_once __DIR__ . '/../dashboard/footer-dashboard.php'; ?>
