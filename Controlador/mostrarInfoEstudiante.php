<?php
    // Mostrar asignaturas a los estudiantes en el aside  
    function mostrarAsignaturaEstudiante(){
        session_start();
        $id = $_SESSION['id'];
        $objConsultas = new Consultas();
        $filas = $objConsultas->mostrarAsignaturas($id);

        foreach ($filas as $fila) {
            echo '
                <li><a href="homeAsignatura.php?idAsignatura'.$fila['idAsignatura'].'">'.$fila['asignatura'].'</a></li>
            ';
        }
    }

?>