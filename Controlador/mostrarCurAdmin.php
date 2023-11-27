<?php

    // SE RECIBEN TODAS LAS CONSULTAS PARA MOSTRAR CURSOS

    // ESTA FUNCIÓN ES LA QUE SE LLAMA EN LA VISTA
    function cargarCursos() {
        
        $objConsultas = new Consultas();
        $consultas = $objConsultas->mostrarCursosAdmin();

        if (!isset($consultas)) {
            echo '<h2> No hay cursos registrados </h2>';
        } else {
            $n = 0;
            foreach($consultas as $f) {
                $n += 1;
                echo '
                <tr>
                    <td>'.$n.'</td>
                    <td>'.$f['nombre'].'</td>
                    <td>'.$f['jornada'].'</td>
                    <td>'.$f['cantidadEstudiantes'].'</td>

                    <td class="ultimo"><a href="adminCurModificar.php?id='.$f['idCurso'].'">Modificar<img src="../../img/edit.svg" alt="Modificar"></a></td>
                    
                </tr>
                ';

            }

        }

    }

    function filtrarCursos($jornada, $nombre) {

        $objConsultas = new Consultas();
        $consulta = $objConsultas->filtrarCursos($jornada, $nombre);

        if(!isset($consulta)){

            echo '<h3>NO HAY CURSOS REGISTRADOS CON LAS CARACTERISTICAS SELECCIONADAS</h3>';

        }else {
            $n = 0;
            foreach($consulta as $f) {
                $n += 1;
                echo '
                <tr>
                    <td>'.$n.'</td>
                    <td>'.$f['nombre'].'</td>
                    <td>'.$f['jornada'].'</td>
                    <td>'.$f['cantidadEstudiantes'].'</td>

                    <td class="ultimo"><a href="adminCurModificar.php?id='.$f['idCurso'].'">Modificar<img src="../../img/edit.svg" alt="Modificar"></a></td>
                    
                </tr>
                ';

            }

        }

    }

    function cargarCurEditar(){

        // Aterrizamos la PK enviada desde la tabla
        $id = $_GET['id']; 

        // Eviamos la PK a una función de la clase consultas
        $objConsultas = new Consultas();
        $consulta = $objConsultas->mostrarCursoAdmin($id);

        // Pintamos la información consultada en el artefacto (formulario)
        foreach ($consulta as $f) {

            echo ' 
            <form action="../../../Controlador/actualizarCurAdmin.php" method="post" id="formularioAdmin">
            
            <div class="fieldset_view">
                <label for="jornada">Jornada</label>
                <select class="veriSelect" required name="jornada">
                    <option value="'.$f['jornada'].'" selected>'.$f['jornada'].'</option>
                    <option value="unica">Unica</option>
                    <option value="mañana">Mañana</option>
                    <option value="tarde">Tarde</option>
                </select>
            </div>

            <div class="fieldset">
                <fieldset>
                    <legend id="nom">Nombre</legend>
                </fieldset>
                <input type="text" value="'.$f['nombre'].'"  placeholder="Nombre" required legend="#nom" name="nombre">
            </div>

            <input type="number" hidden value="'.$f['idCurso'].'" name="idCurso">
            
            <button type="submit" class="enviar">Actualizar curso</button>

        </form>
            ';
        }

    }

    function cargarCursosRegistro() {
        
        $objConsultas = new Consultas();
        $consultas = $objConsultas->mostrarCursosAdmin();

        if (!isset($consultas)) {
            echo '<h2> No hay cursos registrados </h2>';
        } else {

            foreach($consultas as $f) {

                echo '
                    <option value="'.$f['idCurso'].'">'.$f['nombre'].' - Jornada: '.$f['jornada'].'</option>
                ';

            }

        }

    }

    function cargarCursoActual($idEstudiante) {

        $objConsultas = new Consultas();
        $consulta = $objConsultas->buscarCursoEstudiante($idEstudiante);

        foreach ($consulta as $f) {

            echo ' 
                <option value="'.$f['idCurso'].'" selected>'.$f['nombre'].' - Jornada: '.$f['jornada'].'</option>
            ';
        }

    }

    function cargarCursosReportes() {
        
        $objConsultas = new Consultas();
        $consultas = $objConsultas->mostrarCursosAdmin();

        if (!isset($consultas)) {
            echo '<h2> No hay cursos registrados </h2>';
        } else {

            foreach($consultas as $f) {

                echo '
                <tr>
                    <td>'.$f['nombre'].'</td>
                    <td>'.$f['jornada'].'</td>
                    <td>'.$f['cantidadEstudiantes'].'</td>             
                </tr>
                ';

            }

        }

    }

    function cargarCursosReportesFiltro($jornada, $nombre) {

        $objConsultas = new Consultas();
        $consulta = $objConsultas->filtrarCursos($jornada, $nombre);

        if(!isset($consulta)){

            echo '<h3>NO HAY CURSOS REGISTRADOS CON LAS CARACTERISTICAS SELECCIONADAS</h3>';

        }else {

            foreach($consulta as $f) {

                echo '
                <tr>
                    <td>'.$f['nombre'].'</td>
                    <td>'.$f['jornada'].'</td>
                    <td>'.$f['cantidadEstudiantes'].'</td>
                </tr>
                ';

            }

        }

    }

?>