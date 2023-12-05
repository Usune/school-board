<?php

    //  require_once() para enlazar las dependencias necesarias
    require_once("../Modelo/conexion.php");
    require_once("../Modelo/consultas.php");
    require_once('../Modelo/seguridadDoc.php');

    // Aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del metodo POST y los name de los campos
    $observacion = $_POST['observacion'];
    $idObservacion = $_POST['idObservacion'];
    $idEstudiante = $_POST['idEstudiante'];
    $idAutor = $_POST['idAutor'];
    $idClase = $_POST['idClase'];
    session_start();

    if (strlen($observacion)>0 && strlen($idObservacion)>0 && strlen($idEstudiante)>0) {

        if ($idAutor == $_SESSION['id']){

            $objConsultas = new Consultas();
            $result = $objConsultas->actualizarObserDoc($observacion, $idObservacion, $idEstudiante, $idClase);

        } else{

            echo '<script>alert("No es posible modificar observaciones que no son de su autoria")</script>';
            echo '<script>location.href="../Vista/html/Docente/docObser.php?documento='.$idEstudiante.'&idClase='.$idClase.'"</script>';

        }

    } else{

        echo '<script>alert("Por favor complete todos los campos")</script>';
        echo '<script>location.href="../Vista/html/Docente/docObser.php?documento='.$idEstudiante.'&idClase='.$idClase.'"</script>';

    }

?>