<?php

    //  require_once() para enlazar las dependencias necesarias
    require_once("../Modelo/conexion.php");
    require_once("../Modelo/consultas.php");

    // Aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del metodo POST y los name de los campos
    $nombre = $_POST['nombre'];
    $idAsignatura = $_POST['idAsignatura'];

    if (strlen($nombre)>0 && strlen($idAsignatura)>0) {

        $objConsultas = new Consultas();
        $result = $objConsultas->actualizarAsigAdmin($nombre, $idAsignatura);

    } else{

        echo '<script>alert("Por favor complete todos los campos")</script>';
        echo '<script>location.href="../Vista/html/Administrador/adminAsigModificar.php?id='.$idAsignatura.'"</script>';

    }

?>