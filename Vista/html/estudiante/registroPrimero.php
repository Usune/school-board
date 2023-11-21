<?php
    header("Cache-Control: no-store, must-revalidate");
    require_once('../../../Modelo/conexion.php');
    require_once('../../../Modelo/consultas.php');
    require_once('../../../Controlador/mostrarPerfil.php');
    require_once('../../../Controlador/mostrarInfoEstudiante.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/logo.svg">

    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    <link rel="stylesheet" type="text/css" href="../../css/administrador/estilosAdmin.css">
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <link rel="stylesheet" href="../../css/estudiante/estilosEstu.css">

    <script src="../../js/controlGeneral.js"></script>
    <title>Usuarios</title>
</head>

<body>

    <section>
        <div class="decoracion">
            <img src="../../img/mancha.svg" alt="decoración">
        </div>

        <div class="container-fluid registro">
            <form class="row" action="../../../Controlador/actualizarPrimeraVezEst.php" method="post"
                enctype="multipart/form-data" id="formularioGeneral">

                <div class="row" id="formularioAcudiente">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>Formulario Acudiente</h1>
                                <p>
                                    ¡Hola futuro estudiante! Estamos emocionados de que te unas a nuestra plataforma
                                    educativa. Para garantizar una experiencia educativa óptima, por favor completa
                                    todos los campos con información veraz sobre tu acudiente.
                                </p>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="fieldset">
                                    <fieldset>
                                        <legend id="nomAcu">Nombres</legend>
                                    </fieldset>
                                    <input type="text" placeholder="Nombres" required legend="#nomAcu" name="nomAcu">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="fieldset">
                                    <fieldset>
                                        <legend id="apeAcu">Apellidos</legend>
                                    </fieldset>
                                    <input type="text" placeholder="Apellidos" required legend="#apeAcu" name="apeAcu">
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="fieldset">
                                    <fieldset>
                                        <legend id="docAcu">Documento</legend>
                                    </fieldset>
                                    <input type="text" placeholder="Documento" required legend="#docAcu" name="docAcu">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="fieldset">
                                    <fieldset>
                                        <legend id="celAcu">Número de celular</legend>
                                    </fieldset>
                                    <input type="text" placeholder="Número de celular" required legend="#celAcu" name="celAcu">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="fieldset">
                                    <fieldset>
                                        <legend id="corAcu">Correo electrónico </legend>
                                    </fieldset>
                                    <input type="email" placeholder="Correo electrónico " required legend="#corAcu" name="corAcu">
                                </div>
                            </div>

                        </div>




                        <div class="col-md-12">
                            <button type="button" class="btnPrincipal" onclick="btnToggle()">Siguiente</button>
                        </div>

                    </div>

                    <div class="col-md-2">
                        <img src="../../img/casa.svg" alt="" class="formImg">
                    </div>
                </div>

                <div class="row oculto" id="formularioEstudiante">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>Formulario Estudiante</h1>
                                <p>
                                    Ahora es el momento de agregar tus datos personales. Asegúrate de proporcionar
                                    información real en cada campo y crea una contraseña segura con un mínimo de 8
                                    caracteres.
                                </p>
                            </div>
                        </div>
                        <div class="row g-3">
                            <?php primeraActualizacionEst(); ?>

                            <div class="col-md-6">
                                <div class="fieldset">
                                    <fieldset>
                                        <legend id="cel">Número de celular </legend>
                                    </fieldset>
                                    <input type="text" placeholder="Número de celular " required legend="#cel"
                                        name="telefono">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="fieldset">
                                    <fieldset>
                                        <legend id="dir">Dirección de residencia </legend>
                                    </fieldset>
                                    <input type="text" placeholder="Dirección de residencia" required legend="#dir"
                                        name="direccion">
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="fieldset">
                                    <fieldset>
                                        <legend id="cor">Correo electrónico </legend>
                                    </fieldset>
                                    <input type="email" placeholder="Correo electrónico " required legend="#cor"
                                        name="correo">
                                </div>
                            </div>

                            <!-- Input funcionalito -->
                            <!-- <div class="col-md-6">
                                <div class="fieldset">
                                    <fieldset>
                                        <legend id="adjunto">Adjuntar Archivo</legend>
                                    </fieldset>
                                    <input type="file" id="fileInput" class="fileInput" accept=".jpg, .jpeg, .png, .gif" name="foto">
                                    <label for="fileInput" class="fileLabel">Foto de perfil </label>
                                </div>
                            </div> -->

                            <div class="col-md-6">
                                <div class="fieldset">
                                    <fieldset>
                                        <legend id="fileLegen">Foto de perfil</legend>
                                    </fieldset>
                                    <input type="file" id="fileInput" class="fileInput" accept=".jpg, .jpeg, .png, .gif"
                                        name="foto" onchange="checkFile()"  legend="#fileLegen" placeholder="hola">
                                    <label for="fileInput" class="fileLabel">Foto de perfil</label>
                                </div>
                            </div>

                            <!-- <div class="col-md-6">
                                <div class="fieldset">
                                    <fieldset>
                                        <legend id="foto">Foto</legend>
                                    </fieldset>
                                    <label for="" class="fileLabel">Foto</label>
                                    <input type="file" placeholder="Foto" required legend="#foto"
                                        id="campo1Est" name="clave">
                                </div>
                            </div> -->




                            <div class="col-md-6">
                                <div class="fieldset">
                                    <fieldset>
                                        <legend id="cla1Est">Clave nueva</legend>
                                    </fieldset>
                                    <input type="password" placeholder="Clave nueva" required legend="#cla1Est"
                                        id="campo1Est" name="clave">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="fieldset">
                                    <fieldset>
                                        <legend id="cla2Est">Verificar clave nueva</legend>
                                    </fieldset>
                                    <input type="password" placeholder="Verificar clave nueva" required
                                        legend="#cla2Est" id="verifyEst" verify="#campo1Est">
                                </div>
                            </div>




                            <p id="textoEst"></p>

                        </div>



                    </div>

                    <div class="col-md-2">
                        <img src="../../img/maleta.svg" alt="" class="formImg">
                    </div>

                    <div class="col-md-12">

                        <div class="submit">
                            <button type="button" class="btnAtras" onclick="btnToggle()"><img src="../../img/volver.svg"
                                    alt="volver">Atrás</button>
                            <button type="submit" class="btnPrincipal">Actualizar datos</button>
                        </div>


                    </div>



            </form>
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

    <!-- Link Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <!-- Tu script de JavaScript aquí... -->
    <script>

        function checkFile() {
            var fileInput = document.getElementById('fileInput');
            var fileLabel = document.querySelector('.fileLabel');

            if (fileInput.files.length > 0) {
                fileLabel.classList.add('valid');
            } else {
                fileLabel.classList.remove('valid');
            }
        }

        function btnToggle() {
            const formularioAcudiente = document.getElementById('formularioAcudiente');
            const formularioEstudiante = document.getElementById('formularioEstudiante');

            formularioAcudiente.classList.toggle("oculto");
            formularioEstudiante.classList.toggle("oculto");
        }

        // Función para verificar que dos campos son iguales en un formulario y en caso de serlo no se envía el formulario.
        const formularioRegistroPrimero = (event) => {
            event.preventDefault();
            const form = event.target;
            const text = document.getElementById('textoEst');

            // Validamos que los campos del documento son iguales
            let idcampo1 = document.getElementById('campo1Est');
            let campo1 = idcampo1.value;
            let campo2 = document.getElementById('verifyEst').value;

            if (campo1.length >= 8) {
                if (campo1 === campo2) {
                    text.innerText = ''; // Restablecer el mensaje de error
                    form.submit();
                } else {
                    text.innerText = 'Verifique las claves, los valores no son iguales';
                }
            } else {
                text.innerText = 'Recuerde que la clave debe tener mínimo 8 caracteres';
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('formularioGeneral').addEventListener('submit', formularioRegistroPrimero);
        });
    </script>

</body>

</html>