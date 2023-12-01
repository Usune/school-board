<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Asignatura</title>
    <link rel="shortcut icon" href="../../img/logo.svg">
    <!-- link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <link rel="stylesheet" type="text/css" href="../../css/estudiante/estilosEstu.css">
    <script src="../../js/controlGeneral.js"></script>
</head>

<body>
    <!-- Barra de navegación principal (horizontal) -->
    <?php
        include("menu-include.php");
    ?>


        

        <!-- breadcrumb -->
        <nav class="nav-main">
            <?php navAsignatura(); ?>
        </nav>


        <section>

            <div class="container-fluid">
                <!-- <h2>Español</h2>
                <p class="fila">Docente Prueba - Aula</p> -->
                <?php mostrarClaseEstudiante(); ?>
                <div class="row">
                    <div class="table-responsive col-md-12 tablas">
                        <table class="table table-borderless table-hover ">
                        <thead>
                            <tr>
                            <th scope="col">Titulo</th>
                            <th scope="col">Fecha de Entrega</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Nota</th>
                            <th scope="col" class="ultimo">Detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- cambiar -->
                            <?php mostrarTareasAsignatura(); ?>
                        </tbody>
                        </table>
                    </div>
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
    
    <!-- link bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>