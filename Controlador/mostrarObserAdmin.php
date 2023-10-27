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
                        <input type="number" placeholder="Documento" required legend="#doc" name="id">
                    </div>

                    <p id="texto"></p>
                
                <button type="submit" class="enviar">Siguiente</button>
            </form>
        </div>
        
        ';

    }
    
    function cargarObservador() {

        $documento = $_GET['id'];
        
        $objConsultas = new Consultas();
        $consultas = $objConsultas->mostrarUsuarioAdmin($documento);

        if(!isset($consultas)){
            echo '<script>alert("No existe un estudiante con el documento ingresado")</script>';
            echo "<script>location.href='adminObser.php'</script>";
        }else {
            foreach($consultas as $f) {
    
                echo '
                <h2>Observador del estudiante</h2>
                <div class="cabecera">
                    <button type="button" class="desplegarModal btn-cabecera" modal="#obser">
                        <img src="../../img/agregar.svg" alt="Agregar" modal="#obser">Nueva
                    </button>
                    <p>'.$f['nombres'].' '.$f['apellidos'].'</p>
                    <p>'.$f['tipoDoc'].' - '.$f['documento'].'</p>
                </div>

                <div class="modal" id="obser">

                    <div class="modal_container">
                        <button type="button" class="desplegarModal btn-cerrar" modal="#obser"><img src="../../img/x.svg" alt="Salir" modal="#obser"></button>
                    
                        <div class="formulario">
                            
                            <h3>Crear Observación</h3>

                            <p class="recordatorio">Antes de subir la observación, asegurese de que todos los campos son correctos.</p>
                
                            <form action="../../../Controlador/registrarComunAdmin.php" method="post" enctype="multipart/form-data" id="formulario">

                                <div class="fieldset">
                                    <fieldset>
                                        <legend id="tit">Título</legend>
                                    </fieldset>
                                    <input type="text" placeholder="Título" required legend="#tit" name="titulo">
                                </div>
                
                                <div class="textarea">
                                    <label for="descripcion">Descripción</label>
                                    <textarea id="descripcion" cols="30" rows="10" name="descripcion">Ingrese una descripción</textarea>
                                </div>

                                <div class="file">
                                    <label for="archivo">Seleccione un archivo</label>
                                    <input type="file" accept=".pdf" name="archivo">
                                </div>
            
                                <p id="texto"></p>
                            
                                <button type="submit" class="enviar">Subir Observación</button>
                            </form>
                            
                        </div>

                    </div>
                    
                </div>
                ';

            }

        
            $consultas = $objConsultas->mostrarObservadorAdmin($documento);
    
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
    
    function cargarInfoRegistroObser() {

        $documento = $_GET['documento'];
        
        $objConsultas = new Consultas();
        $consultas = $objConsultas->mostrarUsuarioAdmin($documento);

        if(!isset($consultas)){
            echo '<script>alert("No existe un estudiante con el documento ingresado")</script>';
            echo "<script>location.href='adminObser.php'</script>";
        }else {
            foreach($consultas as $f) {
    
                echo '
                <h2>Observador del estudiante</h2>
                <div class="cabecera">
                    <a href="adminObserRegistro.php" class="btn-cabecera"><img src="../../img/agregar.svg">Nueva</a>
                    <p>'.$f['nombres'].' '.$f['apellidos'].'</p>
                    <p>'.$f['tipoDoc'].' - '.$f['documento'].'</p>
                </div>
                ';

            }

        
            $consultas = $objConsultas->mostrarObservadorAdmin($documento);
    
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