<?php
    include_once "../Modelo/conexion.php"; 
    include_once "../Modelo/consultas.php"; 
    include_once "./mostrarInfoEstudiante.php"; 


    // header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
    // header("Content-Disposition: attachment; filename=archivo.xls");
    // header('Content-Type: text/html; charset=UTF-8');
    

    header("Content-Type: application/vnd.ms.excel; charset=iso-8859-1");
    header("Content-Disposition: attachment; filename=archivo.xls");
?>
<!-- Resto de tu código -->

<table border="1" class="table table-borderless table-hover">
              <thead>
                <tr>
                  <th scope="col">Clase</th>
                  <th scope="col">Docente</th>
                  <th scope="col">Titulo</th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Archivos</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Detalles</th>
                </tr>
              </thead>
              <tbody>
                <?php mostrarTodasTareas(); ?>
              </tbody>
            </table>