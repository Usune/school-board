// Función ppara mostrar o no un elemento
// Para que funcione el elemento acciodador debe tener el atributo 'enlace' con el id correspondiante del elemento a mostrar y ocultar
const mostrar = (event) => {
    let el = document.querySelector(event.target.getAttribute('enlace'));
    if (el !== null) {
        el.classList.toggle('show_modal');
    }
}

// Función para mostrar o no un modal elemento
// Para que funcione el elemento acciodador debe tener el atributo 'modal' con el id correspondiante del elemento a mostrar y ocultar
const mostrarModal = (event) => {
    let el = document.querySelector(event.target.getAttribute('modal'));
    if (el !== null) {
        el.classList.toggle('show_modal');
    }
}

// Función para asignar la clase "activeA" para que quede seleccionada la sección del aside actual. Para que funcione el breadcrumb debe tener el atributo 'actual' y su valor debe corresponder al id especifico de la sección del aside, ejemplo: "#usuario". Adicional a esto, el breadcrumb también debe tener el id='actual'.
const activeAside = () => {
    const actual = document.getElementById('actual').getAttribute('actual');
    if(actual != '#home'){
        const seccion = document.querySelector(actual);
        seccion.classList.add('activeA');
    }
}

// Funciones para mostrar y quitar el legend de un input especifico al dar click en el input, para que eso funcione el input debe tener el atributo legend y dentro el id del legend al que está asociado, así mismo el legend debe tener el id especifico que tiene el atributo legend.
const onFocus = (event) => {
    let idLegend = event.target.getAttribute('legend');
    const fieldset = event.target.closest('.fieldset');
    if(fieldset != null){
        if(event.target.previousElementSibling === fieldset.querySelector('fieldset')) {
            document.querySelector(event.target.getAttribute('legend')).style.display = 'block';
        
            document.querySelector(idLegend).style.color = 'var(--principal)';
            event.target.previousElementSibling.style.border = 'var(--principal) 2px solid';
            event.target.previousElementSibling.style.height = '95%';
        }
    }
}

const onBlur = (event) => {
    let value = event.target.value;
    let idLegend = event.target.getAttribute('legend');
    const fieldset = event.target.closest('.fieldset');
    if(fieldset != null){
        if(value.length > 0 && event.target.previousElementSibling === fieldset.querySelector('fieldset')) {
            event.target.previousElementSibling.style.border = 'var(--grisOscuro) 2px solid';
            event.target.previousElementSibling.style.height = '95%';
            document.querySelector(idLegend).style.color = 'var(--grisOscuro)';
            document.querySelector(idLegend).style.display = 'block';
        }else {
            event.target.previousElementSibling.style.border = 'var(--grisOscuro) 2px solid';
            event.target.previousElementSibling.style.height = '80%';
            document.querySelector(idLegend).style.display = 'none';
        }
    }
}

document.addEventListener('DOMContentLoaded', function () {
    
    // En esta línea traemos todos los elementos con la clase 'desplegar' y le vamos a agregar el evento 'click', que ejecuta la función 'mostrar', esto lo hacemos con la función forEach() o tambien se puede hacer usando bucle 'for'
    document.querySelectorAll('.desplegar').forEach(function (element) {
        element.addEventListener('click', mostrar);
    });

    // En esta línea traemos todos los elementos con la clase 'desplegarModal' y le vamos a agregar el evento 'click', que ejecuta la función 'mostrarModal', esto lo hacemos con la función forEach() o tambien se puede hacer usando bucle 'for'
    document.querySelectorAll('.desplegarModal').forEach(function (element) {
        element.addEventListener('click', mostrarModal);
    });

    //Quita el elemento con el id 'op1' cuando se da click sobre la página index
    document.onclick = (ev) => {
        if (ev.target.id != "butdesplegar" && ev.target.parentElement.id != "butdesplegar") {
            let element = document.getElementById('op1');
            if (element !== null) {
                element.classList.remove('show');
            }
        }
    }

    // Aquí le agregamos a todos los input la función onFocus y onBlur con ayuda de un forEach
    document.querySelectorAll('input').forEach(function (elemt) {
        elemt.addEventListener('focus', onFocus);
        elemt.addEventListener('blur', onBlur);
        
        // Se evalua si los inpit ya están llenos para aplicar los estilos correspondiente
        if (elemt.value.length > 0) {
            // closest() busca el ancestro más cercano (o el propio elemento) que cumple con un selector especificado.
            const fieldset = elemt.closest('.fieldset');
            if (fieldset != null){
                if (elemt.previousElementSibling === fieldset.querySelector('fieldset')) {
                    elemt.previousElementSibling.style.border = 'var(--grisOscuro) 2px solid';
                    elemt.previousElementSibling.style.height = '95%';
                    let idLegend = elemt.getAttribute('legend');
                    document.querySelector(idLegend).style.color = 'var(--grisOscuro)';
                    document.querySelector(idLegend).style.display = 'block';
                }
            }
        }
    });

    activeAside();

});





// quita la clase del elemento con el id 'op1' cuando se da click sobre el iframe
// let iframe = document.querySelector('iframe');
// if (iframe !== null){
//     iframe.onload = function () {
//         iframe.contentWindow.document.onclick = (ev) => {
//             let element = document.getElementById('op1');
//             element.classList.remove('show');
//         }
//     }


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