const validarUsuario = (even) => {
    //even.preventDefault(); Cancela el evento si este es cancelable, sin detener el resto del funcionamiento del evento, es decir, puede ser llamado de nuevo.
    even.preventDefault();
    const form = even.target;
    let usuario = document.getElementById('usuario').value;

    // Validación para verificar que exista el usuario
    if (usuario === 'estudiante' || usuario === 'profesor' || usuario === 'administrador') {
        form.setAttribute('action', 'metodo-recuperacion-clave.html');
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

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('formulario').addEventListener('submit', validarUsuario)
});

