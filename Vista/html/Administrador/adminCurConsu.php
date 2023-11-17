<?php
    require_once ('../../../Modelo/conexion.php');
    require_once ('../../../Modelo/consultas.php');
    require_once ('../../../Modelo/seguridadAdmin.php');
    require_once ('../../../Controlador/mostrarPerfil.php');
    require_once ('../../../Controlador/mostrarCurAdmin.php');
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
    <title>Cursos Admin</title>
</head>

<body>

    <?php
        include("menu-include.php");
    ?>
    <main>

        <!-- breadcrumb -->
        <nav class="nav-main">
            <a href="homeAdmin.php">Home</a>
            <a href="adminCurso.php"> / Cursos</a>
            <a href="adminCurConsu.php"> / Consultar</a>
        </nav>

        <section>

            <h2>Administración de cursos</h2>
            <h3>Consultar cursos</h3>

            <div class="tabla">

                <div class="opciones">
                    <a href="reportesCurAdmin.php"><img src="../../img/curso.svg" alt="Reportes">Generar Reporte</a>

                    <button type="button" class="desplegar" enlace="#filtro"><img src="../../img/filtro.svg"
                            alt="filtro">Filtrar</button>
                </div>

                <div id="filtro">

                    <form method="get">

                        <div class="fieldset">
                            <fieldset>
                                <legend id="nom">Nombre</legend>
                            </fieldset>
                            <input type="text" placeholder="Nombre" legend="#nom" name="nombre">
                        </div>

                        <div class="fila-cont">

                            <div class="radio">
                                <p>Jornada</p>
                                <input type="radio" name="jornada" value="nada" checked hidden>
                                <input type="radio" name="jornada" id="unica" value="unica">
                                <label for="unica">Única</label><br>
                                <input type="radio" name="jornada" id="manana" value="mañana">
                                <label for="manana">Mañana</label><br>
                                <input type="radio" name="jornada" id="tarde" value="tarde">
                                <label for="tarde">Tarde</label><br>
                            </div>
                            <button type="submit" class="filtrar">Filtrar</button>
                            <a href="adminCurConsu.php" class="filtrar">Limpiar</a>

                        </div>


                    </form>

                </div>


                <div class="tablas">
                    <table>
                        <caption>
                            Lista de cursos registrados
                        </caption>
                        <thead>
                            <tr>
                                <th>Curso</th>
                                <th>Jornada</th>
                                <th class="ultimo">Opciones</th>
                                <!-- <th colspan="2">Opciones</th> -->
                            </tr>
                        </thead>


                        <?php
    
                                    if(isset($_GET['jornada']) || isset($_GET['nombre']) ){
                                            
                                        filtrarCursos($_GET['jornada'], $_GET['nombre']);
                                      
                                    }else {
    
                                        cargarCursos();
    
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