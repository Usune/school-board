
    <div class="aside-main">

        <aside id="menu">
            <div>
                <div class="logo">
                    <a href="homeDoc.php"><img src="../../img/logo.svg" alt="logo">
                    <h1>School Board</h1></a>
                </div>
                <ul>
                    <?php
                        menuIncludeDoc();
                    ?>
                </ul>
            </div>
            <div>
                <div class="asideImgDoc">
                </div>
                <footer>
                    <div class="info-footer">
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
                    <h2 id="liRol">Docente</h2>
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