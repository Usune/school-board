<?php
require_once('../../../Modelo/conexion.php');
require_once('../../../Modelo/consultas.php');
require_once('../../../Modelo/seguridadDoc.php');
require_once('../../../Controlador/mostrarPerfil.php');
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
    <?php
    include("menu-include.php");
    ?>
    <!-- Barra de navegación principal -->
    

   >

        <main>

            <!-- breadcrumb -->
            <nav class="nav-main">
                <a href="homeDoc.php">Cursos </a>
            </nav>

            <section>
                <h2>Cursos</h2>

                <!-- Formulario para subir tareas (No borrar) -->
                <form class="doc" action="../../../Controlador/subirTarea.php" method="post" enctype="multipart/form-data" id="formulario">

                    <div class="textarea" >
                        <label for="titulo">Título</label>
                        <textarea id="titulo" cols="30" rows="10" name="titulo">Ingrese un título</textarea>
                    </div>
                    <div class="textarea">
                        <label for="descripcion">Descripción</label>
                        <textarea id="descripcion" cols="30" rows="10" name="descripcion">Ingrese una descripción</textarea>
                    </div>

                    <div class="file">
                        <label for="archivo">Seleccione un archivo</label>
                        <input type="file" accept=".pdf" name="archivos[]" multiple>
                    </div>

                    <button type="submit" class="enviar">Entregar Tarea</button>
                </form>

                
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