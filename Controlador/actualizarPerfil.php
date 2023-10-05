<?php

    //  require_once() para enlazar las dependencias necesarias
    require_once("../Modelo/conexion.php");
    require_once("../Modelo/consultas.php");


    // Aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del metodo POST y los name de los campos
    $documento = $_POST['documento'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];

    if (strlen($telefono)>0 && strlen($direccion)>0 && strlen($correo)>0 && strlen($documento)>0) {

        $objConsultas = new Consultas();
        $result = $objConsultas->actualizarPerfil($telefono, $direccion, $correo, $documento);

    } else{

        echo '<script>alert("Por favor complete todos los campos")</script>';
        echo '<script>location.href="../Vista/html/Administrador/perfil.php?id='.$documento.'"</script>';

    }

?>