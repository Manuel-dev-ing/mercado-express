<?php include_once __DIR__ . '/../dashboard/header-dashboard.php'; ?>

<a href="/productos/crear" class="boton-azul-sm">Nuevo Producto</a>

<?php include_once __DIR__ . "/../templates/alertas-mensajes.php"; ?>

<table class="tabla-categorias verde">

    <thead>
        <tr>
            <th></th>
            <th>Nombre</th>
            <th>Marca</th>
            <th>Categoria</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($productos as $producto): ?>
        <tr>
            <td class="td-id"><?php echo $producto->id; ?></td>
            <td><?php echo $producto->nombre; ?></td>
            <td><?php echo $producto->marca->nombre; ?></td>
            <td><?php echo $producto->categoria->nombre; ?></td>
            <td><?php echo $producto->precio; ?></td>
            <td>
                <div class="tabla-acciones">
                    <form action="/productos/eliminar" method="post">
                        <input type="hidden" name="id" value="<?php echo $producto->id; ?>">

                        <input type="submit" class="boton-rojo-sm" value="Eliminar">
                    </form>

                    <a href="/productos/actualizar?resultado=<?php echo $producto->id; ?>" class="boton-yellow-sm">Actualizar</a>
                </div>
            </td>


        </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<?php echo $paginacion; ?>


<?php include_once __DIR__ . '/../dashboard/footer-dashboard.php'; ?>


<?php 
    $script = "
    <script src='/build/js/productos-index.js'></script>
    <script src='/build/js/menu-mobile.js'></script>
    ";
?>
