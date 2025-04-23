const btnAgregar = document.querySelector('.btn-agregar-informacion'); 
const contenedormd = document.querySelector('.contenedor-md'); 
const contenedor = document.querySelector('.contenedor-informacion-adicional');


var cantidad = 0;

events()
function events() {
    btnAgregar.addEventListener('click', agregarInformacion);
    contenedormd.addEventListener('click', eliminar)
    document.addEventListener('DOMContentLoaded', ()=>{
        contarElementos();
        previsualizarImagen();
        eliminarAlertas();
    })
}




//Archivo crear.php
function eliminarAlertas() {
    
    document.querySelectorAll('.alerta').forEach(e =>{
        
        setTimeout(() => {
            e.remove();
            
        }, 3000);
    })
    // console.log(alerta);

}


//previsualizar imagen
function previsualizarImagen() {
    const imgInput = document.querySelector('#img')
    
    imgInput.addEventListener('change', function(e) {
        const url = imgInput.value;
        const ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();

        const validExtensions = ["gif", "jpg", "jfif", "png", "bmp"];
        if (imgInput.files && imgInput.files[0] && validExtensions.includes(ext)) {
            const reader = new FileReader();

            reader.onload = function () {
                const output = document.getElementById('previmg');
                output.src = reader.result;
            };
            reader.readAsDataURL(e.target.files[0]);
        }


    })    


}   

//inicio seccion informacion adicional
function eliminar(e) {
    e.preventDefault();

    if (e.target.classList.contains('btn-eliminar-input')) {
        console.log("elemento a eliminar: ", e.target.parentElement.parentElement);
        var eliminar = e.target.parentElement.parentElement;
        eliminar.remove();
        console.log("eliminado");
        
    }
}

function contarElementos() {

    let cant = 0;
    document.querySelectorAll(".div-informacionAdicional").forEach( el =>{
        
        cant = cant +1

    })
    
    cantidad = cant
    
}


function agregarInformacion(e) {
    e.preventDefault();

    cantidad = cantidad+1;
    //div Atributo
    const divAtributo = document.createElement('div');
    divAtributo.classList.add('forms-fields-md');

    //label
    const labelAtributo = document.createElement('label');
    labelAtributo.setAttribute("for", "atributo");
    labelAtributo.textContent = "Atributo";

    //input
    const inputAtributo = document.createElement('input');
    inputAtributo.type = 'text';
    inputAtributo.name = 'atributo' + cantidad;
    inputAtributo.id = 'atributo';
    

    divAtributo.appendChild(labelAtributo);
    divAtributo.appendChild(inputAtributo);
    //fin divAtributo


    //div valor
    const divValor = document.createElement('div');
    divValor.classList.add('forms-fields-md');

    //label
    const labelValor = document.createElement('label');
    labelValor.setAttribute("for", "valor");
    labelValor.textContent = "Valor";

    //input
    const inputValor = document.createElement('input');
    inputValor.type = 'text';
    inputValor.name = 'valor' + cantidad;
    inputValor.id = 'valor';


    divValor.appendChild(labelValor);
    divValor.appendChild(inputValor);
    //fin divValor

    //eliminar
    const btnEliminar = document.createElement('a')
    btnEliminar.textContent = "Eliminar";
    btnEliminar.classList.add("btn-eliminar-input");
    //div-eliminar
    const divEliminar = document.createElement('div');
    divEliminar.classList.add('div-eliminar');
    //fin div-eliminar
    
    divEliminar.appendChild(btnEliminar);

    //div que contiene el divAtributo, divValor y divEliminar
    const divPrincipal = document.createElement('div');
    divPrincipal.classList.add('div-informacionAdicional');
    
    
    divPrincipal.appendChild(divAtributo);
    divPrincipal.appendChild(divValor);
    divPrincipal.appendChild(divEliminar);
    
    // contenedormd.appendChild(divAtributo);
    // contenedormd.appendChild(divValor);
    contenedor.appendChild(divPrincipal)
    // contenedormd.appendChild(divEliminar);   
    contenedormd.appendChild(contenedor)

   
}
//fin seccion informacion adicional
