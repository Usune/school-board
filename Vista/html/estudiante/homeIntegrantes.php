<?php
    require_once ('../../../Modelo/conexion.php');
    require_once ('../../../Modelo/consultas.php');
    require_once ('../../../Controlador/mostrarPerfil.php');
    require_once ('../../../Controlador/mostrarUsuAdmin.php');
    require_once ('../../../Controlador/mostrarInfoEstudiante.php');
?>

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

        <!-- Filtro funcional -->
        <div class="row filtro">
          <div class="col-md-12">
            <form method="get">

              <div class="row ">

                <!-- select - rol -->
                <div class="col-lg-3 col-md-6 col-sm-12 filtro-inputs">
                  <div class="fieldset_view">
                    <label for="rol">Rol</label>
                    <select class="veriSelect" required="" name="rol">
                      <option value="nada" selected  checked>Seleccione ...</option>
                      <option value="administrador">Administrativo</option>
                      <option value="docente">Docente</option>
                      <option value="estudiante">Estudiante</option>
                    </select>
                  </div>
                </div>

                <!-- select - Estado -->
                <div class="col-lg-3 col-md-6 col-sm-12 filtro-inputs">
                  <div class="fieldset_view">
                    <label for="rol">Estado</label>
                    <select name="estado">
                      <option value="nada" checked>Seleccione ...</option>
                      <option value="activo" id="activo">Activo</option>
                      <option value="inactivo" id="inactivo">Inactivo</option>
                    </select>
                  </div>
                </div>

                <!-- input - nombres -->
                <div class="col-lg-3 col-md-6 col-sm-12 filtro-inputs">
                  <div class="fieldset_view">
                    <div class="fieldset">
                      <fieldset>
                        <legend id="nom">Nombre</legend>
                      </fieldset>
                      <input type="text" placeholder="Nombre" legend="#nom" name="nombres">
                    </div>
                  </div>

                </div>

                <!-- botones -->
                <div class="col-lg-3 col-md-6 col-sm-12 filtro-inputs">

                  <div class="buscador col-6">
                    <div class="col-6">
                      <button type="submit" class="filtrar">Filtrar</button>
                    </div>

                    <div class="col-6">
                      <a href="homeProfesores.php" class="filtrar">Limpiar</a>
                    </div>
                  </div>

                </div>

                <!-- <div class="col-lg-3 col-md-6 col-sm-12 filtro-inputs">
                  <div class="buscador">
                    <input type="text" placeholder="Buscar por nombre" name="nombres">
                    <a href="">
                      <img src="../../img/lupa.svg" alt="">
                    </a>
                  </div>
                </div> -->


              </div>
            </form>


          </div>
        </div>

        <!-- Contenedor de Error  -->
        
        
        <!-- Listado - Cards -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 g-4">

          <?php

              if(isset($_GET['rol']) || isset($_GET['estado']) || isset($_GET['nombres'])){

                if($_GET['rol'] === 'administrador'){
                  echo '<h3 class="texto">'.'Administradores'.'</h3>';
                }elseif ($_GET['rol'] === 'docente') {
                  echo '<h3 class="texto">'.'Docentes'.'</h3>';
                }elseif ($_GET['rol'] === 'estudiante') {
                  echo '<h3 class="texto">'.'Estudiantes'.'</h3>';
                }else{
                  echo '<h3 class="texto">'.'Todos'.'</h3>';
                }

                mostrarUsuariosFiltrados($_GET['rol'], $_GET['estado'], $_GET['nombres']);
                        
              }else {

                echo '<h3  class="texto">'.'Todos'.'</h3>';

                mostrarTodosUsuarios();

              }
            ?>
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