<?php


    require_once("../Modelo/conexion.php");
    require_once("../Modelo/consultas.php"); 


    // Aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del metodo POST y los name de los campos

    session_start();
    $idEstudiante = $_SESSION['id'];

    // Campos acudiente
    $nomAcu = $_POST['nomAcu'];
    $apeAcu = $_POST['apeAcu'];
    $docAcu = $_POST['docAcu'];
    $celAcu = $_POST['celAcu'];
    $corAcu = $_POST['corAcu'];



    if(strlen($nomAcu)>0 && strlen($apeAcu)>0 && strlen($docAcu)>0 && strlen($celAcu)>0 && strlen($corAcu)>0 ){


        $objConsultas = new Consultas();
        $result = $objConsultas->actualizacionAcudienteEst($idEstudiante, $nomAcu, $apeAcu, $docAcu, $celAcu, $corAcu);

    }else {

        echo '<script>alert("Por favor complete todos los campos")</script>';
        echo '<script>location.href="../Vista/html/Estudiante/registroPrimero"</script>';

    }

?>




