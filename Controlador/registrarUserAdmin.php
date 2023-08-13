<?php

    //  require_once() para enlazar las dependencias necesarias
    require_once("../Modelo/conexion.php");
    require_once("../Modelo/consultas.php");

    // Aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del metodo POST y los name de los campos
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $rol = $_POST['rol'];
    $tipoDoc = $_POST['tipoDoc'];
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    $estado = 'activo';

    if (strlen($nombres)>0 && strlen($apellidos)>0 && strlen($rol)>0 && strlen($tipoDoc)>0 && strlen($usuario)>0 && ($clave)>0 && ($estado)>0) {

        $claveMd = md5($clave);

        $objConsultas = new Consultas();

        $result = $objConsultas->insertarUsuAdmin($nombres, $apellidos, $rol, $tipoDoc, $usuario, $claveMd, $estado);

    } else{

        echo '<script>alert("Por favor complete todos los campos")</script>';
        echo '<script>location.href="../Vista/html/Administrador/adminUsuRegistro.html"</script>';

    }

?>