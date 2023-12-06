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
            <!-- breadcrumb -->    
            <nav class="nav-main">
                <a href="homeAdmin.php" id="actual" actual="#home">Home</a>
            </nav>

            <section>
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
                        <a href="adminAula.php">                
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
                    <div class="fila-cont">
                        <a href="adminObser.php">                
                            <img src="../../img/observador.svg" alt="logo">
                            <p>Observador</p>
                        </a>
                    </div>
                </div>
            </section>
        </main>
    </div>    

</body>

</html>