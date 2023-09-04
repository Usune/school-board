<?php

    //  require_once() para enlazar las dependencias necesarias
    require_once("../Modelo/conexion.php");
    require_once("../Modelo/consultas.php");

    $objConsultas = new ValidarSesion();
    $consulta = $objConsultas->cerrarSesion();
?>