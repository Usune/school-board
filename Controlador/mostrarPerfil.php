<?php

    // FUNCIONES GENERALES PARA MOSTRAR INFORMACIÓN DEL USUARIO

    function primeraActualizacion(){

        $id = $_GET['id'];

        $objConsultas = new ConsultasUsuario();
        $consulta = $objConsultas->buscarUsuario($id);

        foreach($consulta as $f){

            if(strlen($f['correo'])>0){

                switch ($f['rol']){

                    case "Administrador":
                        echo "<script>location.href='homeAdmin.php?id=".$f['documento']."'</script>";
                    break;
                    case "Docente":
                        echo "<script>location.href='homeDoc.php?id=".$f['documento']."'</script>";
                    break;
                    case "Estudiante":
                        echo "<script>location.href='homeEstu.php?id=".$f['documento']."'</script>";
                    break;
    
                }

            }else {

                echo '
    
                <div class="fila-cont">
    
                    <div class="fieldset">
                        <fieldset>
                            <legend id="nom">Nombres</legend>
                        </fieldset>
                        <input type="text" value="'.$f['nombres'].'" placeholder="Nombres" required legend="#nom" name="nombres" readonly>
                    </div>
    
                    <div class="fieldset">
                        <fieldset>
                            <legend id="ape">Apellidos</legend>
                        </fieldset>
                        <input type="text" value="'.$f['apellidos'].'" placeholder="Apellidos" required legend="#ape" name="apellidos" readonly>
                    </div>
    
                </div>
    
                <div class="fila-cont">
    
                    <div class="fieldset">
                        <fieldset>
                            <legend id="tipo">Tipo de documento</legend>
                        </fieldset>
                        <input type="text" value="'.$f['tipoDoc'].'" placeholder="Tipo de documento" required legend="#tipo" name="tipoDoc" readonly>
                    </div>
    
                    <div class="fieldset">
                        <fieldset>
                            <legend id="usu">Documento</legend>
                        </fieldset>
                        <input type="number" value="'.$f['documento'].'" placeholder="Documento" required legend="#usu" name="documento" readonly>
                    </div>
    
                    <input type="text" value="'.$f['rol'].'" required name="rol" hidden>
                </div>
                ';

            }
        }

    }

    function perfilHome(){

        // session_start(); Se quita porque ya existe en el archivo se seguridad
        // VARIABLE DE SESIÓN DEL LOGIN
        $id = $_SESSION['id'];

        $objConsultas = new ConsultasUsuario();
        $consulta = $objConsultas->buscarUsuario($id);

        foreach($consulta as $f){
            echo '

                <button type="button" enlace="#op1" class="desplegar" id="butdesplegar">
                    <h2 enlace="#op1" id="nombre">'.$f['nombres'].'</h2>
                    <img src="'.$f['foto'].'" alt="imagen" enlace="#op1">
                </button>
                <div id="op1">
                    <ul>
                        <li><a href="perfil.php?id='.$f['documento'].'">Perfil</a></li>
                        <li><a href="../../../Controlador/cerrarSesion.php">Cerrar sesión</a></li>
                    </ul>
                </div>
            
            ';
        }
    }

    function actualizarPerfil(){

        $id = $_GET['id'];

        $objConsultas = new ConsultasUsuario();
        $consulta = $objConsultas->buscarUsuario($id);

        foreach($consulta as $f){
            echo '
                <div class="fotoNombre">
                    <img src="'.$f['foto'].'" alt="fotoPerfil">
                    <div class="texto">
                        <h4>'.$f['nombres'].'</h4>
                        <h4>'.$f['apellidos'].'</h4>
                        <h5>'.$f['tipoDoc'].' '.$f['documento'].'</h5>
                        <p>'.$f['rol'].'</p>
                    </div>
                </div>

                <div class="enlacesPerfil">
                    <a href="adminPerfil.php?id='.$f['documento'].'">Perfil</a>
                    <a href="adminPerfilFoto.php?id='.$f['documento'].'"">Cambiar Foto</a>
                    <a href="adminPerfilClave.php?id='.$f['documento'].'"">Cambiar Clave</a>
                </div>

                <div class="formulario">
                    <form action="../../../Controlador/actualizarPerfil.php" method="post" enctype="multipart/form-data">

                        <div class="fieldset">
                            <fieldset>
                                <legend id="cel">Celular</legend>
                            </fieldset>
                            <input type="number" placeholder="Celular" required legend="#cel" name="telefono" value="'.$f['telefono'].'">
                        </div>
    
                        <div class="fieldset">
                            <fieldset>
                                <legend id="cor">Correo</legend>
                            </fieldset>
                            <input type="email" placeholder="Correo" required legend="#cor" name="correo" value="'.$f['correo'].'">
                        </div>

                        <div class="fieldset">
                            <fieldset>
                                <legend id="dir">Dirección</legend>
                            </fieldset>
                            <input type="text" placeholder="Dirección" required legend="#dir" name="direccion" value="'.$f['direccion'].'">
                        </div>
                        
                        <input type="number" value="'.$f['documento'].'" required name="documento" hidden>

                        <button type="submit" class="enviar">Actualizar Datos</button>
                    </form>
                </div>
            ';
        }

    }

    function actualizarFoto() {
        $id = $_GET['id'];

        $objConsultas = new ConsultasUsuario();
        $consulta = $objConsultas->buscarUsuario($id);

        foreach($consulta as $f){

            echo'
                <div class="fotoNombre">
                <img src="'.$f['foto'].'" alt="fotoPerfil">
                    <div class="texto">
                        <h4>'.$f['nombres'].'</h4>
                        <h4>'.$f['apellidos'].'</h4>
                        <h5>'.$f['tipoDoc'].' '.$f['documento'].'</h5>
                        <p>'.$f['rol'].'</p>
                    </div>
                </div>

                <div class="enlacesPerfil">
                    <a href="adminPerfil.php?id='.$f['documento'].'">Perfil</a>
                    <a href="adminPerfilFoto.php?id='.$f['documento'].'"">Cambiar Foto</a>
                    <a href="adminPerfilClave.php?id='.$f['documento'].'"">Cambiar Clave</a>
                </div>

                <div class="formulario">                    
                    <!--  enctype="multipart/form-data" -->
                    <form action="../../../Controlador/actualizarPerfilFoto.php" method="post" enctype="multipart/form-data" id="formulario">

                        <div class="file">
                            <label for="archivo">Seleccione una foto</label>
                            <input type="file" accept=".jpg, .jpeg, .png, .gif" name="foto" required>
                        </div>
                        
                        <input type="number" value="'.$f['documento'].'" required name="documento" hidden>
                    
                        <button type="submit" class="enviar">Cambiar Foto</button>
                    </form>
                </div>
            ';

        }
    
    } 

    function actualizarClave() {
        $id = $_GET['id'];

        $objConsultas = new ConsultasUsuario();
        $consulta = $objConsultas->buscarUsuario($id);

        foreach($consulta as $f){

            echo'
                <div class="fotoNombre">
                <img src="'.$f['foto'].'" alt="fotoPerfil">
                    <div class="texto">
                        <h4>'.$f['nombres'].'</h4>
                        <h4>'.$f['apellidos'].'</h4>
                        <h5>'.$f['tipoDoc'].' '.$f['documento'].'</h5>
                        <p>'.$f['rol'].'</p>
                    </div>
                </div>

                <div class="enlacesPerfil">
                    <a href="adminPerfil.php?id='.$f['documento'].'">Perfil</a>
                    <a href="adminPerfilFoto.php?id='.$f['documento'].'"">Cambiar Foto</a>
                    <a href="adminPerfilClave.php?id='.$f['documento'].'"">Cambiar Clave</a>
                </div>

                <div class="formulario">                    
                    <!--  enctype="multipart/form-data" -->
                    <form action="../../../Controlador/actualizarPerfilClave.php" method="post">
                        
                        <div class="fieldset">
                            <fieldset>
                                <legend id="claA">Clave Actual</legend>
                            </fieldset>
                            <input type="password" placeholder="Clave Actual" required legend="#claA" name="claveActual">
                        </div>
                    
                        <div class="fieldset">
                            <fieldset>
                                <legend id="cla">Nueva Clave</legend>
                            </fieldset>
                            <input type="password" placeholder="Nueva clave" required legend="#cla" name="claveNueva">
                        </div>

                        <div class="fieldset">
                            <fieldset>
                                <legend id="cor">Confirmar clave</legend>
                            </fieldset>
                            <input type="password" placeholder="Confirmar clave" required legend="#cor" name="claveNueva2">
                        </div>
                        
                        <input type="number" value="'.$f['documento'].'" required name="documento" hidden>

                        <button type="submit" class="enviar">Actualizar Clave</button>
                    </form>
                <div>
            
            ';

        }


    }

?>