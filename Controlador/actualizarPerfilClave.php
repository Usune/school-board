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
        
        if(strlen($clave) >= 8){
            if($clavedb == MD5($claveActual)) {

                if($claveNueva == $claveNueva2){
        
                    $claveMD = MD5($claveNueva);
                    $objConsultas = new Consultas();
                    $result = $objConsultas->actualizarClave($documento ,$claveMD);
            
                }else {
                    echo '<script>alert("Las claves no coninciden, intentelo nuevamente")</script>';
                    if($_SESSION['rol'] == 'Administrador') {
                        echo '<script>location.href="../Vista/html/Administrador/perfilClave.php?id='.$documento.'"</script>';
                    }
            
                    if($_SESSION['rol'] == 'Docente') {
                        echo '<script>location.href="../Vista/html/Docente/perfilClave.php?id='.$documento.'&idCurso=&idClase="</script>';
                    }
            
                    if($_SESSION['rol'] == 'Estudiante') {
                        echo '<script>location.href="../Vista/html/Estudiante/perfilClave.php?id='.$documento.'"</script>';
                    }
                }
            }else{
                echo '<script>alert("La clave actual ingresada no es correcta, intentelo nuevamente")</script>';
                if($_SESSION['rol'] == 'Administrador') {
                    echo '<script>location.href="../Vista/html/Administrador/perfilClave.php?id='.$documento.'"</script>';
                }
        
                if($_SESSION['rol'] == 'Docente') {
                    echo '<script>location.href="../Vista/html/Docente/perfilClave.php?id='.$documento.'&idCurso=&idClase="</script>';
                }
        
                if($_SESSION['rol'] == 'Estudiante') {
                    echo '<script>location.href="../Vista/html/Estudiante/perfilClave.php?id='.$documento.'"</script>';
                }
            }
        }

        }else {

            echo '<script>alert("Recuerde que la clave debe tener mínimo 8 carácteres")</script>';
            if($_SESSION['rol'] == 'Administrador') {
                echo '<script>location.href="../Vista/html/Administrador/perfilClave.php?id='.$documento.'"</script>';
            }
    
            if($_SESSION['rol'] == 'Docente') {
                echo '<script>location.href="../Vista/html/Docente/perfilClave.php?id='.$documento.'&idCurso=&idClase="</script>';
            }
    
            if($_SESSION['rol'] == 'Estudiante') {
                echo '<script>location.href="../Vista/html/Estudiante/perfilClave.php?id='.$documento.'"</script>';
            }
        }

        

        
    


?>