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
    $hojaActiva->setTitle("Usuarios");
    $hojaActiva->getColumnDimension('A')->setWidth(20);
    $hojaActiva->getColumnDimension('B')->setWidth(15);
    $hojaActiva->getColumnDimension('C')->setWidth(20);
    $hojaActiva->getColumnDimension('D')->setWidth(20);
    $hojaActiva->getColumnDimension('E')->setWidth(10);
    $hojaActiva->getColumnDimension('F')->setWidth(10);

    $hojaActiva->setCellValue('A1','TIPO DOCUMENTO');
    $hojaActiva->setCellValue('B1','DOCUMENTO');
    $hojaActiva->setCellValue('C1','APELLIDOS');
    $hojaActiva->setCellValue('D1','NOMBRES');
    $hojaActiva->setCellValue('E1','ESTADO');
    $hojaActiva->setCellValue('F1','ROL');

    $fila = 2;


    if(isset($_GET['rol']) || isset($_GET['estado']) || isset($_GET['nombres']) || isset($_GET['apellidos']) || isset($_GET['documento'])){
                            
        $objConsultas = new Consultas();
        $resultado = $objConsultas->filtrarUsuarios($_GET['rol'], $_GET['estado'], $_GET['nombres'], $_GET['apellidos'], $_GET['documento']);


        foreach($resultado as $f) {
            $hojaActiva->setCellValue('A'.$fila, $f['tipoDoc']);
            $hojaActiva->setCellValue('B'.$fila, $f['documento']);
            $hojaActiva->setCellValue('C'.$fila, $f['apellidos']);
            $hojaActiva->setCellValue('D'.$fila, $f['nombres']);
            $hojaActiva->setCellValue('E'.$fila, $f['estado']);
            $hojaActiva->setCellValue('F'.$fila, $f['rol']);
            $fila++;
        }
        
    }else {
        
        $objConsultas = new Consultas();
        $resultado = $objConsultas->mostrarUsuariosAdmin();

        foreach($resultado as $f) {
            $hojaActiva->setCellValue('A'.$fila, $f['tipoDoc']);
            $hojaActiva->setCellValue('B'.$fila, $f['documento']);
            $hojaActiva->setCellValue('C'.$fila, $f['apellidos']);
            $hojaActiva->setCellValue('D'.$fila, $f['nombres']);
            $hojaActiva->setCellValue('E'.$fila, $f['estado']);
            $hojaActiva->setCellValue('F'.$fila, $f['rol']);
            $fila++;
        }

    }
    
    // redirect output to client browser
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="usuariosSB.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = IOFactory::createWriter($excel, 'Xlsx');
    $writer->save('php://output');
    exit;

?>