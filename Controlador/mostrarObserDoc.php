<?php

    // SE RECIBEN TODAS LAS CONSULTAS PARA MOSTRAR ASIGNATURAS

    // ESTA FUNCIÓN ES LA QUE SE LLAMA EN LA VISTA

    function mostrarObserForm() {
        
        echo '

        <div class="formulario">
            
            <h3>Observador</h3>

            <p class="recordatorio">Ingrese el documento del estudiante.</p>

            <form method="get" id="formulario">

                    <div class="fieldset">
                        <fieldset>
                            <legend id="doc">Documento</legend>
                        </fieldset>
                        <input type="number" placeholder="Documento" required legend="#doc" name="documento">
                        <input type="number" style="display:none" value="'.$_GET["idClase"].'" required name="idClase">
                    </div>

                    <p id="texto"></p>
                
                <button type="submit" class="enviar">Siguiente</button>
            </form>
        </div>
        
        ';

    }

    function cargarNombre() {
        $documento = $_GET['documento'];        

        $objConsultas = new Consultas();
        $consultas = $objConsultas->mostrarUsuarioAdmin($documento);

        foreach($consultas as $f) {
            $nombres = $f['nombres'];
            $apellidos = $f['apellidos'];
        }
        
        echo $nombres . ' ' . $apellidos;
    }

    function cargarObservador() {

        $documento = $_GET['documento'];
        
        $objConsultas = new Consultas();
        $consultas = $objConsultas->mostrarUsuarioAdmin($documento);

        if(!isset($consultas)){
            echo '<script>alert("No existe un estudiante con el documento ingresado")</script>';
            echo "<script>location.href='adminObser.php'</script>";
        }else {
            foreach($consultas as $f) {
    
                echo '
                <div class="cabecera">
                    <button type="button" class="desplegarModal btn-cabecera" modal="#obser">
                        <img src="../../img/agregar.svg" alt="Agregar" modal="#obser"> Nueva observación
                    </button>
                    <h2>'.$f['nombres'].' '.$f['apellidos'].'</h2>
                    <h2>'.$f['tipoDoc'].' - '.$f['documento'].'</h2>
                </div>
                <div class="modal" id="obser">

                    <div class="modal_container">
                        <button type="button" class="desplegarModal btn-cerrar" modal="#obser"><img src="../../img/x.svg" alt="Salir" modal="#obser"></button>
                    
                        <div class="formulario">
                            
                            <h3>Crear Observación</h3>

                            <p class="recordatorio">Antes de subir la observación, asegurese de que todos los campos son correctos.</p>
                
                            <form action="../../../Controlador/registrarObserDoc.php?idClase='.$_GET['idClase'].'" method="post" id="formulario">

                                <div class="fieldset">
                                    <fieldset>
                                        <legend id="estu">Estudiante</legend>
                                    </fieldset>
                                    <input type="text" value="'.$f['nombres'].' '.$f['apellidos'].'" placeholder="Estudiante" required legend="#estu" name="estudiante" readonly>
                                </div>
                
                                <div class="textarea">
                                    <label for="obser">Observación</label>
                                    <textarea id="obser" cols="30" rows="10" name="observacion" placeholder="Ingrese la observación"></textarea>
                                </div>

                                <input type="text" value="'.$f['documento'].'" hidden name="id">
            
                                <p id="texto"></p>
                            
                                <button type="submit" class="enviar">Subir Observación</button>
                            </form>
                            
                        </div>

                    </div>
                    
                </div>
                ';

            }
              
            
            $consultas = $objConsultas->mostrarObservadorDoc($documento);
    
            if (!isset($consultas)) {
                echo '<h3>El estudiante no tiene observaciones</h3>';
            } else {
                $n = 0;
                foreach($consultas as $f) {
                    
                    echo '
                    <div class="card-tarea">
                        <div class="card-header">
                            <div class="info-user fila">
                                <img src="'.$f['fotoAutor'].'" alt="foto perfil Docente">
                                <p>
                                    '.$f['NombreAutor'].'
                                </p>
                            </div>
                            
                            <div class="fechas">
                                <p>
                                    '.$f['FechaObservacion'].'
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="card-header">
                            <div class="card-info">
                                <img src="../../img/observador.svg">
                                <div class="info">
                                    <p>
                                        '.$f['Observacion'].'
                                    </p>
                                </div>
                            </div>
                            <div class="boton">
                                <a href="adminObserModificar.php?id='.$f['idObservador'].'"><img src="../../img/edit.svg">Modificar</a>
                            </div>
                        </div>
                    </div>
                    ';
    
                }
    
            }    

        }

    }
?>