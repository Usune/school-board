<?php

    //  require_once() para enlazar las dependencias necesarias
    require_once("../Modelo/conexion.php");
    require_once("../Modelo/consultas.php");
    require_once ('../Modelo/seguridadAdmin.php');

    // session_start(); Se quita porque ya existe en el archivo se seguridad
    // VARIABLE DE SESIÓN DEL LOGIN
    $autor = $_SESSION['id'];

    // Aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del metodo POST y los name de los campos
    $observacion = $_POST['observacion'];
    $estudiante = $_GET['id'];

    if (strlen($observacion)>0 && strlen($estudiante)>0 && strlen($autor)>0) {
        
        $zonaHoraria = new DateTimeZone('America/Bogota');
        $fecha = new DateTime('now', $zonaHoraria);
        $fecha = $fecha->format('Y-m-d H:i:s');

        $objConsultas = new Consultas();
        $result = $objConsultas->insertarObserAdmin($observacion, $estudiante, $autor, $fecha);

    } else{

        echo '<script>alert("Por favor complete todos los campos")</script>';
        echo '<script>location.href="../Vista/html/Administrador/adminObser.php?id='.$estudiante.'"</script>';

    }

?>