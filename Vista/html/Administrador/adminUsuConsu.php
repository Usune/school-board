<?php
    require_once ('../../../Modelo/conexion.php');
    require_once ('../../../Modelo/consultas.php');
    require_once ('../../../Controlador/mostrarUsuAdmin.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/logo.svg">
    <link rel="stylesheet" type="text/css" href="../../css/administrador/estilosAdmin.css">
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <script src="../../js/controlGeneral.js"></script>
    <title>Consultar usuario</title>
</head>
<body>

    <?php
        include('menu-include.php');
    ?>
        <main>
            
            <!-- breadcrumb -->  
            <nav class="nav-main">
                <a href="homeAdmin.php">Home</a>
                <a href="adminUsu.php"> / Usuarios</a>
                <a href="adminUsuConsu.html"> / Consultar</a>
            </nav>
        
            <section>
                <h2>Administración de usuarios</h2>

                <div class="formulario">

                    <h3>Consultar usuario</h3>

                    <p class="recordatorio">Seleccione el dato e ingrese la información del usuario que desea consultar</p>
            
                    <form action="administrador-usuario-consulta1.html" method="get">
            
                        <div class="fieldset_view">
                            <label for="rol">Dato</label>
                            <select class="veriSelect" required name="rol">
                                <option value="Seleccione" selected disabled>Seleccione una opción</option>
                                <option value="Administrador">Documento</option>
                                <option value="Profesor">Rol</option>
                                <option value="Estudiante">Estado</option>
                                <option value="Estudiante">Apellidos</option>
                                <option value="Estudiante">Nombres</option>
                            </select>
                        </div>
                        
                        <div class="fieldset"> 
                            <fieldset>
                                <legend id="usu">Documento</legend>
                            </fieldset>
                            <input type="number" placeholder="Documento" required legend="#usu" name="usuario">
                        </div>
                        <br>
                        <button type="submit" class="enviar">Buscar</button>
                    </form>
                </div>

                <h3>Lista de usuarios</h3>

                <div class="tabla">
                    <table>
                        <tr>
                            <th>Tipo Documento</th>
                            <th>Documento</th>
                            <th>Apellidos</th>
                            <th>Nombres</th>
                            <th>Estado</th>
                            <th>Rol</th>
                            <th colspan="2">Opciones</th>
                        </tr>
                        <tr>
                            <?php
                                cargarUsuarios();
                            ?>
                        </tr>
                    </table>
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