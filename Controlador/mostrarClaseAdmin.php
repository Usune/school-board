<?php

    // SE RECIBEN TODAS LAS CONSULTAS PARA MOSTRAR AULAS

    // ESTA FUNCIÓN ES LA QUE SE LLAMA EN LA VISTA
    function cargarClases() {
        
        $objConsultas = new Consultas();
        $consultas = $objConsultas->mostrarClasesAdmin();

        if (!isset($consultas)) {
            echo '
            <div class="alert">
                <p>No se han creado clases</p>
            </div>
            ';
        } else {
            echo '
            <div class="contClases">
            ';
            $n=0;
            $m=0;
            foreach($consultas as $f) {
                if($n%3 == 0){
                    $m += 1;
                    echo'
                    <div class="filaClases">
                        <div class="cardClases">
                            <div class="cardClasesImg">
                                <img src="'.$f['foto'].'" alt="docente">
                                <p>'.$f['nombreDocente'].'</p>
                            </div>
                            <div class="cardClasesInfo">
                                <div class="infoClase">
                                    <div class="infoImg">
                                        <img src="../../img/curso.svg" alt="curso">
                                    </div>
                                    <div class="infoTexto">
                                        <p class="tipo">Curso</p>
                                        <p>'.$f['nombreCurso'].'</p>
                                    </div>
                                </div>
                                <div class="infoClase">
                                    <div class="infoImg">
                                        <img src="../../img/asignaturas.svg" alt="asignatura">
                                    </div>
                                    <div class="infoTexto">
                                        <p class="tipo">Asignatura</p>
                                        <p>'.$f['nombreAsignatura'].'</p>
                                    </div>
                                </div>
                                <div class="infoClase">
                                    <div class="infoImg">
                                        <img src="../../img/aulas.svg" alt="aula">
                                    </div>
                                    <div class="infoTexto">
                                        <p class="tipo">Aula</p>
                                        <p>'.$f['nombreAula'].'</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ';
                }else{
                    $m += 1;
                    echo '
                        <div class="cardClases">
                            <div class="cardClasesImg">
                                <img src="'.$f['foto'].'" alt="docente">
                                <p>'.$f['nombreDocente'].'</p>
                            </div>
                            <div class="cardClasesInfo">
                                <div class="infoClase">
                                    <div class="infoImg">
                                        <img src="../../img/curso.svg" alt="curso">
                                    </div>
                                    <div class="infoTexto">
                                        <p class="tipo">Curso</p>
                                        <p>'.$f['nombreCurso'].'</p>
                                    </div>
                                </div>
                                <div class="infoClase">
                                    <div class="infoImg">
                                        <img src="../../img/asignaturas.svg" alt="asignatura">
                                    </div>
                                    <div class="infoTexto">
                                        <p class="tipo">Asignatura</p>
                                        <p>'.$f['nombreAsignatura'].'</p>
                                    </div>
                                </div>
                                <div class="infoClase">
                                    <div class="infoImg">
                                        <img src="../../img/aulas.svg" alt="aula">
                                    </div>
                                    <div class="infoTexto">
                                        <p class="tipo">Aula</p>
                                        <p>'.$f['nombreAula'].'</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ';
                }
                if($m%3 == 0){
                    echo'
                    </div>
                    ';
                    $m = 0;
                }
                $n += 1; 
            }
            echo '
            </div>
            ';

        }

    }

    function cargarClaseEditar(){

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
                    
                    <button type="submit" class="enviar">Modificar comunicado</button>
                </form>
            ';
        }

    }
// Quitado de la línea 55 y 94
//<div class="cardClasesOpciones">
//     <a href="">Ver más</a>
//     <a href="">Editar  <img src="../../img/edit.svg"></a>
// </div>
?>