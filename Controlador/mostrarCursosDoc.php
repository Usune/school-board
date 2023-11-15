<?php
//SE CREA LA FUNCION PARA LLAMAR LOS CURSOS QUE EL DOCENTE TIENE ASIGNADO

function traerCursos() {

    $documento = $_SESSION['id'];

    $objConsultas = new Consultas();
    $consultas = $objConsultas->mostrarClasesDoc($documento);

    if (!isset($consultas)){
        echo'<h2>El docente no tiene cursos asignados.</h2>';

    }else{
        foreach($consultas as $f){
            echo'
            <a href="docCurso.php?idClase='.$f['idClase'].'">
                <img src="../../img/curso.svg" alt="logo">
                <p>Jornada: '.$f['curJor'].'</p>
                <p>Curso: '.$f['nomCur'].'</p>
                <p>Asignarura: '.$f['asigNom'].'</p>
            </a>
            ';
        }
    }


    // Definir una variable global
    // $_GLOBALS['mi_variable_global'] = "Este es mi valor global";
    // Eliminar una variable global
    // unset($_GLOBALS['mi_variable_global']);

}

function traerCurso() {
    $_GLOBALS['idClase'] = $_GET['idClase'];

    $objConsultas = new Consultas();
    $consultas = $objConsultas->mostrarCurDoc($_GLOBALS['idClase']);

    foreach($consultas as $f){
        echo'
        <a href="docCurso.php?idClase='.$_GLOBALS['idClase'].'"> / '.$f['jornada'].'-'.$f['nombre'].' </a>
            </nav>  

            <section>
                <h2>Jornada: '.$f['jornada'].'<br> Curso: '.$f['nombre'].'</h2>
        ';
    }
 

}

function navMainDoc() {
    
    $idClase = $_GET['idClase'];

    $objConsultas = new Consultas();
    $consultas = $objConsultas->mostrarCurDoc($idClase);

    foreach($consultas as $f){
        echo'
        <a href="docCurso.php?idClase='.$idClase.'"> / '.$f['jornada'].'-'.$f['nombre'].' </a>
        ';
    }


}

function menuIncludeDoc() {

    $clase = $_GET['idClase'];
    // $tarea =$_GET['idTarea'];
    echo'
        <li id="liRol">Docente</li>
        <li><a href="homeDoc.php?idClase='.$clase.'"><img src="../../img/curso.svg" alt="logo">Clases</a></li>
        <li><a href="tareasDoc.php?idClase='.$clase.'"><img src="../../img/tareas.svg" alt="logo">Tareas</a></li>
        <li><a href="docCalif.php?idClase='.$clase.'"><img src="../../img/calificaciones.svg" alt="logo">Calificaciones</a></li>
        <li><a href="docObser.php?idClase='.$clase.'"><img src="../../img/observador.svg" alt="logo">Observador</a></li>
        <li><a href="docComun.php?idClase='.$clase.'"><img src="../../img/comunicados.svg" alt="logo">Comunicados</a></li>
        <li><a href="docAsistencia.php?idClase='.$clase.'"><img src="../../img/asistencia.svg" alt="logo">Asistencia</a></li>

    ';
 
}



function registroTareaDoc() {

    $clase = $_GET['idClase'];
    echo'
    <a href="docTareaRegistro.php?idClase='.$clase.'" class="btn_crear"><img src="../../img/agregar.svg" alt="filtro">Crear Tarea</a>
    ';

}


function tarjetasInicioDoc() {

    $clase = $_GET['idClase'];
    echo'
    <div class="fila-cont">                        
        <a href="homeDoc.php?idClase='.$clase.'">            
            <img src="../../img/curso.svg" alt="logo">
            <p>Clases</p>
        </a>
        <a href="tareasDoc.php?idClase='.$clase.'">                
            <img src="../../img/tareas.svg" alt="logo">
            <p>Tareas</p>            
        </a>
        <a href="docCalif.php?idClase='.$clase.'">
            <img src="../../img/calificaciones.svg" alt="logo">
            <p>Calificaciones</p>
        </a>
    </div>
    <div class="fila-cont">
        <a href="docObser.php">                
            <img src="../../img/observador.svg" alt="logo">
            <p>Observador</p>            
        </a>
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


