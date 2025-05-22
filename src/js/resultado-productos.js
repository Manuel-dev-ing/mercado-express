(function () {
    console.log("Productos Resultados");
    
    const urlParams = new URLSearchParams(window.location.search);
    const btnFiltrarPrecio = document.querySelector('#btn-filtrar-precio')

    let arrProductos = [] 
    let arrMarcas = []
    let prodductosFiltrados = []

    let pagina_actual = 1
    let total_paginas = 0
    let pagina_siguiente = 0
    let pagina_anterior = 0

    obtenerResultadoProductos()

    async function obtenerResultadoProductos() {
        const id = urlParams.get("resultado")

        try {
            const datos = new FormData();
            datos.append('id', id)
            datos.append('pagina', pagina_actual)

            const url = '/api/obtenerResultadosBusqueda';

            const resultado = await fetch(url, {
                method: 'POST',
                body: datos
            });

            if (resultado.ok) {
                const productos = await resultado.json();
                console.log("productos: ", productos);
                
                total_paginas = productos.total_paginas
                pagina_siguiente = productos.pagina_siguiente
                pagina_anterior = productos.pagina_anterior

                console.log("total paginas: ", total_paginas);
                console.log("pagina_siguiente: ", pagina_siguiente);
                console.log("pagina_anterior: ", pagina_anterior);
                
                arrProductos = [...productos.datos]
                console.log("arrProductos: ", arrProductos);

                arrMarcas = [...productos.marcas]
                
                mostrar()
                mostrarMarcas()
                paginacion()
            }
            
            
            // mostrar(productos.datos)

        } catch (error) {
            console.log(error);
        }
    }

    function mostrar() {
        const section = document.querySelector('#secctionContainer')
        const productos = prodductosFiltrados.length ? prodductosFiltrados : arrProductos

        //limpiar
        while (section.firstChild) {
            section.removeChild(section.firstChild)
        }

        //mostrar
        productos.forEach(element => {
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
            section.appendChild(sectionResultados)

        });

    }

    function mostrarMarcas() {
        const contenedorMarcas = document.querySelector('#contenedor-marcas')
        //limpiar
        while (contenedorMarcas.firstChild) {
            contenedorMarcas.removeChild(contenedorMarcas.firstChild)
        }

        arrMarcas.forEach(marca => {
            const contenedorMarca = document.createElement('div')
            contenedorMarca.classList.add('contenedor-marca')

            //label
            const labelMarca = document.createElement('label')
            labelMarca.setAttribute('for', `marca${marca.id}`)
            labelMarca.classList.add('label-filter')
            labelMarca.textContent = marca.nombre

            // input
            const inputMarca = document.createElement('input')
            inputMarca.type = "checkbox"
            inputMarca.setAttribute('id', `marca${marca.id}`)
            inputMarca.setAttribute('data-id', marca.id)

            contenedorMarca.appendChild(inputMarca)
            contenedorMarca.appendChild(labelMarca)


            contenedorMarcas.appendChild(contenedorMarca)
        })

        const checkboxMarca = document.querySelectorAll('input[type="checkbox"]');
        checkboxMarca.forEach(item => item.addEventListener('click', filtrarMarca))
    }

    function filtrarMarca(e) {
        const id_marca = e.target.getAttribute('data-id')

        const isChecked = e.target.checked

        var copy_arrProducts = [...arrProductos]

        console.log("id marca: ", id_marca);

        if (isChecked) {
           console.log("checked...");
           

            const array = copy_arrProducts.filter(item => item.id_marca === id_marca)
            console.log(array);
            if (array.length !== 0) {
                prodductosFiltrados = [...prodductosFiltrados, array[0]]
            
                mostrar()
                return
            }

            mostrar()
           
            return
        }
        prodductosFiltrados = prodductosFiltrados.filter(item => item.id_marca !== id_marca)
        
        console.log(prodductosFiltrados);
        mostrar()
        
        if (prodductosFiltrados.length === 0) {
            prodductosFiltrados = []
            mostrar()
        }
        

       
        // console.log(typeof id_marca);

        // const marcas_filtradas = arrProductos.filter(item => item.id_marca === id_marca)
        // arrProductos = [...marcas_filtradas]
        // console.log(marcas_filtradas);
        // mostrar()
         
        // console.log("input: ", e.target.checked);
        
    }

    filtrarPrecios()

    function filtrarPrecios() {
        const linkOne = document.querySelector('#linkOne-precio')
        linkOne.addEventListener('click', fnFiltrarPrecioOne)
        
        const linkThree = document.querySelector('#linkThree-precio')
        linkThree.addEventListener('click', fnFiltrarPrecioThree)

        const linkTwo = document.querySelector('#linkTwo-precio')
        linkTwo.addEventListener('click', fnFiltrarPrecioTwo)
    }


    function fnFiltrarPrecioOne() {
        const precio = 5000
        const copy_arrProducts = [...arrProductos]

        prodductosFiltrados = copy_arrProducts.filter(item => Number(item.precio) <= precio)
        if (prodductosFiltrados.length > 0) {
            mostrar()
        }
                
        
    }

    function fnFiltrarPrecioTwo() {
        const primer_precio = 5000
        const segundo_precio = 9000
        const copy_arrProducts = [...arrProductos]

        prodductosFiltrados = copy_arrProducts.filter(item => Number(item.precio) >= primer_precio &&  Number(item.precio) <= segundo_precio)

        if (prodductosFiltrados.length > 0) {
            mostrar()
        }
    }

    function fnFiltrarPrecioThree() {
        const primer_precio = 9000
        const copy_arrProducts = [...arrProductos]

        prodductosFiltrados = copy_arrProducts.filter(item => Number(item.precio) >= primer_precio)

        if (prodductosFiltrados.length > 0) {
            mostrar()
        }
    }

    btnFiltrarPrecio.addEventListener('click', filtrarProductos)

    function filtrarProductos() {
        console.log('filtrando...');
        const p_alerta = document.createElement('p')

        const contenedor_filtros = document.querySelector('.contenedor-precio-filtro')
        const precios_filtros = document.querySelector('.precios-filtros')

        const minimo = Number(document.querySelector("#minimo").value)
        const maximo = Number(document.querySelector("#maximo").value)
        const copy_arrProducts = [...arrProductos]

        prodductosFiltrados = copy_arrProducts.filter(item => Number(item.precio) >= minimo &&  Number(item.precio) <= maximo)            

        console.log("prodductosFiltrados: ", prodductosFiltrados);
        

        if (minimo <= 0 || maximo <= 0) {
            p_alerta.textContent = "El precio minimo o el precio maximo son requeridos"
            p_alerta.classList.add('alerta-error-precio')
            contenedor_filtros.insertBefore(p_alerta, precios_filtros)
            
            setTimeout(() => {
                p_alerta.remove()

            }, 4000);
        }
        
    }

    //Paginacion

    function paginacion() {

        const contenedor_paginacion = document.querySelector('.paginacion')
        // console.log(contenedor_paginacion);

        //limpiar
        while (contenedor_paginacion.firstChild) {
            contenedor_paginacion.removeChild(contenedor_paginacion.firstChild)
        }

        //mostrar boton anterior
        if (pagina_anterior) {
            const enlace_pagina_anterior = document.createElement('a')
            enlace_pagina_anterior.classList.add('paginacion__enlace', 'paginacion__enlace--texto')
            enlace_pagina_anterior.textContent = "Anterior"
            enlace_pagina_anterior.onclick = function () {
                fnPaginaAnterior(pagina_anterior)
            }

            contenedor_paginacion.appendChild(enlace_pagina_anterior)
        }


        //mostrar numeros de pagina
        for (let i = 1; i <= total_paginas; i++) {
            if (i === pagina_actual) {
                const span = document.createElement('span')
                span.classList.add('paginacion__enlace', 'paginacion__enlace--actual')
                span.textContent = i
                
                contenedor_paginacion.appendChild(span)
            }else{
                const enlace = document.createElement('a')
                enlace.classList.add('paginacion__enlace', 'paginacion__enlace--numero')
                enlace.textContent = i
                enlace.onclick = function () {
                    fnPaginaNumero(i)
                }
                contenedor_paginacion.appendChild(enlace)
            }
        }


        //mostrar boton siguiente
        if (pagina_siguiente) {
            const enlace_pagina_anterior = document.createElement('a')
            enlace_pagina_anterior.classList.add('paginacion__enlace', 'paginacion__enlace--texto')
            enlace_pagina_anterior.textContent = "Siguiente"
            enlace_pagina_anterior.onclick = function () {
                fnPaginaSiguiente(pagina_siguiente)
            }

            contenedor_paginacion.appendChild(enlace_pagina_anterior)
        }

    }

    async function fnPaginaAnterior(pagina) {
        console.log("click pagina anterior... ", pagina);

        try {
            const id = urlParams.get("resultado")
            const datos = new FormData();
            datos.append('id', id)
            datos.append('pagina', pagina)

            const url = '/api/obtenerResultadosBusqueda';

            const resultado = await fetch(url, {
                method: 'POST',
                body: datos
            });

            if (resultado.ok) {
                pagina_actual = pagina

                const productos = await resultado.json();
                console.log("productos: ", productos);

                total_paginas = productos.total_paginas
                pagina_siguiente = productos.pagina_siguiente
                pagina_anterior = productos.pagina_anterior

                console.log("total paginas: ", total_paginas);
                console.log("pagina_siguiente: ", pagina_siguiente);
                console.log("pagina_anterior: ", pagina_anterior);
                console.log("pagina actual: ", pagina_actual);
                
                
                arrProductos = [...productos.datos]
                console.log("arrProductos: ", arrProductos);

                arrMarcas = [...productos.marcas]
                
                mostrar()
                mostrarMarcas()
                paginacion()
            }


            
        } catch (error) {
            console.log(error);
            
        }

        
    }

    async function fnPaginaNumero(pagina) {
        console.log("click paginacion numero... ", pagina);
        
        try {
            const id = urlParams.get("resultado")
            const datos = new FormData();
            datos.append('id', id)
            datos.append('pagina', pagina)

            const url = '/api/obtenerResultadosBusqueda';

            const resultado = await fetch(url, {
                method: 'POST',
                body: datos
            });

            if (resultado.ok) {
                pagina_actual = pagina

                const productos = await resultado.json();
                console.log("productos: ", productos);

                total_paginas = productos.total_paginas
                pagina_siguiente = productos.pagina_siguiente
                pagina_anterior = productos.pagina_anterior

                console.log("total paginas: ", total_paginas);
                console.log("pagina_siguiente: ", pagina_siguiente);
                console.log("pagina_anterior: ", pagina_anterior);
                console.log("pagina actual: ", pagina_actual);
                
                
                arrProductos = [...productos.datos]
                console.log("arrProductos: ", arrProductos);

                arrMarcas = [...productos.marcas]
                
                mostrar()
                mostrarMarcas()
                paginacion()
            }

        } catch (error) {
            console.log(error);
            
        }

    }

    async function fnPaginaSiguiente(pagina) {
        console.log("click pagina siguiente... ", pagina);
        
        try {
            const id = urlParams.get("resultado")
            const datos = new FormData();
            datos.append('id', id)
            datos.append('pagina', pagina)

            const url = '/api/obtenerResultadosBusqueda';

            const resultado = await fetch(url, {
                method: 'POST',
                body: datos
            });

            if (resultado.ok) {
                pagina_actual = pagina

                const productos = await resultado.json();
                console.log("productos: ", productos);

                total_paginas = productos.total_paginas
                pagina_siguiente = productos.pagina_siguiente
                pagina_anterior = productos.pagina_anterior

                console.log("total paginas: ", total_paginas);
                console.log("pagina_siguiente: ", pagina_siguiente);
                console.log("pagina_anterior: ", pagina_anterior);
                console.log("pagina actual: ", pagina_actual);
                
                
                arrProductos = [...productos.datos]
                console.log("arrProductos: ", arrProductos);

                arrMarcas = [...productos.marcas]
                
                mostrar()
                mostrarMarcas()
                paginacion()

            }


            
        } catch (error) {
            console.log(error);
            
        }

    }


})()


