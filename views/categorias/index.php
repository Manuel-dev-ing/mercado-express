<?php include_once __DIR__ . '/../dashboard/header-dashboard.php'; ?>

<a href="/categorias/crear" class="boton-azul-sm">Nueva Categoria</a>

<?php include_once __DIR__ . "/../templates/alertas-mensajes.php"; ?>

<table class="tabla-categorias verde">

    <thead>
        <tr>
            <th></th>
            <th>Nombre</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categorias as $categoria): ?>
        <tr>
            <td class="td-id"><?php echo $categoria->id; ?></td>
            <td><?php echo $categoria->nombre; ?></td>
            <td> <img class="imagen-tabla" src="/imagenes/<?php echo $categoria->imagen; ?>" alt="imagen tabla"></td>
            <td>
                <div class="tabla-acciones">
                    <form class="" action="/categorias/eliminar" method="post">
                        <input type="hidden" name="id" value="<?php echo $categoria->id; ?>">

                        <input type="submit" class="boton-rojo-sm" value="Eliminar">
                    </form>

                    <a href="/categorias/actualizar?resultado=<?php echo $categoria->id; ?>" class="boton-yellow-sm">Actualizar</a>
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