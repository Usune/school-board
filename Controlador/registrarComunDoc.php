<?php

    //  require_once() para enlazar las dependencias necesarias
    require_once("../Modelo/conexion.php");
    require_once("../Modelo/consultas.php");
    require_once('../Modelo/seguridadDoc.php');

    // session_start(); Se quita porque ya existe en el archivo se seguridad
    // VARIABLE DE SESIÓN DEL LOGIN
    $idUsuario = $_SESSION['id'];

    // Aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del metodo POST y los name de los campos
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $idCurso = $_POST['curso'];
    $idClase = $_GET['idClase'];

    if (strlen($titulo)>0 && strlen($descripcion)>0 && strlen($idUsuario)>0 && strlen($idCurso)>0) {

        // SE CREA LA VARIALE QUE GUARDA LA DIRECCIÓN DEL ARCHIVO DONDE QUEDA LA IMAGEN
        $archivo = "../../Uploads/Comunicados/".$_FILES['archivo']['name'];

        $guardar = "../Vista/Uploads/Comunicados/".$_FILES['archivo']['name'];

        // MOVEMOS EL ARCHIVO A LA CARPETA UPLOADS CON LA FUNCIÓN DE PHP move_uploaded_file()
        // tmp_name: NOMBRE TEMPORAL DEL ARCHIVO
        $mover = move_uploaded_file($_FILES['archivo']['tmp_name'], $guardar);

        $objConsultas = new Consultas();
        $result = $objConsultas->insertarComunDoc($idUsuario, $idCurso, $titulo, $descripcion, $archivo, $idClase);

    } else{

        echo '<script>alert("Por favor complete todos los campos")</script>';
        echo '<script>location.href="../Vista/html/Docente/docComunRegistrar.php?id='.$_GET['idClase'].'"</script>'; 

    }

?>