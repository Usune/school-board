<?php
    require_once ('../../../Modelo/conexion.php');
    require_once ('../../../Modelo/consultas.php');
    require_once ('../../../Modelo/seguridadAdmin.php');
    require_once ('../../../Controlador/mostrarPerfil.php');
    require_once ('../../../Controlador/mostrarUsuAdmin.php');
?>

<!DOCTYPE html>
<html lang="en">

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

    <main>

        <!-- breadcrumb -->
        <nav class="nav-main">
            <a href="homeAdmin.php">Home</a>
            <a href="adminUsu.php"> / Usuarios</a>
            <a href="adminUsu.php"> / Consultar</a>
        </nav>

        <section>
            <h2>Administración de usuarios</h2>

            <h3>Consultar usuarios</h3>
            <div class="opciones">

                <button type="button" class="desplegar" enlace="#filtro"><img src="../../img/filtro.svg"
                        alt="filtro">Filtrar</button>

                <?php

                        if(isset($_GET['rol']) || isset($_GET['estado']) || isset($_GET['nombres']) || isset($_GET['apellidos']) || isset($_GET['documento'])){
                                
                            echo'<a href="reportesUsuAdmin.php?rol='.$_GET['rol'].'&estado='.$_GET['estado'].'&nombres='.$_GET['nombres'].'&apellidos='.$_GET['apellidos'].'&documento='.$_GET['documento'].'" target="_blank"><img src="../../img/curso.svg" alt="Reportes">Generar Reporte</a>';
                            
                        }else {

                            echo'<a href="reportesUsuAdmin.php" target="_blank"><img src="../../img/curso.svg" alt="Reportes">Generar Reporte</a>';

                        }
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

            <div class="tabla">

                <div class="tablas">
                    <table>
                        <thead>
                            <tr>
                                <th>Tipo Documento</th>
                                <th>Documento</th>
                                <th>Apellidos</th>
                                <th>Nombres</th>
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