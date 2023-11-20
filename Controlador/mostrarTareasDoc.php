<?php

function cargarTareas(){
    $docente = $_SESSION['id'];
    $clase = $_GET['idClase'];

    $objConsulta = new Consultas();
    $consulta = $objConsulta->consultarTareasDoc($docente, $clase);

    if (!isset($consulta)){
        echo'<h2>El docente no tiene tareas creadas.</h2>';

    }else{
        foreach($consulta as $f){
            echo'
            <div class="card-tarea">
            <div class="card-header">
                <div class="info-user fila">
                    <img src="'.$f['fotoUsu'].'" alt="foto perfil Docente">
                    <p>
                        '.$f['nombreUsu'].' <br>
                        '.$f['apellidoUsu'].'
                    </p>
                </div>
                <div class="fecha">
                    <p>
                        '.$f['fecha_C'].'
                    </p>
                </div>
            </div>
            <hr>
            <div class="card-header">
                <div class="card-info">
                    <img src="../../img/tareas.svg" alt="">
                    <div class="info">
                        <h3>'.$f['titulo'].'</h3>
                        <p>
                            '.$f['descripcion'].'
                        </p>
                    </div>
                </div>
                <div class="boton">
                    <a href="docTareaModificar.php?idTarea='.$f['idTarea'].'&idClase='.$clase.'"><img src="../../img/edit.svg">Modificar</a>
                </div>
                <div class="boton">
                <a href="../../../Controlador/eliminarTarDoc.php?idTarea='.$f['idTarea'].'&idClase='.$clase.'"><img src="../../img/eliminar.svg">Eliminar</a>
            </div>
            </div>
        </div>
            ';
        }
    }
   

}

function cargarTareaEditarDoc(){

    // Aterrizamos la PK enviada desde la tabla
    $id = $_GET['idTarea']; 
    $idClase = $_GET['idClase'];

    // Eviamos la PK a una función de la clase consultas
    $objConsultas = new Consultas();
    $consulta = $objConsultas->consultarTareaDoc($id);

    // Pintamos la información consultada en el artefacto (formulario)
    foreach ($consulta as $f) {

        $fecha = $f['fecha_V'];
        $fecha_formateada = date('Y-m-d', strtotime($fecha));

        echo '<form class="doc" action="../../../Controlador/actualizarTarDoc.php" method="post" enctype="multipart/form-data" id="formulario">


        <div class="fieldset">
        
            <fieldset>
                <legend id="tit">Título</legend>
            </fieldset>
            <input id="titulo" type="text" placeholder="Título" required legend="#tit" name="titulo" value="'.$f['titulo'].'">
        </div>


        <div class="textarea">
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" cols="30" rows="10" name="descripcion" placeholder="Ingrese una descripción">'.$f['descripcion'].'</textarea>
        </div>

       
        <div class="select">
            <label for="fecha_V">Fecha limite de entrega </label>
            <input type="date" value="'.$fecha_formateada.'" name="fecha_V">
        </div>

        <div class="file">
            <label for="archivo">Seleccione un archivo</label>
            <input type="file"  accept=".pdf" name="archivos" multiple>
        </div>

        <input type="number" hidden value="'.$f['idTarea'].'" name="id">
        <input type="number" hidden value="'.$idClase.'" name="idClase">


        <button type="submit" class="enviar">Modificar Tarea</button>
    </form> ';

    }
}

function formRegistroTarDoc(){

    // Aterrizamos la PK enviada desde la tabla
    $idClase = $_GET['idClase']; 

    echo '
    <form action="../../../Controlador/registrarTareasDoc.php" method="post" enctype="multipart/form-data" id="formulario">

        <div class="fieldset">
            <fieldset>
                <legend id="tit">Título</legend>
            </fieldset>
            <input type="text" placeholder="Título" required legend="#tit" name="titulo">
        </div>
        <div class="textarea">
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" cols="30" rows="10" name="descripcion" placeholder="Ingrese una descripción"></textarea>
        </div>
        
        <div class="select">
            <label for="fecha_V">Fecha limite de entrega </label>
            <input type="date" name="fecha_V">
        </div>

        <div class="file">
            <label for="archivo">Seleccione un archivo</label>
            <input type="file" accept=".pdf" name="archivos" multiple>
        </div>

        <input type="text" hidden name="idClase" value="'.$idClase.'">

        <button type="submit" class="enviar">Entregar Tarea</button>
    </form>

    ';

}

function cargaTareasCalificaciones(){
    $docente = $_SESSION['id'];
    $clase = $_GET['idClase'];

    $objConsulta = new Consultas();
    $consulta = $objConsulta->consultarTareasDoc($docente, $clase);

    if (!isset($consulta)){
        echo'<h2>El docente no tiene tareas creadas.</h2>';

    }else{
        foreach($consulta as $f){
            echo'
            <div class="card-tarea">
            <div class="card-header">
                <div class="info-user fila">
                    <img src="'.$f['fotoUsu'].'" alt="foto perfil Docente">
                    <p>
                        '.$f['nombreUsu'].' <br>
                        '.$f['apellidoUsu'].'
                    </p>
                </div>
                <div class="fecha">
                    <p>
                        '.$f['fecha_C'].'
                    </p>
                </div>
            </div>
            <hr>
            <div class="card-header">
                <div class="card-info">
                    <img src="../../img/tareas.svg" alt="">
                    <div class="info">
                        <h3>'.$f['titulo'].'</h3>
                        <p>
                            '.$f['descripcion'].'
                        </p>
                    </div>
                </div>                
                <div class="boton">
                    <a href="docCalificacionEntrega.php?idTarea='.$f['idTarea'].'&idClase='.$clase.'"><img src="../../img/edit.svg">Calificar</a>
                </div>
            </div>
        </div>
            ';
        }
    }
}




?>