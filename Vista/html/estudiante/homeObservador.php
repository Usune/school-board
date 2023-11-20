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
  <link rel="stylesheet" href="../../css/hola.css">
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
      <a href="homeObservador.php"> / Observador</a>
    </nav>

    <section >
      <div class="container-fluid" >
        <h2>Observador</h2>
        <div class="row" id="observador">
          <!-- columna -card -->
          <div class="col-md-12 col-xl-6">

            <div class="card mb-3 card-usu">

              <div class="row g-0 ">

                <div class="col-md-12 ">
                  <div class="card-body">
                    <h5 class="card-title">
                      Septiembre 7, 2023
                    </h5>
                    <p class="card-text">
                      This is a wider card with supporting text below as a natural lead-in to
                      additional content. This content is a little bit longer.
                    </p>
                    <hr>
                    <div class="usuario">
                      <img src="../../Uploads/Usuario/fotoUsuario.jpg" alt="">
                      <p class="card-text">
                        <small class="text-body-secondary">
                          Docente Prueba
                        </small>
                      </p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>

          <!-- columna -card -->
          <div class="col-md-12 col-xl-6">

            <div class="card mb-3 card-usu">

              <div class="row g-0 ">

                <div class="col-md-12 ">
                  <div class="card-body">
                    <h5 class="card-title">
                      Septiembre 7, 2023
                    </h5>
                    <p class="card-text">
                      This is a wider card with supporting text below as a natural lead-in to
                      additional content. This content is a little bit longer.
                    </p>
                    <hr>
                    <div class="usuario">
                      <img src="../../Uploads/Usuario/fotoUsuario.jpg" alt="">
                      <p class="card-text">
                        <small class="text-body-secondary">
                          Docente Prueba
                        </small>
                      </p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
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