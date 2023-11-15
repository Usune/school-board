<?php

    // SE RECIBEN TODAS LAS CONSULTAS PARA MOSTRAR USUARIOS

    // ESTA FUNCIÓN ES LA QUE SE LLAMA EN LA VISTA
    function cargarAsistencia(){
        $idClase = $_GET['idClase'];

        $objConsultas = new Consultas();
        $consultas = $objConsultas->mostrarUsuariosAsis($idClase);

        if (!isset($consultas)) {
            echo '<h3> No hay usuarios </h3>';
        } else {

            foreach($consultas as $f) {

                echo '
                <tr>
                    <td>'.$f['tipoDoc'].'</td>
                    <td>'.$f['documento'].'</td>
                    <td>'.$f['apellidos'].'</td>
                    <td>'.$f['nombres'].'</td>
                    <td>'.$f['Fecha'].'</td>       
                    <td><input type="checkbox" id="chkAsiste" name="chkAsiste" value="1"></td>                                            
                </tr>
                ';

            }

        }

    } 
?>