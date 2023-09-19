<?php
    require_once ('../../../Modelo/conexion.php');
    require_once ('../../../Modelo/consultas.php');
    require_once ('../../../Modelo/seguridadAdmin.php');
    require_once ('../../../Controlador/mostrarPerfil.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/logo.svg">
    <link rel="stylesheet" type="text/css" href="../../css/administrador/estilosAdmin.css">
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <script src="../../js/controlGeneral.js"></script>
    <title>Usuarios</title>
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
                <a href="adminUsuRegistro.php"> / Registrar</a>
            </nav>
        
            <section>

                <h2>Administración de usuarios</h2>
                
                <div class="formulario">
                    
                    <h3>Registrar usuario</h3>

                    <p class="recordatorio">Por favor, seleccione el rol del usuario que desea registrar.</p>
                    <!--  enctype="multipart/form-data" -->
                    <form action="adminUsuRegistro2.php" method="get" id="formulario">
            
                        <div class="fieldset_view">
                            <label for="rol">Rol</label>
                            <select class="veriSelect" required name="rol">
                                <option value="Seleccione" selected disabled>Seleccione una opción</option>
                                <option value="Docente">Docente</option>
                                <option value="Estudiante">Estudiante</option>
                            </select>
                        </div>
        
                        <p id="texto"></p>
                        
                        <button type="submit" class="enviar">Siguiente</button>

                    </form>
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
    
            // Validamos que los select estén seleccionados
            let select2 = document.getElementsByName('rol');
            select2 = select2[0].value;

            if (select2 !== 'Seleccione') {

                form.submit();
                return;

            }else{

                text.innerText = 'Seleccione una opción';
                document.getElementById('texto').style.visibility = 'visible';
                return;

            }

        }

        document.addEventListener('DOMContentLoaded', function () {

        // Se agrega la función verificar a todos los elementos con el 'id=formulario' que y se activa al intentar hacer un submit.
        document.getElementById('formulario').addEventListener('submit', formularioRegistroAdmin);

        });        
        
    </script>

</body>

</html>