<?php
require_once ('../../../Modelo/conexion.php');
require_once ('../../../Modelo/consultas.php');
require_once('../../../Modelo/seguridadDoc.php');
require_once ('../../../Controlador/mostrarPerfil.php');
require_once ('../../../Controlador/mostrarCursosDoc.php');
require_once ('../../../Controlador/mostrarAsisDoc.php');
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
            <a href="adminUsu.php"> / Asistencia</a>
        </nav>

        <section>
            <h2>Asistencia Estudiantes</h2>

            <!-- <h3>Consultar usuarios</h3> -->

            <div class="tabla">

                <div class="opciones">

                    <?php

                        if(isset($_GET['rol']) || isset($_GET['estado']) || isset($_GET['nombres']) || isset($_GET['apellidos']) || isset($_GET['documento'])){
                                
                            echo'<a href="reportesAsis.php?rol='.$_GET['rol'].'&estado='.$_GET['estado'].'&nombres='.$_GET['nombres'].'&apellidos='.$_GET['apellidos'].'&documento='.$_GET['documento'].'" target="_blank"><img src="../../img/curso.svg" alt="Reportes">Generar Reporte</a>';
                            
                        }else {

                            echo'<a href="reportesAsis.php" target="_blank"><img src="../../img/curso.svg" alt="Reportes">Generar Reporte</a>';

                        }
                    ?>

                    <button type="button" class="desplegar" enlace="#filtro"><img src="../../img/filtro.svg"
                            alt="filtro">Filtrar</button>
                </div>

                <div id="filtro">

                    <form method="get">

                        <div class="fila-cont">


                        </div>

                        <div class="fila-cont">

                            <div class="fieldset">
                                <fieldset>
                                    <legend id="nom">Nombre</legend>
                                </fieldset>
                                <input type="text" placeholder="Nombre" legend="#nom" name="nombres">
                            </div>

                            <div class="fieldset">
                                <fieldset>
                                    <legend id="ape">Apellido</legend>
                                </fieldset>
                                <input type="text" placeholder="Apellido" legend="#ape" name="apellidos">
                            </div>

                        </div>

                        <div class="fila-cont">

                            <div class="fieldset">
                                <fieldset>
                                    <legend id="doc">Documento</legend>
                                </fieldset>
                                <input type="number" placeholder="Documento" legend="#doc" name="documento">
                            </div>

                            <button type="submit" class="filtrar">Filtrar</button>
                            <a href="adminUsu.php" class="filtrar">Limpiar</a>

                        </div>

                    </form>

                </div>

                <div class="tablas">
                    <table>
                        <caption>
                            Lista de usuarios registrados
                        </caption>
                        <thead>
                            <tr>
                                <th>Tipo Documento</th>
                                <th>Documento</th>
                                <th>Apellidos</th>
                                <th>Nombres</th>
                                <th>Fecha</th>
                                <th class="ultimo">Asistencia</th>
                                <!-- <th colspan="2">Opciones</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php cargarAsistencia(); ?>
                        </tbody>
                       
                        <?php
    
                                    if( isset($_GET['nombres']) || isset($_GET['apellidos']) || isset($_GET['documento'])){
                                            
                                        // filtrarUsuarios($_GET['nombres'], $_GET['apellidos'], $_GET['documento']);
                                      
                                    }else {
    
                                        
    
                                    }
                                ?>



                    </table>
                </div>

            </div>
        </section>



    </main>

</body>

</html>