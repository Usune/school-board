<?php

    //  require_once() para enlazar las dependencias necesarias
    require_once("../Modelo/conexion.php");
    require_once("../Modelo/consultas.php");

    $id = $_GET['id'];

    $objConsulta = new Consultas();
    $consulta = $objConsulta->eliminarUsuAdmin($id);

?>