<?php
require_once("../Modelo/consultas.php");
require_once("../Modelo/conexion.php");

session_start();

$idAutor = $_SESSION['id'];
$idEstudiante = $_POST['id'];
$descripcion = $_POST['observacion'];
$idClase = $_GET['idClase'];

if (strlen($idAutor)>0 && strlen($idEstudiante)>0 && strlen($descripcion)>0 && strlen($idClase)>0) {

    $zonaHoraria = new DateTimeZone('America/Bogota');
    $fecha = new DateTime('now', $zonaHoraria);
    $fecha = $fecha->format('Y-m-d H:i:s');

    $objConsultas = new Consultas();
    $result = $objConsultas->insertarObserDoc($idEstudiante, $idAutor, $descripcion, $fecha, $idClase);
}
else{
    echo '<script>alert("Por favor complete todos los campos")</script>';
}
?>