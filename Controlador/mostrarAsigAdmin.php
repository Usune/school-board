<?php

    // SE RECIBEN TODAS LAS CONSULTAS PARA MOSTRAR ASIGNATURAS

    // ESTA FUNCIÓN ES LA QUE SE LLAMA EN LA VISTA
    function cargarAsignaturas() { 
        
        $objConsultas = new Consultas();
        $consultas = $objConsultas->mostrarAsignaturasAdmin();

        if (!isset($consultas)) {
            echo '
            <div class="alert">
                <p>No hay asignaturas registradas</p>
            </div>
            ';
        } else {
            echo '
            <div class="tablas">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Asignatura</th>
                                <th>Cursos</th>
                                <th class="ultimo">Opciones</th>
                                <!-- <th colspan="2">Opciones</th> -->
                            </tr>
                        </thead>
            ';
            $n = 0;
            foreach($consultas as $f) {
                $n += 1;
                echo '
                <tr>
                    <td>'.$n.'</td>
                    <td>'.$f['nombreAsig'].'</td>
                    <td>'.$f['cursos'].'</td>

                    <td class="ultimo"><a href="adminAsigModificar.php?id='.$f['idAsignatura'].'">Modificar<img src="../../img/edit.svg" alt="Modificar"></a></td>
                    
                </tr>
                ';

            }
            echo '
                </table>
            </div>
            ';

        }

    }

    function filtrarAsignaturas($nombre) {

        $objConsultas = new Consultas();
        $consulta = $objConsultas->filtrarAsignaturas($nombre);

        if(!isset($consulta)){
            echo '
            <div class="alert">
                <p>No hay asignaturas en el sistema con el nombre ingresado registradas</p>
            </div>
            ';

            echo '<h3>NO HAY ASIGNATURAS EN EL SISTEMA CON EL NOMBRE INGRESADO</h3>';

        }else {
            echo '
            <div class="tablas">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Asignatura</th>
                                <th>Cursos</th>
                                <th class="ultimo">Opciones</th>
                                <!-- <th colspan="2">Opciones</th> -->
                            </tr>
                        </thead>
            ';
            $n = 0;
            foreach($consulta as $f) {
                $n += 1;
                echo '
                <tr>
                    <td>'.$n.'</td>
                    <td>'.$f['nombreAsig'].'</td>
                    <td>'.$f['cursos'].'</td>

                    <td class="ultimo"><a href="adminAsigModificar.php?id='.$f['idAsignatura'].'">Modificar<img src="../../img/edit.svg" alt="Modificar"></a></td>
                    
                </tr>
                ';

            }
            echo '
                </table>
            </div>
            ';

        }


    }

    function cargarAsigEditar(){

        // Aterrizamos la PK enviada desde la tabla
        $id = $_GET['id']; 

        // Eviamos la PK a una función de la clase consultas
        $objConsultas = new Consultas();
        $consulta = $objConsultas->mostrarAsignaturaAdmin($id);

        // Pintamos la información consultada en el artefacto (formulario)
        foreach ($consulta as $f) {

            echo ' 
                <form action="../../../Controlador/actualizarAsigAdmin.php" method="post" id="formulario">

                    <div class="fieldset">
                        <fieldset>
                            <legend id="nom">Nombre</legend>
                        </fieldset>
                        <input type="text" value="'.$f['nombre'].'" placeholder="Nombre" required legend="#nom" id="campo1" name="nombre">
                    </div>
                
                    <div class="fieldset">
                        <fieldset>
                            <legend id="veri">Verificación nombre</legend>
                        </fieldset>
                        <input type="text" placeholder="Verificación nombre" required legend="#veri" id="verify" verify="#campo1">
                    </div>

                    <p id="texto"></p>

                    <input type="number" hidden value="'.$f['idAsignatura'].'" name="idAsignatura">
                    
                    <button type="submit" class="enviar">Actualizar Asignatura</button>

                </form>
            ';
        }

    }

    function cargarAsignaturasRegistro(){
        
        $objConsultas = new Consultas();
        $consultas = $objConsultas->mostrarAsignaturasAdmin();

        if (!isset($consultas)) {
            echo '<option value="">Sin registros</option>';
        } else {

            foreach($consultas as $f) {

                echo '
                    <option value="'.$f['idAsignatura'].'">'.$f['nombreAsig'].'</option>
                ';

            }

        }

    }

?>