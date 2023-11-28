<?php
    header("Cache-Control: no-store, must-revalidate");
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
    <title>Usuarios</title>
</head>

<body>
    
    <section class="registroPrimero">
        <div class="cont-regisPrimero">

            <h2>Bienvenido a School Board</h2>
            
            <div class="formulario">
                
                <h3>Actualizar información personal</h3>

                <p class="recordatorio">La clave nueva que debe ingresar debe tener como mínimo 8 caracteres.<br><br> Antes de actualizar sus datos, asegurese de que todos los campos son correctos.</p>
                <!--  enctype="multipart/form-data" -->
                <form action="../../../Controlador/actualizarPrimeraVez.php" method="post" id="formulario" enctype="multipart/form-data">

                    <?php 

                        primeraActualizacion();

                    ?>


                    <div class="fila-cont">
        
                        <div class="fieldset">
                            <fieldset>
                                <legend id="cel">Celular</legend>
                            </fieldset>
                            <input type="text" placeholder="Celular" required legend="#cel" name="telefono">
                        </div>
        
                        <div class="fieldset">
                            <fieldset>
                                <legend id="dir">Dirección</legend>
                            </fieldset>
                            <input type="text" placeholder="Dirección" required legend="#dir" name="direccion">
                        </div>

                    </div>

                    <div class="fila-cont">
        
                        <div class="fieldset">
                            <fieldset>
                                <legend id="cor">Correo</legend>
                            </fieldset>
                            <input type="email" placeholder="Correo" required legend="#cor" name="correo">
                        </div>
        
                        <div class="fieldset">
                            <fieldset>
                                <legend id="cla1">Clave nueva</legend>
                            </fieldset>
                            <input type="password" placeholder="Clave nueva" required legend="#cla1" id="campo1" name="clave">
                        </div>

                    </div>

                    <div class="fila-cont">
        
                        <div class="fieldset">
                            <fieldset>
                                <legend id="cla2">Verificar clave nueva</legend>
                            </fieldset>
                            <input type="password" placeholder="Verificar clave nueva" required legend="#cla2" id="verify" verify="#campo1">
                        </div>

                        <div class="file">
                            <label for="foto">Foto</label>
                            <input type="file" accept=".jpg, .jpeg, .png, .gif" name="foto" legend="foto">
                        </div>                        

                    </div>

                    <p id="texto"></p>
                    
                    <button type="submit" class="enviar">Actualizar datos</button>
                </form>
                
            </div>

        </div>
    </section>

    <hr>

    <footer>
        <div class="info-footer">
            <p>School Board</p>
            <p>Copyright © - 2023. Todos los Derechos Reservados</p>
            <p>Autor: Estefani Arenas, Erika Diaz, Nicole Benavides y Tatiana Arevalo.</p>
        </div>
    </footer>

    <script>
        
        // Función para verificar que dos campos son iguales en un formulario y en caso de serlo no se envia el formulario, también que no se envien los select si una opción.
        // Para que funcione se deben tener dos input, el input1 debe tener 'id="campo1"' y el input2 debe tener 'id="verify" verify="#campo1"'
        // Y los select deben tener la clase 'veriSelect'
        const formularioRegistroPrimero = (event) => {
        
            event.preventDefault();
            const form = event.target;
            const text = document.getElementById('texto');
        
            // Validamos que los campos del documento son iguales
            let idcampo1 = document.getElementById('verify').getAttribute('verify');
            let campo1 = document.querySelector(idcampo1).value;
            let campo2 = document.getElementById('verify').value;
            
            if (campo1.length >= 8) {

                if(campo1 === campo2) {
                    
                    form.submit();
                    return;

                }else {
    
                    text.innerText = 'Verifique las claves, los valores no son iguales';
                    document.getElementById('texto').style.visibility = 'visible';
                    return;

                }
    
        
            }else {
    
                text.innerText = 'Recuerde que la clave debe tener mínimo 8 caracteres';
                document.getElementById('texto').style.visibility = 'visible';
                return;
    
            }
        
        }

        document.addEventListener('DOMContentLoaded', function () {

        // Se agrega la función verificar a todos los elementos con el 'id=formulario' que y se activa al intentar hacer un submit.
        document.getElementById('formulario').addEventListener('submit', formularioRegistroPrimero);

        });        
        
    </script>

</body>

</html>