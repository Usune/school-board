// Función para verificar que dos campos son iguales en un formulario y en caso de serlo no se envia el formulario
// Para que funcione esta función se deben tener dos input, el input1 debe tener 'id="campo1"' y el input2 debe tener 'id="verify" verify="#campo1"'
const verificar = (event) => {
    event.preventDefault();
    const form = event.target;

    let idcampo1 = document.getElementById('verify').getAttribute('verify');
    let campo1 = document.querySelector(idcampo1).value;
    let campo2 = document.getElementById('verify').value;

    if (campo1 === campo2) {
        form.submit();
        return;
    }

    document.getElementById('texto').style.visibility = 'visible';
    return;
}

// Función para asignar la clave temporal de un usuario
const claveTemporal = (event) => {
    let nombre = document.getElementsByName('nombres');
    nombre = nombre[0].value;
    nombre = nombre[0];
    let apellido = document.getElementsByName('apellidos');
    apellido = apellido[0].value;
    apellido = apellido[0];
    let usuario = document.getElementsByName('usuario');
    usuario = usuario[0].value;
    clave = usuario + nombre + apellido;
    console.log(clave);
    return clave;
}
 
document.addEventListener('DOMContentLoaded', function () {

    // Se agrega la función verificar a todos los elementos con el 'id=formulario' que y se activa al intentar hacer un submit.
    document.getElementById('formulario').addEventListener('submit', verificar);
    document.getElementById('formulario').addEventListener('submit', claveTemporal);


});