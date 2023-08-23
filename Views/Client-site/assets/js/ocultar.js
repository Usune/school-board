//Tipo de variable, dentro de un tipo de codigo 
//Con el lef se llama el id boton o listas 
let boton = document.getElementById('boton');
let listas = document.getElementById('botonListas');
boton.addEventListener('click', desplegar);
//cuando el usuario haga click en el div o los elementos del div "buttom" con el "id= boton" se realizara la funcion "desplegar"
//La funcion desplegar establece que sera visible para el usuario por medio de "show" el div "botonlistas"
function desplegar(){
    botonListas.classList.toggle('show');
}