<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Estudiante</title>
  <link rel="shortcut icon" href="../../img/logo.svg">
  <!-- link bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
  <link rel="stylesheet" href="../../css/estudiante/estilosEstu.css">
  <script src="../../js/controlGeneral.js"></script>


</head>
<body>
    
    <?php
        include("menu-include.php");
    ?>
            
            <!-- breadcrumb -->  
            <nav class="nav-main">
                <a href="homeEstu.php">Home</a>
                <a href="homeClases.php" id="actual" actual="#clases"> / Clases</a>
            </nav>
        
            <section>
            

                <div class="contClases">
                <?php

                    mostrarClasesEstu();    

                ?>
                </div>

        
            </section>
        </main>

    </div>

    <script>

        // Función para verificar que dos campos son iguales en un formulario y en caso de serlo no se envia el formulario, también que no se envien los select si una opción.
        // Para que funcione se deben tener dos input, el input1 debe tener 'id="campo1"' y el input2 debe tener 'id="verify" verify="#campo1"'
        // Y los select deben tener la clase 'veriSelect'
        const formularioRegistroAdmin = (event) => {

            event.preventDefault();
            const form = event.target;
            const text = document.getElementById('texto');        

            // Validamos que los select estén seleccionados
            let select2 = document.getElementsByName('curso');
            select2 = select2[0].value;

            let select3 = document.getElementsByName('asignatura');
            select3 = select3[0].value;

            let select4 = document.getElementsByName('docente');
            select4 = select4[0].value;

            let select5 = document.getElementsByName('aula');
            select5 = select5[0].value;

            if (select2 !== 'Seleccione' && select3 !== 'Seleccione' && select4 !== 'Seleccione' && select5 !== 'Seleccione') {

                form.submit();
                return;

            }else{

                text.innerText = 'Seleccione una opción';
                document.getElementById('texto').style.visibility = 'visible';
                return;

            }

        }

        document.addEventListener('DOMContentLoaded', function () {

        // Se agrega la función verificar a todos los elementos con el 'id=formulario' que y se activa al intentar hacer un submit.
        document.getElementById('formulario').addEventListener('submit', formularioRegistroAdmin);

        });        

    </script>
    
</body>
</html>