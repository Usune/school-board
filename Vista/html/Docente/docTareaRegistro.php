<?php
require_once('../../../Modelo/conexion.php');
require_once('../../../Modelo/consultas.php');
require_once('../../../Modelo/seguridadDoc.php');
require_once('../../../Controlador/mostrarPerfil.php');
require_once('../../../Controlador/mostrarCursosDoc.php');
require_once('../../../Controlador/mostrarTareasDoc.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesor</title>
    <link rel="shortcut icon" href="../../img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
                <a href="homeDoc.php">crearTarea </a>
            </nav>

            <section>
                <h2>Crear Tareas</h2>

                <div class="formulario">
                <?php
                    formRegistroTarDoc();
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>