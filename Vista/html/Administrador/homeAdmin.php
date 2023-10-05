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
            </nav>

            <section>
                <h2>Administrar</h2>
                <div class="contenedor">
                    <div class="fila-cont">                        
                        <a href="adminUsu.php">            
                            <img src="../../img/user.svg" alt="logo">
                            <p>Usuarios</p>
                        </a>
                        <a href="adminCurso.php">                
                            <img src="../../img/curso.svg" alt="logo">
                            <p>Cursos</p>            
                        </a>
                        <a href="adminAsig.php">
                            <img src="../../img/asignaturas.svg" alt="logo">
                            <p>Asignaturas</p>
                        </a>
                    </div>
                    <div class="fila-cont">
                        <a href="adminAulas.php">                
                            <img src="../../img/aulas.svg" alt="logo">
                            <p>Aulas</p>
                        </a>
                        <a href="adminClase.php">                
                            <img src="../../img/clases.svg" alt="logo">
                            <p>Clases</p>            
                        </a>
                        <a href="adminComun.php">                
                            <img src="../../img/comunicados.svg" alt="logo">
                            <p>Comunicados</p>            
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