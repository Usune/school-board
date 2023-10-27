<?php
require_once ('../../../Modelo/conexion.php');
require_once ('../../../Modelo/consultas.php');
require_once('../../../Modelo/seguridadDoc.php');
require_once ('../../../Controlador/mostrarPerfil.php');
require_once ('../../../Controlador/mostrarCursosDoc.php');
?>

<!DOCTYPE html>
<html lang="es"> 

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesor</title>
    <link rel="shortcut icon" href="../../img/logo.png">
    <link rel="stylesheet" type="text/css" href="../../css/Docente/estilosDoc.css">
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <script src="../../js/controlGeneral.js"></script>
</head>

<body>

    <!-- Barra de navegación principal -->
    
    <nav class="nav-pri ">
        <div class="fila">
            <div class="menu">
                <button type="button" class="desplegar" enlace="#menu">
                    <img src="../../img/menu.svg" alt="menu" enlace="#menu">
                </button>
            </div> 
            <div class="logo">
                <img src="../../img/logo.svg" alt="logo">
                <h1>School Board</h1>
            </div>
        </div>
        <div class="buscar">
            <!-- <form action="#">
                <input type="text" name="q" placeholder="Buscar...">
                <button type="button"><img src="../../img/lupa.svg" alt="buscar"></button>
            </form> -->
        </div>
        <div class="user">
            
            <?php
                perfilHome(); 
            ?>

        </div>
    </nav>


        <main class="home">

            <!-- breadcrumb -->
            <nav class="nav-main">
                <a href="homeDoc.php">Clases </a>
            </nav>

            <section>
                <h2>Clases</h2>

                <div class="contenedor Doc">
                    <div class="fila-cont">
                        <?php
                        traerCursos(); 
                        ?>
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