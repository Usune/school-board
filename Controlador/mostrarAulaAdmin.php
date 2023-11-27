<?php

    // SE RECIBEN TODAS LAS CONSULTAS PARA MOSTRAR AULAS

    // ESTA FUNCIÓN ES LA QUE SE LLAMA EN LA VISTA
    function cargarAulas() {
        
        $objConsultas = new Consultas();
        $consultas = $objConsultas->mostrarAulasAdmin();

        if (!isset($consultas)) {
            echo '<h2> No hay aulas registradas con el nombre ingresado</h2>';
        } else {
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

        }

    }

    function filtrarAulas($nombre) {

        $objConsultas = new Consultas();
        $consulta = $objConsultas->filtrarAulas($nombre);

        if(!isset($consulta)){

            echo '<h3>NO HAY AULAS EN EL SISTEMA CON EL NOMBRE INGRESADO</h3>';

        }else {
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

?>