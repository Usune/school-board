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
        <!-- breadcrumb -->
        <nav class="nav-main">
            <a href="homeAdmin.php">Home</a>
            <a href="adminCurso.php" id="actual" actual="#cursos"> / Cursos</a>
        </nav>

        <section>

            <div class="cabecera">
                <button type="button" class="desplegarModal btn-cabecera" modal="#usuario">
                    <img src="../../img/agregar.svg" alt="Registrar" modal="#usuario"> Registrar curso
                </button>
            </div>
            
            <div class="modal" id="usuario">

                <div class="modal_container">
                    <button type="button" class="desplegarModal btn-cerrar" modal="#obser"><img src="../../img/x.svg" alt="Salir" modal="#usuario"></button>
                
                    <div class="formulario">
                    
                        <h3>Crear Curso</h3>

                        <p class="recordatorio">Antes de crear el curso, asegurese de que todos los campos son correctos.</p>
            
                        <form action="../../../Controlador/registrarCurAdmin.php" method="post" id="formulario">
                
                            <div class="fieldset_view">
                                <label for="jornada">Jornada</label>
                                <select class="veriSelect" required name="jornada">
                                    <option value="Seleccione" selected disabled>Seleccione una opción</option>
                                    <option value="unica">Unica</option>
                                    <option value="mañana">Mañana</option>
                                    <option value="tarde">Tarde</option>
                                </select>
                            </div>

                            <div class="fieldset">
                                <fieldset>
                                    <legend id="nom">Nombre</legend>
                                </fieldset>
                                <input type="text" placeholder="Nombre" required legend="#nom" name="nombre">
                            </div>
                
                            <p id="texto"></p>
                            
                            <button type="submit" class="enviar">Registrar curso</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="opciones">
                <button type="button" class="desplegar" enlace="#filtro"><img src="../../img/filtro.svg"
                        alt="filtro">Filtrar</button>
                <?php

                    if(isset($_GET['jornada']) || isset($_GET['nombre']) ){
                            
                       echo '
                       <a href="reporteExcelCurso.php?jornada='.$_GET['jornada'].'&nombre='.$_GET['nombre'].'" target="_blank"><img src="../../img/curso.svg" alt="Reportes">Reporte EXCEL</a>
                       ';
                        
                    }else {
                            
                        echo '
                        <a href="reporteExcelCurso.php" target="_blank"><img src="../../img/curso.svg" alt="Reportes">Reporte EXCEL</a>
                        ';

                    }

                    if(isset($_GET['jornada']) || isset($_GET['nombre']) ){
                            
                       echo '
                       <a href="reportesCurAdmin.php?jornada='.$_GET['jornada'].'&nombre='.$_GET['nombre'].'" target="_blank"><img src="../../img/curso.svg" alt="Reportes">Reporte PDF</a>
                       ';
                        
                    }else {
                            
                        echo '
                        <a href="reportesCurAdmin.php" target="_blank"><img src="../../img/curso.svg" alt="Reportes">Reporte PDF</a>
                        ';

                    }
                    
                ?>

            </div>

            <div id="filtro">
                <div class="cont-filtro">

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
                            <a href="adminCurso.php" class="filtrar">Limpiar</a>

                        </div>


                    </form>
                </div>
            </div>

                    <?php

                        if(isset($_GET['jornada']) || isset($_GET['nombre']) ){
                                
                            filtrarCursos($_GET['jornada'], $_GET['nombre']);
                            
                        }else {

                            cargarCursos();

                        }
                    ?>
        </section>

    </main>

    </div>

    <script>

        // Función para verificar que dos campos son iguales en un formulario y en caso de serlo no se envia el formulario, también que no se envien los select si una opción.
        // Para que funcione se deben tener dos input, el input1 debe tener 'id="campo1"' y el input2 debe tener 'id="verify" verify="#campo1"'
        // Y los select deben tener la clase 'veriSelect'
        const formularioRegistroAdmin = (event) => {

            event.preventDefault();
            const form = event.target;
            const text = document.getElementById('texto');        

            // Validamos que los select estén seleccionados
            let select2 = document.getElementsByName('jornada');
            select2 = select2[0].value;

            if (select2 !== 'Seleccione') {

                form.submit();
                return;

            }else{

                text.innerText = 'Seleccione una opción';
                document.getElementById('texto').style.visibility = 'visible';
                return;

            }

        }

        document.addEventListener('DOMContentLoaded', function () {

            // Se agrega la función verificar a todos los elementos con el 'id=formulario' que y se activa al intentar hacer un submit.
            document.getElementById('formulario').addEventListener('submit', formularioRegistroAdmin);

        });        

    </script>

</body>

</html>