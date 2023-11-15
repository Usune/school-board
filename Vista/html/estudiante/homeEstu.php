<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiante</title>
    <link rel="shortcut icon" href="../../img/logo.svg">



    <!-- link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

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
        </nav>

        <section>
            <h2>Tareas</h2>

           
           
            <div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
        <a class="nav-link active" href="#">Active</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="homeEstu.php">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <h5 class="card-title">Special title treatment</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>




            <h3>No es esa</h3>
            <table>
                <thead>
                    <tr>
                        <th>Clase</th>
                        <th>Docente</th>
                        <th>Titulo</th>
                        <th>Fecha</th>
                        <th>Archivos</th>
                        <th>Estado</th>
                        <th>Ver más</th>
                    </tr>
                </thead>
                <tbody>
                    <td>Español</td>
                    <td>
                        <div class="tdDocente">
                            <img src="../../Uploads/Usuario/fotoUsuario.jpg" alt="">
                            <p>
                                Docente <br>
                                Prueba
                            </p>
                        </div>
                    </td>
                    <td>Ensayo sobre Tecnologia 1</td>
                    <td>
                        2023-09-13 <br>
                        13:11:05
                    </td>
                    <td>01</td>
                    <td>Pendiente</td>
                    <td><img src="../../img/flecha-arriba.svg" alt=""></td>
                </tbody>
            </table>
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