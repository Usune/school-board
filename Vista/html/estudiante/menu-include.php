<!-- Barra de navegación principal -->
<?php
    require_once("../../../Modelo/conexion.php");
    require_once("../../../Modelo/consultas.php");
    require_once("../../../Controlador/mostrarInfoEstudiante.php");
?>


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
        <form action="#">
            <input type="text" name="q" placeholder="Buscar...">
            <button type="button"><img src="../../img/lupa.svg" alt="buscar"></button>
        </form>
    </div>
    <div class="user">
        <button type="button" enlace="#op1" class="desplegar" id="butdesplegar">
            <h2 enlace="#op1" id="nombre">Nombre Usuario</h2>
            <img src="../../img/user.svg" alt="imagen" enlace="#op1">
        </button>
        <div id="op1">
            <ul>
                <li><a href="adminConfi.php">Configuración</a></li>
                <li><a href="../Extras/inicioSesion.html">Cerrar sesión</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="aside-main">

    <aside id="menu">
        <ul>
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
                    
                    <!-- <li><a href="homeEstu.html">Matemáticas</a></li>
                    <li><a href="homeEstu.html">Español</a></li>
                    <li><a href="homeEstu.html">Ciencias</a></li>
                    <li><a href="homeEstu.html">Sociales</a></li>
                    <li><a href="homeEstu.html">Física</a></li> -->
                </ul>
            </div>
            <li><a href="homeEstu.html"><img src="../../img/tareas.svg" alt="logo">Tareas</a></li>
            <li><a href="calificaciones-estudiante.html"><img src="../../img/calificaciones.svg"
                        alt="logo">Calificaciones</a></li>
            <li><a href="homeEstu.html"><img src="../../img/observador.svg" alt="logo">Observador</a></li>
            <li><a href="homeEstu.html"><img src="../../img/profesores.svg" alt="logo">Profesores</a></li>
        </ul>
    </aside>
