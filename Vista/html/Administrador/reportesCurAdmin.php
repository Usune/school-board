<?php

    require_once ('../../../Modelo/conexion.php');
    require_once ('../../../Modelo/consultas.php');
    require_once ('../../../Modelo/seguridadAdmin.php');
    require_once ('../../../Controlador/mostrarPerfil.php');
    require_once ('../../../Controlador/mostrarCurAdmin.php');

    ob_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>

        .tabla {
            background-color: transparent;
            padding: 10px;
        }

        .tabla table {
            margin: auto;
            border-collapse: collapse;
        }

        .tabla caption{
            font-size: 18px;
            padding: 10px;
            font-weight: bold;
        }

        .tabla table tr:nth-child(odd) {
            background-color: #eaeaea;
        }

        .tabla table tr:nth-child(even) {
            background-color: #cbcbcb;
        }

        .tabla tr th {
            font-size: 14px;
            padding: 10px;
            border: none;
            background-color: #5FDA9F;
        }

        .tabla tr td {
            font-size: 12px;
            padding: 10px;
            max-width: 200px;
            min-width: 100px;
            border: none;
            text-align: center;
        }
 
    </style>

  <title>Reporte Cursos</title>
</head>
<body>

    <div class="tabla">
                    
        <table>
            <caption>
                Lista de cursos registrados
            </caption>
            <tr>
                <th>Curso</th>
                <th>Jornada</th>
                <th>Estudiantes</th>
            </tr>

                <?php

                    if(isset($_GET['jornada']) || isset($_GET['nombre']) ){
                            
                        cargarCursosReportesFiltro($_GET['jornada'], $_GET['nombre']);
                        
                    }else {

                        cargarCursosReportes();

                    }
                ?>

        </table>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>
</html>


<?php

    $html = ob_get_clean();

    require_once ('../../../DOMpdf/autoload.inc.php');
    use Dompdf\Dompdf;
    $dompdf = new Dompdf();

    $options = $dompdf->getOptions();
    $options->set(array('isRemoteEnabled' => true));
    $dompdf->setOptions($options);

    $dompdf->loadHtml($html);

    // Para crear documentos tipo carta:
    $dompdf->setPaper('letter');

    // Para crear documentos tipo horizontales A4, ej: certificados
    // $dompdf->setPaper('A4', 'Landscape');

    $dompdf->render();

    // ('Attachment' => false)  PARA QUE SE ABRA EN EL NAVEGADOR Y NO SE DESCARGUE
    $dompdf->stream("reporteCursosRegistrados.pdf", array('Attachment' => true));


?>