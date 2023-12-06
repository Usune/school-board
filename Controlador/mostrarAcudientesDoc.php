<?php
function cargaAcudientes(){
    $documento = $_GET['documento'];
    
    $objConsultas = new Consultas();
    $consultas = $objConsultas->mostrarAcudientesDoc($documento);

    if (!isset($consultas)) {
        echo '<h3> No hay acudientes registrados </h3>';
    } else {

        foreach($consultas as $f) {

            echo '
            <tr>
                <td>'.$f['nombres'].'</td>
                <td>'.$f['apellidos'].'</td>
                <td>'.$f['telefono'].'</td>
                <td>'.$f['correo'].'</td>
            </tr>
            ';

        }

    }

} 

?>