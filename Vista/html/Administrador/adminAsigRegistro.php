<?php
    require_once ('../../../Modelo/conexion.php');
    require_once ('../../../Modelo/consultas.php');
    require_once ('../../../Modelo/seguridadAdmin.php');
    require_once ('../../../Controlador/mostrarPerfil.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/logo.svg">
    <link rel="stylesheet" type="text/css" href="../../css/administrador/estilosAdmin.css">
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <script src="../../js/controlGeneral.js"></script>
    <title>Asignaturas Admin</title>
</head>

<body>
    
    <?php
        include("menu-include.php");
    ?>
        <main>

            <!-- breadcrumb -->  
            <nav class="nav-main">
                <a href="homeAdmin.php">Home</a>
                <a href="adminAsig.php"> / Asignaturas</a>
                <a href="adminAsigRegistro.php"> / Crear</a>
            </nav>
        
            <section>

                <h2>Administración de asignaturas</h2>
                
                <div class="formulario">
                    
                    <h3>Crear Asignatura</h3>

                    <p class="recordatorio">Antes de crear la asignatura, asegurese de que todos los campos son correctos.</p>
        
                    <form action="../../../Controlador/registrarAsigAdmin.php" method="post" id="formulario">

                        <div class="fieldset">
                            <fieldset>
                                <legend id="nom">Nombre</legend>
                            </fieldset>
                            <input type="text" placeholder="Nombre" required legend="#nom"  id="campo1" name="nombre">
                        </div>
        
                        <div class="fieldset">
                            <fieldset>
                                <legend id="veri">Verificación nombre</legend>
                            </fieldset>
                            <input type="text" placeholder="Verificación nombre" required legend="#veri" id="verify" verify="#campo1">
                        </div>
        
                        <p id="texto"></p>
                        
                        <button type="submit" class="enviar">Crear asignatura</button>
                    </form>
                </div>
            </section>
        
        </main>

    </div>

    <hr>

    <footer>
        <div class="info-footer">
            <p>School Board</p>
            <p>Copyright © - 2023. Todos los Derechos Reservados</p>
            <p>Autor: Estefani Arenas, Erika Diaz, Nicole Benavides y Tatiana Arevalo.</p>
        </div>
    </footer>

<script>

    // Para que funcione se deben tener dos input, el input1 debe tener 'id="campo1"' y el input2 debe tener 'id="verify" verify="#campo1"'
    // Y los select deben tener la clase 'veriSelect'
    const formularioRegistroAdmin = (event) => {
    
        event.preventDefault();
        const form = event.target;
        const text = document.getElementById('texto');
    
        // Validamos que los campos del documento son iguales
        let idcampo1 = document.getElementById('verify').getAttribute('verify');
        let campo1 = document.querySelector(idcampo1).value;
        let campo2 = document.getElementById('verify').value;
    
        if (campo1 === campo2) {
    
                form.submit();
                return;
    
        }else {

            text.innerText = 'Verifique el nombre, los datos ingresados no son iguales';
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