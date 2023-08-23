<?php

    // SE RECIBEN TODAS LAS CONSULTAS DE 

    // ESTA FUNCIÓN ES LA QUE SE LLAMA EN LA VISTA

    function cargarUsuarios(){
        
        $objConsultas = new Consultas();
        $consultas = $objConsultas->mostrarUsuAdmin();

        if (!isset($consultas)) {
            echo '<h2> No hay usuarios registrados </h2>';
        } else {

            foreach($consultas as $f) {

                echo '
                <tr>
                    <td>'.$f['tipoDoc'].'</td>
                    <td>'.$f['documento'].'</td>
                    <td>'.$f['apellidos'].'</td>
                    <td>'.$f['nombres'].'</td>
                    <td>'.$f['estado'].'</td>
                    <td>'.$f['rol'].'</td>

                    <td><a href="">Modificar<img src="../../img/edit.svg" alt="Modificar"></a></td>

                    <td><a href="../../../Controlador/eliminarUsuAdmin.php?id='.$f['documento'].'">Eliminar<img src="../../img/eliminar.svg" alt="Eliminar"></a></td>
                </tr>
                ';

            }

        }

    }

?>