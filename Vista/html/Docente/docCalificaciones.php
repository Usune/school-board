<?php
require_once ('../../../Modelo/conexion.php');
require_once ('../../../Modelo/consultas.php');
require_once('../../../Modelo/seguridadDoc.php');
require_once ('../../../Controlador/mostrarPerfil.php');
require_once ('../../../Controlador/mostrarCursosDoc.php');
require_once ('../../../Controlador/mostrarAsisDoc.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesor</title>
    <link rel="stylesheet" type="text/css" href="../../css/Docente/estilosDoc.css">
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <script src="../../js/controlGeneral.js"></script>
</head>

<body>

    <?php
        include('menu-include.php');
    ?>


    <main>

        <!-- breadcrumb -->
        <nav class="nav-main">
            <a href="homeDoc.php">Clases</a>
            <a href="adminUsu.php"> / Única-PRIMERO</a>
            <a href="docCalificaciones.php"> / Calificaciones </a>
        </nav>

        <section>
            <h2>Calificaciones</h2>

            <div class="tabla">
                <div class="opciones">
                    <div class="tablas">
                        <table>
                            <thead>
                                <tr>
                                    <th>Estudiante</th>
                                    <th>Tarea</th>
                                    <th>Fecha de Entrega</th>
                                    <th>Fecha de Vencimiento</th>
                                    <th>Nota</th>
                                    <th class="ultimo">Archivo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Ejemplo de fila en la tabla -->
                                <tr>
                                    <td>Nombre del Estudiante</td>
                                    <td>Nombre de la Tarea</td>
                                    <td>01/01/2023</td>
                                    <td>05/01/2023</td>
                                    <td>4.5</td>
                                    <td class="ultimo"><a href="ruta_del_archivo" target="_blank">Ver Archivo</a></td>
                                </tr>
                                <!-- Puedes repetir esta estructura para cada tarea y estudiante -->
                            </tbody>
                        </table>
                    </div>
                    
        </section>



    </main>

    </div>
    </div>

</body>

</html>