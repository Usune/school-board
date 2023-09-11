<?php
    require_once("../../../Modelo/conexion.php");
    require_once("../../../Modelo/consultas.php");
    require_once("../../../Controlador/mostrarInfoEstudiante.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Asignatura</title>
    <link rel="shortcut icon" href="../../img/logo.svg">
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <link rel="stylesheet" type="text/css" href="../../css/estudiante/estilosEstu.css">
    <script src="../../js/controlGeneral.js"></script>
</head>

<body>
    <!-- Barra de navegación principal (horizontal) -->
    <?php
        include("menu-include.php");
    ?>

    <main>

        <!-- breadcrumb -->
        <nav class="nav-main">
            <a href="homeEstu.php">Home</a>
            <a href="homeAsignatura.php"> / AsignaturaExample</a>
        </nav>


        <section>
            
            <h2>Principal de AsignaturaExample</h2>

            <?php mostrarTareasAsignatura(); ?>
        
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