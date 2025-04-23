(function () {
    establecerCantidadCarrito();

    function establecerCantidadCarrito() {
        
        var productos = JSON.parse(localStorage.getItem('productos')) || []

        const cantidadBadge = document.querySelector('#badge-cantidad')

        cantidadBadge.textContent = productos.length

    }
})()
