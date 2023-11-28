<?php
 //  require_once() para enlazar las dependencias necesarias
 require_once("../Modelo/conexion.php");
 require_once("../Modelo/consultas.php");
 require_once('../Modelo/seguridadAdmin.php');

 // session_start(); Se quita porque ya existe en el archivo se seguridad
 // VARIABLE DE SESIÓN DEL LOGIN
 $idAutor = $_SESSION['id'];

 // Aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del metodo POST y los name de los campos
 $titulo = $_POST['titulo'];
 $descripcion = $_POST['descripcion'];
 $idCurso = $_POST['curso'];
 $idComunicado = $_POST['idComunicado'];
 $archivo = "";

 if (strlen($titulo)>0 && strlen($descripcion)>0 && strlen($idAutor)>0 && strlen($idCurso)>0 && strlen($idComunicado)>0) {

    if(isset($_FILES['archivo'])){

        // SE CREA LA VARIALE QUE GUARDA LA DIRECCIÓN DEL ARCHIVO DONDE QUEDA LA IMAGEN
        $archivo = "../../Uploads/Comunicados/".$_FILES['archivo']['name'];
    
        $guardar = "../Vista/Uploads/Comunicados/".$_FILES['archivo']['name'];
    
        // MOVEMOS EL ARCHIVO A LA CARPETA UPLOADS CON LA FUNCIÓN DE PHP move_uploaded_file()
        // tmp_name: NOMBRE TEMPORAL DEL ARCHIVO
        $mover = move_uploaded_file($_FILES['archivo']['tmp_name'], $guardar);

    }
        
    $zonaHoraria = new DateTimeZone('America/Bogota');
    $fecha = new DateTime('now', $zonaHoraria);
    $fecha = $fecha->format('Y-m-d H:i:s');

    // echo $archivo;

    $objConsultas = new Consultas();
    $result = $objConsultas->actualizarComunAdmin($titulo, $descripcion, $archivo, $idCurso, $idComunicado, $idAutor);

 } else{

     echo '<script>alert("Por favor complete todos los campos")</script>';
     echo '<script>location.href="../Vista/html/Docente/docComunRegistrar.php?id='.$_GET['idClase'].'"</script>';

 }
 ?>
