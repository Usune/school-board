<?php

    session_start();

    if(!isset($_SESSION['AUTENTICADO'])){

        echo '<script>alert("Por favor, inicie sesión")</script>';
        echo "<script>location.href='../Extras/inicioSesion.html'</script>";

    }

    if($_SESSION['rol'] != 'Estudiante'){

        echo '<script>alert("No posee los permisos para acceder a esta interfaz")</script>';                

        // history.go(-1)
        echo "<script>history.go(-1)</script>";

    }

?>