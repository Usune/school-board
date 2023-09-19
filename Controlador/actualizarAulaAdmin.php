<?php

    //  require_once() para enlazar las dependencias necesarias
    require_once("../Modelo/conexion.php");
    require_once("../Modelo/consultas.php");

    // Aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del metodo POST y los name de los campos
    $nombre = $_POST['nombre'];
    $idAula = $_POST['idAula'];

    if (strlen($nombre)>0 && strlen($idAula)>0) {

        $objConsultas = new Consultas();
        $result = $objConsultas->actualizarAulaAdmin($nombre, $idAula);

    } else{

        echo '<script>alert("Por favor complete todos los campos")</script>';
        echo '<script>location.href="../Vista/html/Administrador/adminAulaModificar.php?id='.$idAula.'"</script>';

    }

?>