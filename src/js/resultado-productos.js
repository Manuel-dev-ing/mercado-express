(function () {
    console.log("Productos Resultados");
    
    const urlParams = new URLSearchParams(window.location.search);
    let arrProductos = [] 

    document.addEventListener('DOMContentLoaded', () =>{
        
        obtenerResultadoProductos()

    })

    async function obtenerResultadoProductos() {
        const id = urlParams.get("resultado")
        
        try {
            const datos = new FormData();
            datos.append('id', id)

            console.log("form data: ", datos);
            
            const url = '/api/obtenerResultadosBusqueda';

            const resultado = await fetch(url, {
                method: 'POST',
                body: datos
            });

            if (resultado.ok) {
                const productos = await resultado.json();

                arrProductos = [...productos.datos]
                mostrar()
            }
          
            // console.log(productos.datos);
            // mostrar(productos.datos)

        } catch (error) {
            console.log(error);
        }
    }

    function mostrar() {
        const section = document.querySelector('#secctionContainer')
        
        arrProductos.forEach(element => {
            // console.log(element);

            //Principal
            const sectionResultados = document.createElement('section')
            sectionResultados.classList.add('secction_resultados')

            //Secundario
            const div = document.createElement('div')
            div.classList.add('card', 'secction_producto')

            //Portada
            const divPortada = document.createElement('div')
            divPortada.classList.add('card_producto-portada')
            
            const img = document.createElement('img')
            img.classList.add('card_producto-portada');
            img.src = `/imagenes/${element.imagen}`;
            img.alt = 'imagen portada'
            
            divPortada.appendChild(img)

            div.appendChild(divPortada)

            //div informacion del producto
            const divInformacion = document.createElement('div')
            divInformacion.classList.add('card_producto-informacion')

            const nombreProducto = document.createElement('p')
            nombreProducto.classList.add('nombre-producto')
            // nombreProducto.textContent = `${element.nombre}`

            const linkNombreProducto = document.createElement('a')
            linkNombreProducto.classList.add('link-nombre-producto')
            linkNombreProducto.href = `/productos/detalleProducto?resultado=${element.id}`
            linkNombreProducto.textContent = `${element.nombre}`
            nombreProducto.appendChild(linkNombreProducto)

            divInformacion.appendChild(nombreProducto)
            
            //div contenido
            const divContenido = document.createElement('div')
            divContenido.classList.add('producto-informacion_contenido')

            const precioLine = document.createElement('p')
            precioLine.classList.add('line')
            precioLine.textContent = '$19853'

            divContenido.appendChild(precioLine)

            //precio
            const precioProducto = document.createElement('p')
            precioProducto.classList.add('producto-precio')
            const precio = new Intl.NumberFormat().format(element.precio)
            precioProducto.textContent = `${precio} `
            
            const spanDesc = document.createElement('span')
            spanDesc.textContent = '25% OFF'
            precioProducto.appendChild(spanDesc)
            
            divContenido.appendChild(precioProducto)
            //fin precio
            
            //meses sin intereses
            const productoMSI = document.createElement('p')
            productoMSI.classList.add('producto-mesesintereses')
            productoMSI.textContent = 'en '

            const spanmsi = document.createElement('span')
            spanmsi.textContent = '15 meses sin intereses de $999.95'
            productoMSI.appendChild(spanmsi)

            divContenido.appendChild(productoMSI)
            // fin meses sin intereses

            const promo = document.createElement('p')
            promo.classList.add('producto-promocion')
            promo.textContent = 'por ser tu primera compra '

            const spanpromo = document.createElement('span')
            spanpromo.textContent = 'Llega gratis mañana'
            promo.appendChild(spanpromo)


            divContenido.appendChild(promo)
            //fin div contenido

            divInformacion.appendChild(divContenido)

            div.appendChild(divInformacion)

            // div.appendChild(divContenido)

            sectionResultados.appendChild(div)
            console.log(sectionResultados);
            
            section.appendChild(sectionResultados)

        });
        


    }










})()


