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


      <!-- Card- Tarea -->
      <div class="row centrado">
        <div class="card mb-3 card-tareas">
          <div class="card-body">
            <div class="row contEtiquetas">

              <div class="col-md-6">
                <div class="row infoDoc">
                  <div class="col-md-2">
                    <img src="../../Uploads/Usuario/userAngelica.jpg" alt="">
                  </div>
                  <div class="col-md-10">
                    <p>Docente Angelica Maria</p>
                  </div>
                </div>
              </div>

              <div class="col-md-6 fechasCont">
                <p>15/01/2023</p>
              </div>

            </div>

            <h5 class="card-title card-titulo">
              Ensayo sobre Tecnologia1
            </h5>


            <p class="card-text card-texto">
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

            <div class="row">
              <div class="col-md-12">
                <button type="button" class="btn btnPrincipal" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <a href="#id">Entregar</a>
                </button>
              </div>
            </div>

          </div>
        </div>


      </div>




      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Entrega</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="">

              <div class="modal-body">


                <div class="row contEtiquetas">

                  <div class="col-md-12">
                    <div class="row infoDoc">
                      <div class="col-md-2">
                        <img src="../../Uploads/Usuario/fotoPrueba.jpg" alt="fotoEstudiante">
                      </div>

                      <div class="col-md-10">
                        <p>Nicole Dayana Benavides Alfonso</p>
                      </div>
                    </div>
                  </div>


                </div>

                <div class="row">
                  <div class="col-md-12">
                    <label for="name">Mensaje:</label>
                    <textarea class="form-control" name="message" rows="10" required></textarea>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="fieldset">
                      <fieldset>
                        <legend id="fileLegen">Adjunta Archivos</legend>
                      </fieldset>
                      <input type="file" id="fileInput" class="fileInput" accept=".jpg, .jpeg, .png, .gif" name="foto"
                        onchange="checkFile()" legend="#fileLegen" placeholder="hola">
                      <label for="fileInput" class="fileLabel">Adjunta Archivos</label>
                    </div>
                  </div>
                </div>



              </div>
              <div class="row modal-footer">
                <div class="row">
                  <div class="col-md-6">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                  <div class="col-md-6">
                    <button type="button" class="btn btnPrincipal">Save changes</button>
                  </div>
                </div>

              </div>
            </form>

          </div>
        </div>
      </div>

          <!-- Card- Tarea -->
          <div class="row centrado">
                <div class="card mb-3 card-tareas">
                    <div class="card-body">
                        <div class="row contEtiquetas">

                            <div class="col-md-6">
                                <div class="row infoDoc">
                                    <div class="col-md-2">
                                        <img src="'.$f['foto'].'" alt="">
                                    </div>
                                    <div class="col-md-10">
                                        <p>Docente '.$f['nombres'].' '.$f['apellidos'].'</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 fechasCont">
                                <p class="'.$fechaEstado.'">'.$fechaFormateada.'</p>
                            </div>

                        </div>

                        <h5 class="card-title card-titulo">
                            '.$f['titulo'].'
                        </h5>


                        <p class="card-text card-texto">
                            '.$f['descripcion'].'
                        </p>

                        <div class="row">';

                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" class="btn btnPrincipal" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        <a href="?id">Entregar</a>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>






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




      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Entrega</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

              <div class="row contEtiquetas">

                <div class="col-md-12">
                  <div class="row infoDoc">
                    <div class="col-md-2">
                      <img src="../../Uploads/Usuario/fotoPrueba.jpg" alt="fotoEstudiante">
                    </div>
                    <div class="col-md-10">
                      <p>Nicole Dayana Benavides Alfonso</p>
                    </div>
                  </div>
                </div>

              </div>

              <div class="textarea">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" cols="30" rows="10" name="descripcion">Ingrese una descripción</textarea>
              </div>

              <div class="col-md-6">
                <div class="fieldset">
                  <fieldset>
                    <legend id="fileLegen">Foto de perfil</legend>
                  </fieldset>
                  <input type="file" id="fileInput" class="fileInput" accept=".jpg, .jpeg, .png, .gif" name="foto"
                    onchange="checkFile()" legend="#fileLegen" placeholder="hola">
                  <label for="fileInput" class="fileLabel">Foto de perfil</label>
                </div>
              </div>




              <div class="row">';

                <div class="row">
                  <div class="col-md-12">
                    <button type="button" class="btn btnPrincipal">
                      <a href="?id">Entregar</a>
                    </button>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
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