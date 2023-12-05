<?php

    //  require_once() para enlazar las dependencias necesarias
    require_once("../Modelo/conexion.php");
    require_once("../Modelo/consultas.php");
    

    // Aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del metodo POST y los name de los campos
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $fecha_vencimiento =  $_POST["fecha_V"];
    $idTarea = $_POST["id"];
    $idClase = $_POST['idClase'];

    if (strlen($titulo)>0 && strlen($descripcion)>0 && strlen($fecha_vencimiento)>0 && strlen($idClase)>0) {
        $NombreArchivo = $_FILES['archivos']['name'];
        $archivos = "../../Uploads/Tareas/".$_FILES['archivos']['name'];
        $guardar = "../Vista/Uploads/Tareas/".$_FILES['archivos']['name'];
        $mover = move_uploaded_file($_FILES['archivos']['tmp_name'], $guardar);

        $zonaHoraria = new DateTimeZone('America/Bogota');
        $fechaActual = new DateTime('now', $zonaHoraria);
        $fechaActual = $fechaActual->format('Y-m-d H:i:s');
          
        $objConsultas = new Consultas();
        $result = $objConsultas->ActualizarTarDoc($titulo, $descripcion, $fechaActual, $fecha_vencimiento, $idTarea, $idClase, $archivos,  $NombreArchivo);
        
        }else { 
            echo '<script>alert("Por favor complete todos los campos")</script>';
        
    }


?>