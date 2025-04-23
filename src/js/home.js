const inputSearch = document.querySelector('#search-input')
const listaul = document.querySelector('#lista')

events()

function events() {

    document.addEventListener('DOMContentLoaded', ()=>{

        obtenerProductos()
        swiper()
    
    })
        
}



async function obtenerProductos() {
    try {
       
        const url = '/api/obtenerProductos';

        const respuesta = await fetch(url, {
            method: 'GET'
        });

        const resultado = await respuesta.json()

        const arrayProductos = [...resultado.datos] 
        buscar(arrayProductos)

    } catch (error) {
        console.log(error);
        
    }


}

function buscar(arrayProductos) {

    inputSearch.addEventListener('keyup', e =>{

        let query = e.target.value
        
        console.log(query);
        
        if (query != "") {
            const productos = arrayProductos.filter(x => x.nombre.includes(query))    
            mostrarListado(productos)
            
        }else{
            query = ""
            console.log(query)
            mostrarListado(query)
        }
        
    })

}


function mostrarListado(query) {
    listaul.innerHTML = ''

    if (query != "") {
        
        query.forEach(query => {
            // listaul.classList.add('lista-ul')
            console.log(query);

            const li = document.createElement('li')
            li.classList.add("list-item")
            li.dataset.id = query.id
            li.textContent = query.nombre
            const lista_ancor = document.createElement('a')
            let id_categoria = parseInt(query.id_categoria)
            lista_ancor.href = `/productos/detalleProducto?resultado=${query.id}`
            lista_ancor.classList.add('list-item_ancor')

            lista_ancor.appendChild(li)

            listaul.appendChild(lista_ancor)

        });
        
    }

    // if (listaul.classList.contains('lista-ul')) {
    //     listaul.classList.remove('lista-ul')
        
    // }

}

// async function listadoProductos(id) {
//     // console.log("click lista Listado Productos. ID: ", id);

//     try {
        
//         const url = `/api/mostrarProductos/resultado=${id}`;
//         console.log(url);
        
//         await fetch(url, {
//             method: 'GET'
//         });

//         // const resultado = await respuesta.json()
//         // console.log(respuesta);
        
//     } catch (error) {
//         console.log(error);
        
//     }
    
// }


function swiper(){
    
    new Swiper('.card-wrapper', {
        // Optional parameters
        loop: true,
      
        // If we need pagination
        pagination: {
          el: '.swiper-pagination',
        },
      
        // Navigation arrows
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
      
        
    });

}

