<?php

// function cargarConsultaCalificaciones() {
//     $idClase = $_GET['idClase'];
    
//     $objConsultas = new Consultas();
//     $consultas = $objConsultas->cargarCalificacionesDoc($idClase);

//     // Obtén la lista única de titulos y estudiantes
//     $titulos = array_unique(array_column($consultas, 'titulo'));
//     $estudiantes = array_unique(array_column($consultas, 'nombres'));

//     echo '<div class="container">
//             <div class="">
//                 <table>
//                     <thead>
//                         <tr>
//                             <th>Estudiante</th>';

//     // Imprime las titulos en el encabezado
//     foreach ($titulos as $titulo) {
//         echo '<th>' . $titulo . '</th>';
//     }

//     echo '</tr>
//         </thead>
//         <tbody>';

//     // Recorre los estudiantes e imprime
//     foreach ($estudiantes as $estudiante) {
//         echo '<tr>';
//         echo '<td>' . $estudiante . '</td>';

//         // Recorre las titulos y muestra el estado correspondiente
//         foreach ($titulos as $titulo) {
//             $estado = obtenerCalificacion($consultas, $estudiante, $titulo);
//             echo '<td>' . $estado . '</td>';
//         }

//         echo '</tr>';
//     }

//     echo '</tbody>
//         </table>
//     </div>
// </div>';
// }

function cargarConsultaCalificaciones() {
    $idClase = $_GET['idClase'];
    
    $objConsultas = new Consultas();
    $consultas = $objConsultas->cargarCalificacionesDoc($idClase);

    // Obtén la lista única de títulos y estudiantes
    $titulos = array_unique(array_column($consultas, 'titulo'));
    $estudiantes = array_unique(array_column($consultas, 'nombres'));

    echo '<div class="container">
            <div class="">
                <table>
                    <thead>
                        <tr>
                            <th>Estudiante</th>';

    // Imprime los títulos en el encabezado
    foreach ($titulos as $titulo) {
        echo '<th><a href="tareasDoc.php?titulo=' . urlencode($titulo) . '&idClase='.$idClase.'" style="color: black !important; ">' . $titulo . '</a></th>';
    }

    echo '</tr>
        </thead>
        <tbody>';

    // Recorre los estudiantes e imprime
    foreach ($estudiantes as $estudiante) {
        echo '<tr>';
        echo '<td>' . $estudiante . '</td>';

        // Recorre los títulos y muestra el estado correspondiente
        foreach ($titulos as $titulo) {
            $estado = obtenerCalificacion($consultas, $estudiante, $titulo);
            echo '<td>' . $estado . '</td>';
        }

        echo '</tr>';
    }

    echo '</tbody>
        </table>
    </div>
</div>';
}


function obtenerCalificacion($consultas, $estudiante, $titulo) {
    foreach ($consultas as $fila) {
        if ($fila['nombres'] == $estudiante && $fila['titulo'] == $titulo) {
            return $fila['nota'];
        }
    }
    return '';
}




?>