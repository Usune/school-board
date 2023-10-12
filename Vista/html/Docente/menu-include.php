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
                perfilHome();  
            ?>

        </div>
    </nav>

    <div class="aside-main">

        <aside id="menu">
                <ul>
                    <li id="liRol">Docente</li>
                    <li><a href="docCurso.php"><img src="../../img/curso.svg" alt="logo">Cursos</a></li>
                    <li><a href="docTareaRegistro.php"><img src="../../img/tareas.svg" alt="logo">Tareas</a></li>
                    <li><a href="docCalif.php"><img src="../../img/calificaciones.svg" alt="logo">Calificaciones</a></li>
                    <li><a href="docObser.php"><img src="../../img/observador.svg" alt="logo">Observador</a></li>
                    <li><a href="docComun.php"><img src="../../img/comunicados.svg" alt="logo">Comunicados</a></li>
                </ul>
            </aside>