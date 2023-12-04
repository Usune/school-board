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

  <?php
        include("menu-include.php");
    ?>
  <!-- breadcrumb -->
  <nav class="nav-main">
    <a href="homeEstu.php">Home</a>
  </nav>

  <section id="home">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4 fotoPrincipal d-none d-md-block">
          <img src="../../img/imgHomeEstu.svg" alt="">
        </div>
        <div class="col-md-8 cont-card">
          <div class="row">
            <!-- nombres -->
            <div class="col-md-12 card-usu ">
              <div class="row ">
                <div class="col-md-4">
                  <img src="../../Uploads/Usuario/userNicole.jpg" alt="">
                </div>
                <div class="col-md-8">
                  <p>
                    Nicole Dayana <br>
                    Benavides Alfonso
                  </p>
                </div>
              </div>
            </div>
            <!-- curso , joranada -->
            <div class="col-md-12 ">
              <div class="row">
                <div class="col-md-6 card-usu card-espacio ">
                  <p>Curso Sexto</p>
                  <img src="../../img/librosHome.svg" alt="">
                </div>
                <div class="col-md-6 card-usu">
                  <p>Jornada Única</p>
                  <img src="../../img/diaHome.svg" alt="">
                </div>
              </div>
            </div>

            <!-- tareas -->
            <div class="col-md-12 card-usu ">
              <div class="row ">
                <div class="col-md-6">
                  <p>
                    Tareas Pendientes <br>
                  </p>
                  <p class="normal">
                    A continuación, te presentamos un porcentaje que refleja la cantidad de tareas pendientes que aún tienes por completar. Para obtener información detallada sobre las tareas pendientes y otros detalles relevantes, te invitamos a hacer clic en el botón correspondiente. 
                  </p>
                  <button class="btnPrincipal" >
                    <a href="../estudiante/homeTareas.php" >Ver Tareas</a>
                  </button>
                </div>
                <div class="col-md-6 grafica">
                  <p>10</p>
                  <p>/</p>
                  <p>20</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


  </section>
  </main>

  <!-- link bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>