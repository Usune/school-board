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
    <title>Administrar cursos</title>
</head>
<body>
    
    <?php
        include("menu-include.php");
    ?>

        <main>
            
            <!-- breadcrumb -->  
            <nav class="nav-main">
                <a href="homeAdmin.php">Home</a>
                <a href="adminCurso.php"> / Comunicados</a>
            </nav>
        
            <section>

                <h2>Administración de comunicados</h2>
                
                <div class="contenedor">
                    <div class="fila-cont">
                        <a href="adminComunRegistrar.php">
                            <img src="../../img/registrar.svg" alt="logo">
                            <p>Subir</p>
                        </a>

                        <a href="adminComunConsu.html">
                            <img src="../../img/lupa.svg" alt="logo">
                            <p>Consultar</p>
                        </a>
                    </div>
        
                    <a href="adminComunModificar.html">
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