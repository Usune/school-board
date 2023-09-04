<?php

    //  require_once() para enlazar las dependencias necesarias
    require_once("../Modelo/conexion.php");
    require_once("../Modelo/generarClave.php");

    $documento = $_POST['documento'];
    $correo = $_POST['correo'];
    
    if (strlen($documento)>0 && strlen($correo)>0) {

        $objClave = new GenerarClave();
        $result = $objClave->nuevaClave($documento, $correo);

        // if(!isset($result)){
        //     echo '<script>alert("El usuario ingresado o correo no existe")</script>';
        //     echo '<script>location.href="../Vista/html/Extras/olvido-clave.html"</script>';
        // }
        
    } else{

        echo '<script>alert("Digite todos los campos")</script>';
        echo '<script>location.href="../Vista/html/Extras/olvido-clave.html"</script>';

    }

?>