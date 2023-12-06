<?php
    require_once ('../../../Modelo/conexion.php');
    require_once ('../../../Modelo/consultas.php');
    require_once ('../../../Modelo/seguridadAdmin.php');
    require_once ('../../../Controlador/mostrarPerfil.php');
    require_once ('../../../Controlador/mostrarUsuAdmin.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/logo.svg">
    <link rel="stylesheet" type="text/css" href="../../css/administrador/estilosAdmin.css">
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
                <a href="homeAdmin.php">Home</a>
                <a href="adminUsu.php" id="actual" actual="#usuarios"> / Usuarios</a>
            </nav>

            <section>
                
                <div class="cabecera">
                    <button type="button" class="desplegarModal btn-cabecera" modal="#modUsuario">
                        <img src="../../img/agregar.svg" alt="Registrar" modal="#modUsuario"> Registrar usuario
                    </button>
                </div>
                
                <div class="modal" id="modUsuario">

                    <div class="modal_container">
                        <button type="button" class="desplegarModal btn-cerrar" modal="#modUsuario"><img src="../../img/x.svg" alt="Salir" modal="#modUsuario"></button>
                    
                        <div class="formulario">
                    
                            <h3>Registrar usuario</h3>

                            <p class="recordatorio">Por favor, seleccione el rol del usuario que desea registrar.</p>
                            <!--  enctype="multipart/form-data" -->
                            <form action="adminUsuRegistro2.php" method="get" id="formulario">
                    
                                <div class="fieldset_view">
                                    <label for="rol">Rol</label>
                                    <select class="veriSelect" required name="rol">
                                        <option value="Seleccione" selected disabled>Seleccione una opción</option>
                                        <option value="Docente">Docente</option>
                                        <option value="Estudiante">Estudiante</option>
                                    </select>
                                </div>
                
                                <p id="texto"></p>
                                
                                <button type="submit" class="enviar">Siguiente</button>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="opciones">

                    <button type="button" class="desplegar" enlace="#filtro"><img src="../../img/filtro.svg"
                            alt="filtro">Filtrar</button>

                    <?php

                        if(isset($_GET['rol']) || isset($_GET['estado']) || isset($_GET['nombres']) || isset($_GET['apellidos']) || isset($_GET['documento'])){
                                
                        echo '
                        <a href="reporteExcelUsuario.php?rol='.$_GET['rol'].'&estado='.$_GET['estado'].'&nombres='.$_GET['nombres'].'&apellidos='.$_GET['apellidos'].'&documento='.$_GET['documento'].'" target="_blank"><img src="../../img/curso.svg" alt="Reportes">Reporte EXCEL</a>
                        ';
                            
                        }else {
                                
                            echo '
                            <a href="reporteExcelUsuario.php" target="_blank"><img src="../../img/curso.svg" alt="Reportes">Reporte EXCEL</a>
                            ';

                        }

                        if(isset($_GET['rol']) || isset($_GET['estado']) || isset($_GET['nombres']) || isset($_GET['apellidos']) || isset($_GET['documento'])){
                                
                        echo '
                        <a href="reportesUsuAdmin.php?rol='.$_GET['rol'].'&estado='.$_GET['estado'].'&nombres='.$_GET['nombres'].'&apellidos='.$_GET['apellidos'].'&documento='.$_GET['documento'].'" target="_blank"><img src="../../img/curso.svg" alt="Reportes">Reporte PDF</a>
                        ';
                            
                        }else {
                                
                            echo '
                            <a href="reportesUsuAdmin.php" target="_blank"><img src="../../img/curso.svg" alt="Reportes">Reporte PDF</a>
                            ';

                        }

                        // if(isset($_GET['rol']) || isset($_GET['estado']) || isset($_GET['nombres']) || isset($_GET['apellidos']) || isset($_GET['documento'])){
                                
                        //     echo'<a href="reportesUsuAdmin.php?rol='.$_GET['rol'].'&estado='.$_GET['estado'].'&nombres='.$_GET['nombres'].'&apellidos='.$_GET['apellidos'].'&documento='.$_GET['documento'].'" target="_blank"><img src="../../img/curso.svg" alt="Reportes">Generar Reporte</a>';
                            
                        // }else {

                        //     echo'<a href="reportesUsuAdmin.php" target="_blank"><img src="../../img/curso.svg" alt="Reportes">Generar Reporte</a>';

                        // }
                    ?>

                </div>
                <div id="filtro">

                    <div class="cont-filtro">

                        <form method="get">

                            <div class="fila-cont">

                                <div class="radio">
                                    <p>Rol</p>
                                    <input type="radio" name="rol" value="nada" checked hidden>
                                    <input type="radio" name="rol" id="docente" value="docente">
                                    <label for="docente">Docente</label><br>
                                    <input type="radio" name="rol" id="estu" value="estudiante">
                                    <label for="estu">Estudiante</label>
                                </div>

                                <div class="radio">
                                    <p>Estado</p>
                                    <input type="radio" name="estado" value="nada" checked hidden>
                                    <input type="radio" name="estado" id="activo" value="activo">
                                    <label for="activo">Activo</label><br>
                                    <input type="radio" name="estado" id="inactivo" value="inactivo">
                                    <label for="inactivo">Inactivo</label>
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
                                <a href="adminUsu.php" class="filtrar">Limpiar</a>

                            </div>

                        </form>

                    </div>

                </div>

                    <div class="tablas">
                        <table>
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Apellidos</th>
                                    <th>Nombres</th>
                                    <th>Tipo Documento</th>
                                    <th>Documento</th>
                                    <th>Estado</th>
                                    <th>Rol</th>
                                    <th class="ultimo">Opciones</th>
                                    <!-- <th colspan="2">Opciones</th> -->
                                </tr>
                            </thead>


                            <?php
        
                                        if(isset($_GET['rol']) || isset($_GET['estado']) || isset($_GET['nombres']) || isset($_GET['apellidos']) || isset($_GET['documento'])){
                                                
                                            filtrarUsuarios($_GET['rol'], $_GET['estado'], $_GET['nombres'], $_GET['apellidos'], $_GET['documento']);
                                        
                                        }else {
        
                                            cargarUsuarios();
        
                                        }
                                    ?>

                        </table>
                    </div>
                    
            </section>

        </main>

    </div>

</body>

</html>