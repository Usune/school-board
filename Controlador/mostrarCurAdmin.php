<?php

    // SE RECIBEN TODAS LAS CONSULTAS DE 

    // ESTA FUNCIÓN ES LA QUE SE LLAMA EN LA VISTA

    function cargarCurso() {
        
        $objConsultas = new Consultas();
        $consultas = $objConsultas->mostrarCurAdmin();

        if (!isset($consultas)) {
            echo '<h2> No hay cursos registrados </h2>';
        } else {

            foreach($consultas as $f) {

                echo '
                <tr>
                    <td>'.$f['nombre'].'</td>
                    <td>'.$f['jornada'].'</td>

                    <td><a href="">Modificar<img src="../../img/edit.svg" alt="Modificar"></a></td>

                    <td><a href="../../../Controlador/eliminarCurAdmin.php?id='.$f['idCurso'].'">Eliminar<img src="../../img/eliminar.svg" alt="Eliminar"></a></td>
                </tr>
                ';

            }

        }

    }

?>