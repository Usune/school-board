<?php
require_once('../../../Modelo/conexion.php');
require_once('../../../Modelo/consultas.php');
require_once('../../../Modelo/seguridadDoc.php');
require_once('../../../Controlador/mostrarPerfil.php');
require_once('../../../Controlador/mostrarTareasDoc.php');
require_once('../../../Controlador/mostrarCursosDoc.php');
// require_once('../../../Controlador/actualizarTarDoc.php');


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docente</title>
    <link rel="shortcut icon" href="../../img/logo.png">
    <link rel="stylesheet" type="text/css" href="../../css/Docente/estilosDoc.css">
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <script src="../../js/controlGeneral.js"></script>
</head>

<body>
    <?php
    include("menu-include.php");
    ?>
    <!-- Barra de navegación principal -->
    
        <main>

            <!-- breadcrumb -->  
            <nav class="nav-main">
                <a href="homeDoc.php">Clases</a> 
                <?php
                    traerCurso();
                    echo'
                        <a href="tareasDoc.php?idClase='.$_GET['idClase'].'&tarea=" id="actual" actual="#tareas"> / Tareas</a>
                    ';
                ?>
                <a href=""> / Modificar</a>
            </nav>

            <section>

                <!-- Formulario para subir tareas (No borrar) -->

                <div class="formulario">
                    
                    <h3>Modificar Tarea</h3>

                    <p class="recordatorio">Modifique los campos necesarios sin dejarlos en blanco.</p>
        
                <?php
                    cargarTareaEditarDoc(); 
                ?>

                </div>
                


                
            </section>

        </main>

    </div>

</body>

</html>