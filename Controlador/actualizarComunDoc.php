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
 $idComunicado = $_POST['idComunicado'];
 $idCurso = $_POST['curso'];
 $idClase = $_POST['idClase'];    
 $archivo = "";

 if (strlen($titulo)>0 && strlen($descripcion)>0 && strlen($idUsuario)>0 && strlen($idCurso)>0) {   

     $objConsultas = new Consultas();
     $result = $objConsultas->actualizarComunDoc($titulo, $fecha, $descripcion, $archivo, $idComunicado, $idCurso, $idClase);

 } else{

     echo '<script>alert("Por favor complete todos los campos")</script>';
     echo '<script>location.href="../Vista/html/Docente/docComunRegistrar.php?id='.$_GET['idClase'].'"</script>'; 

 }
 ?>
