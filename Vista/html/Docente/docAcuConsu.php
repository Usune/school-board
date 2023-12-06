<?php
   require_once ('../../../Modelo/conexion.php');
   require_once ('../../../Modelo/consultas.php');
   require_once('../../../Modelo/seguridadDoc.php');
   require_once ('../../../Controlador/mostrarPerfil.php');
   require_once ('../../../Controlador/mostrarCursosDoc.php');
   require_once ('../../../Controlador/mostrarAsisDoc.php');
   require_once ('../../../Controlador/mostrarEstudiantesDoc.php');
//    require_once ('../../../Controlador/mostrarAsisDoc.php');
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/logo.svg">
    <link rel="stylesheet" type="text/css" href="../../css/Docente/estilosAdmin.css">
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <script src="../../js/controlGeneral.js"></script>
    <title>Consultar Estudiantes</title>
</head>

<body>
    
    <?php
        include('menu-include.php');
    ?>

            <!-- breadcrumb -->
            <nav class="nav-main">
                <a href="homeDoc.php">Home</a> 
                <?php
                    traerCurso();
                ?>
                <a href="" id="actual" actual="#usuarios"> / Lista</a>
            </nav>

            <section>
                
                    <div class="tablas">
                        <table>
                            <thead>
                                <tr>
                                    <th>Tipo Documento</th>
                                    <th>Documento</th>
                                    <th>Apellidos</th>
                                    <th>Nombres</th>
                                    <th>Estado</th>
                                    <th>Rol</th>
                                    <th class="ultimo">Opciones</th>
                                    <!-- <th colspan="2">Opciones</th> -->
                                </tr>
                            </thead>


                            <?php
        
                                        if(isset($_GET['rol']) || isset($_GET['estado']) || isset($_GET['nombres']) || isset($_GET['apellidos']) || isset($_GET['documento'])){
                                                
                                            filtrarUsuarios($_GET['rol'], $_GET['estado'], $_GET['nombres'], $_GET['apellidos'], $_GET['documento']);
                                        
                                        }else {
        
                                            cargarUsuariosDoc($_GET['idClase']);
        
                                        }
                                    ?>

                        </table>
                    </div>
                    
            </section>

        </main>

    </div>

</body>

</html>