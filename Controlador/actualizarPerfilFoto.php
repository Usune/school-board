<?php

    //  require_once() para enlazar las dependencias necesarias
    require_once("../Modelo/conexion.php");
    require_once("../Modelo/consultas.php");

    $documento = $_POST['documento'];

    $foto = '../../Uploads/Usuario/'.$_FILES['foto']['name'];
    // MOVEMOS EL ARCHIVO A LA CARPETA UPLOADS CON LA FUNCIÓN DE PHP move_uploaded_file()
    // tmp_name: NOMBRE TEMPORAL DEL ARCHIVO
    $mover = move_uploaded_file($_FILES['foto']['tmp_name'], $foto);

    $objConsultas = new Consultas();
    $result = $objConsultas->actualizarFotoAdmin($documento ,$foto);


?>