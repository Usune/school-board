<?php
    require_once ('../../../Modelo/conexion.php');
    require_once ('../../../Modelo/consultas.php');
    require_once ('../../../Modelo/seguridadAdmin.php');
    require_once ('../../../Controlador/mostrarPerfil.php');
    require_once ('../../../Controlador/mostrarComunAdmin.php');
    require_once ('../../../Controlador/mostrarCurAdmin.php');
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/logo.svg">
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <link rel="stylesheet" type="text/css" href="../../css/administrador/estilosAdmin.css">
    <script src="../../js/controlGeneral.js"></script>
    <title>Comunicados Admin</title>
</head>
<body>
    
    <?php
        include("menu-include.php");
    ?>

        <main>
            
            <!-- breadcrumb -->  
            <nav class="nav-main">
                <a href="homeAdmin.php">Home</a>
                <a href="adminComun.php"> / Comunicados</a>
            </nav>
        
            <section>

                <h2>Administración de comunicados</h2>
                <div class="cabecera">
                    <button type="button" class="desplegarModal btn-cabecera" modal="#modComun">
                        <img src="../../img/agregar.svg" alt="Registrar" modal="#modComun"> Crear
                    </button>
                </div>
                
                <div class="modal" id="modComun">

                    <div class="modal_container">
                        <button type="button" class="desplegarModal btn-cerrar" modal="#modComun"><img src="../../img/x.svg" alt="Salir" modal="#modComun"></button>
                        <div class="formulario">
                    
                            <h3>Subir comunicado</h3>

                            <p class="recordatorio">Antes de subir el comunicado, asegurese de que todos los campos son correctos.</p>
                            <p class="recordatorio">Recuerde que el sistema solo acepta archivos PDF.</p>
                
                            <form action="../../../Controlador/registrarComunAdmin.php" method="post" enctype="multipart/form-data" id="formulario">

                                    <div class="fieldset">
                                        <fieldset>
                                            <legend id="tit">Título</legend>
                                        </fieldset>
                                        <input type="text" placeholder="Título" required legend="#tit" name="titulo">
                                    </div>
                    
                                    <div class="textarea">
                                        <label for="descripcion">Descripción</label>
                                        <textarea id="descripcion" cols="30" rows="10" name="descripcion" placeholder="Ingrese una descripción"></textarea>
                                    </div> 

                                    <div class="fieldset_view">
                                        <label for="rol">Curso</label>
                                        <select class="veriSelect" required name="curso">
                                            <option value="Seleccione" selected disabled>Seleccione una opción</option>
                                            <option value="1">Todos</option>
                                            
                                            <?php
                                                cargarCursosRegistro();
                                            ?>
                                    
                                        </select>
                                    </div>

                                    <div class="file">
                                        <label for="archivo">Archivo</label>
                                        <input type="file" accept=".pdf" name="archivo">
                                    </div>
                
                                    <p id="texto"></p>
                                
                                <button type="submit" class="enviar">Subir comunicado</button>
                            </form>

                        </div>
                    </div>
                </div>

                <h2>Comunicados</h2>

                <?php

                    cargarComunicados();

                ?>
        
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

            if (select2 !== 'Seleccione') {

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