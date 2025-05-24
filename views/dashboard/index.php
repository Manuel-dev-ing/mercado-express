<?php include_once __DIR__ . '/header-dashboard.php'; ?>


<div class="contenedor-dashboard">


    <div class="dashboard-totales">

        <div class="dashboard card">
            <h5 class="card-titulo">Total Pedidos</h5>
            <div class="card-body">
                <p><?php echo $total_pedidos; ?></p>
                <p>pedidos</p>
            </div>
        </div>

        <div class="dashboard card">
            <h5 class="card-titulo">Total Ingresos</h5>
            <div class="card-body">
                <p>$ <?php echo $total_ingresos; ?></p>
            </div>
        </div>
    </div>

    
    <div class="dashboard-card-top">
        <h5 class="card-titulo">Top productos mas vendidos</h5>
        <div class="card-body">
            <?php foreach ($top_productos as $producto) {?>
                <p class="card-texto"><?php echo $producto->producto->nombre; ?></p>
            <?php } ?>
        </div>
    </div>
    
    
</div>






<?php include_once __DIR__ . '/footer-dashboard.php'; ?>













