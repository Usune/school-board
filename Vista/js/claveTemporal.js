// Función para asignar la clave temporal de un usuario
const claveTemporal = (even) => {

    even.preventDefault();

    let nombre = document.getElementsByName('nombres');
    nombre = nombre[0].value;
    nombre = nombre[0];

    let apellido = document.getElementsByName('apellidos');
    apellido = apellido[0].value;
    apellido = apellido[0];

    let usuario = document.getElementsByName('usuario');
    usuario = usuario[0].value;

    clave = usuario + nombre + apellido;

    let select = document.getElementsByName('tipo_doc');
    select = select[0].value;

    document.getElementById('clatem').value = clave;

    if (clave.length <= 0 ) {
        alert("Ingrese todos los campos");
    }

}

document.addEventListener('DOMContentLoaded', function () {

    document.getElementById('formulario').addEventListener('submit', claveTemporal);

});