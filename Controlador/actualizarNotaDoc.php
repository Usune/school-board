<?php        
    require_once("../Modelo/conexion.php");
    require_once("../Modelo/consultas.php");
    require_once ('../Modelo/seguridadDoc.php');

    $idCalificacion = $_POST['idCalificacionEditar'];    
    $nota = $_POST['editarCalificacion']; 
    $observacion = $_POST['editarObservacion'];
    $idClase = $_POST['idTareaEditar']; 
    $idTarea = $_POST['idClaseEditar'];

    if (strlen($idCalificacion)>0 && strlen($nota)>0 && strlen($observacion)>0 && strlen($idClase)>0 && strlen($idTarea)>0) {
        
        $zonaHoraria = new DateTimeZone('America/Bogota');
        $fecha = new DateTime('now', $zonaHoraria);
        $fecha = $fecha->format('Y-m-d H:i:s');

        $objConsultas = new Consultas();
        $result = $objConsultas->editarNotaDoc($idCalificacion, $fecha, $nota, $observacion, $idClase, $idTarea);

    } else{

        echo '<script>alert("Por favor complete todos los campos")</script>';
        echo '<script>location.href="../Vista/html/Docente/docCalificacionEntrega.php?idTarea='.$idTarea.'&idClase='.$idClase.'"</script>';

    }

?>