<?php

    //  require_once() para enlazar las dependencias necesarias
    require_once("../Modelo/conexion.php");
    require_once("../Modelo/consultas.php");

    // Aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del metodo POST y los name de los campos
    $clase= $_POST['idClase'];   

    $objConsultas = new Consultas();
    $consultas = $objConsultas->validaExistenciaDeAsistencia($clase);
    
    if (!isset($consultas)) {       
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
                $result = $objConsultas->registrarAsistencia($asiste, $clase, $documento);    
            } else{    
                echo '<script>alert("Por favor complete todos los campos")</script>';
                echo '<script>location.href="../Vista/html/Docente/docAsistencia.php?idClase='.$clase.'"</script>';    
            }        
        }  
    }
    else {      
        $zonaHoraria = new DateTimeZone('America/Bogota');
        $fecha = new DateTime('now', $zonaHoraria);
        $fecha = $fecha->format('Y-m-d');
        
        echo '<script>alert("Ya se guardo la asistencia para la fecha actual ('. $fecha .')")</script>';
        echo '<script>location.href="../Vista/html/Docente/docAsistencia.php?idClase='.$clase.'"</script>';              
    }      
?>