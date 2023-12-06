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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
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
                    <a href="tareasDoc.php?idClase='.$_GET['idClase'].'&tarea=" id="actual" actual="#tareas"> / Tareas</a>
                ';
            ?>     
            <a href="" id="actual" actual="#tareas"> / Calificar</a>      
        </nav>

        <section>
                
                
                        <?php 
                            mostrarEntregasCalificacion();
                        ?>

                    <?php
                        echo '<input id="idTarea" name="idTarea" style="display: none;" type="text" value="'.$_GET['idTarea'].'">';
                        echo '<input id="idClase" name="idClase" style="display: none;" type="text" value="'.$_GET['idClase'].'">';
                    ?>

             <!-- The Modal -->
            <div class="modal" id="modalCalificacion">
                <div class="modal_container">
                    <button type="button" class="desplegarModal btn-cerrar" modal="#modalCalificacion"><img src="../../img/x.svg" alt="Salir" modal="#modalCalificacion"></button>                                                
                        <div class="formulario">                    
                            <h3>Calificar entrega</h3>                
                            <form action="../../../Controlador/registrarNotaDoc.php" method="post" enctype="multipart/form-data" id="formulario">                    
                                <div class="textarea">
                                    <label for="observacion">Obervación</label>
                                    <textarea id="observacion" cols="30" rows="10" name="observacion" require placeholder="Ingrese una observación"></textarea>
                                </div> 
                                <div class="fieldset">
                                    <fieldset>
                                        <legend id="nota">Calificación de entrega</legend>
                                    </fieldset>
                                    <input id="calificacion" type="number" step="any" require placeholder="Ingrese la nota" required legend="#nota" name="calificacion">
                                </div>             
                                

                                <input type="text" style="display: none;" id="idTareaG" name="idTareaG">
                                <input type="text" style="display: none;" id="idClaseG" name="idClaseG">                  
                                <input hidden id="idEntrega" name="idEntrega" type="text">
                                <button type="submit" class="enviar">Guardar calificación</button>
                            </form>
                        </div>
                    </div>            
            </div> 
            
             <!-- The Modal -->
             <div class="modal" id="modalEditarCalificacion">                
                <div class="modal_container">    
                    <button type="button" class="desplegarModal btn-cerrar" modal="#modalEditarCalificacion"><img src="../../img/x.svg" alt="Salir" modal="#modalEditarCalificacion"></button>          
                    <div class="formulario">
                        <h3>Editar de calificación</h3>
                        <form action="../../../Controlador/actualizarNotaDoc.php" method="post" enctype="multipart/form-data" id="formulario">                                                  
                            <div class="textarea">
                                <label>Observacion:</label>
                                <textarea id="editarObservacion" name="editarObservacion" rows="4" cols="50" class="form-control" style="width: 100%;"></textarea>
                            </div>
                            <div class="fieldset">
                                <fieldset>
                                    <legend id="nota">Calificación de entrega</legend>
                                </fieldset>
                                <input type="text" class="form-control" id="editarCalificacion" name="editarCalificacion">
                            </div>   

                            <input type="text" style="display: none;" id="idCalificacionEditar" name="idCalificacionEditar">
                            <input type="text" style="display: none;" id="idTareaEditar" name="idTareaEditar">
                            <input type="text" style="display: none;" id="idClaseEditar" name="idClaseEditar">                                                            
                        
                            <button type="submit" class="enviar">Editar calificación</button>                        
                        </form>     
                    </div>                  
                </div>            
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