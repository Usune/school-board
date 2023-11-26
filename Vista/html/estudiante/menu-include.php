<?php
    require_once ('../../../Modelo/conexion.php');
    require_once ('../../../Modelo/consultas.php');
    require_once ('../../../Modelo/seguridadEstu.php');
    require_once ('../../../Controlador/mostrarInfoEstu.php');
?>

<!-- Barra de navegación principal -->
    <nav class="nav-pri">
        <div class="fila">
            <div class="menu">
                <button type="button" class="desplegar" enlace="#menu">
                    <img src="../../img/menu.svg" alt="menu" enlace="#menu">
                </button>
            </div>
            <div class="logo">
                <img src="../../img/logo.svg" alt="logo">
                <h1>School Board</h1>
            </div>
        </div>
        <div class="buscar">
            <!-- <form action="#">
                <input type="text" name="q" placeholder="Buscar...">
                <button type="button"><img src="../../img/lupa.svg" alt="buscar"></button>
            </form> -->
        </div>
        <div class="user">
            
            <?php
                perfilEstu();
            ?>

        </div>
    </nav>


    <div class="aside-main">

    <aside id="menu">
        <ul>
            <!-- <li id="liRol">Estudiante</li> -->
            <li>
                <button type='button' id="buttonAsignaturas" enlace="#asignaturas" class="desplegar">
                    <img src="../../img/asignaturas.svg" alt="logo" enlace="#asignaturas">
                    Asignaturas
                    <img src="../../img/flecha-abajo.svg" enlace="#asignaturas">
                </button>
            </li>
            <div id="asignaturas" class="cont-desplegar">
                <ul>
                    <?php
                        mostrarAsignaturasEstudiante();
                    ?>
                </ul>
            </div>
            <li><a href="homeTareas.php"><img src="../../img/tareas.svg" alt="logo">Tareas</a></li>
            <li><a href="homeCalificaciones.php"><img src="../../img/calificaciones.svg"
                        alt="logo">Calificaciones</a></li>
            <!-- <li><a href="homeIntegrantes2.php"><img src="../../img/observador.svg" alt="logo">Observador</a></li> -->
            <li><a href="homeObservador.php"><img src="../../img/observador.svg" alt="logo">Observador</a></li>
            <li><a href="homeIntegrantes.php"><img src="../../img/profesores.svg" alt="logo">Integrantes</a></li>
        </ul>
    </aside>
