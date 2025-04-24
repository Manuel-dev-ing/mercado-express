<?php include_once __DIR__ . '/../dashboard/header-dashboard.php'; ?>

<a href="/marcas/crear" class="boton-azul-sm">Nueva Marca</a>

<?php include_once __DIR__ . "/../templates/alertas-mensajes.php"; ?>

<table class="tabla-categorias verde">

    <thead>
        <tr>
            <th></th>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($marcas as $marca): ?>
        <tr>
            <td class="td-id"><?php echo $marca->id; ?></td>
            <td><?php echo $marca->nombre; ?></td>
            <td><?php echo $marca->fecha_registro; ?></td>
            <td>
                <div class="tabla-acciones">
                    <form class="" action="/marcas/eliminar" method="post">
                        <input type="hidden" name="id" value="<?php echo $marca->id; ?>">

                        <input type="submit" class="boton-rojo-sm" value="Eliminar">
                    </form>

                    <a href="/marcas/actualizar?resultado=<?php echo $marca->id; ?>" class="boton-yellow-sm">Actualizar</a>
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
        <script src='/build/js/menu-mobile.js'></script>
    ";

?>

