// Función ppara mostrar o no e
const mostrar = (event) => {
    let el = document.querySelector(event.target.getAttribute('enlace'));
    if (el !== null) {
        el.classList.toggle('show');
    }
}

// Funciones para mostrar y quitar el legend de un input especifico al dar click en el input, para que eso funcione el input debe tener el atributo legend y dentro el id del legend al que está asociado, así mismo el legend debe tener el id especifico que tiene el atributo legend.
const onFocus = (event) => {
    document.querySelector(event.target.getAttribute('legend')).style.display = 'block';
}

const onBlur = (event) => {
    document.querySelector(event.target.getAttribute('legend')).style.display = 'none';
}


document.addEventListener('DOMContentLoaded', function () {

    // Aquí de agregamos a todos los input la función onFocus y onBlur con ayuda de un forEach
    document.querySelectorAll('input').forEach(function (elemt) {
        elemt.addEventListener('focus', onFocus);
        elemt.addEventListener('blur', onBlur);
    });

    // En esta línea traemos todos los elementos con la clase 'desplegar' y le vamos a agregar el evento 'click', que ejecuta la función 'mostrar', esto lo hacemos con la función forEach() o tambien se puede hacer usando bucle 'for'
    document.querySelectorAll('.desplegar').forEach(function (element) {
        element.addEventListener('click', mostrar);
    });

    //quita el elemento con el id 'op1' cuando se da click sobre la página index
    document.onclick = (ev) => {
        if (ev.target.id != "opciones" && ev.target.id != "butdesplegar" && ev.target.parentElement.id != "butdesplegar") {
            let element = document.getElementById('op1');
            if (element !== null) {
                element.classList.remove('show');
            }
        }
    }

    // quita la clase del elemento con el id 'op1' cuando se da click sobre el iframe
    let iframe = document.querySelector('iframe');
    if (iframe !== null){
        iframe.onload = function () {
            iframe.contentWindow.document.onclick = (ev) => {
                let element = document.getElementById('op1');
                element.classList.remove('show');
            }
        }
    }

});





/* <script>

// Función para controlar el src de un iframe

const vistaIframe = (eve) => {
    let iframe = document.querySelector('iframe');
    iframe.src = eve.target.getAttribute('link');
}

document.addEventListener('DOMContentLoaded', function () {

    console.log('listo');
    let iframe = document.querySelector('iframe');

    iframe.onload = function () {
        console.log('listo');

        iframe.contentWindow.document.querySelectorAll('.cambiarLink').forEach(function (element) {
            console.log(element);
            element.addEventListener('click', vistaIframe);
        });
    }
});

</script> */