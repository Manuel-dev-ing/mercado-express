const select = document.querySelector('#id_producto')
const spanValidacion = document.querySelector('.validacion');
const stock = document.querySelector('#stock');

const categoria = document.querySelector('#categoria')
const marca = document.querySelector('#marca')
const precio = document.querySelector('#precio')
const imagen = document.querySelector('#imagen');

document.addEventListener('DOMContentLoaded', ()=>{

    select.addEventListener('change', seleccionarProducto)
    // consultarProducto()

  
})

async function seleccionarProducto(e) {

    var valor = Number(select.value);
    stock.value = ''

    if (valor === "") {
        spanValidacion.style.display = 'block';
        setTimeout(() => {
            spanValidacion.style.display = 'none';

        }, 5000);
        return;
    }

    try {
        const datos = new FormData();
        datos.append('id', valor)
        const url = '/api/consultarProducto';

        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.json();
        console.log(resultado);
        
        // let producto = resultado.datos[0]; 
        // mostrar(producto);
        

    } catch (error) {
        console.log(error);
        
    }
}

function mostrar(producto) {
    console.log(producto);

    categoria.value = producto.categoria
    marca.value = producto.marca
    precio.value = producto.precio
    imagen.src = "/imagenes/" + producto.imagen;

}


// async function consultarProducto() {
    
//     // /api/stockProductos
//     try {
//         const datos = new FormData();
//         datos.append('id', 20)
//         const url = '/api/consultarProducto';

//         const resultado = await fetch(url, {
//             method: 'POST',
//             body: datos
//         });

//         const productos = await resultado.json();

//         console.log(productos);


//     } catch (error) {
//         console.log(error);
        
//     }

// }



