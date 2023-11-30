    
    <div class="aside-main">

        <aside id="menu">
            <div>
                <div class="logo">
                    <a href="homeAdmin.php"><img src="../../img/logo.svg" alt="logo">
                    <h1>School Board</h1></a>
                </div>
                <ul>
                    <li><a href="adminUsu.php" id="usuarios"><img src="../../img/user.svg" alt="logo">Usuarios</a></li>
                    <li><a href="adminCurso.php" id="cursos"><img src="../../img/curso.svg" alt="logo">Cursos</a></li>
                    <li><a href="adminAsig.php" id="asignaturas"><img src="../../img/asignaturas.svg" alt="logo">Asignaturas</a></li>
                    <li><a href="adminAula.php" id="aulas"><img src="../../img/aulas.svg" alt="logo">Aulas</a></li>
                    <li><a href="adminClase.php" id="clases"><img src="../../img/clases.svg" alt="logo">Clases</a></li>
                    <li><a href="adminComun.php" id="comunicados"><img src="../../img/comunicados.svg" alt="logo">Comunicados</a></li>
                    <li><a href="adminObser.php" id="observador"><img src="../../img/observador.svg" alt="logo">Observador</a></li>
                </ul>
            </div>
            <div>
                <div class="asideImgAdmin">
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
                    <h2 id="liRol">Administrador</h2>
                </div>
                <div class="buscar">
                    <!-- <form action="#">
                        <input type="text" name="q" placeholder="Buscar...">
                        <button type="button"><img src="../../img/lupa.svg" alt="buscar"></button>
                    </form> -->
                </div>
                <div class="user">
                    
                    <?php
                        perfilHome();
                    ?>

                </div>
            </nav>
