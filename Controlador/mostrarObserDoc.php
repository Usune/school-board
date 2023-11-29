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
                <h2>Observador del estudiante</h2>
                <div class="datosCabecera ">
                    <a  class="enviar boton" href="docObserRegistro.php?documento='.$f['documento'].'&idClase='.$_GET['idClase'].'"><img src="../../img/agregar.svg">Nueva observación</a>
                    <p>'.$f['nombres'].' '.$f['apellidos'].'</p>
                    <p>'.$f['tipoDoc'].' - '.$f['documento'].'</p>
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
                            </div>' . ($f['idAutor'] == $_SESSION['id'] ? 
                            '<div class="boton">
                                <a href="adminObserModificar.php?id='.$f['idObservador'].'"><img src="../../img/edit.svg">Modificar</a>
                            </div>' : '') . '
                        </div>
                    </div>';
    
                }
    
            }    

        }

    }
?>