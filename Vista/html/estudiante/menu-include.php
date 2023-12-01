<?php
    require_once ('../../../Modelo/conexion.php');
    require_once ('../../../Modelo/consultas.php');
    require_once ('../../../Modelo/seguridadEstu.php');
    require_once ('../../../Controlador/mostrarPerfil.php');
    require_once ('../../../Controlador/mostrarInfoEstu.php');
    require_once ('../../../Controlador/actualizarInfoEstu.php');
?>

    <div class="aside-main">

        <aside id="menu">
            <div>
                <div class="logo">
                    <a href="homeAdmin.php"><img src="../../img/logo.svg" alt="logo">
                    <h1>School Board</h1></a>
                </div>
                <ul>
                    <li><a href="homeClases.php" id="liClases"><img src="../../img/clases.svg" alt="logo">Clases</a></li>
                    <li><a href="homeTareas.php" id="liTareas"><img src="../../img/tareas.svg" alt="logo">Tareas</a></li>
                    <li><a href="homeObservador.php" id="liObservador"><img src="../../img/observador.svg" alt="logo">Observador</a></li>
                    <li><a href="homeIntegrantes.php" id="liIntegrantes"><img src="../../img/profesores.svg" alt="logo">Integrantes</a></li>
                    <li><a href="homeComunicados.php" id="liComunicados"><img src="../../img/comunicados.svg" alt="logo">Comunicados</a></li>
                    <li><a href="homeAsistencia.php" id="liAsistencia"><img src="../../img/asistencia.svg" alt="logo">Asistencia</a></li>
                    <!-- <li><a href="homeAcudiente.php"><img src="../../img/user.svg" alt="logo">Acudiente</a></li> -->
                </ul>
            </div>
            <div>
                <div class="asideImgEstu">
                </div>
                <footer>
                    <div class="info-footer">
                        <p>School Board</p>
                        <p>Copyright © - 2023. Todos los Derechos Reservados</p>
                        <p>Autor: Estefani Arenas, Erika Diaz, Nicole Benavides y Tatiana Arevalo.</p>
                    </div>
                </footer>
            </div>
        </aside>

        <main>
            <!-- Barra de navegación principal -->
            <nav class="nav-pri">
                <div class="fila">
                    <div class="menu">
                        <button type="button" class="desplegar" enlace="#menu">
                            <img src="../../img/menu.svg" alt="menu" enlace="#menu">
                        </button>
                    </div>
                    <h2 id="liRol">Estudiante</h2>
                </div>

                <div class="user">
                    <?php
                        perfilHome();
                    ?>
                </div>
            </nav>
