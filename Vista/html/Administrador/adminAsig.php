<?php
    require_once ('../../../Modelo/conexion.php');
    require_once ('../../../Modelo/consultas.php');
    require_once ('../../../Modelo/seguridadAdmin.php');
    require_once ('../../../Controlador/mostrarPerfil.php');
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
    <title>Asignaruras Admin</title>
</head>
<body>
    
    <?php
        include("menu-include.php");
    ?>
        <main>
            
            <!-- breadcrumb -->  
            <nav class="nav-main">
                <a href="homeAdmin.php">Home</a>
                <a href="adminAsig.php"> / Asignaturas</a>
            </nav>
        
            <section>

                <h2>Administración de asignaturas</h2>
                
                <div class="contenedor">
                    <div class="fila-cont">
                        <a href="adminAsigRegistro.php">
                            <img src="../../img/crearAsig.svg" alt="logo">
                            <p>Crear <br> Asignatura</p>
                        </a>

                        <a href="adminAsigConsu.php">
                            <img src="../../img/lupa.svg" alt="logo">
                            <p>Consultar Asignaturas</p>
                        </a>
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