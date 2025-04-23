<?php include_once __DIR__ . '/../dashboard/header-dashboard.php'; ?>

<div class="contenedor">
    <p>Datos del cliente</p>
</div>

<div class="contenedor-lg">
    <div class="forms-fields-md">
        <label for="usuario">Usuario</label>
        <input type="text" name="usuario" id="usuario" value="<?php echo sanitizar($detalle_pedido[0]->usuario->nombre); ?>" readonly>
    </div>
    <div class="forms-fields-md">
        <label for="cliente">Nombre cliente</label>
        <input type="text" name="cliente" id="cliente" value="<?php echo sanitizar($detalle_pedido[0]->cliente->nombreCompleto); ?>">
    </div>
    <div class="forms-fields-md">
        <label for="correo">Correo electronico</label>
        <input type="text" name="correo" id="correo" value="<?php echo sanitizar($detalle_pedido[0]->cliente->correo_electronico); ?>">
    </div>
    <div class="forms-fields-md">
        <label for="fecha">Fecha del pedido</label>
        <input type="text" name="fecha" id="fecha" value="<?php echo sanitizar($detalle_pedido[0]->cliente->fecha); ?>">
    </div>
    <div class="forms-fields-md">
        <label for="codigo">Codigo pais</label>
        <input type="text" name="codigo" id="codigo" value="<?php echo sanitizar($detalle_pedido[0]->cliente->codigo_pais); ?>">
    </div>
</div>
<table class="tabla-categorias verde">

    <thead>
        <tr>
            <th></th>
            <th>Id Pedido</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($detalle_pedido as $pedido): ?>
            <tr>
                <td class="td-id"><?php echo $pedido->id; ?></td>
                <td><?php echo $pedido->id_pedido; ?></td>
                <td><?php echo $pedido->producto; ?></td>
                <td><?php echo $pedido->cantidad; ?></td>
                <td><?php echo $pedido->precio; ?></td>
               


            </tr>
        <?php endforeach; ?>
    </tbody>
</table>







<?php include_once __DIR__ . '/../dashboard/footer-dashboard.php'; ?>
