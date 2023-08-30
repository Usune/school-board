
<?php
    require_once ('../../../Modelo/conexion.php');
    require_once ('../../../Modelo/consultas.php');
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
    <title>Usuarios</title>
</head>

<body>
    
    <?php
        include("menu-include.php");
    ?>
        <main>

            <!-- breadcrumb -->  
            <nav class="nav-main">
                <a href="homeAdmin.php">Home</a>
                <a href="adminCurso.php"> / Cursos</a>
                <a href="adminCurRegistro.php"> / Registrar</a>
            </nav>
        
            <section>

                <h2>Administración de cursos</h2>
                
                <div class="tabla">
                    <table>
                        <tr>
                            <th>Curso</th>
                            <th>Jornada</th>
                            <th colspan="2">Opciones</th>
                        </tr>
                        <?php
                            cargarCurso();
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