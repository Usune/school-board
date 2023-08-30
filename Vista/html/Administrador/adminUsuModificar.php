<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Admin</title>
    <link rel="shortcut icon" href="../../img/logo.svg">
    <link rel="stylesheet" type="text/css" href="../../css/administrador/estilosAdmin.css">
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <script src="../../js/controlGeneral.js"></script>
</head>

<body>
    
    <?php
        include("menu-include.php");
    ?>

        <main>

            <!-- breadcrumb -->    
            <nav class="nav-main">
                <a href="homeAdmin.php">Home</a>
                <a href="adminUsu.php"> / Usuarios</a>
                <a href="adminUsuModificar.php"> / Modificar</a>
            </nav>

            <section>

                <h2>Administración de usuarios</h2>
                
                <div class="formulario">
                    
                    <h3>Modificar usuario</h3>

                    <p class="recordatorio">Digite el documento del usuario que desea modificar</p>
        
                    <form action="../../../Controlador/registrarUserAdmin.php" method="post" id="formularioAdmin">
            
                        <div class="fieldset">
                            <fieldset>
                                <legend id="usu">Documento</legend>
                            </fieldset>
                            <input type="number" placeholder="Documento" required legend="#usu" id="campo1" name="usuario">
                        </div>
        
                        <p id="texto">No hay nungún usuario registrado con el documento ingresado, verifique el documento</p>
                        
                        <button type="submit" class="enviar">Buscar</button>
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