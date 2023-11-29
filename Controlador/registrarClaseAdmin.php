<?php

    //  require_once() para enlazar las dependencias necesarias
    require_once("../Modelo/conexion.php");
    require_once("../Modelo/consultas.php");

    // Aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del metodo POST y los name de los campos
    $idCurso = $_POST['curso'];
    $idAsignatura = $_POST['asignatura'];
    $idDocente = $_POST['docente'];
    $idAula = $_POST['aula'];
    $descripcion = $_POST['descripcion'];

    if (strlen($idCurso)>0 && strlen($idAsignatura)>0 && strlen($idDocente)>0 && strlen($idAula)>0 && strlen($descripcion)>0) {

        $objConsultas = new Consultas();
        $result = $objConsultas->insertarClaseAdmin($idCurso, $idAsignatura, $idDocente, $idAula, $descripcion);

    } else{

        echo '<script>alert("Por favor complete todos los campos")</script>';
        echo '<script>location.href="../Vista/html/Administrador/adminClase.php"</script>';

    }

?>