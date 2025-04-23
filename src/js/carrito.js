console.log("carrito");
const contenedorItems = document.querySelector('#lists-items')
var itemsCarrito = JSON.parse(localStorage.getItem('productos')) || [];
// console.log(itemsCarrito);


document.addEventListener('DOMContentLoaded', ()=>{
    establecerCantidadCarrito()
    obtener()
    estaVacioCarrito()
})


function estaVacioCarrito() {
    const btnComprar = document.querySelector('#btnComprar')
    
    if (itemsCarrito.length === 0) {
        
        btnComprar.remove()

    }
    
}

function obtener() {
    

    itemsCarrito.forEach(element => {

        // Crear el contenedor principal de la tarjeta
        const cardItem = document.createElement('div');
        cardItem.classList.add('card-list__item');

        // Crear la sección de la imagen
        const itemImage = document.createElement('div');
        itemImage.classList.add('item-imagen');
        
        const image = document.createElement('img')
        image.classList.add('imagen-portada')
        image.src = `/imagenes/${element.imagen}`

        itemImage.appendChild(image)

        // Crear la sección de descripción
        const itemDescription = document.createElement('div');
        itemDescription.classList.add('item-descripcion');

        const descriptionText = document.createElement('p');
        descriptionText.textContent = `${element.producto}`;

        const itemActions = document.createElement('div');
        itemActions.classList.add('item-acciones');

        const eliminarLink = document.createElement('a');
        eliminarLink.href = '#';
        eliminarLink.textContent = 'Eliminar';
        eliminarLink.onclick = function(){
            eliminar(element.id)
        }

        const guardarLink = document.createElement('a');
        guardarLink.href = '#';
        guardarLink.textContent = 'Guardar';

        const comprarLink = document.createElement('a');
        comprarLink.href = '#';
        comprarLink.textContent = 'Comprar ahora';

        // Agregar los enlaces a la sección de acciones
        itemActions.appendChild(eliminarLink);
        itemActions.appendChild(guardarLink);
        itemActions.appendChild(comprarLink);

        // Agregar todo a la sección de descripción
        itemDescription.appendChild(descriptionText);
        itemDescription.appendChild(itemActions);

        // Crear la sección de cantidad
        const itemCantidad = document.createElement('div');
        itemCantidad.classList.add('item-cantidad');

        const itemCantidadContainer = document.createElement('div');
        itemCantidadContainer.classList.add('item-cantidad_container');

        const minusButton = document.createElement('button');
        minusButton.textContent = '-'
        minusButton.onclick = function () {
            let cantidad = parseInt(element.cantidad)
            element.cantidad = cantidad

            restarCantidad(element)
        }

        const quantitySpan = document.createElement('span');
        quantitySpan.classList.add('span-cantidad');
        quantitySpan.textContent = `${element.cantidad}`;

        const plusButton = document.createElement('button');
        plusButton.textContent = '+';
        plusButton.onclick = function () {
            let cantidad = parseInt(element.cantidad)
            element.cantidad = cantidad

            sumarCantidad(element)
        }

        // Agregar los botones y el span de cantidad al contenedor de cantidad
        itemCantidadContainer.appendChild(minusButton);
        itemCantidadContainer.appendChild(quantitySpan);
        itemCantidadContainer.appendChild(plusButton);

        // Agregar el contenedor de cantidad a la sección de cantidad
        itemCantidad.appendChild(itemCantidadContainer);

        // Crear la sección de precio
        const itemPrecio = document.createElement('div');
        itemPrecio.classList.add('item-precio');

        const priceText = document.createElement('p');
        priceText.textContent = '$' + new Intl.NumberFormat().format(element.precio)

        // Agregar el texto de precio a la sección de precio
        itemPrecio.appendChild(priceText);

        // Finalmente, agregar todos los elementos creados al contenedor principal de la tarjeta
        cardItem.appendChild(itemImage);
        cardItem.appendChild(itemDescription);
        cardItem.appendChild(itemCantidad);
        cardItem.appendChild(itemPrecio);

        contenedorItems.appendChild(cardItem)

    });
    calcularTotales()
}



function eliminar(id) {
    
    itemsCarrito = itemsCarrito.filter(item => item.id !== id)

    sincronizarLS()
    limpiarContenedor()
    obtener()
    establecerCantidadCarrito()

}


function sumarCantidad(element) {

    if (element.cantidad > 0) {
        
        if (itemsCarrito.some(item => item.id === element.id)) {
            const itemActualizado = itemsCarrito.map(item => {
                if (item.id === element.id && item.cantidad < 5) {
                    item.cantidad = element.cantidad + 1
                }

                return item
            })
            itemsCarrito = [...itemActualizado]
            sincronizarLS()
            limpiarContenedor()
            obtener()

        }

    }
    
}

function restarCantidad(element) {

    if (element.cantidad > 0) {
        
        if (itemsCarrito.some(item => item.id === element.id)) {
            const itemActualizado = itemsCarrito.map(item => {
                if (item.id === element.id && item.cantidad > 1) {
                    item.cantidad = element.cantidad - 1
                }

                return item
            })
            itemsCarrito = [...itemActualizado]
            sincronizarLS()
            limpiarContenedor()
            obtener()
        }

    }

    
}

function sincronizarLS() {
    localStorage.setItem('productos', JSON.stringify(itemsCarrito))
}

function limpiarContenedor() {
    while (contenedorItems.firstChild) {
        contenedorItems.removeChild(contenedorItems.firstChild)
    }
}

function establecerCantidadCarrito() {
        
    const cantidadBadge = document.querySelector('#badge-cantidad')

    cantidadBadge.textContent = itemsCarrito.length

}


function calcularTotales() {
    
    const productosCantidad = document.querySelector('#productos-cantidad')
    const psubtotal = document.querySelector('#subtotal')
    const ptotal = document.querySelector('#total')
    
    let total = 0;
    
    itemsCarrito.forEach(element => {
        let precio = element.precio

        total += element.cantidad * precio        
    });
    
    productosCantidad.textContent = `(${cantidadProdcutos()})`
    psubtotal.textContent = new Intl.NumberFormat().format( total )
    ptotal.textContent = new Intl.NumberFormat().format( total )

}


function cantidadProdcutos() {
    
    var total = 0;
    itemsCarrito.forEach(element => {
        total += element.cantidad
        
    });

    return total
}
