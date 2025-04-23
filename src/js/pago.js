
console.log("Pago...");
var itemsCarrito = JSON.parse(localStorage.getItem('productos')) || [];
var total_paypal;

document.addEventListener('DOMContentLoaded', () =>{

    console.log(itemsCarrito);
    cantidadProdcutos()
    calcularTotales();
    fnPaypal()
})

function fechaActual() {
    let fechaActual = new Date();

    // Formatear la fecha al formato YYYY-MM-DD HH:MM:SS
    let anio = fechaActual.getFullYear();
    let mes = String(fechaActual.getMonth() + 1).padStart(2, '0');
    let dia = String(fechaActual.getDate()).padStart(2, '0');
    let horas = String(fechaActual.getHours()).padStart(2, '0');
    let minutos = String(fechaActual.getMinutes()).padStart(2, '0');
    let segundos = String(fechaActual.getSeconds()).padStart(2, '0');

    // Formato final
    let fechaFormateada = `${anio}-${mes}-${dia} ${horas}:${minutos}:${segundos}`;

    return fechaFormateada;
}

function cantidadProdcutos() {
    
    let total = 0;
    itemsCarrito.forEach(element => {
        total += element.cantidad
        
    });

    return total
}

function calcularTotales() {
    console.log("calculando totales...");
    
    let USDollar = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
    })
    
    const productosCantidad = document.querySelector('#productos-cantidad')
    const psubtotal = document.querySelector('#subtotal')
    const ptotal = document.querySelector('#total')
    
    let total = 0;
    
    itemsCarrito.forEach(element => {
        let precio = element.precio

        total += element.cantidad * precio        
    });
    total_paypal = total
    // fnPaypal(total)

    productosCantidad.textContent = `(${cantidadProdcutos()})`
    psubtotal.textContent = USDollar.format( total )
    ptotal.textContent = USDollar.format( total )

}

function fnPaypal() {
    
    paypal.Buttons({
        style:{
            color: 'blue',
            shape: 'pill',
            label: 'pay'
        },
        createOrder: function (data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount:{
                        value: total_paypal
                    }
                }]
            });
        },
        onApprove: function (data, actions) {
            actions.order.capture().then(function (detalles) {
                console.log(detalles);
                if (detalles.status === 'COMPLETED') {
                    
                    console.log("pago completado correctamente");

                    itemsCarrito.map(item => item['id_pedido'] = detalles.id);
                    const items = itemsCarrito.map( ({ imagen, ...resto }) => resto )
                   
                    guardarPedido(detalles, items)
                }
                
            })
        },
        onCancel: function (data) {
            console.log(data);
            
        }

    }).render('#paypal-button-container')

}

async function guardarPedido(detalles, items) {
    
    try {
        // let fecha = new Date().to
        
        const datos = new FormData()
        datos.append("id_pedido", detalles.id)
        datos.append("nombre", detalles.payer.name.given_name)
        datos.append("apellidos", detalles.payer.name.surname)
        datos.append("correo_electronico", detalles.payer.email_address)
        datos.append("codigo_pais", detalles.payer.address.country_code)
        datos.append("fecha", fechaActual())
        datos.append("productos", JSON.stringify(items))

        const url = '/api/guardarPedido'
        
        const resultado = await fetch(url, {
            method: 'POST',
            body: datos
        });

        if (resultado.ok) {
            console.log("Pedido guardado...");
            const res = await resultado.json()
            console.log("res: ", res);
            
            if (res.datos.resultado) {
                console.log("resultado true...");
                itemsCarrito = []
                sincronizarLS()
                calcularTotales()
                cantidadProdcutos()
                window.location.href = '/'
            }


        }   

    } catch (error) {
        console.log(error);
        
    }

}


function sincronizarLS() {
    localStorage.setItem('productos', JSON.stringify(itemsCarrito))
}
