<?php

    // SE RECIBEN TODAS LAS CONSULTAS PARA MOSTRAR ASIGNATURAS

    // ESTA FUNCIÓN ES LA QUE SE LLAMA EN LA VISTA

    function mostrarObserForm() {
        
        echo '

        <div class="formulario">
            
            <h3>Observador</h3>

            <p class="recordatorio">Ingrese el documento del estudiante.</p>

            <form method="get" id="formulario">

                    <div class="fieldset">
                        <fieldset>
                            <legend id="doc">Documento</legend>
                        </fieldset>
                        <input type="number" placeholder="Documento" required legend="#doc" name="documento">
                    </div>

                    <p id="texto"></p>
                
                <button type="submit" class="enviar">Siguiente</button>
            </form>
        </div>
        
        ';

    }
    
    function cargarObservador() {

        $documento = $_GET['documento'];
        
        $objConsultas = new Consultas();
        $consultas = $objConsultas->mostrarUsuarioAdmin($documento);

        if(!isset($consultas)){
            echo '<script>alert("No existe un estudiante con el documento ingresado")</script>';
            echo "<script>location.href='adminObser.php'</script>";
        }else {
            foreach($consultas as $f) {
    
                echo '
                <h2>Observador del estudiante</h2>
                <div class="datosCabecera">
                    <a href="adminObserRegistro.php"><img src="../../img/agregar.svg">Nueva</a>
                    <p>'.$f['nombres'].' '.$f['apellidos'].'</p>
                    <p>'.$f['tipoDoc'].' - '.$f['documento'].'</p>
                </div>
                ';

            }

        
            $consultas = $objConsultas->mostrarObservadorAdmin($documento);
    
            if (!isset($consultas)) {
                echo '<h3>El estudiante no tiene observaciones</h3>';
            } else {
                $n = 0;
                foreach($consultas as $f) {
                    
                    echo '
                    <div class="card-tarea">
                        <div class="card-header">
                            <div class="info-user fila">
                                <img src="'.$f['fotoAutor'].'" alt="foto perfil Docente">
                                <p>
                                    '.$f['NombreAutor'].'
                                </p>
                            </div>
                            
                            <div class="fechas">
                                <p>
                                    '.$f['FechaObservacion'].'
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="card-header">
                            <div class="card-info">
                                <img src="../../img/observador.svg">
                                <div class="info">
                                    <p>
                                        '.$f['Observacion'].'
                                    </p>
                                </div>
                            </div>
                            <div class="boton">
                                <a href="adminObserModificar.php?id='.$f['idObservador'].'"><img src="../../img/edit.svg">Modificar</a>
                            </div>
                        </div>
                    </div>
                    ';
    
                }
    
            }    

        }

    }

    function filtrarAsignaturas($nombre) {

        $objConsultas = new Consultas();
        $consulta = $objConsultas->filtrarAsignaturas($nombre);

        if(!isset($consulta)){

            echo '<h3>NO HAY ASIGNATURAS EN EL SISTEMA CON EL NOMBRE INGRESADO</h3>';

        }else {
            $n = 0;
            foreach($consulta as $f) {
                $n += 1;
                echo '
                <tr>
                    <td>'.$n.'</td>
                    <td>'.$f['nombre'].'</td>

                    <td><a href="adminAsigModificar.php?id='.$f['idAsignatura'].'">Modificar<img src="../../img/edit.svg" alt="Modificar"></a></td>
                    
                </tr>
                ';

            }


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

?>