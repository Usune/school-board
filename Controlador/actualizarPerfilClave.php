<?php

    //  require_once() para enlazar las dependencias necesarias
    require_once("../Modelo/conexion.php");
    require_once("../Modelo/consultas.php");

    session_start();

    $rol = $_SESSION['rol'];

    $documento = $_POST['documento'];
    $claveActual = $_POST['claveActual'];
    $claveNueva = $_POST['claveNueva'];
    $claveNueva2 = $_POST['claveNueva2'];


    if (strlen($documento)>0 && strlen($claveActual)>0 && strlen($claveNueva)>0 && strlen($claveNueva2)>0) {

        $objConsultas = new Consultas();
        $result = $objConsultas->mostrarUsuarioAdmin($documento);
        
        foreach($result as $f) {
            $clavedb = $f['clave'];
        }
        
        if($clavedb == MD5($claveActual)) {

            if($claveNueva == $claveNueva2){
    
                $claveMD = MD5($claveNueva);
                $objConsultas = new Consultas();
                $result = $objConsultas->actualizarClave($documento ,$claveMD);
        
            }else {
    
                switch ($rol) {
                case 'Administrador':
                        echo '<script>alert("Las claves no coninciden, intentelo nuevamente")</script>';
                        echo '<script>location.href="../Vista/html/Administrador/adminPerfilClave.php?id='.$documento.'"</script>';
                    break;

                case 'Docente':
                    echo '<script>alert("Las claves no coninciden, intentelo nuevamente")</script>';
                    echo '<script>location.href="../Vista/html/Docente/PerfilClave.php?id='.$documento.'"</script>';
                break;

                case 'Estudiante':
                    echo '<script>alert("Las claves no coninciden, intentelo nuevamente")</script>';
                    echo '<script>location.href="../Vista/html/Estudiante/PerfilClave.php?id='.$documento.'"</script>';
                break;
    
            }
        }

        }else {

            switch ($rol) {
                case 'Administrador':
                        echo '<script>alert("La clave actual ingresada no es correcta, intentelo nuevamente")</script>';
                        echo '<script>location.href="../Vista/html/Administrador/adminPerfilClave.php?id='.$documento.'"</script>';
                    break;

                case 'Docente':
                    echo '<script>alert("La clave actual ingresada no es correcta, intentelo nuevamente")</script>';
                    echo '<script>location.href="../Vista/html/Docente/PerfilClave.php?id='.$documento.'"</script>';
                break;

                case 'Estudiante':
                    echo '<script>alert("La clave actual ingresada no es correcta, intentelo nuevamente")</script>';
                    echo '<script>location.href="../Vista/html/Estudiante/PerfilClave.php?id='.$documento.'"</script>';
                break;

            }
    

        }
    }


?>