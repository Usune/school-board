<?php


    require_once("../Modelo/conexion.php");
    require_once("../Modelo/consultas.php"); 


    // Aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del metodo POST y los name de los campos

    // Campos estudiante
    $documento = $_POST['documento'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];
    $rol = $_POST['rol'];
    $clave = $_POST['clave'];

    // Campos acudiente
    $nomAcu = $_POST['nomAcu'];
    $apeAcu = $_POST['apeAcu'];
    $docAcu = $_POST['docAcu'];
    $celAcu = $_POST['celAcu'];
    $corAcu = $_POST['corAcu'];



    if(strlen($telefono)>0 && strlen($direccion)>0 && strlen($correo)>0 && strlen($documento)>0 && strlen($rol)>0 && strlen($clave)>0 && strlen($nomAcu)>0 && strlen($apeAcu)>0 && strlen($docAcu)>0 && strlen($celAcu)>0 && strlen($corAcu)>0 ){

        // var_dump($_POST);

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
        $result = $objConsultas->primeraActualizacionEst($rol, $telefono, $direccion, $correo, $documento, $fotoM, $claveMD, $nomAcu, $apeAcu, $docAcu, $celAcu, $corAcu);

    }else {

        echo '<script>alert("Por favor complete todos los campos")</script>';
        echo '<script>location.href="../Vista/html/Administrador/homDoc.php?id='.$documento.'"</script>';

    }

?>




