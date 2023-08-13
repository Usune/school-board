<?php

    //  require_once() para enlazar las dependencias necesarias
    require_once("../Modelo/conexion.php");
    require_once("../Modelo/consultas.php");

    // Aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del metodo POST y los name de los campos
    $usuario = $_POST['usuario'];
    $claveMd = md5($_POST['clave']);

    if (strlen($usuario)>0 && strlen($claveMd)>0) {
        
        $objConsultas = new Consultas();

        $result = $objConsultas->validarInicioSesion($usuario, $claveMd);

    } else {

        echo '<script>alert("Por favor, complete todos los campos")</script>';
        echo '<script>location.href="../Vista/html/Extras/InicioSesion.html"</script>';

    }

?>