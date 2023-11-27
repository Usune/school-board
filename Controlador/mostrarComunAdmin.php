<?php

    // SE RECIBEN TODAS LAS CONSULTAS PARA MOSTRAR AULAS

    // ESTA FUNCIÓN ES LA QUE SE LLAMA EN LA VISTA
    function cargarComunicados() {
        
        $objConsultas = new Consultas();
        $consultas = $objConsultas->mostrarComunicadosAdmin();

        if (!isset($consultas)) {
            echo '<h2> No hay comunucados registrados con el nombre ingresado</h2>';
        } else {

            foreach($consultas as $f) {

                echo '

                <div class="card-tarea">
                    <div class="card-header">
                        <div class="info-user fila">
                            <img src="'.$f['foto'].'" alt="foto perfil Docente">
                            <p>
                                '.$f['nombre'].' <br>
                                '.$f['apellido'].'
                            </p>
                        </div>
                        <div class="para">
                            <p>
                                Destinatario: '.$f['curso'].'-'.$f['jornada'].'
                            </p>
                        </div>
                        <div class="fechas">
                            <p>
                                '.$f['fecha'].'
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="card-header">
                        <div class="card-info">
                            <img src="../../img/comunicados.svg" alt="">
                            <div class="info">
                                <h3>'.$f['titulo'].'</h3>
                                <p>
                                    '.$f['descripcion'].'
                                </p>
                            </div>
                        </div>
                        <div class="boton">
                            <a href="'.$f['archivo'].'" download="comunicado"><img src="../../img/descargar.svg">Descargar</a>
                        </div>
                        <div class="boton">
                            <a href="adminComunModificar.php?id='.$f['idComunicado'].'"><img src="../../img/edit.svg">Modificar</a>
                        </div>
                    </div>
                </div>
                ';

            }

        }

    }

    function cargarComunEditar(){

        // Aterrizamos la PK enviada desde la tabla
        $id = $_GET['id']; 

        // Eviamos la PK a una función de la clase consultas
        $objConsultas = new Consultas();
        $consulta = $objConsultas->mostrarComunicadoAdmin($id);

        // Pintamos la información consultada en el artefacto (formulario)
        foreach ($consulta as $f) {

            echo '
                    
                <form action="../../../Controlador/actualizarComunAdmin.php" method="post" enctype="multipart/form-data" id="formulario">

                        <div class="fieldset">
                            <fieldset>
                                <legend id="tit">Título</legend>
                            </fieldset>
                            <input type="text" value="'.$f['titulo'].'" placeholder="Título" required legend="#tit" name="titulo">
                        </div>
        
                        <div class="textarea">
                            <label for="descripcion">Descripción</label>
                            <textarea id="descripcion" cols="30" rows="10" name="descripcion"> '.$f['descripcion'].' </textarea>
                        </div> 

                        <div class="fieldset_view">
                            <label for="rol">Curso</label>
                            <select class="veriSelect" required name="curso">
            ';

            if($f['curso'] == 'Todos'){

                echo '
                            <option value="'.$f['idCurso'].'" selected>'.$f['curso'].'</option>
                            <option value="1">Todos</option> 
                ';

            }else {

                echo '
                            <option value="'.$f['idCurso'].'" selected>'.$f['curso'].' - Jornada: '.$f['jornada'].'</option>
                            <option value="1">Todos</option> 
                ';

            }
                cargarCursosRegistro();

            echo '            
                            </select>
                        </div>

                        <div class="file">
                            <label for="archivo">Seleccione un archivo</label>
                            <input type="file" accept=".pdf" name="archivo">
                        </div>

                        <input type="text" value="'.$f['idComunicado'].'" required hidden name="idComunicado">

                        <p id="texto"></p>
                    
                    <button type="submit" class="enviar">Subir comunicado</button>
                </form>
            ';
        }

    }

?>