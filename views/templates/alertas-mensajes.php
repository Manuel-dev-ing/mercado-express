
<?php if (intval($resultado) === 1) :?>
    <p class="alerta exito">Creada Correctamente</p> 


<?php elseif (intval($resultado) === 2): ?>
    <p class="alerta actualizado">Actualizada Correctamente</p>

<?php elseif (intval($resultado) === 3): ?>
        
    <p class="alerta eliminado">Eliminado Correctamente</p>

<?php endif; ?>