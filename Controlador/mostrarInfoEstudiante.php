<?php
    // Mostrar asignaturas a los estudiantes en el aside  
    function mostrarAsignaturasEstudiante(){
        session_start();
        $documento = $_SESSION['id'];
        $objConsultas = new Consultas();
        $filas = $objConsultas->cargarAsignaturas($documento);

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
            $fechaDBDateTime = new DateTime($fechaDB);
            // Colocar en el formato Sep 2, 2023
            $fechaFormato = $fechaDBDateTime->format('M j, Y');


            // Operación para indicar el color de vencimiento de la fecha (Vencida, Proxima y Con Tiempo)
            // Capturar fecha actual
            $fechaActual = date("Y-m-d H:i:s");
            // Convertirla en DateTime
            $fechaActualDateTime = new DateTime($fechaActual);
            // Restar las dos fechas, para definir estado
            $fechaDiferencia = $fechaActualDateTime->diff($fechaDBDateTime);

            // El signo %r devuelve el signo (+ o -) de la diferencia y %a es el numero
            $fechaEstado = $fechaDiferencia->format('%r%a');

            // Condicional para aplicar estilos en css
            if ($fechaEstado < 1) {
                $fechaEstado = "vencida"; // La tarea esta vencida o vence ese dia
            } elseif ($fechaEstado >= 1 && $fechaEstado <=3) {
                $fechaEstado = "proximo"; // La tarea tiene un plazo entre 1 dia y 3 dias para ser entregada
            } else {
                $fechaEstado = "conTiempo"; // La tarea tiene un plazo de más de 4 dias para ser entregada
            }


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
                        <div class="fechas" id="'.$fechaEstado.'">
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
                            <a href="../../../Vista/html/estudiante/tareaAsignatura.php?idTarea='.$f['idTarea'].'">Ver más</a>
                        </div>
                    </div>
                </div>
            ';
        };


    }

    // Mostrar la tarea y habilitar la entrega
    function habilitarEntregaTareas(){
        $idTarea = $_GET['idTarea'];
        $objConsultas = new Consultas();
        $filas = $objConsultas->cargarTarea($idTarea);

        foreach($filas as $f){

            // Operación para traer la fecha en este formato Sep 2, 2023
            // Capturar la fecha desde la DB 
            $fechaDB = $f['fecha_vencimiento'];
            // Convertirla en el tipo de dato que se encuentra en la DB, ya que antes de este momento pasa como string (Verificar con  echo gettype($fechaDB); )
            $fechaDBDateTime = new DateTime($fechaDB);
            // Colocar en el formato Sep 2, 2023
            $fechaFormato = $fechaDBDateTime->format('M j, Y');


            // Operación para indicar el color de vencimiento de la fecha (Vencida, Proxima y Con Tiempo)
            // Capturar fecha actual
            $fechaActual = date("Y-m-d H:i:s");
            // Convertirla en DateTime
            $fechaActualDateTime = new DateTime($fechaActual);
            // Restar las dos fechas, para definir estado
            $fechaDiferencia = $fechaActualDateTime->diff($fechaDBDateTime);

            // El signo %r devuelve el signo (+ o -) de la diferencia y %a es el numero
            $fechaEstado = $fechaDiferencia->format('%r%a');

            // Condicional para aplicar estilos en css
            if ($fechaEstado < 1) {
                $fechaEstado = "vencida"; // La tarea esta vencida o vence ese dia
            } elseif ($fechaEstado >= 1 && $fechaEstado <=3) {
                $fechaEstado = "proximo"; // La tarea tiene un plazo entre 1 dia y 3 dias para ser entregada
            } else {
                $fechaEstado = "conTiempo"; // La tarea tiene un plazo de más de 4 dias para ser entregada
            }


            // manejo de archivos 
            $archivos = explode(",", $f['archivos']);


            echo '
                <div class="card-tarea">
                    <div class="card-header">
                        <div class="info-user fila">
                            <img src="'.$f['foto'].'" alt="imagen" enlace="#op1">
                            <p>
                                '.$f['nombres'].' <br>
                                '.$f['apellidos'].'
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="card-cont">
                        <div class="card-info">
                            <img src="../../img/descripcion.png" alt="">
                            <div class="info">
                                <h3>'.$f['titulo'].'</h3>
                                <p>
                                    '.$f['descripcion'].'
                                </p>
                            </div>
                        </div>
                        <div class="card-info">
                            <img src="'.$f['foto'].'" alt="">
                            <div class="fila">
                                <div class="fechas">
                                    <p>
                                        '.$f['fecha_creacion'].'
                                        03 / 09 / 2023
                                    </p>
                                </div>
                                <hr id="fechas">
                                <div class="fechas" id="vencida">
                                    <p>
                                        '.$fechaEstado.'
                                        03 / 09 / 2023
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-info">
                            <img src="../../img/archivos.png" alt="">
            ';

                            foreach($archivos as $archivo){
                                echo '
                                    <div class="card-archivos">
                                        <div class="archivos">
                                            <a href="../../Uploads/Actividades/'.$archivo.'" target="_blank">ARCHIVITOS</a>
                                        </div>
                                    </div>
                                ';
                            }

            echo '
                        </div>
                    </div>
                </div>
            
                <div class="card-tarea">
                <div class="card-header">
                    <div class="info-user fila">
                        <img src="'.$f['foto'].'" alt="imagen" enlace="#op1">
                        <p>
                            '.$f['nombres'].' <br>
                            '.$f['apellidos'].'
                        </p>
                    </div>
                </div>
                <hr>
                <div class="card-formulario">
                    <div class="formulario">
                        <form action="../../../Controlador/entregarTarea.php" method="post" enctype="multipart/form-data" id="formulario">

                            <div class="textarea">
                                <label for="descripcion">Descripción</label>
                                <textarea id="descripcion" cols="30" rows="10"
                                    name="descripcion">Ingrese una descripción</textarea>
                            </div>

                            <div class="file">
                                <label for="archivo">Seleccione un archivo</label>
                                <input type="file" accept=".pdf" name="archivos[]" multiple>
                            </div>

                            <button type="submit" class="enviar">Entregar Tarea</button>
                        </form>
                    </div>
                </div>
            </div>
                  
            ';



                

                

                
            
        };


    }


?>