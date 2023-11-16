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
      <h2>Home</h2>
      <div class="container-fluid ">
        <!-- Filtro - Tarea o Entregas -->
        <div class="row filtro ">
          <div class="col-md-3">
            <p>Tarea</p>
          </div>
          <div class="col-md-3">
            <p>Entrega 1</p>
          </div>
          <div class="col-md-3">
            <p>Entrega 2</p>
          </div>
          <div class="col-md-3">
            <p>Entrega 3</p>
          </div>
        </div>

        <div class="centrado">
          <div class="card-tarea">
            <div class="card-header">
              <div class="info-user fila">
                <img src="../../Uploads/Usuario/fotoUsuario.jpg" alt="foto perfil Docente">
                <p>
                  Docente <br>
                  Prueba
                </p>
              </div>
              <div class="fecha">
                <p>
                  2023-11-15 19:25:12
                </p>
              </div>
            </div>
            <hr>
            <div class="card-header">
              <div class="card-info">
                <img src="../../img/tareas.svg" alt="">
                <div class="info">
                  <h3>Ensayo sobre Tecnologia1</h3>
                  <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus magnam enim natus explicabo amet
                    beatae saepe iste veniam sed quisquam.
                  </p>
                </div>
              </div>
              <div class="boton">
                <a href="docTareaModificar.php?idTarea=1&amp;idClase=1"><img src="../../img/edit.svg">Modificar</a>
              </div>
            </div>
          </div>
        </div>
      </div>






      <!-- Card- Tarea -->
      <div class="row centrado">
        <div class="card mb-3 card-tareas">
          <div class="card-body">
            <h5 class="card-title">
              Ensayo sobre Tecnologia1
            </h5>
            <div class="cont-fechas">
              <p>Docente Prueba</p>
            </div>

            <div class="cont-fechas">
              <p>Nov 15, 2023 - 06:48 PM</p>
              <p>-</p>
              <p>Nov 15, 2023 - 06:48 PM</p>
            </div>
            <p class="card-text">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio rerum odio harum ipsum voluptatum,
              voluptatem nisi ea quia placeat amet modi, nulla inventore laborum ratione. Harum consequuntur excepturi
              saepe, corrupti nulla repellat. Totam deleniti iure possimus suscipit illum inventore nemo?
            </p>
            <div class="row">
              <div class="col-md-4">
                <div class="cont-archivo">
                  <a href="#">Archivo</a>
                </div>
              </div>
              <div class="col-md-4">
                <div class="cont-archivo">
                  <a href="#">Archivo</a>
                </div>
              </div>
              <div class="col-md-4">
                <div class="cont-archivo">
                  <a href="#">Archivo</a>
                </div>
              </div>
            </div>
            <a href="#" class="btn btn-principal">Go somewhere</a>
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