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
                <li><a href="adminUsu.php"><img src="../../img/user.svg" alt="logo">Usuarios</a></li>
                <li><a href="adminCurso.php"><img src="../../img/curso.svg" alt="logo">Cursos</a></li>
                <li><a href="adminAsig.html"><img src="../../img/asignaturas.svg" alt="logo">Asignaturas</a></li>
                <li><a href="adminClase.html"><img src="../../img/asignaturas.svg" alt="logo">Clases</a></li>
                <li><a href="adminComun.php"><img src="../../img/comunicados.svg" alt="logo">Comunicados</a></li>
            </ul>
        </aside>