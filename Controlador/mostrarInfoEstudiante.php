<?php
   session_start();

    // Mostrar asignaturas a los estudiantes en el aside  
    function mostrarAsignaturasEstudiante(){
        $documento = $_SESSION['id'];
        $objConsultas = new Consultas();
        $filas = $objConsultas->cargarAsignaturas($documento);

        foreach ($filas as $fila) {
            echo '
                <li><a href="homeAsignatura.php?idAsignatura='.$fila['idAsignatura'].'&nombreAsignatura='.$fila['asignatura'].'">'.$fila['asignatura'].'</a></li>
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
            } elseif ($fechaEstado >= 1 && $fechaEstado <=4) {
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
                                <h3>'.$f['tarea'].'</h3>
                                <p>
                                    '.$f['descripcion'].'
                                </p>
                            </div>
                        </div>
                        <div class="boton">
                            <a href="../../../Vista/html/estudiante/tareaAsignatura.php?idAsignatura='.$f['idAsignatura'].'&idTarea='.$f['idTarea'].'&nombreAsignatura='.$f['asignatura'].'&tarea='.$f['tarea'].'&idTarea='.$f['idTarea'].'">Ver más</a>
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

    // Mostrar todas las tareas
    function mostrarTodasTareas(){
        $idEstudiante = $_SESSION['id'];
        $objConsultas = new Consultas();
        $filas = $objConsultas->cargarTodasTareas($idEstudiante);

        foreach ($filas as $f) {
            echo '
                <tr>
                  <td>'.$f['asignatura'].'</td>
                  <td>
                    <div class="row">
                      <div class="col-sm-12 col-md-6 col-lg-6 imgDoc">
                        <img src="'.$f['fotoDoc'].'" alt="img perfil docente">
                      </div>
                      <div class="col-sm-12 col-md-6 col-lg-6 textDoc">
                        <p>'.$f['nombres'].' '.$f['apellidos'].'</p>
                      </div>
                    </div>
                  </td>
                  <td>'.$f['titulo'].' </td>
                  <td>
                    '.$f['fecha_vencimiento'].' 
                  </td>
                  <td class="'.$f['estadoTarea'].'">
                    <p>
                        '.$f['estadoTarea'].'
                    </p>
                  </td>
                  <td class="ultimo">
                    <a href="../../../Vista/html/estudiante/tareaAsignatura.php?idAsignatura='.$f['idAsignatura'].'&idTarea='.$f['idTarea'].'&nombreAsignatura='.$f['asignatura'].'&tarea='.$f['titulo'].'&idTarea='.$f['idTarea'].'"><img src="../../img/flecha-arriba.svg" alt="" class="verMas"></a>
                  </td>
                </tr>
            ';


        }
    }

    // Mostrar todos los usuarios
    function mostrarTodosUsuarios(){
        $objConsultas = new Consultas();
        $filas = $objConsultas->cargarTodosUsuarios();

        foreach ($filas as $f) {
            $rol = $f['rol'];
            if($rol === 'Administrador'){
                $imagen = '../../img/escritorio.png';
            }elseif ($rol === 'Docente') {
                $imagen = '../../img/pizarron.png';
            }elseif ($rol === 'Estudiante') {
                $imagen = '../../img/gorra.png';
            }

            echo '
                <div class="col">
                    <div class="card h-100 card-usu '.$f['estado'].'">
                        <div class="iconos">
                            ' . (isset($imagen) ? '<img src="'.$imagen.'" alt="">' : '<img src="placeholder.jpg" alt="Placeholder">') . '
                        </div>
                        <div class="fotoUsu">
                            ' . (isset($f['foto']) ? '<img src="'.$f['foto'].'" class="card-img-top" alt="...">' : '<img src="placeholder.jpg" class="card-img-top" alt="Placeholder">') . '
                        </div>
                        <div class="card-body">
                            <p>
                                ' . (isset($f['rol']) ? $f['rol'] : 'Rol no disponible') . '
                            </p>
                            <h5 class="card-title">
                                ' . (isset($f['nombres']) && isset($f['apellidos']) ? $f['nombres'] . ' ' . $f['apellidos'] : 'Nombres y apellidos no disponibles') .'
                            </h5>
                            <p class="card-text">
                                ' . (isset($f['correo']) ? '<a href="">'.$f['correo'].'</a>' : 'Correo no disponible') .'
                            </p>
                            <a href=""><button>Contactar</button></a>
                        </div>
                    </div>
                </div>
            ';

        }
    }
    
    // Mostrar los usuarios Filtrado 
    function mostrarUsuariosFiltrados($rol, $estado, $nombres){

        $objConsultas = new Consultas();

        // Verifica si los parámetros son 'nada' o vacíos
        if ($rol === 'nada' && $estado === 'nada' && $nombres === '') {
            echo '<h4>No ha seleccionado ningún filtro. Por favor, elija una opción o limpie la selección para ver resultados.</h4>';
            return;  // No ejecutar la consulta
        }

        $consulta = $objConsultas->cargarUsuariosFiltrados($rol, $estado, $nombres);

        if(!isset($consulta)){
            echo '<h4>No se encontraron usuarios registrados con las características seleccionadas. Por favor, elija otro filtro o limpie la selección para ver resultados.</h4>';

        }else {

            foreach($consulta as $f) {

                $rol = $f['rol'];
                if($rol === 'Administrador'){
                    $imagen = '../../img/escritorio.png';
                }elseif ($rol === 'Docente') {
                    $imagen = '../../img/pizarron.png';
                }elseif ($rol === 'Estudiante') {
                    $imagen = '../../img/gorra.png';
                }
                
                echo '
                    <div class="col">
                        <div class="card h-100 card-usu '.$f['estado'].'">
                            <div class="iconos">
                                ' . (isset($imagen) ? '<img src="'.$imagen.'" alt="">' : '<img src="placeholder.jpg" alt="Placeholder">') . '
                            </div>
                            <div class="fotoUsu">
                                ' . (isset($f['foto']) ? '<img src="'.$f['foto'].'" class="card-img-top" alt="...">' : '<img src="placeholder.jpg" class="card-img-top" alt="Placeholder">') . '
                            </div>
                            <div class="card-body">
                                <p>
                                    ' . (isset($f['rol']) ? $f['rol'] : 'Rol no disponible') . '
                                </p>
                                <h5 class="card-title">
                                    ' . (isset($f['nombres']) && isset($f['apellidos']) ? $f['nombres'] . ' ' . $f['apellidos'] : 'Nombres y apellidos no disponibles') .'
                                </h5>
                                <p class="card-text">
                                    ' . (isset($f['correo']) ? '<a href="">'.$f['correo'].'</a>' : 'Correo no disponible') .'
                                </p>
                                <a href=""><button>Contactar</button></a>
                            </div>
                        </div>
                    </div>
                ';

            }


        }

    }

    // Mostrar todos los compañeros
    function mostrarTodosCompañeros(){
        $idEstudiante = $_SESSION['id'];
        $objConsultas = new Consultas();
        $filas = $objConsultas->cargarTodosCompañeros($idEstudiante);

        foreach ($filas as $f) {

            echo '
            <tr class="'.$f['estado'].'">
                <td>
                    <img src="'.$f['foto'].'" alt="img perfil">
                </td>
                <td>'.$f['apellidos'].' </td>
                <td>'.$f['nombres'].' </td>
                <td>'.$f['correo'].' </td>
                <td class="ultimo">'.$f['estado'].' </td>
            </tr>
            ';
        }
    }

    // Mostrar todos los profesores
    function mostrarTodosProfesores(){
        $idEstudiante = $_SESSION['id'];
        $objConsultas = new Consultas();
        $filas = $objConsultas->cargarTodosProfesores($idEstudiante);

        foreach ($filas as $f) {

            echo '
                <tr class="'.$f['estado'].'">
                    <td>
                        <img src="'.$f['foto'].'" alt="img perfil">
                    </td>
                    <td>'.$f['apellidos'].' </td>
                    <td>'.$f['nombres'].' </td>
                    <td>'.$f['correo'].' </td>
                    <td class="ultimo">'.$f['estado'].' </td>
                </tr>
            ';
        }
    }

    // Mostrar los compañeros Filtrado 
    function mostrarCompañerosFiltrados($estado, $nombres){
        $idEstudiante = $_SESSION['id'];

        $objConsultas = new Consultas();

        // Verifica si los parámetros son 'nada' o vacíos
        if ($estado === 'nada' && $nombres === '') {
            echo '<h4>No ha seleccionado ningún filtro. Por favor, elija una opción o limpie la selección para ver resultados.</h4>';
            return;  // No ejecutar la consulta
        }

        $consulta = $objConsultas->cargarCompañerosFiltrados($estado, $nombres, $idEstudiante);

        if(!isset($consulta)){
            echo '<h4>No se encontraron usuarios registrados con las características seleccionadas. Por favor, elija otro filtro o limpie la selección para ver resultados.</h4>';

        }else {

            foreach($consulta as $f) {

                echo '
                    <tr class="'.$f['estado'].'">
                        <td>
                            <img src="'.$f['foto'].'" alt="img perfil">
                        </td>
                        <td>'.$f['apellidos'].' </td>
                        <td>'.$f['nombres'].' </td>
                        <td>'.$f['correo'].' </td>
                        <td class="ultimo">'.$f['estado'].' </td>
                    </tr>
                ';
            }


        }

    }

    // Mostrar los profesores Filtrado 
    function mostrarProfesoresFiltrados($estado, $nombres){
        $idEstudiante = $_SESSION['id'];

        $objConsultas = new Consultas();

        // Verifica si los parámetros son 'nada' o vacíos
        if ($estado === 'nada' && $nombres === '') {
            echo '<h4>No ha seleccionado ningún filtro. Por favor, elija una opción o limpie la selección para ver resultados.</h4>';
            return;  // No ejecutar la consulta
        }

        $consulta = $objConsultas->cargarProfesoresFiltrados($estado, $nombres, $idEstudiante);

        if(!isset($consulta)){
            echo '<h4>No se encontraron usuarios registrados con las características seleccionadas. Por favor, elija otro filtro o limpie la selección para ver resultados.</h4>';

        }else {

            foreach($consulta as $f) {

                echo '
                    <tr class="'.$f['estado'].'">
                        <td>
                            <img src="'.$f['foto'].'" alt="img perfil">
                        </td>
                        <td>'.$f['apellidos'].' </td>
                        <td>'.$f['nombres'].' </td>
                        <td>'.$f['correo'].' </td>
                        <td class="ultimo">'.$f['estado'].' </td>
                    </tr>
                ';
            }


        }

    }

  




?>