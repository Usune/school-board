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
  <link rel="stylesheet" href="../../css/estudiante/estilosEstu.css">
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
      <a href="homeAdmin.html">Home</a>
    </nav>

    <section>
      <div class="container-fluid" id="integrantes">
        <h2>Integrantes</h2>
        <div class="row filtros">
          <div class="col-md-6 col-sm-12">
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <select>
                  <option value="">Rol</option>
                  <option value="">Administrativo</option>
                  <option value="">Docente</option>
                  <option value="">Estudiante</option>
                </select>
              </div>
              <div class="col-md-6 col-sm-12">
                <select>
                  <option value="">Asignatura</option>
                  <option value="">Matematicas</option>
                  <option value="">Español</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-12">
            <div class="buscador">
              <input type="text" placeholder="Buscar por nombre">
              <a href="">
                <img src="../../img/lupa.svg" alt="">
              </a>
            </div>
          </div>
        </div>

        <h3>Todos</h3>


        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
          <?php mostrarTodosUsuarios(); ?>
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