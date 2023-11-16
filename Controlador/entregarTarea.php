<?php

    require_once('../Modelo/conexion.php');
    require_once('../Modelo/consultas.php');
    
    $descripcion = $_POST['descripcion'];
    $idEstudiante = $_POST['idEstudiante'];
    $idTarea = $_POST['idTarea'];
    $fechaEntrega = date("Y-m-d H:i:s");

    if(strlen($idEstudiante) > 0 &&  strlen($idTarea) > 0 &&  strlen($fechaEntrega) > 0 && strlen($descripcion) > 0){

        // Nombre del archivo 
        $archivos = $_FILES['archivos']['name'];
        // Separarlo por comas
        $archivos_str = implode(",", $archivos);

        // carpeta de destino
        $carpeta_destino = '../Vista/Uploads/Entregas/';

        // foreach porque son varios archivos 
        // $tmp_name: nombre temporal de los archivos (Generado por el servidor web)
        // key: índice del archivo en el array

        foreach ($_FILES['archivos']['tmp_name'] as $key => $tmp_name) {
            $nombre_archivo = $_FILES['archivos']['name'][$key];
            $ruta_archivo = $carpeta_destino . $nombre_archivo;
            move_uploaded_file($tmp_name, $ruta_archivo);
        }
        

        $objConsultas = new Consultas();
        $filas = $objConsultas->insertarEntregaTarea($idEstudiante, $idTarea, $fechaEntrega, $descripcion, $archivos_str);

    }else{
        echo '<script>alert("Por favor complete todos los campos")</script>';
        echo '<script>location.href="../Vista/html/estudiante/tareaAsignatura.php?idTarea='.$idTarea.'"</script>';
    }


?>