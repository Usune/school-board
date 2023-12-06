<?php
//SE CREA LA FUNCION PARA LLAMAR LOS CURSOS QUE EL DOCENTE TIENE ASIGNADO

function traerCursos() {

    $documento = $_SESSION['id'];

    $objConsultas = new Consultas();
    $consultas = $objConsultas->mostrarClasesDoc($documento);

    if (!isset($consultas)){
        echo'<h2>El docente no tiene cursos asignados.</h2>';

    }else{
        $n=0;
        $m=0;
        foreach($consultas as $f){
            if($n%3 == 0){
                $m += 1;
                echo'
                <div class="filaClases">
                    <div class="cardClases">
                        <div class="cardClasesImg">
                            <img src="../../img/clases.svg" alt="Clase">
                        </div>
                        <div class="cardClasesInfo">
                            <div class="infoClase">
                                <div class="infoImg">
                                    <img src="../../img/curso.svg" alt="curso">
                                </div>
                                <div class="infoTexto">
                                    <p class="tipo">Curso</p>
                                    <p>'.$f['nombreCurso'].'-'.$f['jornadaCurso'].'</p>
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
                        <div class="cardClasesOpciones">
                            <a href="docCurso.php?idClase='.$f['idClase'].'">Ingresar</a>
                        </div>
                    </div>
                ';
            }else{
                $m += 1;
                echo '
                    <div class="cardClases">
                        <div class="cardClasesImg">
                            <img src="../../img/clases.svg" alt="Clase">
                        </div>
                        <div class="cardClasesInfo">
                            <div class="infoClase">
                                <div class="infoImg">
                                    <img src="../../img/curso.svg" alt="curso">
                                </div>
                                <div class="infoTexto">
                                    <p class="tipo">Curso</p>
                                    <p>'.$f['nombreCurso'].'-'.$f['jornadaCurso'].'</p>
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
                        <div class="cardClasesOpciones">
                            <a href="docCurso.php?idClase='.$f['idClase'].'">Ingresar</a>
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
    }


    // Definir una variable global
    // $_GLOBALS['mi_variable_global'] = "Este es mi valor global";
    // Eliminar una variable global
    // unset($_GLOBALS['mi_variable_global']);

}

function traerCurso() {
    $idClase = $_GET['idClase'];

    $objConsultas = new Consultas();
    $consultas = $objConsultas->mostrarCurClase($idClase);

    foreach($consultas as $f){
        echo'
        <a href="docCurso.php?idClase='.$idClase.'"> / '.$f['nombre'].'-'.$f['jornada'].' </a>
             
        ';
    }
 
}

function menuIncludeDoc() {

    $clase = $_GET['idClase'];
    // $tarea =$_GET['idTarea'];
    echo'
        <li><a href="homeDoc.php"><img src="../../img/curso.svg" alt="logo">Clases</a></li>
        <li><a href="tareasDoc.php?idClase='.$clase.'&tarea=" id="tareas"><img src="../../img/tareas.svg" alt="logo">Tareas</a></li>
        <li><a href="docCalificaciones.php?idClase='.$clase.'" id="calificaciones"><img src="../../img/calificaciones.svg" alt="logo">Calificaciones</a></li>
        <li><a href="docObser.php?idClase='.$clase.'" id="observador"><img src="../../img/observador.svg" alt="logo">Observador</a></li>
        <li><a href="docComun.php?idClase='.$clase.'" id="comunicados"><img src="../../img/comunicados.svg" alt="logo">Comunicados</a></li>
        <li><a href="docAsistencia.php?idClase='.$clase.'" id="asistencia"><img src="../../img/asistencia.svg" alt="logo">Asistencia</a></li>
        <li><a href="docAcuConsu.php?idClase='.$clase.'" id="Lista"><img src="../../img/user.svg" alt="logo">Lista</a></li>

    ';
 
}

function traerCursoID() {
    $idClase = $_GET['idClase'];

    $objConsultas = new Consultas();
    $consultas = $objConsultas->mostrarCurDoc($idClase);

    foreach($consultas as $f){
        echo'
            <input type="text" id="curso"  value="'.$f['idCurso'].'" hidden name="curso">
        ';
    }
}

function tarjetasInicioDoc() {

    $clase = $_GET['idClase'];
    echo'
    <div class="fila-cont">
        <a href="tareasDoc.php?idClase='.$clase.'">                
            <img src="../../img/tareas.svg" alt="logo">
            <p>Tareas</p>            
        </a>
        <a href="docCalificaciones.php?idClase='.$clase.'">
            <img src="../../img/calificaciones.svg" alt="logo">
            <p>Calificaciones</p>
        </a>
        <a href="docObser.php?idClase='.$clase.'">                
            <img src="../../img/observador.svg" alt="logo">
            <p>Observador</p>        
        </a>
    </div>
    <div class="fila-cont">
        <a href="docComun.php?idClase='.$clase.'">                
            <img src="../../img/comunicados.svg" alt="logo">
            <p>Comunicados</p>            
        </a>
        <a href="docAsistencia.php?idClase='.$clase.'">                
            <img src="../../img/asistencia.svg" alt="logo">
            <p>Asistencia</p>            
        </a>   
    </div>
    ';

}


