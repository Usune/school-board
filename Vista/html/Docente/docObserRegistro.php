<?php
require_once ('../../../Modelo/conexion.php');
require_once ('../../../Modelo/consultas.php');
require_once('../../../Modelo/seguridadDoc.php');
require_once ('../../../Controlador/mostrarPerfil.php');
require_once ('../../../Controlador/mostrarCursosDoc.php');
require_once ('../../../Controlador/mostrarObserDoc.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/logo.svg">
    <link rel="stylesheet" type="text/css" href="../../css/Docente/estilosDoc.css">
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <script src="../../js/controlGeneral.js"></script>
    <title>Observaciones </title>
</head>
<body>  
    <?php
        include("menu-include.php");
    ?>
        <main>
            <!-- breadcrumb -->  
            <nav class="nav-main">
                <a href="homeAdmin.php">Clases</a>
                <a href="adminComun.php"> / Observador</a>
                <a href="adminComunRegistrar.php"> / Registrar</a>
            </nav>        
            <section>
                <h2>Observación para <?php  cargarNombre()  ?></h2>                
                <div class="formulario">                    
                    <p class="recordatorio">Antes de subir la observación, asegurese de que todos los campos son correctos.</p>        
                    <form action="../../../Controlador/registrarObserDoc.php" method="post" enctype="multipart/form-data" id="formulario">
                            <div class="select">
                                <label for="fechaLimite">Fecha limite de entrega </label>
                                <input type="date" value="'.$fecha_formateada.'" name="fechaLimite">
                            </div>        
                            <div class="textarea">
                                <label for="descripcion">Descripción de la situación</label>
                                <textarea id="descripcionObservador" cols="30" rows="10" name="descripcionObservador" placeholder="Ingrese una descripción"></textarea>
                            </div>                                                                                                
                            <?php
                                echo '<input style="display: none;" id="documentoEstudiante" name="documentoEstudiante" type="text" value="'.$_GET['documento'].'">'; 
                                echo '<input style="display: none;" id="idClase" name="idClase" type="text" value="'.$_GET['idClase'].'">';                                
                            ?>
                        <button type="submit" class="enviar">Subir Observador</button>
                    </form>
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