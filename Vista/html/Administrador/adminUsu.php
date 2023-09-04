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
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <link rel="stylesheet" type="text/css" href="../../css/administrador/estilosAdmin.css">
    <script src="../../js/controlGeneral.js"></script>
    <title>Administrar usuarios</title>
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
            </nav>
        
            <section>

                <h2>Administración de usuarios</h2>
                
                <div class="contenedor">
                    <div class="fila-cont">
                        <a href="adminUsuRegistro.php">
                            <img src="../../img/registrar.svg" alt="logo">
                            <p>Registrar</p>
                        </a>

                        <a href="adminUsuConsu.php">
                            <img src="../../img/lupa.svg" alt="logo">
                            <p>Consultar</p>
                        </a>
                    </div>
        
                    <a href="adminUsuModificar.php">
                        <img src="../../img/edit.svg" alt="logo">
                        <p>Modificar</p>
                    </a>

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