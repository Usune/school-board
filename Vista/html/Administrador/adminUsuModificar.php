<?php
    require_once ('../../../Modelo/conexion.php');
    require_once ('../../../Modelo/consultas.php');
    require_once ('../../../Modelo/seguridadAdmin.php');
    require_once ('../../../Controlador/mostrarPerfil.php');
    require_once ('../../../Controlador/mostrarUsuAdmin.php');
    require_once ('../../../Controlador/mostrarCurAdmin.php');
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Admin</title>
    <link rel="shortcut icon" href="../../img/logo.svg">
    <link rel="stylesheet" type="text/css" href="../../css/administrador/estilosAdmin.css">
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <script src="../../js/controlGeneral.js"></script>
</head>

<body>
    
    <?php
        include("menu-include.php");
    ?>

        <main>

            <!-- breadcrumb -->    
            <nav class="nav-main">
                <a href="homeAdmin.php">Home</a>
                <a href="adminUsu.php"> / Usuarios</a>
                <a href=""> / Modificar</a>
            </nav>

            <section>

                <h2>Administración de usuarios</h2>
                
                <div class="formulario">
                    
                    <h3>Modificar usuario</h3>

                    <p class="recordatorio">Recuerde no dejar campos vacios</p>
        
                    <?php
                        cargarUsuEditar();
                    ?>

                </div>
            </section>

        </main> 
    </div>

    <hr>

    <footer>
        <div class="info-footer">
            <p>School Board</p>
            <p>Copyright © - 2023. Todos los Derechos Reservados</p>
            <p>Autor: Estefani Arenas, Erika Diaz, Nicole Benavides y Tatiana Arevalo.</p>
        </div>
    </footer>

    <script>
        
        // Función para verificar que dos campos son iguales en un formulario y en caso de serlo no se envia el formulario, también que no se envien los select si una opción.
        // Para que funcione se deben tener dos input, el input1 debe tener 'id="campo1"' y el input2 debe tener 'id="verify" verify="#campo1"'
        // Y los select deben tener la clase 'veriSelect'
        const formularioRegistroAdmin = (event) => {
        
            event.preventDefault();
            const form = event.target;
            const text = document.getElementById('texto');
        
            let nombre = document.getElementsByName('nombres');
            nombre = nombre[0].value;
            nombre = nombre[0];
        
            let apellido = document.getElementsByName('apellidos');
            apellido = apellido[0].value;
            apellido = apellido[0];
        
            let usuario = document.getElementsByName('documento');
            usuario = usuario[0].value;
        
            // Validamos que los campos para la clave están diligenciados
            if ( nombre.length > 0 && apellido.length > 0  && usuario.length > 0) {
        
                let clave = usuario + nombre + apellido;
                document.getElementById('clatem').value = clave;
        
                // Validamos que los campos del documento son iguales
                let idcampo1 = document.getElementById('verify').getAttribute('verify');
                let campo1 = document.querySelector(idcampo1).value;
                let campo2 = document.getElementById('verify').value;
            
                if (campo1 === campo2) {
            
                    // Validamos que los select estén seleccionados
                    let select1 = document.getElementsByName('tipoDoc');
                    select1 = select1[0].value;
                    let select2 = document.getElementsByName('rol');
                    select2 = select2[0].value;
        
                    if (select1 !== 'Seleccione' && select2 !== 'Seleccione') {
        
                        form.submit();
                        return;
        
                    }else{
        
                        text.innerText = 'Seleccione una opción';
                        document.getElementById('texto').style.visibility = 'visible';
                        return;
        
                    }
            
                }else {
        
                    text.innerText = 'Verifique el documento, los valores no son iguales';
                    document.getElementById('texto').style.visibility = 'visible';
                    return;
        
                }
        
            }else{
        
                text.innerText = 'Ingrese todos los campos';
                document.getElementById('texto').style.visibility = 'visible';
                return;
        
            }
        
        }

        document.addEventListener('DOMContentLoaded', function () {

        // Se agrega la función verificar a todos los elementos con el 'id=formulario' que y se activa al intentar hacer un submit.
        document.getElementById('formularioAdmin').addEventListener('submit', formularioRegistroAdmin);

        });        
        
    </script>

    

</body>

</html>