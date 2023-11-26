<?php

    require_once('../Modelo/conexion.php');
    require_once('../Modelo/consultas.php');

    session_start();
    $idEstudiante = $_SESSION['id'];

    $idTarea = $_POST['idTarea'];
    $descripcion = $_POST['descripcion'];
    $fechaEntrega = date("Y-m-d H:i:s");

    if(strlen($idEstudiante) > 0 &&  strlen($idTarea) > 0 &&  strlen($fechaEntrega) > 0 && strlen($descripcion) > 0){

        $carpeta_destino = '../Vista/Uploads/Entregas/';

        // Nombre del archivo 
        $archivos = $_FILES['archivos']['name'];

        $archivos_str = null;

        // Verifica si hay archivos antes de intentar procesarlos
        if (!empty($_FILES['archivos']['tmp_name'][0])) {
            foreach ($_FILES['archivos']['name'] as $key => $nombre_archivo) {
                $ruta_archivo = $carpeta_destino . $nombre_archivo;
                move_uploaded_file($_FILES['archivos']['tmp_name'][$key], $ruta_archivo);

                // Concatena el nombre del archivo a la cadena
                $archivos_str .= $nombre_archivo . ',';
            }

            // Elimina la última coma si hay archivos
            $archivos_str = rtrim($archivos_str, ',');
        }else {
            $archivos_str = null; // Define la variable como null si no hay archivos
        }


        $objConsultas = new Consultas();
        $filas = $objConsultas->actualizarEntregaTarea($idEstudiante, $idTarea, $fechaEntrega, $descripcion, $archivos_str);

    }else{
        echo '<script>alert("Por favor complete todos los campos")</script>';
        echo '<script>location.href="../Vista/html/estudiante/tareaAsignatura.php?idTarea='.$idTarea.'"</script>';
    }


?>