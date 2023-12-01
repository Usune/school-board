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
    <link rel="shortcut icon" href="../../img/logo.svg">
    <link rel="stylesheet" type="text/css" href="../../css/Docente/estilosDoc.css">
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <script src="../../js/controlGeneral.js"></script>
</head>

<body>
    <div class="aside-main">

        <aside id="menu">
            <div>
                <div class="logo">
                    <a href="homeDoc.php"><img src="../../img/logo.svg" alt="logo">
                    <h1>School Board</h1></a>
                </div>
                <ul> 
                    <li><a href="homeDoc.php" class="activeA"><img src="../../img/curso.svg" alt="logo">Clases</a></li>
                </ul>
            </div>
            <div>
                <div class="asideImgDoc">
                </div>
                <footer>
                    <div class="info-footer">
                        <p>School Board</p>
                        <p>Copyright © - 2023. Todos los Derechos Reservados</p>
                        <p>Autor: Estefani Arenas, Erika Diaz, Nicole Benavides y Tatiana Arevalo.</p>
                    </div>
                </footer>
            </div>
        </aside>
    
        <main>

            <!-- Barra de navegación principal -->
            <nav class="nav-pri">
                <div class="fila">
                    <div class="menu">
                        <button type="button" class="desplegar" enlace="#menu">
                            <img src="../../img/menu.svg" alt="menu" enlace="#menu">
                        </button>
                    </div> 
                    <h2 id="liRol">Docente</h2>
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

            <!-- breadcrumb -->
            <nav class="nav-main">
                <a href="homeDoc.php">Clases </a>
            </nav>

            <section>

                <div class="contClases">

                    <?php
                        traerCursos();
                    ?>

                </div>
                    
            </section>

        </main>
    </div>

</body>

</html>