<?php

    //  require_once() para enlazar las dependencias necesarias
    require_once("../Modelo/conexion.php");
    require_once("../Modelo/consultas.php");

    // Aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del metodo POST y los name de los campos
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $rol = $_POST['rol'];
    $tipoDoc = $_POST['tipoDoc'];
    $documento = $_POST['documento'];
    $clave = $_POST['clave'];
    $estado = 'activo';

    if (strlen($nombres)>0 && strlen($apellidos)>0 && strlen($rol)>0 && strlen($tipoDoc)>0 && strlen($documento)>0 && strlen($clave)>0 && strlen($estado)>0) {

        $claveMd = md5($clave);

        $objConsultas = new Consultas();
        $result = $objConsultas->insertarUsuAdmin($nombres, $apellidos, $rol, $tipoDoc, $documento, $claveMd, $estado);

    } else{

        echo '<script>alert("Por favor complete todos los campos")</script>';
        echo '<script>location.href="../Vista/html/Administrador/adminUsuRegistro.php"</script>';

    }

?>