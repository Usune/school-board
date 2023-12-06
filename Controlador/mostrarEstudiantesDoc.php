<?php

    // SE RECIBEN TODAS LAS CONSULTAS PARA MOSTRAR USUARIOS

    // ESTA FUNCIÓN ES LA QUE SE LLAMA EN LA VISTA
    function cargarUsuariosDoc($idClase){
        
        $objConsultas = new Consultas();
        $consultas = $objConsultas->mostrarEstudiantesDoc($idClase);

        if (!isset($consultas)) {
            echo '<h3> No hay usuarios registrados </h3>';
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

                    <td class="ultimo"><a href="docAcudientes.php?idClase='.$_GET['idClase'].'&documento='.$f['documento'].'" alt="Modificar">Acudiente<img src="../../img/edit.svg" alt="Eliminar"></a></td>

                </tr>
                ';

            }

        }

    } 

    function filtrarUsuarios($rol, $estado, $nombres, $apellidos, $documento){

        $objConsultas = new Consultas();
        $consulta = $objConsultas->filtrarUsuarios($rol, $estado, $nombres, $apellidos, $documento);

        if(!isset($consulta)){

            echo '<h3>NO HAY USUARIOS REGISTRADOS CON LAS CARACTERISTICAS SELECCIONADAS</h3>';

        }else {

            foreach($consulta as $f) {

                echo '
                <tr>
                    <td>'.$f['tipoDoc'].'</td>
                    <td>'.$f['documento'].'</td>
                    <td>'.$f['apellidos'].'</td>
                    <td>'.$f['nombres'].'</td>
                    <td>'.$f['estado'].'</td>
                    <td>'.$f['rol'].'</td>

                    <td class="ultimo"><a href="adminUsuModificar.php?id='.$f['documento'].'" alt="Modificar">Modificar<img src="../../img/edit.svg" alt="Eliminar"></a></td>

                    <!-- <td><a href="../../../Controlador/eliminarUsuAdmin.php?id='.$f['documento'].'">Eliminar<img src="../../img/eliminar.svg" alt="Eliminar"></a></td> -->
                </tr>
                ';

            }


        }

    }

    function cargarUsuariosReporte(){
        
        $objConsultas = new Consultas();
        $consultas = $objConsultas->mostrarUsuariosAdmin();

        if (!isset($consultas)) {
            echo '<h3> No hay usuarios registrados </h3>';
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
                </tr>
                ';

            }

        }

    } 

    function filtrarUsuariosReporte($rol, $estado, $nombres, $apellidos, $documento){

        $objConsultas = new Consultas();
        $consulta = $objConsultas->filtrarUsuarios($rol, $estado, $nombres, $apellidos, $documento);

        if(!isset($consulta)){

            echo '<h3>NO HAY USUARIOS REGISTRADOS CON LAS CARACTERISTICAS SELECCIONADAS</h3>';

        }else {

            foreach($consulta as $f) {

                echo '
                <tr>
                    <td>'.$f['tipoDoc'].'</td>
                    <td>'.$f['documento'].'</td>
                    <td>'.$f['apellidos'].'</td>
                    <td>'.$f['nombres'].'</td>
                    <td>'.$f['estado'].'</td>
                    <td>'.$f['rol'].'</td>
                </tr>
                ';

            }


        }

    }
