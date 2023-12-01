<?php

    
    // function cargarAsistencia(){
    //     $idClase = $_GET['idClase'];

    //     $objConsultas = new Consultas();
    //     $consultas = $objConsultas->mostrarUsuariosAsis($idClase);

    //     if (!isset($consultas)) {
    //         echo '<h3> No hay usuarios </h3>';
    //     } else {

    //         foreach($consultas as $f) {

    //             echo '
    //                 <tr>
    //                     <td>'.$f['tipoDoc'].'</td>
    //                     <td>'.$f['documento'].'</td>
    //                     <td>'.$f['apellidos'].'</td>
    //                     <td>'.$f['nombres'].'</td>
    //                     <td>'.$f['Fecha'].'</td>       
    //                     <td class="ultimo"><input type="checkbox" id="chkAsiste" name="chkAsiste" value="1"></td>                                            
    //                 </tr>
    //             ';

    //         }

    //     }

    // } 



    // SE RECIBEN TODAS LAS CONSULTAS PARA MOSTRAR USUARIOS

    // ESTA FUNCIÓN ES LA QUE SE LLAMA EN LA VISTA
    function cargarAsistencia(){
        $idClase = $_GET['idClase'];

        $objConsultas = new Consultas();
        $consultas = $objConsultas->mostrarUsuariosAsis($idClase);

        if (!isset($consultas)) {
            echo '<h3> No hay usuarios </h3>';
        } else {

            $posicion = 0;
            foreach($consultas as $f) {
                $posicion++;
                echo '
                    <tr>
                        <td>'.$f['tipoDoc'].'</td>
                        <td>'.$f['documento'].'</td>
                        <td>'.$f['apellidos'].'</td>
                        <td>'.$f['nombres'].'</td>                        
                        <td class="ultimo">
                            <div>
                                <label>
                                    <input type="radio" name="rdblAsistencia'.$posicion.'" value="1"> Asiste
                                </label>
                                <label>
                                    <input type="radio" name="rdblAsistencia'.$posicion.'" value="2"> Falta
                                </label>
                                <label>
                                    <input type="radio" name="rdblAsistencia'.$posicion.'" value="3"> Falta Justificada
                                </label>
                                <label>
                                    <input type="radio" name="rdblAsistencia'.$posicion.'" value="4"> Retardo
                                </label>
                            </div>
                        </td>
                    </tr>
                ';

            }

        }

    } 


    function cargarConsultaAsistencia() {
        $idClase = $_GET['idClase'];
        
        $objConsultas = new Consultas();
        $consultas = $objConsultas->cargarAsistenciaDoc($idClase);
    
        // Obtén la lista única de fechas y estudiantes
        $fechas = array_unique(array_column($consultas, 'fecha_asistencia'));
        $estudiantes = array_unique(array_column($consultas, 'nombres'));
    
        echo '<div class="container">
                <div class="">
                    <table>
                        <thead>
                            <tr>
                                <th>Estudiante</th>';
    
        // Imprime las fechas en el encabezado
        foreach ($fechas as $fecha) {
            echo '<th>' . $fecha . '</th>';
        }
    
        echo '</tr>
            </thead>
            <tbody>';
    
        // Recorre los estudiantes e imprime
        foreach ($estudiantes as $estudiante) {
            echo '<tr>';
            echo '<td>' . $estudiante . '</td>';
    
            // Recorre las fechas y muestra el estado correspondiente
            foreach ($fechas as $fecha) {
                $estado = obtenerEstadoAsistencia($consultas, $estudiante, $fecha);
                echo '<td>' . $estado . '</td>';
            }
    
            echo '</tr>';
        }
    
        echo '</tbody>
            </table>
        </div>
    </div>';
    }
    
    function obtenerEstadoAsistencia($consultas, $estudiante, $fecha) {
        foreach ($consultas as $fila) {
            if ($fila['nombres'] == $estudiante && $fila['fecha_asistencia'] == $fecha) {
                return $fila['estado_asistencia'];
            }
        }
        return '';
    }

    
    
    
    

    
?>
