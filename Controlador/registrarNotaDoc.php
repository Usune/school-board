<?php        
    require_once("../Modelo/conexion.php");
    require_once("../Modelo/consultas.php");
    require_once ('../Modelo/seguridadDoc.php');

    $idEntrega = $_POST['idEntrega'];  
    $nota = $_POST['calificacion']; 
    $observacion = $_POST['observacion'];
    $idClase = $_POST['idClase']; 
    $idTarea = $_POST['idTarea'];

    if (strlen($idEntrega)>0 && strlen($nota)>0 && strlen($observacion)>0 && strlen($idClase)>0 && strlen($idTarea)>0) {
        
        $zonaHoraria = new DateTimeZone('America/Bogota');
        $fecha = new DateTime('now', $zonaHoraria);
        $fecha = $fecha->format('Y-m-d H:i:s');

        $objConsultas = new Consultas();
        $result = $objConsultas->insertarNotaDoc($idEntrega, $fecha, $nota, $observacion, $idClase, $idTarea);

    } else{

        echo '<script>alert("Por favor complete todos los campos")</script>';
        echo '<script>location.href="../Vista/html/Docente/docCalificacionEntrega.php?idTarea='.$idTarea.'&idClase='.$idClase.'"</script>';

    }

?>