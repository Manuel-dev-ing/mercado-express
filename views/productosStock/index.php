<?php include_once __DIR__ . '/../dashboard/header-dashboard.php'; ?>

<a href="/productosStock/crear" class="boton-azul-sm">Nuevo stock</a>

<?php include_once __DIR__ . "/../templates/alertas-mensajes.php"; ?>

<table class="verde">

    <thead>
        <tr>
            <th></th>
            <th>Producto</th>
            <th>Stock</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($stock as $stockProductos): ?>
        <tr>
            <td class="td-id"><?php echo $stockProductos->id; ?></td>
            <td><?php echo $stockProductos->producto->nombre; ?></td>
            <td><?php echo $stockProductos->stock; ?></td>

            <td>
                <div class="tabla-acciones">
                    <form class="" action="/productosStock/eliminar" method="post">
                        <input type="hidden" name="id" value="<?php echo $stockProductos->id; ?>">

                        <input type="submit" class="boton-rojo-sm" value="Eliminar">
                    </form>

                    <a href="/productosStock/actualizar?resultado=<?php echo $stockProductos->id; ?>" class="boton-yellow-sm">Actualizar</a>
                </div>
            </td>


        </tr>
   <?php endforeach; ?>
    </tbody>
</table>

<?php include_once __DIR__ . '/../dashboard/footer-dashboard.php'; ?>

<?php 

    $script = "
        <script src='/build/js/alerta.js'></script>
        <script src='/build/js/menu-mobile.js'></script>
    ";

?>



