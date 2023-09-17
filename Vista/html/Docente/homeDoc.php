<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesor</title>
    <link rel="shortcut icon" href="../../img/logo.png">
    <link rel="stylesheet" type="text/css" href="../../css/Docente/estilosDoc.css">
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <script src="../../js/controlGeneral.js"></script>
</head>

<body>

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
                    <li><a href="docConfi.html">Configuración</a></li>
                    <li><a href="../Extras/inicioSesion.html">Cerrar sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="aside-main">

        <aside id="menu">

        </aside>

        <main>

            <!-- breadcrumb -->
            <nav class="nav-main">
                <a href="homeDoc.html">Cursos </a>
            </nav>

            <section>
                <h2>Cursos</h2>

                <div class="contenedor">
                    <div class="fila-cont">
                        <a href="docCurso.html">
                            <img src="../../img/curso.svg" alt="logo">
                            <p>Curso: 601</p>
                            <p>Asignarura: Español</p>
                        </a>
                        <a href="docCurso.html">
                            <img src="../../img/curso.svg" alt="logo">
                            <p>Curso: 601</p>
                            <p>Asignarura: Ciencias</p>
                        </a>
                    </div>
                </div>
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