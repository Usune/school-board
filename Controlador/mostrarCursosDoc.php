<?php
//SE CREA LA FUNCION PARA LLAMAR LOS CURSOS QUE EL DOCENTE TIENE ASIGNADO

function traerCursos() {

    $documento = $_SESSION['id'];

    $objConsultas = new Consultas();
    $consultas = $objConsultas->mostrarCursosDoc($documento);

    if (!isset($consultas)){
        echo'<h2>El docente no tiene cursos asignados.</h2>';

    }else{
        foreach($consultas as $f){
            echo'
            <a href="docCurso.php?id='.$f['idCur'].'">
                <img src="../../img/curso.svg" alt="logo">
                <p>Jornada: '.$f['curJor'].'</p>
                <p>Curso: '.$f['nomCur'].'</p>
                <p>Asignarura: '.$f['asigNom'].'</p>
            </a>
            ';
        }
    }
}


function traerCurso() {
    
    $idCurso = $_GET['id'];

    $objConsultas = new Consultas();
    $consultas = $objConsultas->mostrarCurDoc($idCurso);

    foreach($consultas as $f){
        echo'
        <a href="docConfi.php"> / '.$f['jornada'].'-'.$f['nombre'].' </a>
            </nav>

            <section>
                <h2>Jornada: '.$f['jornada'].'<br> Curso: '.$f['nombre'].'</h2>
        ';
    }


}