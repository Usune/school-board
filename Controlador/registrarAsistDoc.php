<?php

    //  require_once() para enlazar las dependencias necesarias
    require_once("../Modelo/conexion.php");
    require_once("../Modelo/consultas.php");

    // Aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del metodo POST y los name de los campos
    $clase= $_POST['idClase'];    
    $documento = "";
    $asiste = "";
    $datosArray = $_POST['txtArray'];

    $array_resultante = explode("|", $datosArray);
    $longitud = count($array_resultante);

    for ($i = 0; $i < $longitud; $i++) {
        $arrayDatos = explode(",", $array_resultante[$i]);
        $documento = $arrayDatos[0];
        $asiste = $arrayDatos[1];

        if (strlen($asiste)>0) {

            $objConsultas = new Consultas();
            $result = $objConsultas->registrarAsistencia($asiste, $clase, $documento);
    
        } else{
    
            echo '<script>alert("Por favor complete todos los campos")</script>';
            echo '<script>location.href="../Vista/html/Docente/docAsistencia.php?idClase='.$clase.'"</script>';
    
        }        
    }
    return false;        
?>