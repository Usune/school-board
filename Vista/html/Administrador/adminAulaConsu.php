
<?php
    require_once ('../../../Modelo/conexion.php');
    require_once ('../../../Modelo/consultas.php');
    require_once ('../../../Modelo/seguridadAdmin.php');
    require_once ('../../../Controlador/mostrarPerfil.php');
    require_once ('../../../Controlador/mostrarAulaAdmin.php');
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
    <title>Aulas Admin</title>
</head>

<body>
    
    <?php
        include("menu-include.php");
    ?>
        <main>

            <!-- breadcrumb -->  
            <nav class="nav-main">
                <a href="homeAdmin.php">Home</a>
                <a href="adminAula.php"> / Aulas</a>
                <a href="adminAulaConsu.php"> / Consultar</a>
            </nav>
        
            <section>

                <h2>Administración de aulas</h2>
                <h3>Consultar aulas</h3>

                <div class="tabla">

                    <div class="opciones">
                        <a href="adminUsuReportes.php"><img src="../../img/curso.svg" alt="Reportes">Generar Reporte</a>
                        
                        <button type="button" class="desplegar" enlace="#filtro"><img src="../../img/filtro.svg" alt="filtro">Filtrar</button>
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
                            
                                <button type="submit" class="filtrar">Filtrar</button>
                                <a href="adminAulaConsu.php" class="filtrar">Limpiar</a>

                            </div>

                        </form>
                        
                    </div>
                    
                    <table>
                        <caption>
                            Lista de aulas creadas
                        </caption>
                        <tr>
                            <th>Aula</th>
                            <th>Opciones</th>
                            <!-- <th colspan="2">Opciones</th> -->
                        </tr>

                            <?php

                                if(isset($_GET['nombre']) ){
                                        
                                    filtrarAulas($_GET['nombre']);
                                  
                                }else {

                                    cargarAulas();

                                }
                            ?>

                    </table>
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