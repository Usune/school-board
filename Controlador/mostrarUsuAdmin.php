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

                <p id="texto"></p>
                
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

    function perfil(){

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
                        <li><a href="adminConfi.php">Configuración</a></li>
                        <li><a href="../../../Controlador/cerrarSesion.php">Cerrar sesión</a></li>
                    </ul>
                </div>
            
            ';
        }
    }

?>