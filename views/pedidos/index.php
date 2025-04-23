<?php include_once __DIR__ . '/../dashboard/header-dashboard.php'; ?>


<table class="tabla-categorias verde">

    <thead>
        <tr>
            <th></th>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Correo Electronico</th>
            <th>Codigo Pais</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pedidos as $pedido): ?>
            <tr>
                <td class="td-id"><?php echo $pedido->id; ?></td>
                <td><?php echo $pedido->usuario->nombre; ?></td>
                <td><?php echo $pedido->nombre; ?></td>
                <td><?php echo $pedido->apellidos; ?></td>
                <td><?php echo $pedido->correo_electronico; ?></td>
                <td><?php echo $pedido->codigo_pais; ?></td>
                <td><?php echo $pedido->fecha; ?></td>
                <td>
                    <div class="tabla-acciones">
                     
                        <a href="/pedidos/detalle?resultado=<?php echo $pedido->id_pedido; ?>" class="boton-yellow-sm">Detalle</a>
                    </div>
                </td>


            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<?php include_once __DIR__ . '/../dashboard/footer-dashboard.php'; ?>

<?php 

    $script = "
        <script src='/build/js/menu-mobile.js'></script>
    ";

?>

