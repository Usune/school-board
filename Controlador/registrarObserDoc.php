<?php
require_once("../Modelo/consultas.php");
require_once("../Modelo/conexion.php");


$idEstudiante = $_POST['documentoEstudiante'];
$idAutor = "2";//$_SESSION['id'];
$fechaLimite = $_POST['fechaLimite'];
$descripcionObservador = $_POST['descripcionObservador'];
$idClase = $_POST['idClase'];
// echo'<script>alert("'.$idEstudiante.' '.$idAutor.' '.$fechaLimite .' '.$descripcionObservador.'")</script>';
// return;

if (strlen($fechaLimite)>0 && strlen($descripcionObservador)>0) {
    $objConsultas = new Consultas();
    $result = $objConsultas->insertarObserDoc($idEstudiante, $idAutor, $fechaLimite, $descripcionObservador, $idClase);
}
else{
    echo '<script>alert("Por favor complete todos los campos")</script>';
}
?>