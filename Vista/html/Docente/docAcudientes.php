<?php
require_once ('../../../Modelo/conexion.php');
require_once ('../../../Modelo/consultas.php');
require_once('../../../Modelo/seguridadDoc.php');
require_once ('../../../Controlador/mostrarPerfil.php');
require_once ('../../../Controlador/mostrarCursosDoc.php');
require_once ('../../../Controlador/mostrarAcudientesDoc.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docente</title>
    <link rel="stylesheet" type="text/css" href="../../css/Docente/estilosDoc.css">
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <script src="../../js/controlGeneral.js"></script>
</head>
<body>
    <?php
        include('menu-include.php');
    ?>
        <!-- breadcrumb -->    
        <nav class="nav-main">
            <a href="homeDoc.php">Clases </a>
            
            <?php
                    traerCurso();
                    echo'
                        <a href="docAcuConsu.php?idClase='.$_GET['idClase'].'&tarea=" id="actual" actual="#Lista"> / Lista</a>
                    ';
                ?>
                     
            <a href="docAcudientes.php" id="actual" actual="#Acudiente"> / Acudiente </a>
        </nav>

        <section>   
        <div class="tablas">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Telefono</th>
                                    <th class="ultimo">Correo</th>                                  
                                </tr>
                            </thead>


                            <?php
        
                                      
        
        cargaAcudientes();
        
                                     
                                    ?>

                        </table>
                    </div>
        
        </section>
    </main>
</body>
</html>