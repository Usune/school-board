<?php
    require_once ('../../../Modelo/conexion.php');
    require_once ('../../../Modelo/consultas.php');
    require_once('../../../Modelo/seguridadDoc.php');
    require_once ('../../../Controlador/mostrarPerfil.php');
    require_once ('../../../Controlador/mostrarCursosDoc.php');
    require_once ('../../../Controlador/mostrarComunDoc.php');
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
    <title>Comunicados </title>
</head>
<body>
    <?php
        include('menu-include.php');
    ?>
        <main>            
            <!-- breadcrumb -->  
            <nav class="nav-main">
                <a href="homeDoc.php">Clases</a>                            
                <?php
                    echo '<a href="docComun.php?idClase='.$_GET['idClase'].'"> / Comunicados</a> ';
                ?>            
            </nav> 
            <section>
                <h2>Comunicados</h2>
                <?php

                    cargarComunicados();
                ?>
                 <div class="contenedor">
                    <div class="fila-cont">
                        <?php
                            echo '<a href="docComunRegistrar.php?idClase='.$_GET['idClase'].'">';
                        ?>                          
                            <img src="../../img/agregar.svg" alt="logo">
                            <p>Subir<br> comunicado</p>
                        </a>
                    </div>
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
</body>
</html>
