
const validarInicioSesion = (even) => {
    //even.preventDefault(); Cancela el evento si este es cancelable, sin detener el resto del funcionamiento del evento, es decir, puede ser llamado de nuevo.
    even.preventDefault();
    const form = even.target;
    let clave = document.getElementById('usuario').value;
    let usuario = document.getElementById('clave').value;

    // Validación para ingresar como profesor
    if (clave === 'profesor' && usuario === 'profesor') {
        form.setAttribute('action', 'Vista/html/profesor/cursos-profesor.html');
        form.submit();
        return;
    }

    // Validación para ingresar como estudiante
    if (clave === 'estudiante' && usuario === 'estudiante') {
        form.setAttribute('action', 'Vista/html/estudiante/index-estudiante.html');
        form.submit();
        return;
    }

    // Validación para ingresar como administrador
    if (clave === 'administrador' && usuario === 'administrador') {
        form.setAttribute('action', 'Vista/html/administrador/index-administrador.html');
        form.submit();
        return;
    }

    // Si no valida nunguno de los casos anteriores se pondrá rojo el fieldset, el legend y se mostrará el texto correspondiente
    document.querySelectorAll('fieldset').forEach(function (elem) {
        elem.style.border = 'var(--rojo) 2px solid';
    });
    document.querySelectorAll('legend').forEach(function (elem) {
        elem.style.color = 'var(--rojo)';
    });
    document.querySelectorAll('input').forEach(function (elem) {
        elem.value = '';
    });
    document.getElementById('texto').style.visibility = 'visible';
    return;
}

// function onFocus() {
//     document.querySelectorAll('legend').forEach(function (ele) {
//         ele.style.display = 'block';
//     });
// }

// function onBlur() {
//     document.querySelectorAll('legend').forEach(function (ele) {
//         ele.style.display = 'none';
//     });
// }

document.addEventListener('DOMContentLoaded', function () {

    document.getElementById('formulario').addEventListener('submit', validarInicioSesion);

});