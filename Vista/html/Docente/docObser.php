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

        <main>
            
            <!-- breadcrumb -->  
            <nav class="nav-main">
                <a href="homeDoc.php">Clases</a>                            
                <?php
                    echo '<a href="docObser.php?idClase='.$_GET['idClase'].'"> / Observador</a> ';
                ?>
                <!-- <a href="tareasDoc.php"> / Consultar</a> -->
            </nav>
        
            <section> 

            <nav class="navbar bg-body-tertiary">
                <div class="container-fluid">
                    <form class="d-flex" role="search">

            <?php
                if(isset($_GET['documento']) && isset($_GET['idClase'])){
                    cargarObservador();
                }else {
                    mostrarObserForm();
                }
            ?>


</form>
            </div>
            </nav>

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
    
</body>
</html>