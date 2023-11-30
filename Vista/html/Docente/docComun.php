<?php
    require_once ('../../../Modelo/conexion.php');
    require_once ('../../../Modelo/consultas.php');
    require_once('../../../Modelo/seguridadDoc.php');
    require_once ('../../../Controlador/mostrarPerfil.php');
    require_once ('../../../Controlador/mostrarCursosDoc.php');
    require_once ('../../../Controlador/mostrarComunDoc.php');
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
    <title>Comunicados </title>
</head>
<body>

    <?php
        include('menu-include.php');
    ?>
            
            <!-- breadcrumb -->  
            <nav class="nav-main">
                <a href="homeDoc.php">Clase</a>
                <?php
                    traerCurso();
                ?>
                <a href="" id="actual" actual="#comunicados"> / Comunicados</a>            
            </nav> 
            <section>

                <div class="cabecera">
                    <button type="button" class="desplegarModal btn-cabecera" modal="#modComun">
                        <img src="../../img/agregar.svg" alt="Registrar" modal="#modComun"> Nuevo comunicado
                    </button>
                </div>
                
                <div class="modal" id="modComun">

                    <div class="modal_container">
                        <button type="button" class="desplegarModal btn-cerrar" modal="#modComun"><img src="../../img/x.svg" alt="Salir" modal="#modComun"></button>
                        <div class="formulario">
                    
                            <h3>Subir Comunicado</h3>

                            <p class="recordatorio">Antes de subir el comunicado, asegurese de que todos los campos son correctos.</p>
                            <p class="recordatorio">Recuerde que el sistema solo acepta archivos PDF.</p>
                
                            <form action="../../../Controlador/registrarComunDoc.php" method="post" enctype="multipart/form-data" id="formulario">

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

                                    <div class="file">
                                        <label for="archivo">Archivo</label>
                                        <input type="file" accept=".pdf" name="archivo">
                                    </div>

                                    <?php
                                        traerCursoID();
                                    ?>
                
                                    <p id="texto"></p>
                                
                                <button type="submit" class="enviar">Subir comunicado</button>
                            </form>

                        </div>
                    </div>
                </div>

               <h3>Comunicados</h3>                
           
                <?php

                    cargarComunicados();

                ?>
         
            </section>            
        </main>
        
    </div>
    
</body>
</html>
