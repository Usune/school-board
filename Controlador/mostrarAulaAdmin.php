<?php

    // SE RECIBEN TODAS LAS CONSULTAS PARA MOSTRAR AULAS

    // ESTA FUNCIÓN ES LA QUE SE LLAMA EN LA VISTA
    function cargarAulas() { 
        
        $objConsultas = new Consultas();
        $consultas = $objConsultas->mostrarAulasAdmin();

        if (!isset($consultas)) {
            echo '
            <div class="alert">
                <p>No hay aulas registradas</p>
            </div>
            ';
        } else {
            echo '
            <div class="tablas">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Aula</th>
                                <th>Clases</th>
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
                    <td>'.$f['nombreAula'].'</td>
                    <td>'.$f['clases'].'</td>

                    <td class="ultimo"><a href="adminAulaModificar.php?id='.$f['idAula'].'">Modificar<img src="../../img/edit.svg" alt="Modificar"></a></td>
                    
                </tr>
                ';

            }
            echo '
                </table>
            </div>
            ';

        }

    }

    function filtrarAulas($nombre) {

        $objConsultas = new Consultas();
        $consulta = $objConsultas->filtrarAulas($nombre);

        if(!isset($consulta)){
            echo '
            <div class="alert">
                <p>No hay aulas registradas con el nombre ingresado</p>
            </div>
            ';
        }else {
            echo '
            <div class="tablas">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Aula</th>
                                <th>Clases</th>
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
                    <td>'.$f['nombreAula'].'</td>
                    <td>'.$f['clases'].'</td>

                    <td class="ultimo"><a href="adminAulaModificar.php?id='.$f['idAula'].'">Modificar<img src="../../img/edit.svg" alt="Modificar"></a></td>
                    
                </tr>
                ';

            }
            echo '
                </table>
            </div>
            ';
        }


    }

    function cargarAulaEditar(){

        // Aterrizamos la PK enviada desde la tabla
        $id = $_GET['id']; 

        // Eviamos la PK a una función de la clase consultas
        $objConsultas = new Consultas();
        $consulta = $objConsultas->mostrarAulaAdmin($id);

        // Pintamos la información consultada en el artefacto (formulario)
        foreach ($consulta as $f) {

            echo ' 
                <form action="../../../Controlador/actualizarAulaAdmin.php" method="post" id="formulario">

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

                    <input type="number" hidden value="'.$f['idAula'].'" name="idAula">
                    
                    <button type="submit" class="enviar">Actualizar Aula</button>

                </form>
            ';
        }

    }

    function cargarAulasRegistro(){
        
        $objConsultas = new Consultas();
        $consultas = $objConsultas->mostrarAulasAdmin();

        if (!isset($consultas)) {
            echo '<option value="">Sin registros</option>';
        } else {

            foreach($consultas as $f) {

                echo '
                    <option value="'.$f['idAula'].'">'.$f['nombreAula'].'</option>
                ';

            }

        }

    }

?>