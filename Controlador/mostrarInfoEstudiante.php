<?php
    // Mostrar asignaturas a los estudiantes en el aside  
    function mostrarAsignaturasEstudiante(){
        session_start();
        $id = $_SESSION['id'];
        $objConsultas = new Consultas();
        $filas = $objConsultas->cargarAsignaturas($id);

        foreach ($filas as $fila) {
            echo '
                <li><a href="homeAsignatura.php?idAsignatura='.$fila['idAsignatura'].'">'.$fila['asignatura'].'</a></li>
            ';
        }
    }

    // Mostrar tareas de la asignatura a los estudiantes en homeAsignatura 
    function mostrarTareasAsignatura(){
        $idAsignatura = $_GET['idAsignatura'];
        $objConsultas = new Consultas();
        $filas = $objConsultas->cargarTareas($idAsignatura);

        foreach($filas as $f){
            echo '
                <div class="card-tarea">
                    <div class="card-header">
                        <div class="info-user fila">
                            <img src="'.$f['foto'].'" alt="foto perfil Docente">
                            <p>
                                '.$f['nombres'].' <br>
                                '.$f['apellidos'].'
                            </p>
                        </div>
                        <div class="fechas" id="estado">
                            <p>
                                '.$f['fecha_vencimiento'].'
                                Mayo 2, 2023 
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="card-header">
                        <div class="card-info">
                            <img src="../../img/descripcion.png" alt="">
                            <div class="info">
                                <h3>'.$f['titulo'].'</h3>
                                <p>
                                    '.$f['descripcion'].'
                                </p>
                            </div>
                        </div>
                        <div class="boton">
                            <a href="#">Entregar</a>
                        </div>
                    </div>
                </div>
            ';
        };


    }

?>