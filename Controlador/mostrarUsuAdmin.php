<?php

    // SE RECIBEN TODAS LAS CONSULTAS DE 

    // ESTA FUNCIÓN ES LA QUE SE LLAMA EN LA VISTA

    function cargarUsuarios(){
        
        $objConsultas = new Consultas();
        $consultas = $objConsultas->mostrarUsuAdmin();

        if (!isset($consultas)) {
            echo '<h2> No hay usuarios registrados </h2>';
        } else {

            foreach($consultas as $f) {

                echo '
                <tr>
                    <td>'.$f['tipoDoc'].'</td>
                    <td>'.$f['documento'].'</td>
                    <td>'.$f['apellidos'].'</td>
                    <td>'.$f['nombres'].'</td>
                    <td>'.$f['estado'].'</td>
                    <td>'.$f['rol'].'</td>

                    <td><a href="adminUsuModificar.php?id='.$f['documento'].'" alt="Modificar">Modificar<img src="../../img/edit.svg" alt="Eliminar"></a></td>

                    <td><a href="../../../Controlador/eliminarUsuAdmin.php?id='.$f['documento'].'">Eliminar<img src="../../img/eliminar.svg" alt="Eliminar"></a></td>
                </tr>
                ';

            }

        }

    } 

    function cargarUsuEditar(){

        // Aterrizamos la PK enviada desde la tabla
        $id = $_GET['id']; 

        // Eviamos la PK a una función de la clase consultas
        $objConsultas = new Consultas();
        $consulta = $objConsultas->mostrarUsuarioAdmin($id);

        // Pintamos la información consultada en el artefacto (formulario)
        foreach ($consulta as $f) {

            echo ' 
            <form action="../../../Controlador/actualizarUsuAdmin.php" method="post" id="formularioAdmin">

                <div class="fila-cont">

                    <div class="fieldset">
                        <fieldset>
                            <legend id="nom">Nombres</legend>
                        </fieldset>
                        <input type="text" value="'.$f['nombres'].'" placeholder="Nombres" required legend="#nom" name="nombres">
                    </div>

                    <div class="fieldset">
                        <fieldset>
                            <legend id="ape">Apellidos</legend>
                        </fieldset>
                        <input type="text" value="'.$f['apellidos'].'" placeholder="Apellidos" required legend="#ape" name="apellidos">
                    </div>

                </div>

                <div class="fila-cont">

                    <div class="fieldset_view">
                        <label for="rol">Rol</label>
                        <select class="veriSelect" required name="rol">
                            <option value="'.$f['rol'].'" selected>'.$f['rol'].'</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Profesor">Profesor</option>
                            <option value="Estudiante">Estudiante</option>
                        </select>
                    </div>

                    <div class="fieldset_view">
                        <label for="tipoDoc">Tipo identificación</label>
                        <select class="veriSelect" required name="tipoDoc">
                            <option value="'.$f['tipoDoc'].'" selected disabled>'.$f['tipoDoc'].'</option>
                            <option value="TI">TI</option>
                            <option value="CC">CC</option>
                            <option value="Pasaporte">Pasaporte</option>
                        </select>
                    </div>

                </div>

                <div class="fila-cont">

                    <div class="fieldset">
                        <fieldset>
                            <legend id="usu">Documento</legend>
                        </fieldset>
                        <input type="number" value="'.$f['documento'].'" placeholder="Documento" required legend="#usu" id="campo1" name="documento">
                    </div>

                    <div class="fieldset">
                        <fieldset>
                            <legend id="veri">Verificación documento</legend>
                        </fieldset>
                        <input type="number" value="'.$f['documento'].'" placeholder="Verificación documento" required legend="#veri" id="verify" verify="#campo1">
                    </div>

                </div>

                <div class="fila-cont">

                    <div class="fieldset_view">
                        <label for="estado">Estado</label>
                        <select class="veriSelect" required name="estado">
                            <option value="'.$f['estado'].'" selected>'.$f['estado'].'</option>
                            <option value="activo">activo</option>
                            <option value="inactivo">inactivo</option>
                        </select>
                    </div>

                </div>
                
                <button type="submit" class="enviar">Actualizar información</button>
            </form>
            ';
        }

    }

    function cargarUsuariosReportes(){
        
        $objConsultas = new Consultas();
        $consultas = $objConsultas->mostrarUsuAdmin();

        if (!isset($consultas)) {

            echo '<h2> No hay usuarios registrados </h2>';

        } else {

            foreach($consultas as $f) {

                echo '
                <tr>
                    <td>'.$f['tipoDoc'].'</td>
                    <td>'.$f['documento'].'</td>
                    <td>'.$f['apellidos'].'</td>
                    <td>'.$f['nombres'].'</td>
                    <td>'.$f['estado'].'</td>
                    <td>'.$f['rol'].'</td>
                    <td>'.$f['direccion'].'</td>
                    <td>'.$f['telefono'].'</td>
                    <td>'.$f['correo'].'</td>
                </tr>
                ';

            }

        }

    } 

    function perfilHome(){

        // session_start(); Se quita porque ya existe en el archivo se seguridad
        // VARIABLE DE SESIÓN DEL LOGIN
        $id = $_SESSION['id'];

        $objConsultas = new Consultas();
        $consulta = $objConsultas->verPerfil($id);

        foreach($consulta as $f){
            echo '

                <button type="button" enlace="#op1" class="desplegar" id="butdesplegar">
                    <h2 enlace="#op1" id="nombre">'.$f['nombres'].'</h2>
                    <img src="'.$f['foto'].'" alt="imagen" enlace="#op1">
                </button>
                <div id="op1">
                    <ul>
                        <li><a href="adminPerfil.php?id='.$f['documento'].'">Configuración</a></li>
                        <li><a href="../../../Controlador/cerrarSesion.php">Cerrar sesión</a></li>
                    </ul>
                </div>
            
            ';
        }
    }

    function actualizarPerfil(){

        $id = $_GET['id'];

        $objConsultas = new Consultas();
        $consulta = $objConsultas->verPerfil($id);

        foreach($consulta as $f){
            echo '
                <div class="fotoNombre fila-cont">
                    <img src="../../Uploads/Usuario/fotoUsuario.jpg" alt="fotoPerfil">
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
                    <form action="../../../Controlador/actualizarPerfilAdmin.php" method="post" enctype="multipart/form-data">

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

        $objConsultas = new Consultas();
        $consulta = $objConsultas->verPerfil($id);

        foreach($consulta as $f){

            echo'
                <div class="fotoNombre fila-cont">
                    <img src="../../Uploads/Usuario/fotoUsuario.jpg" alt="fotoPerfil">
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
                            <input type="file" accept=".jpg, .jpeg, .png, .gif" name="foto">
                        </div>
                    
                        <button type="submit" class="enviar">Cambiar Foto</button>
                    </form>
                </div>
            ';

        }
    
    }

    function actualizarClave() {
        $id = $_GET['id'];

        $objConsultas = new Consultas();
        $consulta = $objConsultas->verPerfil($id);

        foreach($consulta as $f){

            echo'
                <div class="fotoNombre fila-cont">
                    <img src="../../Uploads/Usuario/fotoUsuario.jpg" alt="fotoPerfil">
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
                    <form action="../../../Controlador/actualizarPerfilClave.php" method="post" enctype="multipart/form-data">
                        
                        <div class="fieldset">
                            <fieldset>
                                <legend id="claA">Clave Actual</legend>
                            </fieldset>
                            <input type="number" placeholder="Clave Actual" required legend="#claA">
                        </div>
                    
                        <div class="fieldset">
                            <fieldset>
                                <legend id="cla">Nueva Clave</legend>
                            </fieldset>
                            <input type="number" placeholder="Nueva clave" required legend="#cla">
                        </div>

                        <div class="fieldset">
                            <fieldset>
                                <legend id="cor">Confirmar clave</legend>
                            </fieldset>
                            <input type="email" placeholder="Confirmar clave" required legend="#cor">
                        </div>

                        <button type="submit" class="enviar">Actualizar Clave</button>
                    </form>
                <div>
            
            ';

        }


    }

?>