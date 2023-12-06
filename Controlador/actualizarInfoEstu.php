<?php 

    // Funciones para actualizar datos del perfil del estudiante
    function actualizarPerfilEstu(){

        $id = $_GET['id'];

        $objConsultas = new ConsultasUsuario();
        $consulta = $objConsultas->buscarUsuario($id);

        foreach($consulta as $f){

            echo '
            <div class="col-sm-12 col-md-4 espacio">
                <div class="row fotoNombre">
                    <div class="col-md-12">
                        <img src="'.$f['foto'].'" alt="fotoPerfil">
                    </div>
                    <div class="col-md-12">
                        <h4>'.$f['nombres'].'</h4>
                    </div>
                    <div class="col-md-12">
                        <h4>'.$f['apellidos'].'</h4>
                    </div>
                    <div class="col-md-12">
                        <h5>'.$f['tipoDoc'].' '.$f['documento'].'</h5>
                    </div>
                    <div class="col-md-12">
                        <p>'.$f['rol'].'</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-8 espacio">
                <div class="perfilDerecha">
                    <div class="row enlacesPerfil">
                                <div class="col-md-3">
                                    <a href="perfil.php?id='.$f['documento'].'" class="activeP">Perfil</a>
                                </div>
                                <div class="col-md-3">
                                    <a href="perfilFoto.php?id='.$f['documento'].'"">Cambiar Foto</a>
                                </div>

                                <div class=" col-md-3">
                                        <a href="perfilClave.php?id='.$f['documento'].'"">Cambiar Clave</a>
                                </div>

                                <div class=" col-md-3">
                                            <a href="perfilAcudiente.php?id='.$f['documento'].'"">Perfil Acudiente</a>
                                </div>
                    </div>
                    <div class="col-md-12">
                                <p style=" color: var(--grisOscuro);">Nota.</p>
                                <p>
                                    Reescriba los campos que desea modificar.
                                    <br>
                                    Recuerde no dejar ningun campo vacio.
                                </p>
                    </div>
                        <div class="col-md-12">
                            <div class="formulario">
                                    <form action="../../../Controlador/actualizarPerfil.php" method="post"
                                        enctype="multipart/form-data">

                                        <div class="fieldset">
                                            <fieldset>
                                                <legend id="cel">Celular</legend>
                                            </fieldset>
                                            <input type="number" placeholder="Celular" required legend="#cel"
                                                name="telefono" value="'.$f['telefono'].'">
                                        </div>

                                        <div class="fieldset">
                                            <fieldset>
                                                <legend id="cor">Correo</legend>
                                            </fieldset>
                                            <input type="email" placeholder="Correo" required legend="#cor"
                                                name="correo" value="'.$f['correo'].'">
                                        </div>

                                        <div class="fieldset">
                                            <fieldset>
                                                <legend id="dir">Dirección</legend>
                                            </fieldset>
                                            <input type="text" placeholder="Dirección" required legend="#dir"
                                                name="direccion" value="'.$f['direccion'].'">
                                        </div>

                                        <input type="number" value="'.$f['documento'].'" required name="documento"
                                            hidden>

                                        <button type="submit" class="btnPrincipal">Actualizar Datos</button>
                                    </form>
                                </div>
                        </div>
                    </div>
                </div>
            ';

        }

    }

    function actualizarFotoEstu() {
        $id = $_GET['id'];

        $objConsultas = new ConsultasUsuario();
        $consulta = $objConsultas->buscarUsuario($id);

        foreach($consulta as $f){

            echo '
                <div class="col-sm-12 col-md-4 espacio">
                    <div class="row fotoNombre">
                        <div class="col-md-12">
                            <img src="'.$f['foto'].'" alt="fotoPerfil">
                        </div>
                        <div class="col-md-12">
                            <h4>'.$f['nombres'].'</h4>
                        </div>
                        <div class="col-md-12">
                            <h4>'.$f['apellidos'].'</h4>
                        </div>
                        <div class="col-md-12">
                            <h5>'.$f['tipoDoc'].' '.$f['documento'].'</h5>
                        </div>
                        <div class="col-md-12">
                            <p>'.$f['rol'].'</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-8 espacio">
                    <div class="perfilDerecha">
                        <div class="row enlacesPerfil">
                                    <div class="col-md-3">
                                        <a href="perfil.php?id='.$f['documento'].'">Perfil</a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="perfilFoto.php?id='.$f['documento'].'" class="activeP">Cambiar Foto</a>
                                    </div>

                                    <div class=" col-md-3">
                                            <a href="perfilClave.php?id='.$f['documento'].'"">Cambiar Clave</a>
                                    </div>

                                    <div class=" col-md-3">
                                                <a href="perfilAcudiente.php?id='.$f['documento'].'"">Perfil Acudiente</a>
                                    </div>
                        </div>
                        <div class="col-md-12">
                                    <p style=" color: var(--grisOscuro);">Nota.</p>
                                    <p>
                                        Para modificar su foto de perfil, presione el botón "Seleccionar archivo" y seleccione la foto que desea. </br></br>
                                        Se recomienda que la foto ya este recortada en forma de cuadrado.
                                    </p>
                        </div>
                            <div class="col-md-12 formulario">
                            <div class="formulario">                    
                            <!--  enctype="multipart/form-data" -->
                            <form action="../../../Controlador/actualizarPerfilFoto.php" method="post" enctype="multipart/form-data" id="formulario">
    
                                <div class="file">
                                    <label for="archivo">Seleccione una foto</label>
                                    <input type="file" accept=".jpg, .jpeg, .png, .gif" name="foto" required>
                                </div>
                                
                                <input type="number" value="'.$f['documento'].'" required name="documento" hidden>
                            
                                <button type="submit" class="btnPrincipal">Cambiar Foto</button>
                            </form>
                        </div>
                            </div>
                        </div>
                    </div>
            ';
            

        }
    
    } 

    function actualizarClaveEstu() {
        $id = $_GET['id'];

        $objConsultas = new ConsultasUsuario();
        $consulta = $objConsultas->buscarUsuario($id);

        foreach($consulta as $f){

            echo '
                <div class="col-sm-12 col-md-4 espacio">
                    <div class="row fotoNombre">
                        <div class="col-md-12">
                            <img src="'.$f['foto'].'" alt="fotoPerfil">
                        </div>
                        <div class="col-md-12">
                            <h4>'.$f['nombres'].'</h4>
                        </div>
                        <div class="col-md-12">
                            <h4>'.$f['apellidos'].'</h4>
                        </div>
                        <div class="col-md-12">
                            <h5>'.$f['tipoDoc'].' '.$f['documento'].'</h5>
                        </div>
                        <div class="col-md-12">
                            <p>'.$f['rol'].'</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-8 espacio">
                    <div class="perfilDerecha">
                        <div class="row enlacesPerfil">
                                    <div class="col-md-3">
                                        <a href="perfil.php?id='.$f['documento'].'">Perfil</a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="perfilFoto.php?id='.$f['documento'].'">Cambiar Foto</a>
                                    </div>

                                    <div class=" col-md-3">
                                            <a href="perfilClave.php?id='.$f['documento'].'" class="activeP">Cambiar Clave</a>
                                    </div>

                                    <div class=" col-md-3">
                                                <a href="perfilAcudiente.php?id='.$f['documento'].'"">Perfil Acudiente</a>
                                    </div>
                        </div>
                        <div class="col-md-12">
                            <p style=" color: var(--grisOscuro);">Nota.</p>
                            <p>
                                Para modificar su clave debe ingresar la clave actual y posteriormente la clave nueva.
                            </p>
                        </div>
                        <div class="col-md-12">
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

                                <button type="submit" class="btnPrincipal">Actualizar Clave</button>
                            </form>
                        <div>
                    </div>
                </div>
            ';


        }


    }

    function actualizarPerfilAcudiente2() {
        $id = $_GET['id'];

        $objConsultas = new ConsultasUsuario();
        $consulta = $objConsultas->buscarUsuario($id);

        foreach($consulta as $f){

            echo '
                <div class="col-sm-12 col-md-4 espacio">
                    <div class="row fotoNombre">
                        <div class="col-md-12">
                            <img src="'.$f['foto'].'" alt="fotoPerfil">
                        </div>
                        <div class="col-md-12">
                            <h4>'.$f['nombres'].'</h4>
                        </div>
                        <div class="col-md-12">
                            <h4>'.$f['apellidos'].'</h4>
                        </div>
                        <div class="col-md-12">
                            <h5>'.$f['tipoDoc'].' '.$f['documento'].'</h5>
                        </div>
                        <div class="col-md-12">
                            <p>'.$f['rol'].'</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-8 espacio">
                    <div class="perfilDerecha">
                        <div class="row enlacesPerfil">
                                    <div class="col-md-3">
                                        <a href="perfil.php?id='.$f['documento'].'">Perfil</a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="perfilFoto.php?id='.$f['documento'].'"">Cambiar Foto</a>
                                    </div>

                                    <div class=" col-md-3">
                                            <a href="perfilClave.php?id='.$f['documento'].'"">Cambiar Clave</a>
                                    </div>

                                    <div class=" col-md-3">
                                                <a href="perfilAcudiente.php?id='.$f['documento'].'"  class="activeP">Perfil Acudiente</a>
                                    </div>
                        </div>
                        <div class="col-md-12">
                                    <p style=" color: var(--grisOscuro);">Nota.</p>
                                    <p>
                                        Reescriba los campos que desea modificar.
                                        <br>
                                        Recuerde no dejar ningun campo vacio.
                                    </p>
                        </div>
                            <div class="col-md-12">
                                <div class="formulario">
                                        <form action="../../../Controlador/actualizarPerfil.php" method="post"
                                            enctype="multipart/form-data">

                                            <div class="fieldset">
                                                <fieldset>
                                                    <legend id="cel">Celular</legend>
                                                </fieldset>
                                                <input type="number" placeholder="Celular" required legend="#cel"
                                                    name="telefono" value="'.$f['telefono'].'">
                                            </div>

                                            <div class="fieldset">
                                                <fieldset>
                                                    <legend id="cor">Correo</legend>
                                                </fieldset>
                                                <input type="email" placeholder="Correo" required legend="#cor"
                                                    name="correo" value="'.$f['correo'].'">
                                            </div>

                                            <div class="fieldset">
                                                <fieldset>
                                                    <legend id="dir">Dirección</legend>
                                                </fieldset>
                                                <input type="text" placeholder="Dirección" required legend="#dir"
                                                    name="direccion" value="'.$f['direccion'].'">
                                            </div>

                                            <input type="number" value="'.$f['documento'].'" required name="documento"
                                                hidden>

                                            <button type="submit" class="btnPrincipal">Actualizar Datos</button>
                                        </form>
                                    </div>
                            </div>
                        </div>
                    </div>
            ';

        }


    }


    // Mostrar el acudiente
    function actualizarPerfilAcudiente(){
        $idEstudiante = $_SESSION['id'];
        $objConsultas = new Consultas();
        $filas = $objConsultas->cargarAcudienteEstu($idEstudiante);

        foreach ($filas as $f) {

            echo '
                <div class="col-sm-12 col-md-4 espacio">
                    <div class="row fotoNombre">
                        <div class="col-md-12">
                            <img src="'.$f['foto'].'" alt="fotoPerfil">
                        </div>
                        <div class="col-md-12">
                            <h4>'.$f['nombres'].'</h4>
                        </div>
                        <div class="col-md-12">
                            <h4>'.$f['apellidos'].'</h4>
                        </div>
                        <div class="col-md-12">
                            <h5>'.$f['tipoDoc'].' '.$f['documento'].'</h5>
                        </div>
                        <div class="col-md-12">
                            <p>'.$f['rol'].'</p>
                        </div>
                    </div>
                </div>
        
                <div class="col-sm-12 col-md-8 espacio">
                    <div class="perfilDerecha">
                        <div class="row enlacesPerfil">
                            <div class="col-md-3">
                                <a href="perfil.php?id='.$f['documento'].'">Perfil</a>
                            </div>
                            <div class="col-md-3">
                                <a href="perfilFoto.php?id='.$f['documento'].'"">Cambiar Foto</a>
                                                    </div>
        
                                                    <div class=" col-md-3">
                                    <a href="perfilClave.php?id='.$f['documento'].'"">Cambiar Clave</a>
                                                    </div>
        
                                                    <div class=" col-md-3">
                                        <a href="perfilAcudiente.php?id='.$f['documento'].'" class="activeP">Perfil Acudiente</a>
                            </div>
                        </div>
        
                        <div class="col-md-12">
                            <p style=" color: var(--grisOscuro);">Nota.</p>
                            <p class="card-text">
                                Para garantizar una experiencia segura y efectiva, te animamos a ingresar información precisa
                                sobre tu acudiente. La exactitud de estos datos es crucial para cualquier comunicación futura.
                            </p>
                        </div>
        
                        <div class="col-md-12">
                            <div class="formulario">
                                <form action="../../../Controlador/actualizarAcudienteEst.php" method="post">
        
                                    <!-- general -->
                                    <div class="row g-0">
        
                                        <div class="col-md-12 ">
                                            <div class="card-body">
        
                                                <div class="row">
        
                                                    <div class="row g-2">
                                                        <div class="col-md-6">
                                                            <div class="fieldset">
                                                                <fieldset>
                                                                    <legend id="nomAcu">Nombres</legend>
                                                                </fieldset>
                                                                <input type="text" placeholder="Nombres" required legend="#nomAcu"
                                                                    name="nomAcu" value="'.$f['acudienteNombres'].'">
                                                            </div>
                                                        </div>
        
                                                        <div class="col-md-6">
                                                            <div class="fieldset">
                                                                <fieldset>
                                                                    <legend id="apeAcu">Apellidos</legend>
                                                                </fieldset>
                                                                <input type="text" placeholder="Apellidos" required legend="#apeAcu"
                                                                    name="apeAcu" value="'.$f['acudienteApellidos'].'">
                                                            </div>
                                                        </div>
        
                                                        <div class="col-md-6">
        
                                                            <div class="fieldset">
                                                                <fieldset>
                                                                    <legend id="docAcu">Documento</legend>
                                                                </fieldset>
                                                                <input type="text" placeholder="Documento" required legend="#docAcu"
                                                                    name="docAcu" value="'.$f['acudienteDocumento'].'">
                                                            </div>
                                                        </div>
        
                                                        <div class="col-md-6">
                                                            <div class="fieldset">
                                                                <fieldset>
                                                                    <legend id="celAcu">Número de celular</legend>
                                                                </fieldset>
                                                                <input type="text" placeholder="Número de celular" required
                                                                    legend="#celAcu" name="celAcu" value="'.$f['acudienteTelefono'].'">
                                                            </div>
                                                        </div>
        
                                                        <div class="col-md-12">
                                                            <div class="fieldset">
                                                                <fieldset>
                                                                    <legend id="corAcu">Correo electrónico </legend>
                                                                </fieldset>
                                                                <input type="email" placeholder="Correo electrónico " required
                                                                    legend="#corAcu" name="corAcu" value="'.$f['acudienteCorreo'].'">
                                                            </div>
                                                        </div>
        
        
        
        
                                                    </div>
        
                                                </div>
                                            </div>
                                        </div>
        
                                    </div>
        
                                    <br>
        
                                 
                                        <div class="col-md-12">
                                            <button type="submit" class="btnPrincipal">Modificar</button>
                                        </div>
                                    
                                </form>
                            </div>
                        </div>
        
        
                    </div>
                </div>
            ';


        }
    }

?>