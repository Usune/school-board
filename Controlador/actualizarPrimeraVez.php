<?php

    //  require_once() para enlazar las dependencias necesarias
    require_once("../Modelo/conexion.php");
    require_once("../Modelo/consultas.php");
    session_start();

    // Aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del metodo POST y los name de los campos
    $documento = $_POST['documento'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];
    $rol = $_POST['rol'];
    $clave = $_POST['clave'];

    if(strlen($telefono)>0 && strlen($direccion)>0 && strlen($correo)>0 && strlen($documento)>0 && strlen($rol)>0 && strlen($clave)>0) {

        $claveMD = MD5($clave);
        $foto = $_FILES['foto']['name'];
        
        if(strlen($foto)>0) {

            $fotoM = '../../Uploads/Usuario/'.$_FILES['foto']['name'];
            // MOVEMOS EL ARCHIVO A LA CARPETA UPLOADS CON LA FUNCIÓN DE PHP move_uploaded_file()
            // tmp_name: NOMBRE TEMPORAL DEL ARCHIVO
            $mover = move_uploaded_file($_FILES['foto']['tmp_name'], '../Vista/Uploads/Usuario/'.$foto.'');

        }else {
            $fotoM = '../../Uploads/Usuario/fotoUsuario.jpg';
        } 

        $objConsultas = new ConsultasUsuario();
        $result = $objConsultas->primeraActualizacion($rol, $telefono, $direccion, $correo, $documento, $fotoM, $claveMD);

    }else {
        echo '<script>alert("Por favor complete todos los campos")</script>';

        if($_SESSION['rol'] == 'Administrador') {
            echo '<script>location.href="../Vista/html/Administrador/registroPrimero.php?id='.$documento.'"</script>';
        }

        if($_SESSION['rol'] == 'Docente') {
            echo '<script>location.href="../Vista/html/Docente/registroPrimero.php?id='.$documento.'"</script>';
        }

        if($_SESSION['rol'] == 'Estudiante') {
            echo '<script>location.href="../Vista/html/Estudiante/registroPrimero.php?id='.$documento.'"</script>';
        }

    }

?>