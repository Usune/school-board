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


    <!-- breadcrumb -->
    <nav class="nav-main">
      <a href="homeEstu.php">Home</a>
      <a href="homeAsistencia.php" id="actual" actual="#liAsistencia"> / Asistencia</a>
    </nav>

    <section>
      <div class="container-fluid">
      <h2>Asistencia</h2>

        <div class="container">
          <div class="tablas">
            <table>
              <thead>
                <tr>
                  <th>Dia</th>
                  <th>Asistio</th>
                  <th>Falta</th>
                  <th>Falta Justificada</th>
                  <th class="ultimo">Retardo</th>
                </tr>
              </thead>
              <tbody>
                <?php mostrarAsistencia(); ?>
                <!-- <tr>
                  <td>Dia</td>
                  <td>Asistio</td>
                  <td>Falta</td>
                  <td>Falta Justificada</td>
                  <td>Retarda</td>
                </tr> -->
              </tbody>
            </table>
          </div>
        </div>
      </div>






    </section>




  </main>


  </div>



  <!-- link bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>