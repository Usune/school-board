<?php

    //  require_once() para enlazar las dependencias necesarias
    require_once("../Modelo/conexion.php");
    require_once("../Modelo/consultas.php");

    // Aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del metodo POST y los name de los campos
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];

    if (strlen($titulo)>0 && strlen($descripcion)>0 ) {

        // SE CREA LA VARIALE QUE GUARDA LA DIRECCIÓN DEL ARCHIVO DONDE QUEDA LA IMAGEN
        $archivo = "../Vista/Uploads/Comunicados/".$_FILES['archivo']['name'];

        // MOVEMOS EL ARCHIVO A LA CARPETA UPLOADS CON LA FUNCIÓN DE PHP move_uploaded_file()
        // tmp_name: NOMBRE TEMPORAL DEL ARCHIVO
        $mover = move_uploaded_file($_FILES['archivo']['tmp_name'], $archivo);

        $objConsultas = new Consultas();
        $result = $objConsultas->insertarComunAdmin($titulo, $descripcion, $archivo);

    } else{

        echo '<script>alert("Por favor complete todos los campos")</script>';
        echo '<script>location.href="../Vista/html/Administrador/adminComunRegistrar.php"</script>';

    }

?>