<?php
//    session_start();


    //CONSULTAS PERFIL
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
                <a href="#" onclick="irAtras()"> / '.$f['asignaturaNombre'].'</a>
            ';
        }
    }

    function navTarea(){
        $idTarea = $_GET['idTarea'];
        $objConsultas = new Consultas();
        $filas = $objConsultas->cargarTareaNav($idTarea);

        foreach ($filas as $f) {
            echo '
                <a href="homeEstu.php">Home</a>
                <a href="#" onclick="irAtras()"> / '.$f['asignaturaNombre'].'</a>
                <a href="#"> / '.$f['titulo'].'</a>
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


        // Verificar si no hay tareas
        if(empty($filas)){
            echo '<p>No hay tareas</p>';
            return; // Detener la ejecución si no hay tareas
        }

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
                        <a href="../../../Vista/html/estudiante/tareaAsignatura.php?idTarea='.$f['idTarea'].'">
                            <img src="../../img/flecha-arriba.svg" alt="" class="verMas">
                        </a>
                    </td>
                </tr>
            ';


        };


    }

    // Mostrar la tarea y habilitar la entrega
    function mostrarTareaConEntrega(){
        $idEstudiante = $_SESSION['id'];
        $idTarea = $_GET['idTarea'];
        $objConsultas = new Consultas();
        $filas = $objConsultas->cargarTareaConEntregas($idTarea, $idEstudiante);

        foreach($filas as $f){

            // MANEJO DE FECHAS

            // Capturar la fecha desde la DB 
            $fechaDB = $f['fecha_vencimiento'];

            // Formatear la fecha para aspecto visual - 15/10/2023
            $fechaFormateada = date('d/m/Y', strtotime($fechaDB));

            // Convertirla en el tipo de dato que se encuentra en la DB, ya que antes de este momento pasa como string (Verificar con  echo gettype($fechaDB); )
            $fechaDBDateTime = new DateTime($fechaDB);


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
                $fechaEstado = "rojo"; // La tarea esta vencida o vence ese dia
            } elseif ($fechaEstado >= 1 && $fechaEstado <=3) {
                $fechaEstado = "amarillo"; // La tarea tiene un plazo entre 1 dia y 3 dias para ser entregada
            } else {
                $fechaEstado = "verde"; // La tarea tiene un plazo de más de 4 dias para ser entregada
            }


            $notaEstado = $f['nota'];

            // Condicional para aplicar estilos en css a la nota
            if ($notaEstado < 1) {
                $notaEstado = "rojo"; // La tarea esta vencida o vence ese dia
            } elseif ($notaEstado >= 1 && $notaEstado <=3) {
                $notaEstado = "amarillo"; // La tarea tiene un plazo entre 1 dia y 3 dias para ser entregada
            } else {
                $notaEstado = "verde"; // La tarea tiene un plazo de más de 4 dias para ser entregada
            }


            // Manejo de archivos 
            $archivos = explode(",", $f['tareaArchivos']);
            $archivosEntrega = explode(",", $f['entregaArchivos']);


            $estadoEntrega = $f['estadoTarea'];

            

            switch ($estadoEntrega) {
                case 'entregada':
                    echo '
                        <!-- Card Tarea Sola -->
                        <div class="row centrado">
                            <div class="card mb-3 card-tareas">
                                <div class="card-body">
                                <div class="row contEtiquetas">
                    
                                    <div class="col-md-6">
                                    <div class="row infoDoc">
                                        <div class="col-md-2">
                                        <img src="'.$f['foto'].'" alt="">
                                        </div>
                                        <div class="col-md-10">
                                        <p>Docente '.$f['nombres'].' '.$f['apellidos'].'</p>
                                        </div>
                                    </div>
                                    </div>
                    
                                    <div class="col-md-6 fechasCont">
                                    <p class="'.$fechaEstado.'">'.$fechaFormateada.'</p>
                                    </div>
                    
                                </div>
                    
                                <h5 class="card-title card-titulo">
                                    '.$f['titulo'].'
                                </h5>
                    
                    
                                <p class="card-text card-texto">
                                    '.$f['tareaDescripcion'].'
                                </p>
                    
                                <div class="row">';

                                if ((strlen(trim($archivos[0])) == 0) ) {
                                    echo '
                                    <div class="col-md-4">
                                        <div class="cont-archivo-null">
                                            <p>Sin archivos</p>
                                        </div>
                                    </div>
                                    ';
                                }else{
                                
                                
                                    foreach ($archivos as $archivo) {
                                        echo '
                                        <div class="col-md-4">
                                            <div class="cont-archivo">
                                                <a href="../../Uploads/Actividades/'.$archivo.'" target="_blank">'.$archivo.'</a>
                                            </div>
                                        </div>
                                        ';
                                    };
                                }

                                    echo '
                                    <div class="row">
                                
                                </div>
                    
                                </div>
                            </div>
                        </div>
                    ';

                    echo '
                        <!-- Card Entrega -->
                        <h2>Entrega</h2>
                            <div class="card mb-3 card-tareas">
                                <div class="card-body">
                                <div class="row contEtiquetas">
                    
                                    <div class="col-md-6">
                                    <div class="row infoDoc">
                                        <div class="col-md-2">
                                        <img src="'.$f['eFoto'].'" alt="">
                                        </div>
                                        <div class="col-md-10">
                                        <p>Estudiante '.$f['eNombres'].' '.$f['eApellidos'].'</p>
                                        </div>
                                    </div>
                                    </div>
                    
                                    <div class="col-md-6 fechasCont">
                                    <p class="'.($notaEstado !== null ? $notaEstado : ' ').'">'.($f['nota'] !== null ? $f['nota'] : "Sin calificación").'</p>
                                    </div>
                    
                                </div>
                    
                                <p class="card-text card-texto">
                                    '.$f['descripcion'].'
                                </p>
                    
                                <div class="row">';

                                
                                if ((strlen(trim($archivosEntrega[0])) == 0) ) {
                                        echo '
                                        <div class="col-md-4">
                                            <div class="cont-archivo-null">
                                                <p>Sin archivos</p>
                                            </div>
                                        </div>
                                        ';
                                }else{

                                    foreach ($archivosEntrega as $archivo) {


                                        echo '
                                        <div class="col-md-4">
                                            <div class="cont-archivo">
                                                <a href="../../Uploads/Entregas/'.$archivo.'" target="_blank">'.$archivo.'</a>
                                            </div>
                                        </div>
                                        ';
                                    }

                               
                                };
                                


                                    echo '
                                    <div class="row">
                                    <div class="col-md-12">
                                    <button type="button" class="btn btnPrincipal" data-bs-toggle="modal" data-bs-target="#modalEntregaModificar">
                                        Modificar
                                    </button>
                                    </div>
                                </div>
                    
                                </div>
                            </div>
                    ';
                break;

                case 'pendiente':
                    echo '
                        <!-- Card Tarea Sola -->
                        <div class="row centrado">
                            <div class="card mb-3 card-tareas">
                                <div class="card-body">
                                    <div class="row contEtiquetas">
                        
                                        <div class="col-md-6">
                                        <div class="row infoDoc">
                                            <div class="col-md-2">
                                            <img src="'.$f['foto'].'" alt="">
                                            </div>
                                            <div class="col-md-10">
                                            <p>Docente '.$f['nombres'].' '.$f['apellidos'].'</p>
                                            </div>
                                        </div>
                                        </div>
                        
                                        <div class="col-md-6 fechasCont">
                                        <p class="'.$fechaEstado.'">'.$fechaFormateada.'</p>
                                        </div>
                        
                                    </div>
                    
                                    <h5 class="card-title card-titulo">
                                        '.$f['titulo'].'
                                    </h5>
                    
                    
                                    <p class="card-text card-texto">
                                        '.$f['tareaDescripcion'].'
                                    </p>
                    
                                    <div class="row">';

                                    if ((strlen(trim($archivos[0])) == 0) ) {
                                        echo '
                                        <div class="col-md-4">
                                            <div class="cont-archivo-null">
                                                <p>Sin archivos</p>
                                            </div>
                                        </div>
                                        ';
                                    }else{

                                        foreach ($archivos as $archivo) {
                                            echo '
                                            <div class="col-md-4">
                                                <div class="cont-archivo">
                                                    <a href="../../Uploads/Actividades/'.$archivo.'" target="_blank">'.$archivo.'</a>
                                                </div>
                                            </div>
                                            ';
                                        };
                                    }

                                        echo '
                                        <div class="row">
                                            <button type="button" class="btn btnPrincipal" data-bs-toggle="modal" data-bs-target="#modalEntrega">
                                                Entregar
                                            </button>
                                        </div>
                                    </div>
                    
                                </div>
                            </div>
                        </div>
                    ';
                break;
            }

            echo '
            <!-- Modal Entregar-->
            <div class="modal fade" id="modalEntrega" tabindex="-1" aria-labelledby="modalEntrega" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalEntrega">Entrega</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="../../../Controlador/registrarEntrega.php" method="post" enctype="multipart/form-data">

                            <input type="number" name="idTarea" value="'.$idTarea.'" hidden>

                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="name">Descripción:</label>
                                        <textarea class="form-control" name="descripcion" rows="10" required></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="fieldset">
                                            <fieldset>
                                                <legend id="fileLegen">Adjunta Archivos</legend>
                                            </fieldset>
                                            <input type="file" id="fileInput" class="fileInput"
                                                accept=".jpg, .jpeg, .png, .pdf" name="archivos[]" onchange="checkFile()"
                                                legend="#fileLegen" multiple>
                                            <label for="fileInput" class="fileLabel">Adjunta Archivos</label>
                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div class="row modal-footer">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btnAtras" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <img src="../../img/volver.svg" alt="volver">
                                            Atrás
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btnPrincipal">Entregar</button>
                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>


            <!-- Modal Modificar -->
            <div class="modal fade" id="modalEntregaModificar" tabindex="-1" aria-labelledby="modalEntregaModificar" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalEntregaModificar">Modificar Entrega</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="../../../Controlador/actualizarEntrega.php" method="post" enctype="multipart/form-data">

                            <input type="number" name="idTarea" value="'.$idTarea.'" hidden>

                            <div class="modal-body">

                            <p class="rojo">¡Hola Estudiante!

                            Recuerda subir todos tus documentos necesarios. Los datos anteriores se borrarán pronto. ¡Gracias por tu cooperación y éxito en tus estudios!</p>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="name">Descripción:</label>
                                        <textarea class="form-control" name="descripcion" rows="10" required >'.$f['entregaDescripcion'].'</textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="fieldset">
                                            <fieldset>
                                                <legend id="fileLegen">Adjunta Archivos</legend>
                                            </fieldset>
                                            <input type="file" id="fileInput" class="fileInput"
                                                accept=".jpg, .jpeg, .png, .pdf" name="archivos[]" onchange="checkFile()"
                                                legend="#fileLegen" multiple>
                                            <label for="fileInput" class="fileLabel">Adjunta Archivos</label>
                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div class="row modal-footer">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btnAtras" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <img src="../../img/volver.svg" alt="volver">
                                            Atrás
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btnPrincipal">Modificar Entrega</button>
                                    </div>
                                </div>

                            </div>
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

    // Mostrar el acudiente
    function mostrarAcudienteEst(){
        $idEstudiante = $_SESSION['id'];
        $objConsultas = new Consultas();
        $filas = $objConsultas->cargarAcudienteEstu($idEstudiante);

        foreach ($filas as $f) {
            echo '
                <form action="../../../Controlador/actualizarAcudienteEst.php" method="post">

                    <!-- general -->
                    <div class="row g-0 card-usu">

                    <div class="col-md-12 ">
                        <div class="card-body">
                        <h5 class="card-title">
                            Información General
                        </h5>
                        <hr>
                        <div class="row">
                            <p class="card-text">
                            Para garantizar una experiencia segura y efectiva, te animamos a ingresar información precisa
                            sobre tu acudiente. La exactitud de estos datos es crucial para cualquier comunicación futura.
                            </p>

                            <div class="row g-2">
                            <div class="col-md-6">
                                <div class="fieldset">
                                <fieldset>
                                    <legend id="nomAcu">Nombres</legend>
                                </fieldset>
                                <input type="text" placeholder="Nombres" required legend="#nomAcu" name="nomAcu" value="'.$f['nombres'].'">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="fieldset">
                                <fieldset>
                                    <legend id="apeAcu">Apellidos</legend>
                                </fieldset>
                                <input type="text" placeholder="Apellidos" required legend="#apeAcu" name="apeAcu" value="'.$f['apellidos'].'">
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="fieldset">
                                <fieldset>
                                    <legend id="docAcu">Documento</legend>
                                </fieldset>
                                <input type="text" placeholder="Documento" required legend="#docAcu" name="docAcu" value="'.$f['documento'].'">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="fieldset">
                                <fieldset>
                                    <legend id="celAcu">Número de celular</legend>
                                </fieldset>
                                <input type="text" placeholder="Número de celular" required legend="#celAcu" name="celAcu" value="'.$f['telefono'].'">
                                </div>
                            </div>
                            </div>

                        </div>
                        </div>
                    </div>

                    </div>

                    <br>

                    <!-- correo -->
                    <div class="row g-0 card-usu">

                    <div class="col-md-12 ">
                        <div class="card-body">
                        <h5 class="card-title">
                            Correo
                        </h5>
                        <hr>
                        <div class="row">
                            <p class="card-text">
                            La dirección de correo es fundamental para que tu acudiente realice un seguimiento adecuado. Te
                            instamos a ingresar esta información con precisión, ya que nos permite mantener una comunicación
                            efectiva y garantizar el mejor soporte posible.
                            </p>

                            <div class="row g-2">

                            <div class="col-md-12">
                                <div class="fieldset">
                                <fieldset>
                                    <legend id="corAcu">Correo electrónico </legend>
                                </fieldset>
                                <input type="email" placeholder="Correo electrónico " required legend="#corAcu"
                                    name="corAcu" value="'.$f['correo'].'">
                                </div>
                            </div>

                            </div>

                        </div>
                        </div>
                    </div>

                    <div class="row botones">
                        <div class="col-md-4">
                        <button type="button" class="btnAtras" data-bs-dismiss="modal" aria-label="Close">
                            <img src="../../img/volver.svg" alt="volver">
                            Atrás
                        </button>
                        </div>
                        <div class="col-md-8">
                        <button type="submit" class="btnPrincipal">Modificar</button>
                        </div>
                    </div>

                    </div>

                </form>
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

    // Mostrar todos los comunicados 
    function mostrarComunicados(){
        $idEstudiante = $_SESSION['id'];
        $objConsultas = new Consultas();
        $filas = $objConsultas->cargarComunicadosEstu($idEstudiante);

        if(!isset($filas)){
            echo '<h4 class="errorFiltro">No se encontraron comunicados registrados</h4>';
        }else {

            foreach($filas as $f) {

                $fechaDB = $f['fecha'];
                $fechaFormateada = date('M d, Y', strtotime($fechaDB));

                echo '
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <div class="card card-comu">
                        <div class="card-body ">
                            <div class="row">
                            <div class="col-md-12 card-icono">
                                <img src="../../img/megafonoEst.svg" alt="Icono de Megafono">
                            </div>
                            </div>
                            <div class="row infoUsu">
                            <div class="col-md-2 ">
                                <img src="'.$f['foto'].'" alt="Foto Usuario">
                            </div>
                            <div class="col-md-10 ">
                                <p>
                                <strong>
                                    '.$f['nombres'].' '.$f['apellidos'].', <br>
                                    Comunica :
                                </strong>
                                </p>
                            </div>
                            </div>
                            <h5 class="card-title">
                                '.$f['titulo'].'
                            </h5>
                            <p class="card-text">
                            Estimada comunidad educativa,
                            <br>
                                '.$f['descripcion'].'
                            </p>
                            <div class="cont-archivo">
                                <a href="../../Uploads/Comunicados/">Descargar</a>
                            </div>
                            <div class="fechaComu">
                                <p>'.$fechaFormateada.'</p>
                            </div>
                        </div>
                        </div>
                    </div>
                ';

             
            }


        }

    }


  




?>