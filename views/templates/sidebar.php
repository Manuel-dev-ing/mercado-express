<aside class="sidebar">

    <div class="contenedor-sidebar">
        <a href="/dashboard">TiendaVirtual</a>


        <div class="cerrar-menu">
            <img id="cerrar-menu" src="/build/img/cerrar.svg" alt="imagen cerrar">
        </div>
    </div>

    <nav class="sidebar-nav">
        <a href="/dashboard/productos" class="<?php echo ($titulo === 'Productos') ? 'activo' : ''; ?>">productos</a>
        <a href="/dashboard/stock" class="<?php echo ($titulo === 'Stock Productos') ? 'activo' : ''; ?>">stock productos</a>
        <a href="/dashboard/categorias" class="<?php echo ($titulo === 'Categorias') ? 'activo' : ''; ?>">categorias</a>
        <a href="/dashboard/marcas" class="<?php echo ($titulo === 'Marcas') ? 'activo' : ''; ?>">marcas</a>
        <a href="/dashboard/pedidos" class="<?php echo ($titulo === 'Pedidos') ? 'activo' : ''; ?>">Pedidos</a>
       
    </nav>

</aside>




