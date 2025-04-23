Eliminaralerta()



function Eliminaralerta() {
    document.querySelectorAll('.alerta').forEach(alert =>{

        if (alert) {
            setTimeout(() => {
                alert.remove();
            }, 5000);        
        }
    })



}