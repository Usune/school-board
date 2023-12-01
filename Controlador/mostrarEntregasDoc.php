<?php

    function mostrarEntregasCalificacion(){
        $idClase = $_GET['idClase'];
        $idTarea = $_GET['idTarea'];

        $objConsultas = new Consultas();
        $consultas = $objConsultas->mostrarEntregasCalificacion($idClase, $idTarea);

        if (!isset($consultas)) {
            echo '
            <div class="alert">
                <p>No se han subido entregas en esta tarea</p>
            </div>
            ';
        } else {
            echo'
            <div class="tablas">
                <table>
                    <thead>
                        <tr>
                            <th>Estudiante</th>
                            <th style="display: none;">idEntrega</th>
                            <th>Tarea</th>
                            <th>Descripción Entrega</th>
                            <th>Fecha de Entrega</th>
                            <th>Fecha de Vencimiento</th>
                            <th>Archivo</th>
                            <th class="ultimo">Nota</th>
                        </tr>
                    </thead>
                    <tbody>
            ';
            foreach($consultas as $f) {
                $nota = number_format($f['nota'], 1);
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
                    ($f['nota'] != "" ? '
                    <button onclick="cargaDatosCalificacion(this.parentNode.parentNode, this)"  type="button" title="Editar" modal="#modalEditarCalificacion" class="desplegarModal"> '.$nota.'<img src="../../img/edit.svg">
                    </button>
                    ':

                    '<button onclick="cargaDatosEntrega(this.parentNode.parentNode)" type="button" modal="#modalCalificacion" class="desplegarModal">Calificar</button>
                                        
                    ')
                    .                                                            
                    '</td>
                </tr>';
            }
            echo'
            </tbody>
        </table>
    </div>
            ';
        }
    }
?>