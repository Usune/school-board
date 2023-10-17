<?php

require_once("../Modelo/conexion.php");
require_once("../Modelo/consultas.php");

$titulo = $_POST["titulo"];
$descripcion = $_POST["descripcion"];
$fecha_vencimiento =  $_POST["fecha_V"];

if (strlen($titulo)>0 && strlen($descripcion)>0 && strlen($fecha_vencimiento)>0) {

$archivos = "../../Uploads/Tareas/".$_FILES['archivos']['name'];
$guardar = "../Vista/Uploads/Tareas/".$_FILES['archivos']['name'];

$mover = move_uploaded_file($_FILES['archivos']['tmp_name'], $guardar);
$zonaHoraria = new DateTimeZone('America/Bogota');
$fechaActual = new DateTime('now', $zonaHoraria);
$fechaActual = $fechaActual->format('Y-m-d H:i:s');


$objConsultas = new Consultas();
$result = $objConsultas->insertarTarDoc($titulo, $descripcion, $fechaActual, $fecha_vencimiento,$archivos);

}else { 
    echo '<script>alert("Por favor complete todos los campos")</script>';

}

?>