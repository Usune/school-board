<?php

    require '../../../Excel/vendor/autoload.php';
    require '../../../Modelo/conexion.php';
    require '../../../Modelo/consultas.php';
    require_once ('../../../Modelo/seguridadAdmin.php');

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    // use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\IOFactory;

    $excel = new Spreadsheet();
    $excel->getProperties()->setCreator('School Board');

    $hojaActiva = $excel->getActiveSheet();
    $hojaActiva->setTitle("Cursos");
    $hojaActiva->getColumnDimension('A')->setWidth(15);
    $hojaActiva->getColumnDimension('B')->setWidth(15);
    $hojaActiva->getColumnDimension('C')->setWidth(15);

    $hojaActiva->setCellValue('A1','CURSO');
    $hojaActiva->setCellValue('B1','JORNADA');
    $hojaActiva->setCellValue('C1','ESTUDIANTES');

    $fila = 2;


    if(isset($_GET['jornada']) || isset($_GET['nombre']) ){
                            
        $objConsultas = new Consultas();
        $resultado = $objConsultas->filtrarCursos($_GET['jornada'], $_GET['nombre']);
    

        foreach($resultado as $f) {
            $hojaActiva->setCellValue('A'.$fila, $f['nombre']);
            $hojaActiva->setCellValue('B'.$fila, $f['jornada']);
            $hojaActiva->setCellValue('C'.$fila, $f['cantidadEstudiantes']);
            $fila++;
        }
        
    }else {
        
        $objConsultas = new Consultas();
        $resultado = $objConsultas->mostrarCursosAdmin();

        foreach($resultado as $f) {
            $hojaActiva->setCellValue('A'.$fila, $f['nombre']);
            $hojaActiva->setCellValue('B'.$fila, $f['jornada']);
            $hojaActiva->setCellValue('C'.$fila, $f['cantidadEstudiantes']);
            $fila++;
        }

    }
    
    // redirect output to client browser
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="cursosSB.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = IOFactory::createWriter($excel, 'Xlsx');
    $writer->save('php://output');
    exit;
    
    // $objConexion = new Conexion();
    // $conexion = $objConexion->get_conexion();

    // $sql = 'SELECT
    // c.idCurso,
    // c.nombre,
    // c.jornada,
    // COUNT(ec.idEstudiante) AS cantidadEstudiantes
    // FROM curso c
    // LEFT JOIN estudianteCurso ec ON c.idCurso = ec.idCurso
    // GROUP BY c.idCurso, c.nombre, c.jornada
    // ORDER BY c.idCurso DESC';

    // $resultado = $conexion->prepare($sql);
    // $resultado->execute();
    
    // while ($rows = $resultado->fetch(PDO::FETCH_ASSOC)){
    //     $hojaActiva->setCellValue('A'.$fila, $rows['nombre']);
    //     $hojaActiva->setCellValue('B'.$fila, $rows['jornada']);
    //     $hojaActiva->setCellValue('C'.$fila, $rows['cantidadEstudiantes']);
    //     $fila++;
    // }
?>