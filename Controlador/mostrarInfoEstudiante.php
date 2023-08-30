<?php
    function mostrarAsignaturaEstudiante(){
        $objConsultas = new Consultas();
        $filas = $objConsultas->mostrarAsignaturas();

        foreach ($filas as $fila) {
            echo '
                <li><a href="homeAsignatura.php">'.$fila['nombre'].'</a></li>
            ';
        }
    }

?>