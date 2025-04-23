(function () {
    console.log("Detalle Producto");
    const id = document.querySelector('#id-producto')
    const btnAgregar = document.querySelector('#btnAgregar')
    const nombre = document.querySelector('#nombre-producto')
    const precio = document.querySelector('#precio-producto')
    const cantidadStock = document.querySelector('#cantidadStock')
    const btnComprarAhora = document.querySelector('#btnComprarAhora')

    const urlParams = new URLSearchParams(window.location.search);
    let arrProductos = []
    let carrito = []

    var productos = JSON.parse(localStorage.getItem('productos')) || []

    events()
    function events() {
        btnAgregar.addEventListener('click', agregarCarrito)
        btnComprarAhora.addEventListener('click', comprar)

        document.addEventListener('DOMContentLoaded', ()=>{
            obtenerProducto()
            establecerCantidadCarrito()
        })

    }
    
    function comprar() {
        console.log("Comprando Ahora...");
        agregarCarrito()
        
    }

    async function obtenerProducto() {
        const id = parseInt(urlParams.get("resultado"))

        console.log("obteniendo producto...");

        try {
            const datos = new FormData();
            datos.append('id', id)
            const url = '/api/obtenerProductoPorId';

            const resultado = await fetch(url, {
                method: 'POST',
                body: datos
            });

            if (resultado.ok) {
                const productos = await resultado.json();

                arrProductos = productos.datos
                
                mostrar()
            }
          

        } catch (error) {
            console.log(error);
        }

    }

    function mostrar() {
        const idProducto = document.querySelector('#id-producto')
        const producto = document.querySelector('#nombre-producto')
        const precio = document.querySelector('#precio-producto')
        const disponibles = document.querySelector('#disponibles')
        const selectStock = document.querySelector('#cantidadStock');
        const containerInfoAdic = document.querySelector('#container-info-adicional');
        const sectionDescripcion = document.querySelector('#descripcion')
        const imagen = document.querySelector('#imagen')

        const contenedorSelectCantidad = document.querySelector('#contenedor-select-cantidad')
        const pStock = document.querySelector('#pStock')

        //Agrega id al producto
        idProducto.value = arrProductos.id

        //Agrega imagen del producto
        let imgElement = document.createElement('img')
        imgElement.src = `/imagenes/${arrProductos.imagen}`;;
        imgElement.alt = 'imagen del producto';

        imagen.appendChild(imgElement)

        //Agrega nombre y precio del producto
        producto.textContent = arrProductos.nombre
        precio.textContent = new Intl.NumberFormat().format( arrProductos.precio ) 
        
        //Select
        const Stock = arrProductos.stock;
        
        if (Stock !== null) {
            if (parseInt(Stock.stock) != 0) {
                console.log("SI hay Stock");
                btnAgregar.disabled = false
                
                disponibles.textContent = `(${Stock.stock} disponibles)`;

                let cantidadStock = parseInt(Stock.stock);
                for (let i = 1; i <= cantidadStock; i++) {

                    const option = document.createElement('option');
                    option.value = i
                    option.textContent = i

                    selectStock.appendChild(option)
                    
                }
            }else{
                contenedorSelectCantidad.remove();    
                pStock.textContent = "No hay Stock disponible"
                pStock.classList.add('error')
                btnAgregar.disabled = true
                btnComprarAhora.remove()
            }
           
        }
        
        // SEccion caracteristicas del producto
        let informacionAdicional = arrProductos.informacionAdicional
        informacionAdicional.forEach(element => {

            //crear el elemento <p>
            let pElement = document.createElement('p');
            pElement.classList.add('section-caract_container-info-adiciona_atributo');

            let textNodepElement = document.createTextNode(element.atributo);

            //crear el elemento <span>
            let spanElement = document.createElement('span')
            spanElement.textContent = ' '+ element.valor;

            pElement.appendChild(textNodepElement)
            pElement.appendChild(spanElement)

            containerInfoAdic.appendChild(pElement)
        });

        //Seccion descripcion
        
        //titulo
        let pH2Descipcion = document.createElement('h2')
        pH2Descipcion.classList.add('section-descripcion_titulo', 'section-titulo')
        pH2Descipcion.textContent = 'Descripcion'

        //Agrega el titulo Descripcion a la section
        sectionDescripcion.appendChild(pH2Descipcion)

        //descripcion
        let pDescripcion = document.createElement('p')
        pDescripcion.classList.add('section-descripcion_parrafo')
        pDescripcion.textContent = `${arrProductos.descripcion}`

        //Agrega la descripcion a la section
        sectionDescripcion.appendChild(pDescripcion)

    }

    function agregarCarrito() {
        console.log('click...');
        let producto = {}
        producto.id_producto = parseInt(id.value)
        producto.cantidad = parseInt(cantidadStock.value)
        producto.producto = nombre.textContent
        producto.precio = Number(precio.textContent.replace(',',''));
        producto.imagen = arrProductos.imagen

        console.log("Producto: ", producto);

        carrito.push(producto)

        productos = [...productos, producto]

        console.log("Producto Agregado al Carrito");

        localStorage.setItem('productos', JSON.stringify(productos))
        establecerCantidadCarrito() 
    }

    function establecerCantidadCarrito() {
        const cantidadBadge = document.querySelector('#badge-cantidad')

        cantidadBadge.textContent = productos.length

    }

})()









