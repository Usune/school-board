<?php

    require_once('../Modelo/conexion.php');
    require_once('../Modelo/consultas.php');
    
    $descripcion = $_POST['descripcion'];

    if(strlen($descripcion) > 0){

        $archivos = $_FILES['archivos']['name'];
        $archivos_str = implode(",", $archivos);

        $objConsultas = new Consultas();
        $filas = $objConsultas->entregarTarea($descripcion, $archivos_str);

    }else{
        echo '<script>alert("Por favor complete todos los campos")</script>';
        echo '<script>location.href="../Vista/html/estudiante/tareaAsignatura.php?idTarea='.$idTarea.'"</script>';
    }


?>