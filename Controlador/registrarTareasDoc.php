<?php

require_once("../Modelo/conexion.php");
require_once("../Modelo/consultas.php");

session_start();

$titulo = $_POST["titulo"];
$descripcion = $_POST["descripcion"];
$fecha_vencimiento =  $_POST["fecha_V"]; 
$idClase = $_POST["idClase"];
$idDocente = $_SESSION["id"];

if (strlen($titulo)>0 && strlen($descripcion)>0 && strlen($fecha_vencimiento)>0 && strlen($idClase)>0) {

$archivos = "../../Uploads/Tareas/".$_FILES['archivos']['name'];
$guardar = "../Vista/Uploads/Tareas/".$_FILES['archivos']['name'];

$mover = move_uploaded_file($_FILES['archivos']['tmp_name'], $guardar);
$zonaHoraria = new DateTimeZone('America/Bogota');
$fechaActual = new DateTime('now', $zonaHoraria);
$fechaActual = $fechaActual->format('Y-m-d H:i:s');


$objConsultas = new Consultas();
$result = $objConsultas->insertarTarDoc($titulo, $descripcion, $fecha_creacion, $fecha_vencimiento, $archivos,$idClase, $idDocente);

}else { 
    echo '<script>alert("Por favor complete todos los campos")</script>';

}

?>