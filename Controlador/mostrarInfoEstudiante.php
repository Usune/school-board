<?php
//    session_start();

   function primeraActualizacionEst(){

    $id = $_GET['id'];

    $objConsultas = new ConsultasUsuario();
    $consulta = $objConsultas->buscarUsuario($id);

    foreach($consulta as $f){

        if(strlen($f['correo'])>0){

            switch ($f['rol']){

                case "Administrador":
                    echo "<script>location.href='homeAdmin.php?id=".$f['documento']."'</script>";
                break;
                case "Docente":
                    echo "<script>location.href='homeDoc.php?id=".$f['documento']."'</script>";
                break;
                case "Estudiante":
                    echo "<script>location.href='homeEstu.php?id=".$f['documento']."'</script>";
                break;

            }

        }else {

            echo '
                <div class="col-md-6">
                    <div class="fieldset">
                        <fieldset>
                            <legend id="nom">Nombres</legend>
                        </fieldset>
                        <input type="text" value="'.$f['nombres'].'" placeholder="Nombres" required
                            legend="#nom" name="nombres" readonly>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="fieldset">
                        <fieldset>
                            <legend id="ape">Apellidos</legend>
                        </fieldset>
                        <input type="text" value="'.$f['apellidos'].'" placeholder="Apellidos" required
                            legend="#ape" name="apellidos" readonly>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="fieldset">
                        <fieldset>
                            <legend id="tipo">Tipo de documento</legend>
                        </fieldset>
                        <input type="text" value="'.$f['tipoDoc'].'" placeholder="Tipo de documento" required
                            legend="#tipo" name="tipoDoc" readonly>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="fieldset">
                        <fieldset>
                            <legend id="usu">Documento</legend>
                        </fieldset>
                        <input type="number" value="'.$f['documento'].'" placeholder="Documento" required
                            legend="#usu" name="documento" readonly>
                    </div>

                    <input type="text" value="'.$f['rol'].'" required name="rol" hidden>
                </div>
            ';

        }
    }

}

    //    ASIGNATURAS - TAREAS  

    function navAsignatura(){
        $idEstudiante = $_SESSION['id'];
        $idAsignatura = $_GET['idAsignatura'];
        $objConsultas = new Consultas();
        $filas = $objConsultas->cargarClase($idEstudiante, $idAsignatura);

        foreach ($filas as $f) {
            echo '
                <a href="homeEstu.php">Home</a>
                <a href="homeAsignatura.php?idAsignatura='.$f['idAsignatura'].'"> / '.$f['asignaturaNombre'].'</a>
            ';
        }
    }

    function navTarea(){
        $idTarea = $_GET['idTarea'];
        $objConsultas = new Consultas();
        $filas = $objConsultas->cargarTareaNav($idTarea);

        foreach ($filas as $f) {
            echo '
                <a href="TareaAsignatura.php?idAsignatura='.$f['idTarea'].'"> / '.$f['titulo'].'</a>
            ';
        }
    }

    // Mostrar solo asignaturas a los estudiantes en el aside  
    function mostrarAsignaturasEstudiante(){
        $idEstudiante = $_SESSION['id'];
        $objConsultas = new Consultas();
        $filas = $objConsultas->cargarAsignaturas($idEstudiante);

        foreach ($filas as $fila) {
            echo '
                <li>
                    <a href="homeAsignatura.php?idAsignatura='.$fila['idAsignatura'].'">
                        '.$fila['asignaturaNombre'].'
                    </a>
                </li>
            ';
        }
    }

    // Mostrar informacion de la clase = asignaturas a los estudiantes en el homeAsignatura  
    function mostrarClaseEstudiante(){
        $idEstudiante = $_SESSION['id'];
        $idAsignatura = $_GET['idAsignatura'];
        $objConsultas = new Consultas();
        $filas = $objConsultas->cargarClase($idEstudiante, $idAsignatura);

        foreach ($filas as $f) {
            echo '
                <h2>'.$f['asignaturaNombre'].'</h2>
                <p class="fila">'.$f['nombres'].' '.$f['apellidos'].' - '.$f['aulaNombre'].'</p>
            ';
        }
    }

    // Mostrar tareas de la asignatura a los estudiantes en homeAsignatura 
    function mostrarTareasAsignatura(){
        $idEstudiante = $_SESSION['id'];
        $idAsignatura = $_GET['idAsignatura'];
        $objConsultas = new Consultas();
        $filas = $objConsultas->cargarTareasAsignatura($idEstudiante, $idAsignatura);

        foreach($filas as $f){

            // Formatear la fecha
            $formattedFechaVencimiento = date('M j, Y', strtotime($f['fecha_vencimiento']));
            $formattedHoraVencimiento = date('h:i A', strtotime($f['fecha_vencimiento']));
            
            echo '
            <tr>
                <td>'.$f['titulo'].' </td>
                <td>
                    '.$formattedFechaVencimiento.'<br>'.$formattedHoraVencimiento.' 
                </td>
                <td class="estado '.$f['estadoTarea'].'">
                    <p>
                        '.$f['estadoTarea'].'
                    </p>
                </td>
                <td class="calificacion">'.($f["nota"] !== null ? $f["nota"] : "-").'</td>
                <td class="ultimo">
                    <a href="../../../Vista/html/estudiante/tareaAsignatura.php?idAsignatura='.$f['idAsignatura'].'&idTarea='.$f['idTarea'].'&nombreAsignatura='.$f['asignaturaNombre'].'&tarea='.$f['titulo'].'&idTarea='.$f['idTarea'].'"><img src="../../img/flecha-arriba.svg" alt="" class="verMas"></a>
                </td>
            </tr>
        ';


        };


    }

    // Mostrar la tarea y habilitar la entrega
    function habilitarEntregaTareas(){
        $idEstudiante = $_SESSION['id'];
        $idTarea = $_GET['idTarea'];
        $objConsultas = new Consultas();
        $filas = $objConsultas->cargarTareaConEntregas($idTarea, $idEstudiante);

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
            $archivos = explode(",", $f['tareaArchivos']);


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
                                    '.$f['tareaDescripcion'].'
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
                    <form action="../../../Controlador/entregarTarea.php" method="post" enctype="multipart/form-data"
                    id="formulario">

                        <input type="number" placeholder="idEstudiante"  name="idEstudiante" value="'.$idEstudiante.'" hidden >
                        <input type="number" placeholder="idTarea"   name="idTarea" value="'.$f['idTarea'].'" hidden>

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
            // Formatear la fecha
            $formattedFechaVencimiento = date('M j, Y', strtotime($f['fecha_vencimiento']));
            $formattedHoraVencimiento = date('h:i A', strtotime($f['fecha_vencimiento']));

            echo '
                <tr>
                    <td>'.$f['asignaturaNombre'].'</td>
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
                        '.$formattedFechaVencimiento.'<br>'.$formattedHoraVencimiento.' 
                    </td>
                    <td class="estado '.$f['estadoTarea'].'">
                        <p>
                            '.$f['estadoTarea'].'
                        </p>
                    </td>
                    <td class="ultimo">
                        <a href="../../../Vista/html/estudiante/tareaAsignatura.php?idAsignatura='.$f['idAsignatura'].'&idTarea='.$f['idTarea'].'&nombreAsignatura='.$f['asignaturaNombre'].'&tarea='.$f['titulo'].'&idTarea='.$f['idTarea'].'"><img src="../../img/flecha-arriba.svg" alt="" class="verMas"></a>
                    </td>
                </tr>
            ';
        }
    }

    // Mostrar todas las calificaciones de las tareas
    function mostrarTodasCalificaciones(){
        $idEstudiante = $_SESSION['id'];
        $objConsultas = new Consultas();
        $filas = $objConsultas->cargarTodasTareas($idEstudiante);

        foreach ($filas as $f) {
            // Formatear la fecha
            $formattedFechaVencimiento = date('M j, Y', strtotime($f['fecha_calificacion']));
            $formattedHoraVencimiento = date('h:i A', strtotime($f['fecha_calificacion']));

            echo '
                <tr>
                    <td>'.$f['asignaturaNombre'].'</td>
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
                    <td class="estado '.$f['estadoTarea'].'">
                        <p>
                            '.$f['estadoTarea'].'
                        </p>
                    </td>
                    <td>
                        '.($f["fecha_calificacion"] !== null ? $formattedFechaVencimiento.'<br>'.$formattedHoraVencimiento : "No se ha calificado" ).' 
                    </td>
                    <td class="calificacion">'.($f["nota"] !== null ? $f["nota"] : "-").'</td>
                    <td class="ultimo">
                        <a href="../../../Vista/html/estudiante/tareaAsignatura.php?idAsignatura='.$f['idAsignatura'].'&idTarea='.$f['idTarea'].'&nombreAsignatura='.$f['asignaturaNombre'].'&tarea='.$f['titulo'].'&idTarea='.$f['idTarea'].'"><img src="../../img/flecha-arriba.svg" alt="" class="verMas"></a>
                    </td>
                </tr>
            ';
        }
    }

    // Mostrar todas las observaciones
    function mostrarTodasObservaciones(){
        $idEstudiante = $_SESSION['id'];
        $objConsultas = new Consultas();
        $filas = $objConsultas->cargarTodasObservaciones($idEstudiante);

        foreach ($filas as $f) {

            // Formatear la fecha
            $formattedFecha = date('M j, Y', strtotime($f['fecha']));

            echo '
            <div class="card mb-3 card-usu">

              <div class="row g-0 ">

                <div class="col-md-12 ">
                  <div class="card-body">
                    <h5 class="card-title">
                      '.$formattedFecha.'
                    </h5>
                    <p class="card-text">
                        '.$f['observacion'].'
                    </p>
                    <hr>
                    <div class="usuario">
                      <img src="'.$f['foto'].'" alt="">
                      <p class="card-text">
                        <small class="text-body-secondary">
                            '.$f['nombres'].' '.$f['apellidos'].'
                        </small>
                      </p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            ';
        }
    }



    // FUNCIONES MOSTRAR USUARIOS
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
            echo '<h4 class="errorFiltro">No ha seleccionado ningún filtro. Por favor, elija una opción o limpie la selección para ver resultados.</h4>';
            return;  // No ejecutar la consulta
        }

        $consulta = $objConsultas->cargarUsuariosFiltrados($rol, $estado, $nombres);

        if(!isset($consulta)){
            echo '<h4 class="errorFiltro">No se encontraron usuarios registrados con las características seleccionadas. Por favor, elija otro filtro o limpie la selección para ver resultados.</h4>';

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

    // Mostrar todos los profesores
    function mostrarTodosProfesores(){
        $idEstudiante = $_SESSION['id'];
        $objConsultas = new Consultas();
        $filas = $objConsultas->cargarTodosProfesores($idEstudiante);

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

    // Mostrar los compañeros Filtrado 
    function mostrarCompañerosFiltrados($estado, $nombres){
        $idEstudiante = $_SESSION['id'];

        $objConsultas = new Consultas();

        // Verifica si los parámetros son 'nada' o vacíos
        if ($estado === 'nada' && $nombres === '') {
            echo '<h4 class="errorFiltro">No se encontraron usuarios registrados con las características seleccionadas. Por favor, elija otro filtro o limpie la selección para ver resultados.</h4>';
            return;  
        }

        $consulta = $objConsultas->cargarCompañerosFiltrados($estado, $nombres, $idEstudiante);

        if(!isset($consulta)){
            echo '<h4 class="errorFiltro">No se encontraron usuarios registrados con las características seleccionadas. Por favor, elija otro filtro o limpie la selección para ver resultados.</h4>';

        }else {

            foreach($consulta as $f) {

                $imagen = '../../img/gorra.png';

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

    // Mostrar los profesores Filtrado 
    function mostrarProfesoresFiltrados($estado, $nombres){
        $idEstudiante = $_SESSION['id'];

        $objConsultas = new Consultas();

        // Verifica si los parámetros son 'nada' o vacíos
        if ($estado === 'nada' && $nombres === '') {
            echo '<h4 class="errorFiltro">No se encontraron usuarios registrados con las características seleccionadas. Por favor, elija otro filtro o limpie la selección para ver resultados.</h4>';
            return;  
        }

        $consulta = $objConsultas->cargarProfesoresFiltrados($estado, $nombres, $idEstudiante);

        if(!isset($consulta)){
            echo '<h4 class="errorFiltro">No se encontraron usuarios registrados con las características seleccionadas. Por favor, elija otro filtro o limpie la selección para ver resultados.</h4>';
        }else {

            foreach($consulta as $f) {

                $imagen = '../../img/pizarron.png';


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

  




?>