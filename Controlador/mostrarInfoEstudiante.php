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

            // Operación para traer la fecha en este formato Sep 2, 2023

            // Capturar la fecha desde la DB 
            $fechaDB = $f['fecha_vencimiento'];
            // Convertirla en el tipo de dato que se encuentra en la DB, ya que antes de este momento pasa como string (Verificar con  echo gettype($fechaDB); )
            $fechaDateTime = new DateTime($fechaDB);
            // Colocar en el formato Sep 2, 2023
            $fechaFormato = $fechaDateTime->format('M j, Y');



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
                                '.$fechaFormato.'
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