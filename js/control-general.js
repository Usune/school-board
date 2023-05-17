// function mostrar() {
//     document.querySelector("#opciones1").classList.toggle("show");
// }

// Función que trae el contenido del atributo 'enlace' para dirigirse al correspondiente id que se va a mostrar agragando la clase 'show'
// const mostrar = (eve) => {
//     document.querySelector(eve.target.getAttribute('enlace')).classList.toggle('show');
// }

const mostrar = (eve) => {
    let el = document.querySelector(eve.target.getAttribute('enlace'));
    if (el !== null) {
        el.classList.toggle('show');
    }
}

window.onload = function () {

    // En esta línea traemos todos los elementos con la clase 'desplegar' y le vamos a agregar el evento 'click', que ejecuta la función 'mostrar', esto lo hacemos con la función forEach() o tambien se puede hacer usando bucle 'for'
    document.querySelectorAll('.desplegar').forEach(function (elem) {
        elem.addEventListener('click', mostrar);
    });


    // document.querySelector('iframe').contentWindow.document.onclick = (ev) => {
    //     var botones = document.getElementsByClassName('desplegar');
    //     botones.forEach(function (elem) {
    //         document.querySelector(document.elem.getAttribute('enlace')).classList.toggle('show');
    //     });
    //     // document.getElementById('op1').style.display = 'none';
    // }
    // document.onclick = (ev) => {
    //     if (ev.target.id != "op1" && ev.target.id != "button1" && ev.target.parentElement.id != "button1") {
    //         let elem = document.getElementById('op1');
    //         elem.style.display = 'none';
    //     }
    // }
}

const onFocus = (eve) => {
    document.querySelector(eve.target.getAttribute('legend')).style.display = 'block';
}

const onBlur = (eve) => {
    document.querySelector(eve.target.getAttribute('legend')).style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('input').forEach(function (elem) {
        elem.addEventListener('focus', onFocus);
        elem.addEventListener('blur', onBlur);
    });

});

// function asignaturas() {
//     let elem = document.getElementById('asignaturas');
//     elem.style.display = elem.style.display === 'none' ? 'block' : 'none';
// }
