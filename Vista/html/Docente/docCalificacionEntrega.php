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
    <link rel="stylesheet" type="text/css" href="../../css/Docente/estilosDoc.css">
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <script src="../../js/controlGeneral.js"></script>
    <title>Calificación entregas</title>
</head> 
<body>    
    <?php
        include("menu-include.php");
    ?>           
        <!-- breadcrumb -->  
        <nav class="nav-main">
            <a href="homeDoc.php">Clases</a> 
            <?php
                traerCurso();
                echo'
                    <a href="tareasDoc.php?idClase='.$_GET['idClase'].'" id="actual" actual="#tareas"> / Tareas</a>
                ';
            ?>     
            <a href="" id="actual" actual="#tareas"> / Calificar</a>      
        </nav>

        <section>
            <div class="tabla">
                
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
            
             <!-- The Modal -->
             <div class="modal" id="modalEditarCalificacion">
                <div class="modal-dialog">
                    <div class="modal-content">     
                        <form action="../../../Controlador/actualizarNotaDoc.php" method="post" enctype="multipart/form-data" id="formulario">                           
                            <!-- Modal Header -->
                            <div class="modal-header">
                            <h4 class="modal-title">Editar de calificación</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>                    
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Observacion:</label>
                                    <textarea id="editarObservacion" name="editarObservacion" rows="4" cols="50" class="form-control" style="width: 100%;"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Calificación:</label>
                                    <input type="text" class="form-control" id="editarCalificacion" name="editarCalificacion">
                                </div>                              
                                <input type="text" style="display: none;" id="idCalificacionEditar" name="idCalificacionEditar">
                                <input type="text" style="display: none;" id="idTareaEditar" name="idTareaEditar">
                                <input type="text" style="display: none;" id="idClaseEditar" name="idClaseEditar">
                            </div>                    
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button  type="submit" class="btn btn-light">Editar calificación</button>
                                <button  type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
                            </div>   
                        </form>                 
                    </div>
                </div>
        </section>    
    </main>   
</div>
      
<script>
    function cargaDatosEntrega(fila){
        document.getElementById("idEntrega").value = fila.cells[1].innerText;
        document.getElementById("observacion").value = "";
        document.getElementById("calificacion").value = "";
        document.getElementById("idTareaG").value = document.getElementById("idTarea").value;
        document.getElementById("idClaseG").value = document.getElementById("idClase").value;
    }

    function cargaDatosCalificacion(fila, boton){
        document.getElementById("idCalificacionEditar").value = boton.parentElement.children[2].innerText;
        document.getElementById("editarObservacion").value = boton.parentElement.children[1].innerText;
        document.getElementById("editarCalificacion").value = boton.parentElement.children[0].innerText;
        document.getElementById("idTareaEditar").value = document.getElementById("idTarea").value;
        document.getElementById("idClaseEditar").value = document.getElementById("idClase").value;
    }
</script>
    
</body>
</html>