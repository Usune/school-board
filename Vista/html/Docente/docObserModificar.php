<?php
require_once ('../../../Modelo/conexion.php');
require_once ('../../../Modelo/consultas.php');
require_once('../../../Modelo/seguridadDoc.php');
require_once ('../../../Controlador/mostrarPerfil.php');
require_once ('../../../Controlador/mostrarCursosDoc.php');
require_once ('../../../Controlador/mostrarObserDoc.php');
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/logo.svg">
    <link rel="stylesheet" type="text/css" href="../../css/Docente/estilosDoc.css">
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <script src="../../js/controlGeneral.js"></script>
    <title>Observaciones </title>
</head> 
<body>
    
    <?php
        include("menu-include.php");
    ?>
            
            <!-- breadcrumb -->  
    <nav class="nav-main">
        <a href="homeDoc.php">Clases</a>
        <?php
            traerCurso();
        ?>                            
        <!-- <?php
            echo '<a href="docObser.php?idClase='.$_GET['idClase'].'" id="actual" actual="#observador"> / Observador</a> ';
        ?> -->
        <a href="" id="actual" actual="#observador"> / Observador</a>
    </nav>
        
            <section> 

            <?php
                cargarObserEditar();
            ?>

            </section>
    
        </main>

    </div>
    
</body>
</html>