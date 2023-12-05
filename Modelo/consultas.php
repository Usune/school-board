<?php

    class Consultas{

        // CONSULTAS PARA ROL ADMINISTRADOR
        public function insertarUsuAdmin($nombres, $apellidos, $rol, $tipoDoc, $documento, $claveMd, $estado, $idCurso){

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            // SELECT DE USUARIO REGISTRADO EN EL SISTEMA
            $sql = 'SELECT * FROM usuario WHERE documento = :documento';
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':documento', $documento);
            $consulta->execute();
            // fetch() para corvertir un texto separado por comas en un array. Este no existira si en la consulta no se obtuvo nada.
            $f = $consulta->fetch();

            if ($f) {

                echo '<script>alert("Ya existe un usuario en el sistema con el número de documento ingresado")</script>';
                echo "<script>location.href='../Vista/html/Administrador/adminUsu.php'</script>";

            } else {
            
                // SE CREA LA VARIABLE QUE CONTENDRÁ LA CONSULTA A EJECUTAR EN LA TABLA usuario
                $sql = 'INSERT INTO usuario (documento, clave, rol, estado, tipoDoc, nombres, apellidos) VALUES (:documento, :claveMd, :rol, :estado, :tipoDoc, :nombres, :apellidos)';

                // PREPARAMOS TODO LO NOCESARIO PARA EJECUTAR LA FUNCION ANTERIOR
                $consulta = $conexion->prepare($sql);

                // CONVERTIMOS LOS ARGUMENTOS EN PARAMETROS
                $consulta->bindParam(':documento', $documento);
                $consulta->bindParam(':claveMd', $claveMd);
                $consulta->bindParam(':rol', $rol);
                $consulta->bindParam(':estado', $estado);
                $consulta->bindParam(':tipoDoc', $tipoDoc);
                $consulta->bindParam(':nombres', $nombres);
                $consulta->bindParam(':apellidos', $apellidos);

                // EJECUTAMOS EL INSERT DE LA TABLA usuario
                $consulta->execute();

                if($rol == 'Estudiante'){
            
                    $sql = 'INSERT INTO estudiantecurso (idCurso, idEstudiante) VALUES (:idCurso, :idEstudiante)';
    
                    $consulta = $conexion->prepare($sql);
    
                    $consulta->bindParam(':idCurso', $idCurso);
                    $consulta->bindParam(':idEstudiante', $documento);
    
                    $consulta->execute();
    
                    echo '<script>alert("Usuario con rol estudiante registrado con exito")</script>';

                }else if($rol == 'Docente'){

                    echo '<script>alert("Usuario con rol docente registrado con exito")</script>';

                }

                echo "<script>location.href='../Vista/html/Administrador/adminUsu.php'</script>";

            }

        }

        public function insertarCurAdmin($nombre, $jornada) {
            
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'SELECT * FROM curso WHERE nombre = :nombre AND jornada = :jornada';

            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':nombre', $nombre);
            $consulta->bindParam(':jornada', $jornada);
            $consulta->execute();

            $f = $consulta->fetch();

            if($f){

                echo '<script>alert("El nombre del curso ingresado ya existe en la jornada seleccionada")</script>';
                echo '<script>location.href="../Vista/html/Administrador/adminCurso.php"</script>';
                
            }else {

                $sql = 'INSERT INTO curso(nombre, jornada) VALUES (:nombre, :jornada)';
                $resultado = $conexion->prepare($sql);
                $resultado->bindParam(':nombre', $nombre);
                $resultado->bindParam(':jornada', $jornada);
    
                $resultado->execute();
    
                echo '<script>alert("El curso fue registrado")</script>';
                echo '<script>location.href="../Vista/html/Administrador/adminCurso.php"</script>';

            }

        }

        public function insertarObserDoc($idEstudiante, $idAutor, $descripcion, $fecha, $idClase)
        {
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'INSERT INTO observador(idEstudiante, idAutor, fecha, observacion) VALUES (:idEstudiante, :idAutor, :fecha, :observacion)';
            $resultado = $conexion->prepare($sql);
            $resultado->bindParam(':idEstudiante', $idEstudiante);
            $resultado->bindParam(':idAutor', $idAutor);
            $resultado->bindParam(':fecha', $fecha);
            $resultado->bindParam(':observacion', $descripcion);

            $resultado->execute();
            echo '<script>alert("La observación fue registrado")</script>';
            echo '<script>location.href="../Vista/html/Docente/docObser.php?documento='.$idEstudiante.'&idClase='.$idClase.' "</script>';

        }

        public function insertarAsigAdmin($nombre) {
            
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'SELECT * FROM asignatura WHERE nombre = :nombre';

            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':nombre', $nombre);
            $consulta->execute();

            $f = $consulta->fetch();

            if($f){

                echo '<script>alert("Ya existe una asignatura con el nombre ingresado")</script>';
                echo '<script>location.href="../Vista/html/Administrador/adminAsig.php"</script>';
                
            }else {

                $sql = 'INSERT INTO asignatura(nombre) VALUES (:nombre)';
                $resultado = $conexion->prepare($sql);
                $resultado->bindParam(':nombre', $nombre);
    
                $resultado->execute();
    
                echo '<script>alert("La asignatura fue creada correctamente")</script>';
                echo '<script>location.href="../Vista/html/Administrador/adminAsig.php"</script>';

            }

        }

        public function insertarAulaAdmin($nombre) {
            
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'SELECT * FROM aula WHERE nombre = :nombre';

            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':nombre', $nombre);
            $consulta->execute();

            $f = $consulta->fetch();

            if($f){

                echo '<script>alert("Ya existe un aula con el nombre ingresado")</script>';
                echo '<script>location.href="../Vista/html/Administrador/adminAula.php"</script>';
                
            }else {

                $sql = 'INSERT INTO aula(nombre) VALUES (:nombre)';
                $resultado = $conexion->prepare($sql);
                $resultado->bindParam(':nombre', $nombre);
    
                $resultado->execute();
    
                echo '<script>alert("El aula fue creada correctamente")</script>';
                echo '<script>location.href="../Vista/html/Administrador/adminAula.php"</script>';

            }

        }
        
        public function insertarComunAdmin($idUsuario, $idCurso, $titulo, $descripcion, $archivo) {

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'INSERT INTO comunicado (idUsuario, idCurso, titulo, descripcion, archivos) VALUES (:idUsuario, :idCurso, :titulo, :descripcion, :archivo)';
            $consulta = $conexion->prepare($sql);

            $consulta->bindParam(':idUsuario',$idUsuario);
            $consulta->bindParam(':idCurso',$idCurso);
            $consulta->bindParam(':titulo',$titulo);
            $consulta->bindParam(':descripcion',$descripcion);
            $consulta->bindParam(':archivo',$archivo);

            $consulta->execute();

            echo '<script>alert("Comunicado subido correctamente")</script>';
            echo "<script>location.href='../Vista/html/Administrador/adminComun.php'</script>";         

        }

        public function insertarObserAdmin($observacion, $idEstudiante, $idAutor, $fecha) {

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'INSERT INTO observador (idEstudiante, idAutor, observacion, fecha) VALUES (:idEstudiante, :idAutor, :observacion, :fecha)';
            $consulta = $conexion->prepare($sql);

            $consulta->bindParam(':idEstudiante',$idEstudiante);
            $consulta->bindParam(':idAutor',$idAutor);
            $consulta->bindParam(':observacion',$observacion);
            $consulta->bindParam(':fecha',$fecha);

            $consulta->execute();

            echo '<script>alert("Obervación subida correctamente")</script>';
            echo '<script>location.href="../Vista/html/Administrador/adminObser.php?id='.$idEstudiante.'"</script>';

        }

        public function insertarClaseAdmin($idCurso, $idAsignatura, $idDocente, $idAula, $descripcion) {

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'INSERT INTO clase (idCurso, idAsignatura, idDocente, idAula, descripción) VALUES (:idCurso, :idAsignatura, :idDocente, :idAula, :descripcion)';
            $consulta = $conexion->prepare($sql);

            $consulta->bindParam(':idCurso',$idCurso);
            $consulta->bindParam(':idAsignatura',$idAsignatura);
            $consulta->bindParam(':idDocente',$idDocente);
            $consulta->bindParam(':idAula',$idAula);
            $consulta->bindParam(':descripcion',$descripcion);

            $consulta->execute();

            echo '<script>alert("Clase creada correctamente")</script>';
            echo '<script>location.href="../Vista/html/Administrador/adminClase.php"</script>';

        }

        public function actualizarUsuAdmin($nombres, $apellidos, $rol, $tipoDoc, $documento, $estado, $claveMD, $id, $idCurso){
            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            // Evaluamos si se está cambiando el documento
            if ($id != $documento) {

                $sql1 = 'SELECT * FROM usuario WHERE documento = :documento';
                $consulta1 = $conexion->prepare($sql1);
                $consulta1->bindParam(':documento', $documento);
                $consulta1->execute();
    
                // fetch() para corvertir un texto separado por comas en un array. Este no existira si en la consulta no se obtuvo nada.
                $f = $consulta1->fetch();

                // SI SE ESTÁ CAMBIANDO MIRAMOS QUE NO EXISTA YA
                if($f){

                    echo '<script>alert("Ya existe un usuario en el sistema con el número de documento ingresado")</script>';
                    echo "<script>location.href='../Vista/html/Administrador/adminUsuModificar.php?id=".$id."'</script>";

                }else {
                
                    //ANTES DE HACER LA ACTUALIZACIÓN TRAEMOS EL DOCUMENTO ACTUAL HACIENDO UN SELECT PARA TRAER TODOS LOS DATOS DEL USUARIO
                    $sql = 'SELECT * FROM usuario WHERE documento = :documento';
                    $consulta = $conexion->prepare($sql);
                    $consulta->bindParam(':documento', $id);
                    $consulta->execute();
                    
                    while ($resultado = $consulta->fetch()) {
        
                        $f[] = $resultado;
        
                    }
        
                    // VERIFICAMOS SI YA HA INGRESADO
                    foreach ($f as $f1) {
        
                        if (strlen($f1['correo'])>0) {
        
                            $sql = 'UPDATE usuario SET documento=:documento, rol=:rol, estado=:estado, tipoDoc=:tipoDoc, nombres=:nombres, apellidos=:apellidos WHERE documento=:id';
                            $consulta = $conexion->prepare($sql);
                            
                            $consulta->bindParam(':documento', $documento);
                            $consulta->bindParam(':rol', $rol);
                            $consulta->bindParam(':estado', $estado);
                            $consulta->bindParam(':tipoDoc', $tipoDoc);
                            $consulta->bindParam(':nombres', $nombres);
                            $consulta->bindParam(':apellidos', $apellidos);
                            $consulta->bindParam(':id', $id);
                
                            $consulta->execute();
                
                            echo '<script>alert("Usuario actualizado con exito (Sin clave)")</script>';
        
                        } else {
        
                            $sql = 'UPDATE usuario SET documento=:documento, clave=:claveMD, rol=:rol, estado=:estado, tipoDoc=:tipoDoc, nombres=:nombres, apellidos=:apellidos WHERE documento=:id';
                            $consulta = $conexion->prepare($sql);
                            
                            $consulta->bindParam(':documento', $documento);
                            $consulta->bindParam(':claveMD', $claveMD);
                            $consulta->bindParam(':rol', $rol);
                            $consulta->bindParam(':estado', $estado);
                            $consulta->bindParam(':tipoDoc', $tipoDoc);
                            $consulta->bindParam(':nombres', $nombres);
                            $consulta->bindParam(':apellidos', $apellidos);
                            $consulta->bindParam(':id', $id);
                
                            $consulta->execute();
                
                            echo '<script>alert("Usuario actualizado con exito (Con clave)")</script>';
                
                        }

                    }

                }

            }else {
                
                // SELECT PARA TRAER TODOS LOS DATOS DEL USUARIO
                $sql = 'SELECT * FROM usuario WHERE documento = :documento';
                $consulta = $conexion->prepare($sql);
                $consulta->bindParam(':documento', $id);
                $consulta->execute();
                
                while ($resultado = $consulta->fetch()) {
    
                    $f[] = $resultado;
    
                }
    
                // VERIFICAR SI YA HA INGRESADO
                foreach ($f as $f1) {
    
                    if (strlen($f1['correo'])>0) {
    
                        $sql = 'UPDATE usuario SET documento=:documento, rol=:rol, estado=:estado, tipoDoc=:tipoDoc, nombres=:nombres, apellidos=:apellidos WHERE documento=:id';
                        $consulta = $conexion->prepare($sql);
                        
                        $consulta->bindParam(':documento', $documento);
                        $consulta->bindParam(':rol', $rol);
                        $consulta->bindParam(':estado', $estado);
                        $consulta->bindParam(':tipoDoc', $tipoDoc);
                        $consulta->bindParam(':nombres', $nombres);
                        $consulta->bindParam(':apellidos', $apellidos);
                        $consulta->bindParam(':id', $id);
            
                        $consulta->execute();
            
                        echo '<script>alert("Usuario actualizado con exito (Sin clave)")</script>';
    
                    } else {
    
                        $sql = 'UPDATE usuario SET documento=:documento, clave=:claveMD, rol=:rol, estado=:estado, tipoDoc=:tipoDoc, nombres=:nombres, apellidos=:apellidos WHERE documento=:id';
                        $consulta = $conexion->prepare($sql);
                        
                        $consulta->bindParam(':documento', $documento);
                        $consulta->bindParam(':claveMD', $claveMD);
                        $consulta->bindParam(':rol', $rol);
                        $consulta->bindParam(':estado', $estado);
                        $consulta->bindParam(':tipoDoc', $tipoDoc);
                        $consulta->bindParam(':nombres', $nombres);
                        $consulta->bindParam(':apellidos', $apellidos);
                        $consulta->bindParam(':id', $id);
            
                        $consulta->execute();
            
                        echo '<script>alert("Usuario actualizado con exito (Con clave)")</script>';
            
                    }

                }

            }

            if($rol == 'Estudiante') {

                $sql = 'UPDATE estudiantecurso SET idCurso=:idCurso WHERE idEstudiante = :idEstudiante';
                $consulta = $conexion->prepare($sql);
                
                $consulta->bindParam(':idCurso', $idCurso);
                $consulta->bindParam(':idEstudiante', $documento);
    
                $consulta->execute();
                
            }
            
            echo "<script>location.href='../Vista/html/Administrador/adminUsu.php'</script>";

        }

        public function actualizarCurAdmin($nombre, $jornada, $idCurso){
            $f = null;
            
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'SELECT * FROM curso WHERE nombre = :nombre AND jornada = :jornada';

            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':nombre', $nombre);
            $consulta->bindParam(':jornada', $jornada);
            $consulta->execute();

            $f = $consulta->fetch();

            if($f){

                echo '<script>alert("No se pudo realizar la actualización, el nombre del curso ingresado ya existe en la jornada seleccionada")</script>';
                echo '<script>location.href="../Vista/html/Administrador/adminCurModificar.php?id='.$idCurso.'"</script>';
                
            }else {
                
                $sql = 'UPDATE curso SET jornada=:jornada, nombre=:nombre WHERE idCurso=:idCurso';
                $consulta = $conexion->prepare($sql);
                
                $consulta->bindParam(':jornada', $jornada);
                $consulta->bindParam(':nombre', $nombre);
                $consulta->bindParam(':idCurso', $idCurso);
    
                $consulta->execute();
    
                echo '<script>alert("El curso fue actualizado correctamente")</script>';
                echo '<script>location.href="../Vista/html/Administrador/adminCur.php"</script>';

            }
        }

        public function actualizarAsigAdmin($nombre, $idAsignatura){
            $f = null;
            
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'SELECT * FROM asignatura WHERE nombre = :nombre';

            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':nombre', $nombre);
            $consulta->execute();

            $f = $consulta->fetch();

            if($f){

                echo '<script>alert("No se pudo realizar la actualización, el nombre ingresado ya existe en el sistema")</script>';
                echo '<script>location.href="../Vista/html/Administrador/adminAulaModificar.php?id='.$idAsignatura.'"</script>';
                
            }else {
                
                $sql = 'UPDATE asignatura SET nombre=:nombre WHERE idAsignatura=:idAsignatura';
                $consulta = $conexion->prepare($sql);
                
                $consulta->bindParam(':nombre', $nombre);
                $consulta->bindParam(':idAsignatura', $idAsignatura);
    
                $consulta->execute();
    
                echo '<script>alert("La asignatura fue actualizada correctamente")</script>';
                echo '<script>location.href="../Vista/html/Administrador/adminAsig.php"</script>';

            }
        }

        public function actualizarAulaAdmin($nombre, $idAula){
            $f = null;
            
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'SELECT * FROM aula WHERE nombre = :nombre';

            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':nombre', $nombre);
            $consulta->execute();

            $f = $consulta->fetch();

            if($f){

                echo '<script>alert("No se pudo realizar la actualización, el nombre ingresado ya existe en el sistema")</script>';
                echo '<script>location.href="../Vista/html/Administrador/adminAulaModificar.php?id='.$idAula.'"</script>';
                
            }else {
                
                $sql = 'UPDATE aula SET nombre=:nombre WHERE idAula=:idAula';
                $consulta = $conexion->prepare($sql);
                
                $consulta->bindParam(':nombre', $nombre);
                $consulta->bindParam(':idAula', $idAula);
    
                $consulta->execute();
    
                echo '<script>alert("El aula fue actualizada correctamente")</script>';
                echo '<script>location.href="../Vista/html/Administrador/adminAula.php"</script>';

            }
        }

        public function actualizarObserAdmin($observacion, $idObservacion, $idEstudiante){
            
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();
                
            $sql = 'UPDATE observador SET observacion=:observacion WHERE idObservador=:idObservacion';
            $consulta = $conexion->prepare($sql);
            
            $consulta->bindParam(':observacion', $observacion);
            $consulta->bindParam(':idObservacion', $idObservacion);

            $consulta->execute();

            echo '<script>alert("Observación modificada con exito")</script>';
            echo '<script>location.href="../Vista/html/Administrador/adminObser.php?id='.$idEstudiante.'"</script>';

        }

        public function actualizarComunAdmin($titulo, $descripcion, $archivo, $idCurso, $idComunicado, $idAutor){
            
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();
            // Se evalua que se haya enviado un archivo para saber si se debe modificar o no.
            if ($archivo == "../../Uploads/Comunicados/"){
                
                $sql = 'UPDATE comunicado SET idUsuario=:idUsuario, idCurso=:idCurso, titulo=:titulo, descripcion=:descripcion WHERE idComunicado=:idComunicado';

                $consulta = $conexion->prepare($sql);
    
                $consulta->bindParam(':idUsuario', $idAutor);
                $consulta->bindParam(':idCurso', $idCurso);
                $consulta->bindParam(':titulo', $titulo);
                $consulta->bindParam(':descripcion', $descripcion);
                $consulta->bindParam(':idComunicado', $idComunicado);
    
                $consulta->execute();
                echo '<script>alert("Comunicado modificado con exito(Sin archivo)")</script>';

            } else{
                
                $sql = 'UPDATE comunicado SET idUsuario=:idUsuario, idCurso=:idCurso, titulo=:titulo, descripcion=:descripcion, archivos=:archivo WHERE idComunicado=:idComunicado';

                $consulta = $conexion->prepare($sql);
    
                $consulta->bindParam(':idUsuario', $idAutor);
                $consulta->bindParam(':idCurso', $idCurso);
                $consulta->bindParam(':titulo', $titulo);
                $consulta->bindParam(':descripcion', $descripcion);
                $consulta->bindParam(':archivo', $archivo);
                $consulta->bindParam(':idComunicado', $idComunicado);
    
                $consulta->execute();
                echo '<script>alert("Comunicado modificado con exito (Con archivo)")</script>';

            }
            
            echo '<script>location.href="../Vista/html/Administrador/adminComun.php"</script>';

        }

        public function actualizarPerfil($telefono, $direccion, $correo, $documento){

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'UPDATE usuario SET telefono=:telefono, direccion=:direccion, correo=:correo WHERE documento=:documento';
            $consulta = $conexion->prepare($sql);
            
            $consulta->bindParam(':documento', $documento);
            $consulta->bindParam(':telefono', $telefono);
            $consulta->bindParam(':direccion', $direccion);
            $consulta->bindParam(':correo', $correo);

            $consulta->execute();

            echo '<script>alert("Usuario actualizado con exito")</script>';
            session_start();
            // echo $_SESSION['rol'];

            if($_SESSION['rol'] == 'Administrador') {
                echo '<script>location.href="../Vista/html/Administrador/Perfil.php?id='.$documento.'"</script>';
            }

            if($_SESSION['rol'] == 'Docente') {
                echo '<script>location.href="../Vista/html/Docente/Perfil.php?id='.$documento.'"</script>';
            }

            if($_SESSION['rol'] == 'Estudiante') {
                echo '<script>location.href="../Vista/html/Estudiante/Perfil.php?id='.$documento.'"</script>';
            }

        }

        public function actualizarFotoPerfil($documento, $foto){

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'UPDATE usuario SET foto=:foto WHERE documento=:documento';
            $consulta = $conexion->prepare($sql);
            
            $consulta->bindParam(':documento', $documento);
            $consulta->bindParam(':foto', $foto);

            $consulta->execute();
            
            echo '<script>alert("Foto actualizada con exito")</script>';
            session_start();

            if($_SESSION['rol'] == 'Administrador') {
                echo '<script>location.href="../Vista/html/Administrador/perfil.php?id='.$documento.'"</script>';
            }

            if($_SESSION['rol'] == 'Docente') {
                echo '<script>location.href="../Vista/html/Docente/Perfil.php?id='.$documento.'"</script>';
            }

            if($_SESSION['rol'] == 'Estudiante') {
                echo '<script>location.href="../Vista/html/Estudiante/Perfil.php?id='.$documento.'"</script>';
            }

        }

        public function actualizarClave($documento, $claveMD){

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'UPDATE usuario SET clave=:claveMD WHERE documento=:documento';
            $consulta = $conexion->prepare($sql);
            
            $consulta->bindParam(':documento', $documento);
            $consulta->bindParam(':claveMD', $claveMD);

            $consulta->execute();
            
            echo '<script>alert("Clave actualizada con exito")</script>';
            session_start();

            if($_SESSION['rol'] == 'Administrador') {
                echo '<script>location.href="../Vista/html/Administrador/perfil.php?id='.$documento.'"</script>';
            }

            if($_SESSION['rol'] == 'Docente') {
                echo '<script>location.href="../Vista/html/Docente/Perfil.php?id='.$documento.'"</script>';
            }

            if($_SESSION['rol'] == 'Estudiante') {
                echo '<script>location.href="../Vista/html/Estudiante/Perfil.php?id='.$documento.'"</script>';
            }

        }

        // Trae todos los usuarios registrados
        public function mostrarUsuariosAdmin() {
            $f = null;

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT * FROM usuario WHERE rol = 'Docente' OR rol = 'Estudiante' ORDER BY fechaCreacion DESC";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            
            while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }

            return $f;

        }

        // Trae un usuario especifico de los usuarios registrados
        public function mostrarUsuarioAdmin($id) {

           // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
           $objConexion = new Conexion();
           $conexion = $objConexion->get_conexion();

           $sql = "SELECT * FROM usuario WHERE documento=:id";
           $consulta = $conexion->prepare($sql);
           $consulta->bindParam(':id', $id);
           $consulta->execute(); 

           while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }

            // return para que la variable vualva a su estado inicial
            return $f;

        }

        // Trae todos los usuarios con rol docente registrados
        public function mostrarDocentesAdmin() {
            $f = null;

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT * FROM usuario WHERE rol = 'Docente' ORDER BY fechaCreacion DESC";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            
            while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }

            return $f;

        }

        // Trae todos los cursos registrados
        public function mostrarCursosAdmin() {
            $f = null;

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT
            c.idCurso,
            c.nombre,
            c.jornada,
            COUNT(ec.idEstudiante) AS cantidadEstudiantes
            FROM curso c
            LEFT JOIN estudianteCurso ec ON c.idCurso = ec.idCurso
            WHERE c.idCurso != 1
            GROUP BY c.idCurso, c.nombre, c.jornada
            ORDER BY c.idCurso DESC
            ";

            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            
            while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }

            return $f;
        }

        // Trae todas las asignaturas registrados
        public function mostrarAsignaturasAdmin() {
            $f = null;

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT 
            a.idAsignatura, a.nombre AS nombreAsig,
            COUNT(c.idCurso) AS cursos
            FROM asignatura a 
            LEFT JOIN clase cl ON a.idAsignatura = cl.idAsignatura
            LEFT JOIN curso c ON cl.idCurso = c.idCurso
            GROUP BY a.idAsignatura, a.nombre
            ORDER BY a.idAsignatura DESC";

            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            
            while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }

            return $f;
        }

        // Trae todas las aulas registrados
        public function mostrarAulasAdmin() {
            $f = null;

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT 
            a.idAula, a.nombre AS nombreAula,
            COUNT(cl.idClase) AS clases
            FROM aula a
            LEFT JOIN clase cl ON a.idAula = cl.idAula
            GROUP BY  a.idAula, a.nombre
            ORDER BY a.idAula DESC";

            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            
            while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }

            return $f;
        }

        // Trae todas las clases registradas
        public function mostrarClasesAdmin() {
            $f = null;

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT
            cl.idClase,
            u.nombres AS nombreDocente, u.foto,
            cl.descripción AS nombreClase,
            a.nombre AS nombreAula,
            asig.nombre AS nombreAsignatura,
            curso.nombre AS nombreCurso,
            COUNT(ec.idEstudiante) AS cantidadEstudiantes
            FROM clase cl
            JOIN usuario u ON cl.idDocente = u.documento
            JOIN aula a ON cl.idAula = a.idAula
            JOIN asignatura asig ON cl.idAsignatura = asig.idAsignatura
            JOIN curso ON cl.idCurso = curso.idCurso
            LEFT JOIN estudianteCurso ec ON cl.idCurso = ec.idCurso
            GROUP BY cl.idClase, u.nombres, u.foto, cl.descripción, a.nombre, asig.nombre, curso.nombre
            ORDER BY cl.idClase DESC";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            
            while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }

            return $f;

        }

        // Trae todos los comunicados registrados
        public function mostrarComunicadosAdmin() {
            $f = null;

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 
            "SELECT comunicado.idUsuario, usuario.nombres as nombre, usuario.apellidos as apellido, usuario.foto  as foto, 
            comunicado.idComunicado  as idComunicado, comunicado.titulo  as titulo, comunicado.fecha  as fecha, comunicado.descripcion  as descripcion,  comunicado.archivos  as archivo,
            curso.nombre as curso, curso.jornada as jornada
            
            FROM comunicado

            INNER JOIN usuario ON comunicado.idUsuario = usuario.documento
            INNER JOIN curso ON comunicado.idCurso = curso.idCurso
            ORDER BY fecha  DESC";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            
            while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }

            return $f;
        }

        // Trae las observaciones de un estudiante
        public function mostrarObservadorAdmin($documento) {
            $f = null;

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 
            "SELECT 
            o.observacion AS Observacion, o.idObservador AS idObservacion,
            CONCAT(a.nombres, ' ', a.apellidos) AS NombreAutor, a.foto AS fotoAutor, a.documento AS idAutor,
            CONCAT(e.nombres, ' ', e.apellidos) AS NombreEstudiante,
            e.tipoDoc, e.documento AS idEstudiante,
            o.fecha AS FechaObservacion
            FROM 
            observador o
            INNER JOIN usuario a ON o.idAutor = a.documento
            INNER JOIN usuario e ON o.idEstudiante = e.documento
            WHERE o.idEstudiante = :documento
            ORDER BY o.fecha DESC";

            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':documento', $documento);
            $consulta->execute();
            
            while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }

            return $f;

        }
        
        // Trae la observación de un estudiante
        public function mostrarObservacionAdmin($idEstudiante, $idObservacion) {
            $f = null;

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 
            "SELECT 
            o.observacion AS observacion, o.idObservador,
            CONCAT(a.nombres, ' ', a.apellidos) AS nombreAutor, a.foto AS fotoAutor, a.documento AS idAutor,
            CONCAT(e.nombres, ' ', e.apellidos) AS nombreEstudiante,
            e.tipoDoc, e.documento AS idEstudiante,
            o.fecha AS FechaObservacion
            FROM observador o
            INNER JOIN usuario a ON o.idAutor = a.documento
            INNER JOIN usuario e ON o.idEstudiante = e.documento
            WHERE o.idEstudiante = :documento AND o.idObservador = :idObservacion";

            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':documento', $idEstudiante);
            $consulta->bindParam(':idObservacion', $idObservacion);
            $consulta->execute();
            
            while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }

            return $f;

        }

        // Trae un curso especifico de los cursos registrados
        public function mostrarCursoAdmin($id) {

           // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
           $objConexion = new Conexion();
           $conexion = $objConexion->get_conexion();

           $sql = "SELECT * FROM curso WHERE idCurso=:id";
           $consulta = $conexion->prepare($sql);
           $consulta->bindParam(':id', $id);
           $consulta->execute(); 

           while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }

            // return para que la variable vualva a su estado inicial
            return $f;

        }

        // Trae una asignatura especifica de las asignaturas registradas
        public function mostrarAsignaturaAdmin($id) {

           // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
           $objConexion = new Conexion();
           $conexion = $objConexion->get_conexion();

           $sql = "SELECT * FROM asignatura WHERE idAsignatura=:id";
           $consulta = $conexion->prepare($sql);
           $consulta->bindParam(':id', $id);
           $consulta->execute(); 

           while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }

            // return para que la variable vualva a su estado inicial
            return $f;

        }

        // Trae un aula especifica de las aulas registradas
        public function mostrarAulaAdmin($id) {

           // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
           $objConexion = new Conexion();
           $conexion = $objConexion->get_conexion();

           $sql = "SELECT * FROM aula WHERE idAula=:id";
           $consulta = $conexion->prepare($sql);
           $consulta->bindParam(':id', $id);
           $consulta->execute(); 

           while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }

            // return para que la variable vualva a su estado inicial
            return $f;

        }

        // Trae un comunicados especifico registrados
        public function mostrarComunicadoAdmin($idComunicado) {
            $f = null;

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 
            "SELECT comunicado.idComunicado  as idComunicado, comunicado.titulo  as titulo, comunicado.descripcion  as descripcion, 
            curso.idCurso as idCurso, curso.nombre as curso, curso.jornada as jornada
            
            FROM comunicado

            INNER JOIN curso ON comunicado.idCurso = curso.idCurso
            
            WHERE comunicado.idComunicado = :idComunicado";
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':idComunicado', $idComunicado);
            $consulta->execute();
            
            while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }

            return $f;
        }

        public function filtrarUsuarios($rol, $estado, $nombres, $apellidos, $documento) {
            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'SELECT * FROM usuario WHERE rol NOT LIKE "Administrador"';

            if (!empty($nombres)) {
                $sql .= " AND nombres LIKE :nombres";
            }
            
            if (!empty($apellidos)) {
                $sql .= " AND apellidos LIKE :apellidos";
            }
            
            if (!empty($documento)) {
                $sql .= " AND documento = :documento";
            }
            
            if (!empty($estado) && $estado != 'nada') {
                $sql .= " AND estado = :estado";
            }
            
            if (!empty($rol) && $rol != 'nada') {
                $sql .= " AND rol = :rol";
            }

            $consulta = $conexion->prepare($sql);

            if (!empty($nombres)) {
                $nombres = '%'.$nombres.'%';
                $consulta->bindParam(':nombres', $nombres);
            }
            
            if (!empty($apellidos)) {
                
                $apellidos = '%'.$apellidos.'%';
                $consulta->bindParam(':apellidos', $apellidos);
            }
            
            if (!empty($documento)) {
                
                // $documento = '%'.$documento.'%';
                $consulta->bindParam(':documento', $documento);
            }

            if (!empty($estado) && $estado != 'nada') {
                $consulta->bindParam(':estado', $estado);
            }
            
            if (!empty($rol) && $rol != 'nada') {
                $consulta->bindParam(':rol', $rol);
            }

            $consulta->execute();

            while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }

            return $f;

        }

        public function filtrarCursos($jornada, $nombre) {
            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'SELECT
            c.idCurso,
            c.nombre,
            c.jornada,
            COUNT(ec.idEstudiante) AS cantidadEstudiantes
            FROM curso c
            LEFT JOIN estudianteCurso ec ON c.idCurso = ec.idCurso
            WHERE 1 = 1             
            ';
            
            if (!empty($jornada) && $jornada != 'nada') {
                $sql .= " AND jornada LIKE :jornada";
            }

            if (!empty($nombre)) {
                $sql .= " AND nombre LIKE :nombre";
            }

            $sql .= "
            GROUP BY c.idCurso, c.nombre, c.jornada
            ORDER BY c.idCurso DESC
            ";
            
            $consulta = $conexion->prepare($sql);
            
            if (!empty($jornada)  && $jornada != 'nada') {
                
                $consulta->bindParam(':jornada', $jornada);
            }

            if (!empty($nombre)) {
                $nombre = '%'.$nombre.'%';
                $consulta->bindParam(':nombre', $nombre);
            }
            
            $consulta->execute();

            while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }

            return $f;

        }

        public function filtrarAsignaturas($nombre) {
            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $nombre = '%'.$nombre.'%';
            $sql = 'SELECT 
            a.idAsignatura, a.nombre AS nombreAsig,
            COUNT(c.idCurso) AS cursos
            FROM asignatura a 
            LEFT JOIN clase cl ON a.idAsignatura = cl.idAsignatura
            LEFT JOIN curso c ON cl.idCurso = c.idCurso
            WHERE a.nombre LIKE :nombre
            GROUP BY a.idAsignatura, a.nombre
            ';

            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':nombre', $nombre);
            $consulta->execute();

            while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }

            return $f;

        }

        public function filtrarAulas($nombre) {
            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $nombre = '%'.$nombre.'%';
            $sql = 'SELECT 
            a.idAula, a.nombre AS nombreAula,
            COUNT(cl.idClase) AS clases
            FROM aula a
            LEFT JOIN clase cl ON a.idAula = cl.idAula
            WHERE a.nombre LIKE :nombre
            GROUP BY  a.idAula, a.nombre';
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':nombre', $nombre);
            $consulta->execute();

            while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }

            return $f;

        }
        
        public function buscarCursoEstudiante($idEstudiante) {

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'SELECT * FROM estudiantecurso WHERE idEstudiante = :idEstudiante';
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':idEstudiante', $idEstudiante);
            $consulta->execute();

            while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }

            $sql = 'SELECT * FROM curso WHERE idCurso = :idCurso';
            $consulta = $conexion->prepare($sql);
            
            foreach ($f as $f1) {
                $consulta->bindParam(':idCurso', $f1['idCurso']);
            }

            $consulta->execute();

            while ($resultado = $consulta->fetch()) {

                $f2[] = $resultado;

            }

            return $f2;

        }
        

        // CONSULTAS PARA ESTUDIANTES 

        // ESTUDIANTES ASISTENCIA

        // Funcion para cargar info de las clases correspondientes al estudiante
        public function cargarAsistencia($idEstudiante){
            $rows = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT asistencia.* FROM asistencia
            INNER JOIN usuario ON usuario.documento = asistencia.idEstudiante
            WHERE usuario.documento = :idEstudiante
            ORDER BY asistencia.fecha DESC";
            $statement = $conexion->prepare($sql);
            $statement->bindParam(':idEstudiante' , $idEstudiante);
            $statement->execute();

            while ($resultado = $statement->fetch()) {
                $rows[] = $resultado;
            }

            return $rows;
        }


        // ESTUDIANTES CLASES
        
        // Trae todas las clases registradas
        public function cargarClasesEstu($idEstudiante) {
            $f = null;

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT
            cl.idClase,
            u.nombres AS nombreDocente,
            u.apellidos AS apellidosDocente,
            u.foto,
            cl.descripción AS nombreClase,
            a.nombre AS nombreAula,
            asig.nombre AS nombreAsignatura,
            curso.nombre AS nombreCurso
            FROM clase cl
            JOIN usuario u ON cl.idDocente = u.documento
            JOIN aula a ON cl.idAula = a.idAula
            JOIN asignatura asig ON cl.idAsignatura = asig.idAsignatura
            JOIN curso ON cl.idCurso = curso.idCurso
            LEFT JOIN estudianteCurso ec ON cl.idCurso = ec.idCurso
            WHERE ec.idEstudiante = :idEstudiante
            GROUP BY cl.idClase, u.nombres, u.foto, cl.descripción, a.nombre, asig.nombre, curso.nombre
            ORDER BY cl.idClase DESC";
            $statement = $conexion->prepare($sql);
            $statement->bindParam(':idEstudiante' , $idEstudiante);
            $statement->execute();
            
            while ($resultado = $statement->fetch()) {

                $f[] = $resultado;

            }

            return $f;

        }

        // Funcion para cargar info de las clases correspondientes al estudiante
        public function cargarAsignaturas($idEstudiante){
            $rows = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT *,
            asignatura.nombre as asignaturaNombre,
            aula.nombre as aulaNombre
            FROM clase
            INNER JOIN asignatura ON asignatura.idAsignatura = clase.idAsignatura
            INNER JOIN usuario ON usuario.documento = clase.idDocente
            INNER JOIN curso ON curso.idCurso = clase.idCurso
            INNER JOIN estudiantecurso ON estudiantecurso.idestudianteCurso = curso.idCurso
            INNER JOIN aula ON aula.idAula = clase.idAula
            WHERE estudiantecurso.idEstudiante = :idEstudiante";
            $statement = $conexion->prepare($sql);
            $statement->bindParam(':idEstudiante' , $idEstudiante);
            $statement->execute();

            while ($resultado = $statement->fetch()) {
                $rows[] = $resultado;
            }

            return $rows;
        }

        // Funcion para cargar info de una clase correspondiente al estudiante
        public function cargarClase($idEstudiante, $idAsignatura){
            $rows = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT *,
            asignatura.nombre as asignaturaNombre,
            aula.nombre as aulaNombre
            FROM clase
            INNER JOIN asignatura ON asignatura.idAsignatura = clase.idAsignatura
            INNER JOIN usuario ON usuario.documento = clase.idDocente
            INNER JOIN curso ON curso.idCurso = clase.idCurso
            INNER JOIN estudiantecurso ON estudiantecurso.idCurso = curso.idCurso
            INNER JOIN aula ON aula.idAula = clase.idAula
            WHERE estudiantecurso.idEstudiante = :idEstudiante
            AND  asignatura.idAsignatura = :idAsignatura";
            $statement = $conexion->prepare($sql);
            $statement->bindParam(':idEstudiante' , $idEstudiante);
            $statement->bindParam(':idAsignatura' , $idAsignatura);
            $statement->execute();

            while ($resultado = $statement->fetch()) {
                $rows[] = $resultado;
            }

            return $rows;
        }

        // Funcion para cargar nav info Tarea de una clase correspondiente al estudiante
        public function cargarTareaNav($idTarea){
            $rows = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT *,
            asignatura.nombre as asignaturaNombre
            FROM 
            clase
            INNER JOIN tarea ON tarea.idClase = clase.idClase
            INNER JOIN asignatura ON asignatura.idAsignatura = clase.idAsignatura
            WHERE tarea.idTarea = :idTarea";
            $statement = $conexion->prepare($sql);
            $statement->bindParam(':idTarea' , $idTarea);
            $statement->execute();

            while ($resultado = $statement->fetch()) {
                $rows[] = $resultado;
            }

            return $rows;
        }

        // Función que trae todas las tareas asignadas a una asignatura en especifico, con la ultima entrega y calificacion del estudiante, incluye detalles sobre la asignatura y el docente.
        public function cargarTareasAsignatura($idEstudiante, $idAsignatura){
            $rows = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT tarea.* , calificacion.*,
                CASE 
                    WHEN entrega.idEntrega IS NOT NULL THEN 'entregada'
                    ELSE 'pendiente' 
                END AS estadoTarea
            FROM tarea
            JOIN clase ON tarea.idClase = clase.idClase
            JOIN asignatura ON clase.idAsignatura = asignatura.idAsignatura
            JOIN estudianteCurso ON clase.idCurso = estudianteCurso.idCurso
            JOIN usuario ON estudianteCurso.idEstudiante = usuario.documento
            LEFT JOIN entrega ON tarea.idTarea = entrega.idTarea AND entrega.idEstudiante = usuario.documento
            LEFT JOIN calificacion ON entrega.idEntrega = calificacion.idEntrega
            WHERE asignatura.idAsignatura = :idAsignatura AND usuario.documento = :idEstudiante";

            $statement = $conexion->prepare($sql);
            $statement->bindParam(':idEstudiante' , $idEstudiante);
            $statement->bindParam(':idAsignatura' , $idAsignatura);
            $statement->execute();

            while($resultado = $statement->fetch()){
                $rows[] = $resultado;
            }

            return $rows;

        }


        // Funcion que me obtiene todas las tareas de un estudiante junto con la última entrega realizada y su calificación correspondiente. Además, la consulta incluye información sobre la asignatura de la tarea y el docente que la asignó.
        public function cargarTodasTareas($idEstudiante){
            $rows = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT *,
            tarea.idTarea AS idTarea,
            asignatura.nombre as asignaturaNombre,
            usuario.foto as fotoDoc,
            CASE 
                WHEN entrega.idEntrega IS NOT NULL THEN 'entregada'
                ELSE 'pendiente' 
            END AS estadoTarea
        FROM tarea
        JOIN clase ON clase.idClase = tarea.idClase
        JOIN asignatura ON asignatura.idAsignatura = clase.idAsignatura
        JOIN curso ON curso.idCurso = clase.idCurso
        JOIN estudiantecurso ON estudiantecurso.idCurso = curso.idCurso
        JOIN usuario ON usuario.documento = clase.idDocente
        LEFT JOIN entrega ON entrega.idTarea = tarea.idTarea
        LEFT JOIN calificacion ON calificacion.idEntrega = entrega.idEntrega
        WHERE estudiantecurso.idEstudiante = :idEstudiante
        GROUP BY tarea.idTarea;
        ";

            $statement = $conexion->prepare($sql);
            $statement->bindParam(':idEstudiante' , $idEstudiante);
            $statement->execute();

            while($resultado = $statement->fetch()){
                $rows[] = $resultado;
            }

            return $rows;

        }

        // Funcion para mostrar info sobre la tarea 
        public function cargarTarea($idTarea){
            $rows = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT *,
            tarea.archivos as tareaArchivos
            FROM 
            tarea
            INNER JOIN usuario ON usuario.documento = tarea.idDocente
            WHERE tarea.idTarea = :idTarea";

            $statement = $conexion->prepare($sql);
            $statement->bindParam(':idTarea' , $idTarea);
            $statement->execute();

            while($resultado = $statement->fetch()){
                $rows[] = $resultado;
            }

            return $rows;

        }

        // Funcion para mostrar info sobre la tarea y las entregas del estudiante 
        public function cargarTareaConEntregas($idTarea, $idEstudiante){
            $rows = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT tarea.* ,entrega.*, calificacion.*, d.*,
            tarea.archivos AS tareaArchivos,
            tarea.descripcion AS tareaDescripcion,
            entrega.archivos AS entregaArchivos,
            entrega.descripcion AS entregaDescripcion,
            e.nombres AS eNombres,
            e.apellidos AS eApellidos,
            e.foto AS eFoto,
                CASE 
                    WHEN entrega.idEntrega IS NOT NULL THEN 'entregada'
                    ELSE 'pendiente' 
                END AS estadoTarea
            FROM tarea
            LEFT JOIN entrega ON entrega.idTarea = tarea.idTarea AND entrega.idEstudiante = :idEstudiante
            LEFT JOIN calificacion ON calificacion.idEntrega = entrega.idEntrega
            LEFT JOIN usuario e ON e.documento = entrega.idEstudiante
            LEFT JOIN usuario d ON d.documento = tarea.idDocente
            WHERE tarea.idTarea = :idTarea";

            $statement = $conexion->prepare($sql);
            $statement->bindParam(':idTarea' , $idTarea);
            $statement->bindParam(':idEstudiante' , $idEstudiante);
            $statement->execute();

            while($resultado = $statement->fetch()){
                $rows[] = $resultado;
            }

            return $rows;

        }

        // Función para entregar actividades
        public function insertarEntregaTarea($idEstudiante, $idTarea, $fechaEntrega, $descripcion, $archivos_str){
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "INSERT INTO entrega (idEstudiante, idTarea, fecha_entrega_est, descripcion, archivos) VALUES (:idEstudiante, :idTarea, :fechaEntrega, :descripcion, :archivos_str)";
            $statement = $conexion->prepare($sql);
            $statement->bindParam(':idEstudiante' , $idEstudiante);
            $statement->bindParam(':idTarea' , $idTarea);
            $statement->bindParam(':fechaEntrega' , $fechaEntrega);  
            $statement->bindParam(':descripcion' , $descripcion);
            $statement->bindParam(':archivos_str' , $archivos_str);
            $statement->execute();
            

            echo '<script>alert("Entrega exitosa")</script>';

            echo '<script>location.href="../Vista/html/Estudiante/tareaAsignatura.php?idTarea='.$idTarea.'"</script>';
        }

        // Función para modificar e0ntregas - actividades
        public function actualizarEntregaTarea($idEstudiante, $idTarea, $fechaEntrega, $descripcion, $archivos_str){
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "UPDATE entrega SET fecha_entrega_est=:fechaEntrega, descripcion=:descripcion, archivos=:archivos_str WHERE idTarea = :idTarea AND idEstudiante=:idEstudiante";
            $statement = $conexion->prepare($sql);
            $statement->bindParam(':idEstudiante' , $idEstudiante);
            $statement->bindParam(':idTarea' , $idTarea);
            $statement->bindParam(':fechaEntrega' , $fechaEntrega);  
            $statement->bindParam(':descripcion' , $descripcion);
            $statement->bindParam(':archivos_str' , $archivos_str);
            $statement->execute();
            

            echo '<script>alert("Modificación exitosa")</script>';

            echo '<script>location.href="../Vista/html/Estudiante/tareaAsignatura.php?idTarea='.$idTarea.'"</script>';
        }

        // Funcion para mostrar info sobre las observaciones de un estudiante
        public function cargarTodasObservaciones($idEstudiante){
            $rows = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT a.* , o.*
            FROM observador o
            INNER JOIN usuario a ON o.idAutor = a.documento
            INNER JOIN usuario e ON o.idEstudiante = e.documento
            WHERE o.idEstudiante =:idEstudiante";

            $statement = $conexion->prepare($sql);
            $statement->bindParam(':idEstudiante' , $idEstudiante);
            $statement->execute();

            while($resultado = $statement->fetch()){
                $rows[] = $resultado;
            }

            return $rows;

        }

        // Trae todos los comunicados registrados al curso del estudiante
        public function cargarComunicadosEstu($idEstudiante) {
            $rows = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql ="SELECT comunicado.*, u.*
            FROM comunicado 
            INNER JOIN curso ON curso.idCurso = comunicado.idCurso
            INNER JOIN estudiantecurso ON estudiantecurso.idCurso = curso.idCurso
            INNER JOIN usuario e ON e.documento = estudiantecurso.idEstudiante
            INNER JOIN usuario u ON u.documento = comunicado.idUsuario
            WHERE e.documento = :idEstudiante";

            $statement = $conexion->prepare($sql);
            $statement->bindParam(':idEstudiante' , $idEstudiante);
            $statement->execute();
            
            while ($resultado = $statement->fetch()) {

                $rows[] = $resultado;

            }

            return $rows;
        }

        // Funcion para mostrar info sobre el acudiente un estudiante
        public function cargarAcudienteEstu($idEstudiante) {
            $rows = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql ="SELECT usuario.*,
            acudiente.documento AS acudienteDocumento,
            acudiente.nombres AS acudienteNombres,
            acudiente.apellidos AS acudienteApellidos,
            acudiente.telefono AS acudienteTelefono,
            acudiente.correo AS acudienteCorreo
            FROM acudiente
            INNER JOIN estudianteacudiente ON estudianteacudiente.idAcudiente = acudiente.documento
            INNER JOIN usuario ON usuario.documento = estudianteacudiente.idEstudiante
            WHERE usuario.documento = :idEstudiante";

            $statement = $conexion->prepare($sql);
            $statement->bindParam(':idEstudiante' , $idEstudiante);
            $statement->execute();
            
            while ($resultado = $statement->fetch()) {

                $rows[] = $resultado;

            }

            return $rows;
        }


        // Funcion para modificar info sobre el acudiente un estudiante
        public function actualizacionAcudienteEst($idEstudiante, $nomAcu, $apeAcu, $docAcu, $celAcu, $corAcu) {

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $eliminarEstudianteAcudiente = "DELETE FROM estudianteAcudiente WHERE idAcudiente = :docAcu";
            $statement = $conexion->prepare($eliminarEstudianteAcudiente);
            $statement->bindParam(':docAcu', $docAcu); 
            $statement->execute();

            $sqlAcudiente = "UPDATE acudiente SET nombres=:nomAcu, apellidos=:apeAcu, documento=:docAcu, telefono=:celAcu, correo=:corAcu WHERE documento=:docAcu";

            $statement = $conexion->prepare($sqlAcudiente);
            $statement->bindParam(':nomAcu' , $nomAcu);
            $statement->bindParam(':apeAcu' , $apeAcu);
            $statement->bindParam(':docAcu' , $docAcu);
            $statement->bindParam(':celAcu' , $celAcu);
            $statement->bindParam(':corAcu' , $corAcu);
            $statement->bindParam(':idEstudiante' , $idEstudiante);
            $statement->execute();


            $sql = "INSERT INTO estudianteAcudiente (idAcudiente, idEstudiante) VALUES (:docAcu, :idEstudiante)";

            $statement = $conexion->prepare($sql);
            $statement->bindParam(':docAcu' , $docAcu);
            $statement->bindParam(':idEstudiante' , $idEstudiante);
            $statement->execute();

          

            echo '<script>alert("Actualización exitosa")</script>';
            echo '<script>location.href="../Vista/html/Estudiante/perfilAcudiente.php"</script>';


    
        }


        // FUNCIONES MOSTRAR USUARIOS
        //  Función para mostrar todos los usuarios (Integrantes)
        public function cargarTodosUsuarios() {
            $rows = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'SELECT * FROM usuario';
            $statement = $conexion->prepare($sql);
            $statement->execute();

            while($resultado = $statement->fetch()){
                $rows[] = $resultado;
            }

            return $rows;

        }

        //  Función para mostrar usuarios filtrados (Integrantes) 
        public function cargarUsuariosFiltrados($rol, $estado, $nombres) {
            $f = null;
        
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();
        
            $sql = 'SELECT * FROM usuario WHERE';
        
            $condiciones = array();
        
            if (!empty($nombres)) {
                $condiciones[] = "nombres LIKE :nombres";
            }
        
            if (!empty($estado) && $estado != 'nada') {
                $condiciones[] = "estado = :estado";
            }
        
            if (!empty($rol) && $rol != 'nada') {
                $condiciones[] = "rol = :rol";
            }
        
            if (!empty($condiciones)) {
                $sql .= ' ' . implode(' AND ', $condiciones);
            }
        
            $consulta = $conexion->prepare($sql);
        
            if (!empty($nombres)) {
                $nombres = '%'.$nombres.'%';
                $consulta->bindParam(':nombres', $nombres);
            }
        
            if (!empty($estado) && $estado != 'nada') {
                $consulta->bindParam(':estado', $estado);
            }
        
            if (!empty($rol) && $rol != 'nada') {
                $consulta->bindParam(':rol', $rol);
            }
        
            $consulta->execute();
        
            while ($resultado = $consulta->fetch()) {
                $f[] = $resultado;
            }
        
            return $f;
        }

        // Funcion para mostrar todos los compañeros (relacionados)
        public function cargarTodosCompañeros($idEstudiante){
            $rows = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT compañeros.*
                FROM estudiantecurso 
                INNER JOIN curso ON estudiantecurso.idCurso = curso.idCurso
                INNER JOIN usuario ON usuario.documento = estudiantecurso.idEstudiante
                INNER JOIN estudiantecurso AS compañerosCurso ON compañerosCurso.idCurso = curso.idCurso
                INNER JOIN usuario AS compañeros ON compañeros.documento = compañerosCurso.idEstudiante
                WHERE usuario.documento = :idEstudiante AND compañeros.documento != :idEstudiante"
            ;

            $statement = $conexion->prepare($sql);
            $statement->bindParam('idEstudiante' , $idEstudiante);
            $statement->execute();

            while($resultado = $statement->fetch()){
                $rows[] = $resultado;
            }

            return $rows;

        }

        //  Función para mostrar compañeros filtrados (Integrantes) 
        public function cargarCompañerosFiltrados($estado, $nombres, $idEstudiante) {
            $f = null;
        
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();
        
            $sql = 'SELECT compañeros.*
            FROM estudiantecurso 
            INNER JOIN curso ON estudiantecurso.idCurso = curso.idCurso
            INNER JOIN usuario ON usuario.documento = estudiantecurso.idEstudiante
            INNER JOIN estudiantecurso AS compañerosCurso ON compañerosCurso.idCurso = curso.idCurso
            INNER JOIN usuario AS compañeros ON compañeros.documento = compañerosCurso.idEstudiante
            WHERE usuario.documento = :idEstudiante AND compañeros.documento != :idEstudiante AND compañeros.';
        
            $condiciones = array();
        
            if (!empty($nombres)) {
                $condiciones[] = "nombres LIKE :nombres";
            }
        
            if (!empty($estado) && $estado != 'nada') {
                $condiciones[] = "estado = :estado";
            }
        
        
            if (!empty($condiciones)) {
                $sql .= ' ' . implode(' AND ', $condiciones);
            }

        
            $consulta = $conexion->prepare($sql);

            // echo "Consulta SQL: " . $sql . "<br>";
        
            if (!empty($nombres)) {
                $nombres = '%'.$nombres.'%';
                $consulta->bindParam(':nombres', $nombres);
            }
        
            if (!empty($estado) && $estado != 'nada') {
                $consulta->bindParam(':estado', $estado);
            }
        
            $consulta->bindParam(':idEstudiante', $idEstudiante);


            $consulta->execute();
        
            while ($resultado = $consulta->fetch()) {
                $f[] = $resultado;
            }
        
            return $f;
        }


        // Funcion para mostrar todos los profesores (relacionados)
        public function cargarTodosprofesores($idEstudiante){
            $rows = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT  *
            FROM clase 
            JOIN usuario
            ON clase.idDocente = usuario.documento
            JOIN estudianteCurso 
            ON clase.idCurso = estudianteCurso.idCurso
            WHERE estudianteCurso.idEstudiante = :idEstudiante"
            ;

            $statement = $conexion->prepare($sql);
            $statement->bindParam('idEstudiante' , $idEstudiante);
            $statement->execute();

            while($resultado = $statement->fetch()){
                $rows[] = $resultado;
            }

            return $rows;

        }

        //  Función para mostrar Profesores filtrados (Integrantes) 
        public function cargarProfesoresFiltrados($estado, $nombres, $idEstudiante) {
            $f = null;
        
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();
        
            $sql = 'SELECT  *
            FROM clase 
            JOIN usuario
            ON clase.idDocente = usuario.documento
            JOIN estudianteCurso 
            ON clase.idCurso = estudianteCurso.idCurso
            WHERE estudianteCurso.idEstudiante = :idEstudiante AND usuario.';
        
            $condiciones = array();
        
            if (!empty($nombres)) {
                $condiciones[] = "nombres LIKE :nombres";
            }
        
            if (!empty($estado) && $estado != 'nada') {
                $condiciones[] = "estado = :estado";
            }
        
        
            if (!empty($condiciones)) {
                $sql .= ' ' . implode(' AND ', $condiciones);
            }

        
            $consulta = $conexion->prepare($sql);

            // echo "Consulta SQL: " . $sql . "<br>";
        
            if (!empty($nombres)) {
                $nombres = '%'.$nombres.'%';
                $consulta->bindParam(':nombres', $nombres);
            }
        
            if (!empty($estado) && $estado != 'nada') {
                $consulta->bindParam(':estado', $estado);
            }
        
            $consulta->bindParam(':idEstudiante', $idEstudiante);


            $consulta->execute();
        
            while ($resultado = $consulta->fetch()) {
                $f[] = $resultado;
            }
        
            return $f;
        }





        

        // CONSULTAS DOCENTES
        // Función para entregar actividades
        public function insertarTarea($descripcion, $archivos_str){
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "INSERT INTO tarea (descripcion, archivos)  VALUES (:descripcion, :archivos_str)";
            $statement = $conexion->prepare($sql);
            $statement->bindParam(':descripcion' , $descripcion);
            $statement->bindParam(':archivos_str' , $archivos_str);
            $statement->execute();

            echo '<script>alert("Entrega exitosa")</script>';
            echo '<script>location.href="../Vista/html/Estudiante/tareaAsignatura.php"</script>';

        }

        //FUNCION PARA CARGAR LOS CURSOS ASIGNADOS A UN DOCENTE

        public function mostrarClasesDoc($documento){
            
            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT
            cl.idClase,
            u.nombres AS nombreDocente, u.foto,
            cl.descripción AS nombreClase,
            a.nombre AS nombreAula,
            asig.nombre AS nombreAsignatura,
            curso.nombre AS nombreCurso,
            curso.jornada AS jornadaCurso,
            COUNT(ec.idEstudiante) AS cantidadEstudiantes
            FROM clase cl
            JOIN usuario u ON cl.idDocente = u.documento
            JOIN aula a ON cl.idAula = a.idAula
            JOIN asignatura asig ON cl.idAsignatura = asig.idAsignatura
            JOIN curso ON cl.idCurso = curso.idCurso
            LEFT JOIN estudianteCurso ec ON cl.idCurso = ec.idCurso
            WHERE cl.idDocente = :documento
            GROUP BY cl.idClase, u.nombres, u.foto, cl.descripción, a.nombre, asig.nombre, curso.nombre, curso.jornada
            ORDER BY cl.idClase DESC
            ";

            $result = $conexion->prepare($sql);

            $result->bindParam(':documento',$documento);

            $result->execute();


            //para que separe el result en un array
            while ($resultado = $result->fetch()){
                $f[] = $resultado;
            }

            return $f;

        }

        public function mostrarCurDoc($idCurso){
            
            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT * FROM curso WHERE idCurso = :id";
            
            $result = $conexion->prepare($sql);

            $result->bindParam(':id',$idCurso);

            $result->execute();

            //para que separe el result en un array
            while ($resultado = $result->fetch()){
                $f[] = $resultado;
            }

            return $f;


        }

        public function insertarTarDoc($titulo, $descripcion, $fecha_creacion, $fecha_vencimiento, $archivos,$idClase, $idDocente) {

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'INSERT INTO tarea (idClase, idDocente,titulo, descripcion, fecha_creacion, fecha_vencimiento, archivos) VALUES (:idClase, :idDocente,:titulo, :descripcion, :fecha_C, :fecha_V, :archivos)';
            $consulta  = $conexion ->prepare($sql);

            $consulta->bindParam(':idDocente',$idDocente);
            $consulta->bindParam(':idClase',$idClase);
            $consulta->bindParam(':titulo',$titulo);
            $consulta->bindParam(':descripcion',$descripcion);
            $consulta->bindParam(':fecha_C',$fecha_creacion);
            $consulta->bindParam(':fecha_V',$fecha_vencimiento);
            $consulta->bindParam(':archivos',$archivos);

            $consulta->execute();

            echo '<script>alert("Tarea registrada exitosamente")</script>';
            echo '<script>location.href="../Vista/html/Docente/tareasDoc.php?idClase='.$idClase.'"</script>';
            
        }

        public function actualizarComunDoc($titulo, $fecha, $descripcion, $archivo, $idComunicado, $idCurso, $idClase){
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'UPDATE comunicado SET titulo=:titulo, fecha=:fecha, descripcion=:descripcion WHERE idComunicado=:idComunicado AND idCurso=:idCurso';
            $consulta = $conexion->prepare($sql);
            
            $consulta->bindParam(':titulo', $titulo);
            $consulta->bindParam(':fecha', $fecha);
            $consulta->bindParam(':descripcion', $descripcion);            
            $consulta->bindParam(':idComunicado', $idComunicado);     
            $consulta->bindParam(':idCurso', $idCurso);     

            $consulta->execute();
            
            echo '<script>alert("Comunicado actualizado correcamente")</script>';
            echo '<script>location.href="../Vista/html/Docente/docComun.php?idClase='.$idClase.'"</script>'; 
        }

        public function ActualizarTarDoc($titulo, $descripcion, $fecha_creacion, $fecha_vencimiento, $id, $idClase, $archivos, $nombreArchivo) {

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'SELECT*FROM tarea WHERE titulo = :titulo AND descripcion = :descripcion AND fecha_creacion = :fecha_C AND fecha_vencimiento = :fecha_V AND idTarea = :id AND idClase = idClase';

            $consulta = $conexion->prepare($sql);
            
                            
            $consulta->bindParam(':titulo', $titulo);
            $consulta->bindParam(':descripcion', $descripcion);
            $consulta->bindParam(':fecha_C', $fecha_creacion);
            $consulta->bindParam(':fecha_V', $fecha_vencimiento);
            $consulta->bindParam(':id', $id);

            $consulta->execute();

            $f = $consulta->fetch();

            if($f){

                echo '<script>alert("No se pudo realizar la actualización, debe actualizar al menos un campo")</script>';
                echo '<script>location.href="../Vista/html/Docente/docTareaModificar.php?idClase='.$idClase.'"</script>';
                
            }else {
                
                $sql = 'UPDATE tarea 
                        SET titulo=:titulo, 
                            descripcion=:descripcion, 
                            fecha_creacion=:fecha_C, 
                            fecha_vencimiento=:fecha_V'
                            . ($nombreArchivo == "" ? '' : ', archivos = :archivos') .
                            '                            
                        WHERE idTarea=:id';
                
                $consulta = $conexion->prepare($sql);
                
                $consulta->bindParam(':titulo', $titulo);
                $consulta->bindParam(':descripcion', $descripcion);
                $consulta->bindParam(':fecha_C', $fecha_creacion);
                $consulta->bindParam(':fecha_V', $fecha_vencimiento);
                $consulta->bindParam(':id', $id);
                
                if ($nombreArchivo != "")
                    $consulta->bindParam(':archivos', $archivos);

                $consulta->execute();
    
                echo '<script>alert("Tarea actualizado con exito</script>';
                echo '<script>location.href="../Vista/html/docente/tareasDoc.php?idClase='.$idClase.'"</script>';

            }
            

            
            
        }

      
        public function consultarTareasDoc($docente, $clase){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'SELECT tarea.idTarea as idTarea, tarea.titulo as titulo, tarea.descripcion as descripcion, tarea.fecha_creacion as fecha_C, 
                        tarea.fecha_vencimiento as fecha_V, tarea.archivos as archivos, usuario.nombres as nombreUsu, usuario.apellidos as apellidoUsu, 
                        usuario.foto as fotoUsu, entrega.idTarea AS ExisteEntrega
                    FROM tarea INNER JOIN 
                        usuario ON tarea.idDocente = usuario.documento LEFT JOIN 
                        entrega on entrega.idTarea=tarea.idTarea 
                    WHERE tarea.idClase = :idClase
                    GROUP BY tarea.idTarea, tarea.titulo, tarea.descripcion, tarea.fecha_creacion, tarea.fecha_vencimiento, tarea.archivos, 
                            usuario.nombres, usuario.apellidos, usuario.foto, entrega.idTarea 
                    ORDER BY fecha_C DESC';

            $consulta = $conexion->prepare($sql);          
            $consulta->bindParam(':idClase', $clase); 
            $consulta->execute();

            while ($resultado = $consulta->fetch()) {
                $f[] = $resultado;
            }

            return $f;            

        }

        public function consultarTareaDoc($idTarea){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'SELECT idTarea ,titulo,descripcion,fecha_creacion AS fecha_C ,fecha_vencimiento AS fecha_V,archivos FROM tarea WHERE idTarea='.$idTarea;

            $consulta = $conexion->prepare($sql);          
      
            $consulta->execute();

            while ($resultado = $consulta->fetch()) {
                $f[] = $resultado;
            }

            return $f;            

        }

        public function TarDoc($titulo, $descripcion, $fecha_creacion, $fecha_vencimiento, $id, $idClase) {

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'SELECT*FROM tarea WHERE titulo = :titulo AND descripcion = :descripcion AND fecha_creacion = :fecha_C AND fecha_vencimiento = :fecha_V AND idTarea = :id AND idClase = idClase';

            $consulta = $conexion->prepare($sql);
            
                            
            $consulta->bindParam(':titulo', $titulo);
            $consulta->bindParam(':descripcion', $descripcion);
            $consulta->bindParam(':fecha_C', $fecha_creacion);
            $consulta->bindParam(':fecha_V', $fecha_vencimiento);
            $consulta->bindParam(':id', $id);

            $consulta->execute();

            $f = $consulta->fetch();

            if($f){

                echo '<script>alert("No se pudo realizar la actualización, debe actualizar al menos un campo")</script>';
                echo '<script>location.href="../Vista/html/Docente/docTareaModificar.php?idClase='.$idClase.'"</script>';
                
            }else {
                
                $sql = 'UPDATE tarea SET titulo=:titulo, descripcion=:descripcion, fecha_creacion=:fecha_C, fecha_vencimiento=:fecha_V WHERE idTarea=:id';
                
                $consulta = $conexion->prepare($sql);
                
                $consulta->bindParam(':titulo', $titulo);
                $consulta->bindParam(':descripcion', $descripcion);
                $consulta->bindParam(':fecha_C', $fecha_creacion);
                $consulta->bindParam(':fecha_V', $fecha_vencimiento);
                $consulta->bindParam(':id', $id);
                $consulta->execute();
    
                echo '<script>alert("Tarea actualizado con exito</script>';
                echo '<script>location.href="../Vista/html/docente/tareasDoc.php?idClase='.$idClase.'"</script>';

            }
            

            
            
        }

        public function eliminarTarDoc($idTarea, $idClase) {

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();
                     
            $sql = 'DELETE FROM tarea WHERE idTarea = :idTarea AND idClase = :idClase';
        
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':idTarea', $idTarea);
            $consulta->bindParam(':idClase', $idClase);
            $consulta->execute();
            
            echo '<script>alert("La tarea ha sido eliminado.")</script>';
            echo '<script>location.href="../Vista/html/docente/tareasDoc.php?idTarea='.$idTarea.'&idClase='.$idClase.'"</script>';


        }

        public function mostrarObservadorDoc($documento, $clase) {
            $f = null;

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 
            "SELECT 
            o.observacion AS Observacion, o.idObservador, idAutor,
            CONCAT(a.nombres, ' ', a.apellidos) AS NombreAutor, a.foto AS fotoAutor,
            CONCAT(e.nombres, ' ', e.apellidos) AS NombreEstudiante,
            CONCAT(e.tipoDoc, ' ', e.documento) AS documentoEstudiante,
            o.fecha AS FechaObservacion, c.idCurso as curso,
            e.documento AS idEstudiante 
            FROM observador o
            INNER JOIN usuario a ON o.idAutor = a.documento
            INNER JOIN usuario e ON o.idEstudiante = e.documento
            INNER JOIN estudiantecurso c ON c.idEstudiante=o.idEstudiante
            WHERE o.idEstudiante = :documento AND c.idCurso = :clase 
            ORDER BY o.idObservador DESC";

            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':documento', $documento);
            $consulta->bindParam(':clase', $clase);
            $consulta->execute();
            
            while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }

            return $f;

        }

        public function mostrarObservacionDoc($idEstudiante, $idObservacion) {
            $f = null;

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 
            "SELECT 
            o.observacion AS observacion, o.idObservador,
            CONCAT(a.nombres, ' ', a.apellidos) AS nombreAutor, a.foto AS fotoAutor, a.documento AS idAutor,
            CONCAT(e.nombres, ' ', e.apellidos) AS nombreEstudiante,
            e.tipoDoc, e.documento AS idEstudiante,
            o.fecha AS FechaObservacion
            FROM observador o
            INNER JOIN usuario a ON o.idAutor = a.documento
            INNER JOIN usuario e ON o.idEstudiante = e.documento
            WHERE o.idEstudiante = :documento AND o.idObservador = :idObservacion";

            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':documento', $idEstudiante);
            $consulta->bindParam(':idObservacion', $idObservacion);
            $consulta->execute();
            
            while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }

            return $f;

        }

        public function actualizarObserDoc($observacion, $idObservacion, $idEstudiante, $idClase){
            
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();
                
            $sql = 'UPDATE observador SET observacion=:observacion WHERE idObservador=:idObservacion';
            $consulta = $conexion->prepare($sql);
            
            $consulta->bindParam(':observacion', $observacion);
            $consulta->bindParam(':idObservacion', $idObservacion);

            $consulta->execute();

            echo '<script>alert("Observación modificada con exito")</script>';
            echo '<script>location.href="../Vista/html/Docente/docObser.php?documento='.$idEstudiante.'&idClase='.$idClase.'"</script>';

        }

        public function mostrarUsuariosAsis($idClase){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'SELECT usuario.tipoDoc, usuario.documento, usuario.apellidos, usuario.nombres, CURDATE() AS Fecha
                    FROM estudiantecurso INNER JOIN
                        curso on curso.idCurso = estudiantecurso.idCurso INNER JOIN
                        clase on clase.idCurso = estudiantecurso.idCurso INNER JOIN
                        usuario on usuario.documento=estudiantecurso.idEstudiante
                    WHERE clase.idClase = :idClase';

            $consulta = $conexion->prepare($sql);          
            $consulta->bindParam(':idClase', $idClase);
            $consulta->execute();

            while ($resultado = $consulta->fetch()) {
                $f[] = $resultado;
            }

            return $f;            
        }

        public function mostrarComunicadosDoc($idCurso) {
            $f = null;

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 
            "SELECT usuario.documento AS idUsuario, usuario.nombres as nombre, usuario.apellidos as apellido, usuario.foto  as foto, comunicado.idComunicado  as idComunicado, comunicado.titulo  as titulo, comunicado.fecha  as fecha, comunicado.descripcion  as descripcion,  comunicado.archivos  as archivo, curso.nombre as curso, curso.jornada as jornada            
            FROM comunicado 
            INNER JOIN usuario ON comunicado.idUsuario = usuario.documento 
            INNER JOIN curso ON comunicado.idCurso = curso.idCurso
            WHERE curso.idCurso = :idCurso
            ORDER BY fecha  DESC
            ";        
        
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':idCurso', $idCurso);
            $consulta->execute();
            
            while ($resultado = $consulta->fetch()) {
                $f[] = $resultado;
            }

            return $f;
        }

        public function mostrarComunicadoDoc($idComunicado) {
            $f = null;

            // SE CREA EL OBJETO DE LA CONEXION (Esto ncdunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 
            "SELECT comunicado.idComunicado  as idComunicado, comunicado.titulo  as titulo, comunicado.descripcion  as descripcion, 
            curso.idCurso as idCurso, curso.nombre as curso, curso.jornada as jornada
            
            FROM comunicado

            INNER JOIN curso ON comunicado.idCurso = curso.idCurso
            
            WHERE comunicado.idComunicado = :idComunicado";
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':idComunicado', $idComunicado);
            $consulta->execute();
            
            while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }

            return $f;
        }

        public function insertarComunDoc($idUsuario, $idCurso, $titulo, $descripcion, $archivo, $idClase) {

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'INSERT INTO comunicado (idUsuario, idCurso, titulo, descripcion, archivos) VALUES (:idUsuario, :idCurso, :titulo, :descripcion, :archivo)';
            $consulta = $conexion->prepare($sql);

            $consulta->bindParam(':idUsuario',$idUsuario);
            $consulta->bindParam(':idCurso',$idCurso);
            $consulta->bindParam(':titulo',$titulo);
            $consulta->bindParam(':descripcion',$descripcion);
            $consulta->bindParam(':archivo',$archivo);

            $consulta->execute();

            echo '<script>alert("Comunicado subido correcamente")</script>';
            echo '<script>location.href="../Vista/html/Docente/docComun.php?idClase='.$idClase.'"</script>';         

        }

        public function mostrarEntregasCalificacion($idClase, $idTarea) {
            $f = null;

            // SE CREA EL OBJETO DE LA CONEXION (Esto ncdunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 
            "SELECT en.idEntrega, en.fecha_entrega_est, en.archivos,  en.descripcion,
            CONCAT(u.nombres, ' ', u.apellidos) AS Estudiante, 
            tarea.titulo, tarea.fecha_vencimiento,
            cal.nota, cal.observacion, cal.idCalificacion
            FROM tarea 
            INNER JOIN entrega en on en.idTarea = tarea.idTarea 
            INNER JOIN usuario u on u.documento = en.idEstudiante 
            LEFT JOIN calificacion cal on cal.idEntrega = en.idEntrega
            WHERE idClase = :idClase AND en.idTarea = :idTarea";

            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':idClase', $idClase);
            $consulta->bindParam(':idTarea', $idTarea);
            $consulta->execute();
            
            while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }
            return $f;
        }

        public function insertarNotaDoc($idEntrega, $fecha_calificacion, $nota, $observacion, $idClase, $idTarea) {

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'INSERT INTO calificacion (idEntrega, fecha_calificacion, nota, observacion) VALUES (:idEntrega, :fecha_calificacion, :nota, :observacion)';
            $consulta = $conexion->prepare($sql);
            
            $consulta->bindParam(':idEntrega',$idEntrega);
            $consulta->bindParam(':fecha_calificacion',$fecha_calificacion);
            $consulta->bindParam(':nota',$nota);
            $consulta->bindParam(':observacion',$observacion);

            $consulta->execute();

            echo '<script>alert("Entrega calificada")</script>';
            echo '<script>location.href="../Vista/html/Docente/docCalificacionEntrega.php?idTarea='.$idTarea.'&idClase='.$idClase.'"</script>';
        }

        public function editarNotaDoc($idCalificacion, $fecha_calificacion, $nota, $observacion, $idClase, $idTarea) {

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();           
            
            $sql = 'UPDATE calificacion SET fecha_calificacion=:fecha_calificacion, nota=:nota, observacion=:observacion WHERE idCalificacion=:idCalificacion';
            $consulta = $conexion->prepare($sql);
            
            $consulta->bindParam(':idCalificacion',$idCalificacion);
            $consulta->bindParam(':fecha_calificacion',$fecha_calificacion);
            $consulta->bindParam(':nota',$nota);
            $consulta->bindParam(':observacion',$observacion);

            $consulta->execute();

            echo '<script>alert("Calificación modificada")</script>';
            echo '<script>location.href="../Vista/html/Docente/docCalificacionEntrega.php?idTarea='.$idTarea.'&idClase='.$idClase.'"</script>';
        }

        public function validaExistenciaDeAsistencia($idClase) { 
            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'SELECT * FROM asistencia WHERE DATE(fecha) = DATE(CURDATE()) AND idClase = :idClase';
            $consulta = $conexion->prepare($sql);
                                    
            $consulta->bindParam(':idClase',$idClase);

            $consulta->execute();

            while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }
            return $f;
        }

        public function registrarAsistencia($Asistencia, $clase, $documento) {

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'INSERT INTO asistencia (idClase, idEstudiante, estado) VALUES (:clase, :documento, :Asistencia)';
            $consulta = $conexion->prepare($sql);
            
            $consulta->bindParam(':Asistencia',$Asistencia);
            $consulta->bindParam(':clase',$clase);
            $consulta->bindParam(':documento',$documento);

            $consulta->execute();

            echo '<script>alert("Entrega asistencia registrada")</script>';
            echo '<script>location.href="../Vista/html/Docente/docAsistencia.php?idClase='.$clase.'"</script>';
        }

        public function cargarAsistenciaDoc($idClase) {
            $rows = array();
        
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();
        
            $sql = "SELECT
                        u.nombres AS  nombres,
                        a.fecha AS fecha_asistencia,
                        CASE
                            WHEN a.estado = 'Asiste' THEN 'Asistió'
                            WHEN a.estado = 'Falta' THEN 'Falta'
                            WHEN a.estado = 'Falta Justificada' THEN 'Falta justificada'
                            WHEN a.estado = 'Retardo' THEN 'Retardo'
                            ELSE 'No registrado'
                        END AS estado_asistencia
                    FROM asistencia a
                    INNER JOIN usuario u ON a.idEstudiante = u.documento
                    WHERE a.idClase = :idClase
                    ORDER BY u.nombres, a.fecha";
        
            $statement = $conexion->prepare($sql);
            $statement->bindParam(':idClase', $idClase);
            $statement->execute();
        
            while ($resultado = $statement->fetch(PDO::FETCH_ASSOC)) {
                $rows[] = $resultado;
            }
        
            return $rows;
        }


        public function cargarCalificacionesDoc($idClase) {
            $rows = array();
        
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();
        
            $sql = "SELECT usuario.nombres, tarea.titulo, calificacion.nota  FROM entrega INNER JOIN 
                    usuario on usuario.documento=entrega.idEstudiante AND usuario.rol=3 INNER JOIN
                    tarea on tarea.idTarea = entrega.idTarea INNER JOIN
                    calificacion ON calificacion.idEntrega=entrega.idEntrega
                    WHERE tarea.idClase = :idClase";
        
            $statement = $conexion->prepare($sql);
            $statement->bindParam(':idClase', $idClase);
            $statement->execute();
        
            while ($resultado = $statement->fetch(PDO::FETCH_ASSOC)) {
                $rows[] = $resultado;
            }
        
            return $rows;
        }

        public function mostrarEstudiantesDoc() {
            $f = null;

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT * FROM usuario WHERE rol = 'Estudiante' ORDER BY nombres DESC";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            
            while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }

            return $f;

        }
        
        
        


    }

    class ValidarSesion{

        // FUNCIONES PARA TODOS LOS ROLES

        public function validarInicioSesion($usuario, $claveMd) {

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql1 = 'SELECT * FROM usuario WHERE documento = :usuario';

            $consulta1 = $conexion->prepare($sql1);
            $consulta1->bindParam(':usuario', $usuario);
            $consulta1->execute();

            $f = $consulta1->fetch();

            if ($f) {

                if ($f['clave'] == $claveMd) {
                    
                    if ($f['estado'] == 'Activo'){
                        // SE REALIZA EL INICIO DE SESIÓN
                        session_start();

                        // CREAMOS VARIABLES DE SESIÓN
                        $_SESSION['id'] = $f['documento'];
                        $_SESSION['correo'] = $f['correo'];
                        $_SESSION['AUTENTICADO'] = 'SI';
                        $_SESSION['rol'] = $f['rol'];
                        
                        switch ($f['rol']){

                            case "Administrador":
                                if($f['correo']){
                                    echo '<script>alert("Bienvenido rol administrador")</script>';
                                    echo "<script>location.href='../Vista/html/Administrador/homeAdmin.php?id=".$f['documento']."'</script>";
                                }else{
                                    echo '<script>alert("Bienvenido rol administrador, registro primera vez")</script>';
                                    echo "<script>location.href='../Vista/html/Administrador/registroPrimero.php?id=".$f['documento']."'</script>";
                                }
                            break;
                            case "Docente":
                               if($f['correo']){
                                    echo '<script>alert("Bienvenido rol Docente")</script>';
                                    echo "<script>location.href='../Vista/html/Docente/homeDoc.php?id=".$f['documento']."'</script>";
                                }else{
                                    echo '<script>alert("Bienvenido rol docente, registro primera vez")</script>';
                                    echo "<script>location.href='../Vista/html/Docente/registroPrimero.php?id=".$f['documento']."'</script>";
                                }
                            case "Estudiante":
                                if($f['correo']){
                                    echo '<script>alert("Bienvenido rol Estudiante")</script>';
                                    echo "<script>location.href='../Vista/html/Estudiante/homeEstu.php?id=".$f['documento']."'</script>";
                                }else{
                                    echo '<script>alert("Bienvenido rol Estudiante, registro primera vez")</script>';
                                    echo "<script>location.href='../Vista/html/Estudiante/registroPrimero.php?id=".$f['documento']."'</script>";
                                }
                                
                            break;

                        }

                    }else {
                        echo '<script>alert("Su cuenta no se encuentra activa, comuniquese con el administrador de la entidad")</script>';
                        echo "<script>location.href='../Vista/html/Extras/inicioSesion.html'</script>";
                    }

                }else {
                    echo '<script>alert("Clave incorrecta, intentelo nuevamente.")</script>';
                    echo "<script>location.href='../Vista/html/Extras/inicioSesion.html'</script>";
                }

            }else {
                echo '<script>alert("El usuario ingresado no está registrado.")</script>';
                echo "<script>location.href='../Vista/html/Extras/inicioSesion.html'</script>";
            }

        }

        public function cerrarSesion(){
            
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            session_start();
            session_destroy();
            
            echo "<script>location.href='../Vista/html/Extras/inicioSesion.html'</script>";

        }

    }

    class ConsultasUsuario{

        public function buscarUsuario($id) {

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();
 
            $sql = "SELECT * FROM usuario WHERE documento=:id";
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':id', $id);
            $consulta->execute(); 
 
            while ($resultado = $consulta->fetch()) {
 
                 $f[] = $resultado;
 
            }
 
            // return para que la variable vualva a su estado inicial
            return $f;
 
        }

        public function primeraActualizacion($rol, $telefono, $direccion, $correo, $documento, $foto, $claveMD) {

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'UPDATE usuario SET clave=:claveMD, telefono=:telefono, direccion=:direccion, correo=:correo, foto=:foto WHERE documento=:documento';
            $consulta = $conexion->prepare($sql);
            
            $consulta->bindParam(':claveMD', $claveMD);
            $consulta->bindParam(':documento', $documento);
            $consulta->bindParam(':telefono', $telefono);
            $consulta->bindParam(':direccion', $direccion);
            $consulta->bindParam(':correo', $correo);
            $consulta->bindParam(':foto', $foto);

            $consulta->execute();

            echo '<script>alert("Información actualizada con exito")</script>';
            // Evitar volver a la página anterior

            // echo '<script>window.history.pushState(null, null, window.location.href); </script>';

            switch ($rol){

                case "Administrador":
                    echo "<script>location.href='../Vista/html/Administrador/homeAdmin.php?id=".$documento."'</script>";
                break;
                case "Docente":
                    echo "<script>location.href='../Vista/html/Docente/registroPrimero.php?id=".$documento."'</script>";
                break;
            }
        }

        // Consulta para actualizar por primera vez de Estudiante
        public function primeraActualizacionEst($rol, $telefono, $direccion, $correo, $documento, $fotoM, $claveMD, $nomAcu, $apeAcu, $docAcu, $celAcu, $corAcu) {

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'UPDATE usuario SET clave=:claveMD, telefono=:telefono, direccion=:direccion, correo=:correo, foto=:foto WHERE documento=:documento';
            $consulta = $conexion->prepare($sql);
            
            $consulta->bindParam(':claveMD', $claveMD);
            $consulta->bindParam(':documento', $documento);
            $consulta->bindParam(':telefono', $telefono);
            $consulta->bindParam(':direccion', $direccion);
            $consulta->bindParam(':correo', $correo);
            $consulta->bindParam(':foto', $foto);

            $consulta->execute();

            $sqlAcudiente = "INSERT INTO acudiente (documento, nombres, apellidos, telefono, correo) VALUES (:docAcu, :nomAcu, :apeAcu, :celAcu, :corAcu) ";

            $consulta = $conexion->prepare($sqlAcudiente);
            
            $consulta->bindParam(':docAcu', $docAcu);
            $consulta->bindParam(':nomAcu', $nomAcu);
            $consulta->bindParam(':apeAcu', $apeAcu);
            $consulta->bindParam(':celAcu', $celAcu);
            $consulta->bindParam(':corAcu', $corAcu);

            $consulta->execute();

            $sqlEstAcu = "INSERT INTO estudianteacudiente (idAcudiente, idEstudiante) VALUES (:docAcu, :documento) ";

            $consulta = $conexion->prepare($sqlEstAcu);
            
            $consulta->bindParam(':docAcu', $docAcu);
            $consulta->bindParam(':documento', $documento);

            $consulta->execute();

            echo '<script>alert("Información actualizada con exito")</script>';

            switch ($rol){

                case "Estudiante":
                    echo "<script>location.href='../Vista/html/Estudiante/homeEstu.php'</script>";
                break;
            }

            // echo "<script>location.href='../Vista/html/estudiante/homeEstu.php</script>";

        }

    }

?>
