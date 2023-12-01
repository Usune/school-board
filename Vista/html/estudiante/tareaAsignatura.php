<?php
    require_once("../../../Modelo/conexion.php");
    require_once("../../../Modelo/consultas.php");
    require_once("../../../Controlador/mostrarInfoEstu.php");
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

    <link rel="stylesheet" type="text/css" href="../../css/estudiante/estilosEstu.css">
    <script src="../../js/controlGeneral.js"></script>


</head>

<body>
    <!-- Barra de navegación principal (horizontal) -->
    <?php
        include("menu-include.php");
    ?>


        <!-- breadcrumb -->
        <!-- <nav class="nav-main">
            <a href="homeEstu.php">Home</a>
            <a href="#" onclick="irAtras()"> / Tarea</a>
            <a href="#"onclick="irAtras()"> / TareaExample</a>
        </nav> -->



        <!-- breadcrumb -->
        <nav class="nav-main">
            <?php navTarea(); ?>
        </nav>




        <section class="tareaEntrega">
            <h2>Tarea</h2>

            <!-- Card- Tarea -->
            <?php mostrarTareaConEntrega(); ?>



            <!-- Modal -->
            <!-- <div class="modal fade" id="modalEntrega" tabindex="-1" aria-labelledby="modalEntrega" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalEntrega">Entrega</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="../../../Controlador/registrarEntrega.php" method="post" enctype="multipart/form-data">

                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="name">Descripción:</label>
                                        <textarea class="form-control" name="descripción" rows="10" required></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="fieldset">
                                            <fieldset>
                                                <legend id="fileLegen">Adjunta Archivos</legend>
                                            </fieldset>
                                            <input type="file" id="fileInput" class="fileInput"
                                                accept=".jpg, .jpeg, .png, .gif" name="archivos" onchange="checkFile()"
                                                legend="#fileLegen" multiple>
                                            <label for="fileInput" class="fileLabel">Adjunta Archivos</label>
                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div class="row modal-footer">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btnAtras" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <img src="../../img/volver.svg" alt="volver">
                                            Atrás
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btnPrincipal">Entregar</button>
                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div> -->

















            <!-- <div class="card-formulario">
                <div class="formulario">
                    <form action="../../../Controlador/registrarEntrega.php" method="post" enctype="multipart/form-data"
                    id="formulario">

                        <input type="number" placeholder="idEstudiante"  name="idEstudiante" value="1023163094" hidden >
                        <input type="number" placeholder="idTarea"   name="idTarea" value="4" hidden>

                        <div class="textarea">
                            <label for="descripcion">Descripción</label>
                            <textarea id="descripcion" cols="30" rows="10"
                                name="descripcion">Ingrese una descripción</textarea>
                        </div>

                        <div class="file">
                            <label for="archivo">Seleccione un archivo</label>
                            <input type="file" accept=".pdf" name="archivos[]" multiple>
                        </div>

                        <button type="submit" class="enviar">Entregar Tarea</button>
                    </form>
                </div>
            </div> -->



            <!-- <h2>extra</h2>
            <div class="card-tarea">
                <div class="card-header">
                    <div class="info-user fila">
                        <img src="../../Uploads/Usuario/fotoUsuario.jpg" alt="imagen" enlace="#op1">
                        <p>
                            Nicole <br>
                            Benavides
                        </p>
                    </div>
                </div>
                <hr>
                <div class="card-cont">
                    <div class="card-info">
                        <img src="../../img/descripcion.png" alt="">
                        <div class="info">
                            <h3>Ensayo sobre Tecnologia</h3>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus magnam enim natus
                                explicabo amet beatae saepe iste veniam sed quisquam.
                            </p>
                        </div>
                    </div>
                    <div class="card-info">
                        <img src="../../img/reloj.png" alt="">
                        <div class="fila">
                            <div class="fechas">
                                <p>
                                    03 / 09 / 2023
                                </p>
                            </div>
                            <hr id="fechas">
                            <div class="fechas" id="vencida">
                                <p>
                                    03 / 09 / 2023
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-info">
                        <img src="../../img/archivos.png" alt="">
                        <div class="card-archivos">
                            <div class="archivos"></div>
                            <div class="archivos"></div>
                            <div class="archivos"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-tarea">
                <div class="card-header">
                    <div class="info-user fila">
                        <img src="../../Uploads/Usuario/fotoUsuario.jpg" alt="imagen" enlace="#op1">
                        <p>
                            Nicole <br>
                            Benavides
                        </p>
                    </div>
                </div>
                <hr>
                <div class="card-formulario">
                    <div class="formulario">
                        <form action="../../../Controlador/registrarEntrega.php" method="post" enctype="multipart/form-data" id="formulario">
                            
                            <div class="textarea">
                                <label for="descripcion">Descripción</label>
                                <textarea id="descripcion" cols="30" rows="10" name="descripcion">Ingrese una descripción</textarea>
                            </div>

                            <div class="file">
                                <label for="archivos">Seleccione archivos (PDF):</label>
                                <input type="file" accept=".pdf" name="archivos[]" multiple>
                            </div>

                            <button type="submit" class="enviar">Entregar Tarea</button>
                        </form>
                    </div>
                </div>
            </div> -->

            <!-- Frontend para las tareas con entrega vencida -->
            <!-- <div class="card-tarea">
                <div class="card-header">
                    <div class="info-user fila">
                        <img src="../../Uploads/Usuario/fotoUsuario.jpg" alt="imagen" enlace="#op1">
                        <p>
                            Nicole <br>
                            Benavides
                        </p>
                    </div>
                </div>
                <hr>
                <div class="card-cont">
                    <div class="card-info">
                        <img src="../../img/candado.png" alt="">
                        <div class="info">
                            <h3>La fecha de entrega ya paso</h3>
                            <p>
                                Comuniquese con su docente para poder subir sus actividades.
                            </p>
                        </div>
                    </div>
                </div>
            </div> -->


        </section>

    </main>


    </div>


    <!-- link bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        function irAtras() {
            history.go(-1);
        }
    </script>
</body>

</html>