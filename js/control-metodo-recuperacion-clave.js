// const validarMetodo = (even) => {
//     //even.preventDefault(); Cancela el evento si este es cancelable, sin detener el resto del funcionamiento del evento, es decir, puede ser llamado de nuevo.
//     even.preventDefault();
//     const form = even.taget;
//     let metodo = document.getElementById('metodo').value;
// }

const cambiarImagenMetodo = (eve) => {

    let imgMetodo = document.getElementById('img-metodo').src;
    let imgOpcion = document.getElementById('img-opcion').src;
    let legendMetodo = document.getElementById('met');
    let placeMetodo = document.getElementById('metodo');
    document.getElementById('img-metodo').src = imgOpcion;
    document.getElementById('img-opcion').src = imgMetodo;
    placeMetodo.placeholder = placeMetodo.placeholder === 'Correo electronico' ? 'Celular' : 'Correo electronico';
    legendMetodo.textContent = legendMetodo.textContent === 'Correo electronico' ? 'Celular' : 'Correo electronico';
}

document.addEventListener('DOMContentLoaded', function () {

    document.getElementById('btn-opcion').addEventListener('click', cambiarImagenMetodo);

    // Cuando se de 'onclick' en cualquier parte del documento excepto el botón que muestra la opción se va a quitar la opción
    document.onclick = (ev) => {
        if (ev.target.getAttribute('enlace') !== "#btn-opcion") {
            document.querySelector(document.querySelector('.desplegar').getAttribute('enlace')).classList.remove('show');
        }
    }

});

// const metodo = (eve) => {
//     document.getElementById('metodo').placeholder = eve.target.value;
//     document.querySelector('legend').textContent = eve.target.value;
// }
