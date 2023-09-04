<?php
    require_once ('../../../Modelo/conexion.php');
    require_once ('../../../Modelo/consultas.php');
    require_once ('../../../Modelo/seguridadAdmin.php');
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
    <title>Comunicados</title>
</head>

<body>
    
    <?php
        include("menu-include.php");
    ?>
        <main>

            <!-- breadcrumb -->  
            <nav class="nav-main">
                <a href="homeAdmin.php">Home</a>
                <a href="adminUsu.php"> / Comunicados</a>
                <a href="adminUsuRegistro.php"> / Registrar</a>
            </nav>
        
            <section>

                <h2>Administración de comunicados</h2>
                
                <div class="formulario">
                    
                    <h3>Subir comunicado</h3>

                    <p class="recordatorio">Antes de registrar el comunicado, asegurese de que todos los campos son correctos.</p>
        
                    <form action="../../../Controlador/registrarComunAdmin.php" method="post" enctype="multipart/form-data" id="formulario">

                            <div class="fieldset">
                                <fieldset>
                                    <legend id="tit">Título</legend>
                                </fieldset>
                                <input type="text" placeholder="Título" required legend="#tit" name="titulo">
                            </div>
            
                            <div class="textarea">
                                <label for="descripcion">Descripción</label>
                                <textarea id="descripcion" cols="30" rows="10" name="descripcion">Ingrese una descripción</textarea>
                            </div>

                            <div class="file">
                                <label for="archivo">Seleccione un archivo</label>
                                <input type="file" accept=".pdf" name="archivo">
                            </div>
        
                        <p id="texto"></p>
                        
                        <button type="submit" class="enviar">Subir comunicado</button>
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
            <p>Autor: Estefani Arenas, Erika Diaz, Nicole Benabides y Tatiana Arevalo.</p>
        </div>
    </footer>

</body>

</html>