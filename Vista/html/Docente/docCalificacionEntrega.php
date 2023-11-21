<?php
    require_once ('../../../Modelo/conexion.php');
    require_once ('../../../Modelo/consultas.php');
    require_once('../../../Modelo/seguridadDoc.php');
    require_once ('../../../Controlador/mostrarPerfil.php');
    require_once ('../../../Controlador/mostrarCursosDoc.php');
    require_once ('../../../Controlador/mostrarEntregasDoc.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/logo.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../css/Docente/estilosDoc.css">
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <script src="../../js/controlGeneral.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>Calificación entregas</title>
</head> 
<body>    
    <?php
        include("menu-include.php");
    ?>
    <main>            
            <!-- breadcrumb -->  
        <nav class="nav-main">
            <a href="homeDoc.php">Clases</a>                            
            <?php
                 echo '<a href="docComun.php?idClase='.$_GET['idClase'].'"> / Comunicados</a> ';
            ?>            
        </nav>         
        <section> 
            <h2>Calificar entregas</h2>
            <div class="tabla">
                <div class="opciones">
                    <div class="tablas">
                        <table>
                            <thead>
                                <tr>
                                    <th>Estudiante</th>
                                    <th style="display: none;">idEntrega</th>
                                    <th>Tarea</th>
                                    <th>Descripción Entrega</th>
                                    <th>Fecha de Entrega</th>
                                    <th>Fecha de Vencimiento</th>
                                    <th>Archivo</th>
                                    <th class="ultimo">Nota</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    mostrarEntregasCalificacion();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>   
            
            <?php
                echo '<input style="display: none;" id="idTarea" name="idTarea" type="text" value="'.$_GET['idTarea'].'">';
                echo '<input style="display: none;" id="idClase" name="idClase" type="text" value="'.$_GET['idClase'].'">';
            ?>    

             <!-- The Modal -->
            <div class="modal" id="modalCalificación">
                <div class="modal-dialog">
                    <div class="modal-content">     
                        <form action="../../../Controlador/registrarNotaDoc.php" method="post" enctype="multipart/form-data" id="formulario">                           
                            <!-- Modal Header -->
                            <div class="modal-header">
                            <h4 class="modal-title">Calificación de entrega</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>                    
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Observacion:</label>
                                    <textarea id="observacion" name="observacion" rows="4" cols="50" class="form-control" style="width: 100%;"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Calificación:</label>
                                    <input type="text" class="form-control" id="calificacion" name="calificacion">
                                </div>                              
                                <input type="text" style="display: none;" id="idEntrega" name="idEntrega">
                                <input type="text" style="display: none;" id="idTareaG" name="idTareaG">
                                <input type="text" style="display: none;" id="idClaseG" name="idClaseG">
                            </div>                    
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button  type="submit" class="btn btn-light">Guardar calificación</button>
                                <button  type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
                            </div>   
                        </form>                 
                    </div>
                </div>
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
    <script>
        function cargaDatosEntrega(fila){
            document.getElementById("idEntrega").value = fila.cells[1].innerText;
            document.getElementById("observacion").value = "";
            document.getElementById("calificacion").value = "";
            document.getElementById("idTareaG").value = document.getElementById("idTarea").value;
            document.getElementById("idClaseG").value = document.getElementById("idClase").value;
        }
    </script>
</body>
</html>