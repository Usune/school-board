<?php

require_once("../Modelo/conexion.php");
require_once("../Modelo/consultas.php");

$titulo = $_POST["titulo"];
$descripcion = $_POST["descripcion"];
$fecha_creacion = $_POST["fecha_C"]; 
$fecha_vencimiento =  $_POST["fecha_V"];

if (strlen($titulo)>0 && strlen($descripcion)>0 && strlen($fecha_creacion)>0 && strlen($fecha_vencimiento)>0) {

$archivo = "../../Uploads/Tareas/".$_FILES['archivos']['name'];
$guardar = "../Vista/Uploads/Tareas/".$_FILES['archivos']['name'];

$mover = move_uploaded_file($_FILES['archivos']['tmp_name'], $guardar);

$objConsultas = new Consultas();
$result = $objConsultas->insertarTarDoc($titulo, $descripcion, $fecha_creacion, $fecha_vencimiento);

}else { 
    echo '<script>alert("Por favor complete todos los campos")</script>';

}

?>