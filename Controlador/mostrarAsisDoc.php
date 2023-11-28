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
?>
