<?php
    require_once("../../../Modelo/conexion.php");
    require_once("../../../Modelo/consultas.php");
    require_once("../../../Controlador/mostrarInfoEstudiante.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Asignatura</title>
    <link rel="shortcut icon" href="../../img/logo.svg">
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
        <!-- <nav class="nav-main">
            <a href="homeEstu.php">Home</a>
            <a href="homeAsignatura.php"> / AsignaturaExample</a>
            <a href="tareaAsignatura.php"> / TareaExample</a>
        </nav> -->



        <!-- breadcrumb -->
        <nav class="nav-main">
            <?php navAsignatura() . navTarea(); ?>
        </nav>




        <section>
            <h2>Principal de EnviarTareaExample</h2>
            <?php habilitarEntregaTareas(); ?>

            <!-- <div class="card-formulario">
                <div class="formulario">
                    <form action="../../../Controlador/entregarTarea.php" method="post" enctype="multipart/form-data"
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
                        <form action="../../../Controlador/entregarTarea.php" method="post" enctype="multipart/form-data" id="formulario">
                            
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


    <hr>
    <footer>
        <div class="info-footer">
            <p>School Board</p>
            <p>Copyright © - 2023. Todos los Derechos Reservados</p>
            <p>Autor: Estefani Arenas, Erika Diaz, Nicole Benavides y Tatiana Arevalo.</p>
        </div>
    </footer>
</body>

</html>