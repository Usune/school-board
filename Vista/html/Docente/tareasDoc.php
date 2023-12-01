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
            <!-- breadcrumb -->  
            <nav class="nav-main">
                <a href="homeDoc.php">Clases</a> 
                <?php
                    traerCurso();
                ?>
                <a href="" id="actual" actual="#tareas"> / Tareas</a>
            </nav>
        
            <section>

                <div class="cabecera">
                    <button type="button" class="desplegarModal btn-cabecera" modal="#modComun">
                        <img src="../../img/agregar.svg" alt="Registrar" modal="#modComun"> Nueva tarea
                    </button>
                </div>

                <div class="modal" id="modComun">

                    <div class="modal_container">
                        <button type="button" class="desplegarModal btn-cerrar" modal="#modComun"><img src="../../img/x.svg" alt="Salir" modal="#modComun"></button>

                        <div class="formulario">
                    
                            <h3>Subir Tarea</h3>
                            
                            <form action="../../../Controlador/registrarTareasDoc.php" method="post" enctype="multipart/form-data" id="formulario">

                                <div class="fieldset">
                                    <fieldset>
                                        <legend id="tit">Título</legend>
                                    </fieldset>
                                    <input type="text" placeholder="Título" required legend="#tit" name="titulo">
                                </div>
                                <div class="textarea">
                                    <label for="descripcion">Descripción</label>
                                    <textarea id="descripcion" cols="30" rows="10" name="descripcion" placeholder="Ingrese una descripción"></textarea>
                                </div>

                                <div class="select">
                                    <label for="fecha_V">Fecha limite de entrega </label>
                                    <input type="date" name="fecha_V">
                                </div>

                                <div class="file">
                                    <label for="archivo">Seleccione un archivo</label>
                                    <input type="file" accept=".pdf" name="archivos" multiple>
                                </div>

                                <?php
                                    echo '
                                    <input type="text" id="curso"  value="'.$_GET['idClase'].'" hidden name="idClase">
                                    ';
                                ?>

                                <button type="submit" class="enviar">Entregar Tarea</button>
                            </form>

                        </div>

                    </div>
                </div>

                <div class="opciones">
                    <button type="button" class="desplegar" enlace="#filtro"><img src="../../img/filtro.svg" alt="filtro">Filtrar</button>
                </div>

                <div id="filtro">

                    <form method="get">
                        <div class="cont-filtro">

                            <div class="fila-cont">

                                <div class="radio">
                                    <p>Fecha</p>
                                    <label for="fechaInicio">Fecha de creación:</label>
                                    <input type="date" id="fechaInicio" name="fechaInicio">
                                    <br>
                                    <label for="fechaFin">Fecha de vencimiento:</label>
                                    <input type="date" id="fechaFin" name="fechaFin">                  

                                </div>

                                <div class="radio">
                                    <p>Estado</p>
                                    <input type="radio" name="estado" value="nada" checked hidden>
                                    <input type="radio" name="estado" id="activo" value="activo">
                                    <label for="activo">Activo</label><br>
                                    <input type="radio" name="estado" id="vencido" value="vencido">
                                    <label for="inactivo">Vencido</label><br>
                                </div>

                            </div>

                            <div class="fila-cont">

                                <div class="fieldset"> 
                                    <fieldset>
                                        <legend id="tarea">Tarea</legend>
                                    </fieldset>
                                    <input type="text" placeholder="Tarea" legend="#tarea" name="tarea">
                                </div>
                                
                            
                                <button type="submit" class="filtrar">Filtrar</button>
                                <a href="adminUsu.php" class="filtrar">Limpiar</a>

                            </div>

                        </div>

                    </form>
                    
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