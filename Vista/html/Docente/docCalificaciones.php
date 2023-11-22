<?php
require_once ('../../../Modelo/conexion.php');
require_once ('../../../Modelo/consultas.php');
require_once('../../../Modelo/seguridadDoc.php');
require_once ('../../../Controlador/mostrarPerfil.php');
require_once ('../../../Controlador/mostrarCursosDoc.php');
require_once ('../../../Controlador/mostrarAsisDoc.php');
require_once ('../../../Controlador/mostrarTareasDoc.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesor</title>
    <link rel="stylesheet" type="text/css" href="../../css/Docente/estilosDoc.css">
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <script src="../../js/controlGeneral.js"></script>
</head>
<body>
    <?php
        include('menu-include.php');
    ?>
    <main>
        <!-- breadcrumb -->
        <nav class="nav-main">
            <a href="homeDoc.php">Clases</a>
            <a href="adminUsu.php"> / Única-PRIMERO</a>
            <a href="docCalificaciones.php"> / Calificaciones </a>
        </nav>

        <section>
            <h2>Calificaciones</h2>            
            <?php
                cargaTareasCalificaciones();  
            ?>
        </section>
    </main>    
</body>
</html>