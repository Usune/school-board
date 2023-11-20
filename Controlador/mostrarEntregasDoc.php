<?php
    function mostrarEntregasCalificacion(){
        $idClase = $_GET['idClase'];
        $idTarea = $_GET['idTarea'];

        $objConsultas = new Consultas();
        $consultas = $objConsultas->mostrarEntregasCalificacion($idClase, $idTarea);

        if (!isset($consultas)) {
            echo '<h2> No hay comunucados registrados con el nombre ingresado</h2>';
        } else {
            foreach($consultas as $f) {
                echo 
                '<tr>
                    <td>' . $f['Estudiante'] . '</td>
                    <td style="display: none;">' . $f['idEntrega'] . '</td>
                    <td>' . $f['titulo'] . '</td>
                    <td>' . $f['descripcion'] . '</td>
                    <td>' . $f['fecha_entrega_est'] . '</td>
                    <td>' . $f['fecha_vencimiento'] . '</td>
                    <td>'
                    . ($f['archivos'] == "" ? "No hay archivos" :
                    '<a href="' . $f['archivos'] . '" target="_blank">Ver Archivo</a>')
                    .                    
                    '</td>
                    <td class="ultimo">' 
                    .
                    ($f['nota'] != "" ? $f['nota'] :
                    '<button onclick="cargaDatosEntrega(this.parentNode.parentNode)" type="button" class="btn btn-light" data-toggle="modal" data-target="#modalCalificación">Calificar</button>')
                    .                                                            
                    '</td>
                </tr>';
            }
        }
    }
?>