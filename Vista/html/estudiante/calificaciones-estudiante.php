<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calificaciones</title>
    <link rel="stylesheet" href="../../css/estudiante/estilos-calificaciones.css">
    <link rel="stylesheet" href="../../css/estilos-iframe.css">
</head>


<body>
    <nav>
        <a href="principal-estudiante.html">Principal > </a>
        <a href="calificaciones-estudiante.html">Calificaciones</a>
    </nav>
    <main>
        <div class="titulo">
            <h1>Calificaciones</h1>
        </div>
        <div class="desplegable">
            <div class="boton">
                <button class="boton" id="boton">Filtro<img src="../../img/filtro.svg" alt="filtro">
                </button>
            </div>
            <div class="listas" id="botonListas">
                <div class="asignaturas">
                    <section>
                        <p>Asignatura</p>
                    </section>
                    <div class="input">
                        <input id="ingles" type="radio" name="radio">
                        <div class="radio">
                            <label for="ingles">Ingles</label>
                        </div>
                    </div>
                    <div class="input">
                        <input id="español" type="radio" name="radio">
                        <div class="radio">
                            <label for="español">Español</label>
                        </div>
                    </div>
                    <div class="input">
                        <input id="ciencias" type="radio" name="radio">
                        <div class="radio">
                            <label for="ciencias">Ciencias</label>
                        </div>
                    </div>
                    <div class="input">
                        <input id="sociales" type="radio" name="radio">
                        <div class="radio">
                            <label for="sociales">Sociales</label>
                        </div>
                    </div>
                    <div class="input">
                        <input id="matematicas" type="radio" name="radio">
                        <div class="radio">
                            <label for="matematicas">Matemáticas</label>
                        </div>
                    </div>
                </div>
                <div class="estado">
                    <section>
                        <p>Estado</p>
                    </section>
                    <div class="input">
                        <input id="pro1" type="radio" name="radio">
                        <div class="radio">
                            <label for="pro1">Pendiente</label>
                        </div>
                    </div>
                    <div class="input">
                        <input id="pro1" type="radio" name="radio">
                        <div class="radio">
                            <label for="pro1">Entregado</label>
                        </div>
                    </div>
                    <div class="input">
                        <input id="matematicas" type="radio" name="radio">
                        <div class="radio">
                            <label for="matematicas">Con retraso</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="tabla">
            <table>
                <table border="1">
                    <thead>
                        <tr>
                            <th>Asignatura</th>
                            <th>Tipo</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Calificación</th>
                            <th>Ver</th>
                        </tr>
                    </thead>
                    <tr>
                        <td>Español</td>
                        <td>Evaluación</td>
                        <td>Evaluación Verbos</td>
                        <td>Entregado</td>
                        <td>
                            <div class="nota">
                                <div id="nota5" class="nota">
                                    <p>5.0</p>
                                </div>
                            </div>
                        </td>
                        <td><a href="tareas-estudiante.html"><img src="../../img/ojo.svg" alt="ojo"></td></a>
                    </tr>
                    <td>Ciencias</td>
                    <td>Tarea</td>
                    <td>Línea de tiempo: Química orgánica</td>
                    <td>Entregado</td>
                    <td>
                        <div class="nota">
                            <div id="nota3" class="nota">
                                <p>3.5</p>
                            </div>
                        </div>
                    </td>
                    <td><a href="tareas-estudiante.html"><img src="../../img/ojo.svg" alt="ojo"></td></a>
                    </tr>
                    </tr>
                    <td>Ciencias</td>
                    <td>Tarea</td>
                    <td>Informe Laboratorio</td>
                    <td>Pendiente</td>
                    <td>
                        <div class="nota">
                        </div>
                    </td>
                    <td><a href="tareas-estudiante.html"><img src="../../img/ojo.svg" alt="ojo"></td></a>
                    </tr>
                    <tr>
                        <td>Ingles</td>
                        <td>Actividad Clase</td>
                        <td>Models Verbs</td>
                        <td>Entregado</td>
                        <td>
                            <div class="nota">
                                <div id="nota1" class="nota">
                                    <p>1.0</p>
                                </div>
                            </div>
                        </td>
                        <td><a href="tareas-estudiante.html"><img src="../../img/ojo.svg" alt="ojo"></td></a>
                    </tr>
                    <tr>
                        <td>Matemáticas</td>
                        <td>Actividad Clase</td>
                        <td>Taller 1: Conjuntos</td>
                        <td>Con retraso</td>
                        <td>
                            <div class="nota">
                                <div id="nota1" class="nota">
                                    <p>1.0</p>
                                </div>
                            </div>
                        </td>
                        <td><a href="tareas-estudiante.html"><img src="../../img/ojo.svg" alt="ojo"></td></a>
                    </tr>


                </table>
            </table>
        </div>
        <script src="../../js/ocultar.js"></script>
    </main>
</body>


</html>