<?php
require_once ('../../../Modelo/conexion.php');
require_once ('../../../Modelo/consultas.php');
require_once('../../../Modelo/seguridadDoc.php');
require_once ('../../../Controlador/mostrarPerfil.php');
require_once ('../../../Controlador/mostrarTareasDoc.php');
require_once ('../../../Controlador/mostrarCursosDoc.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/logo.svg">
    <link rel="stylesheet" type="text/css" href="../../css/Docente/estilosDoc.css">
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <script src="../../js/controlGeneral.js"></script>
    <title>Consultar usuarios</title>
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

                navMainDoc();

                ?>
                <a href="tareasDoc.php"> / Tareas</a> 
                <!-- <a href="tareasDoc.php"> / Consultar</a> -->
            </nav>
        
            <section>
            

                <h2>Consultar tareas</h2>

                <div class="tabla">

                    <div class="opciones">               

                        <?php
                        registroTareaDoc();
                        ?>
                        <button type="button" class="desplegar" enlace="#filtro"><img src="../../img/filtro.svg" alt="filtro">Filtrar</button>
                        
                    </div>

                    <div id="filtro">

                        <form method="get">

                            <div class="fila-cont">

                                <div class="radio">
                                    <p>Rol</p>
                                    <input type="radio" name="rol" value="nada" checked hidden>
                                    <input type="radio" name="rol" id="docente" value="docente">
                                    <label for="docente">Docente</label><br>
                                    <input type="radio" name="rol" id="estu" value="estudiante">
                                    <label for="estu">Estudiante</label><br>
                                </div>

                                <div class="radio">
                                    <p>Estado</p>
                                    <input type="radio" name="estado" value="nada" checked hidden>
                                    <input type="radio" name="estado" id="activo" value="activo">
                                    <label for="activo">Activo</label><br>
                                    <input type="radio" name="estado" id="inactivo" value="inactivo">
                                    <label for="inactivo">Inactivo</label><br>
                                </div>

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
                                <a href="adminUsuConsu.php" class="filtrar">Limpiar</a>

                            </div>

                        </form>
                        
                    </div>

                </div>

                
                    
                <?php
                    cargarTareas();
                ?>
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