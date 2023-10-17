<?php

    class Consultas{

        // CONSULTAS PARA ADMINISTRADORES

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
                echo "<script>location.href='../Vista/html/Administrador/adminUsuRegistro.php'</script>";

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

                echo "<script>location.href='../Vista/html/Administrador/adminUsuRegistro.php'</script>";

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
                echo '<script>location.href="../Vista/html/Administrador/adminCurRegistro.php"</script>';
                
            }else {

                $sql = 'INSERT INTO curso(nombre, jornada) VALUES (:nombre, :jornada)';
                $resultado = $conexion->prepare($sql);
                $resultado->bindParam(':nombre', $nombre);
                $resultado->bindParam(':jornada', $jornada);
    
                $resultado->execute();
    
                echo '<script>alert("El curso fue registrado")</script>';
                echo '<script>location.href="../Vista/html/Administrador/adminCurRegistro.php"</script>';

            }

        }

        public function insertarAsigAdmin($nombre) {
            
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'SELECT * FROM curso WHERE nombre = :nombre';

            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':nombre', $nombre);
            $consulta->execute();

            $f = $consulta->fetch();

            if($f){

                echo '<script>alert("Ya existe una asignatura con el nombre ingresado")</script>';
                echo '<script>location.href="../Vista/html/Administrador/adminAsigRegistro.php"</script>';
                
            }else {

                $sql = 'INSERT INTO asignatura(nombre) VALUES (:nombre)';
                $resultado = $conexion->prepare($sql);
                $resultado->bindParam(':nombre', $nombre);
    
                $resultado->execute();
    
                echo '<script>alert("La asignatura fue creada correctamente")</script>';
                echo '<script>location.href="../Vista/html/Administrador/adminAsigRegistro.php"</script>';

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
                echo '<script>location.href="../Vista/html/Administrador/adminAulaRegistro.php"</script>';
                
            }else {

                $sql = 'INSERT INTO aula(nombre) VALUES (:nombre)';
                $resultado = $conexion->prepare($sql);
                $resultado->bindParam(':nombre', $nombre);
    
                $resultado->execute();
    
                echo '<script>alert("El aula fue creada correctamente")</script>';
                echo '<script>location.href="../Vista/html/Administrador/adminAulaRegistro.php"</script>';

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

            echo '<script>alert("Comunicado subido correcamente")</script>';
            echo "<script>location.href='../Vista/html/Administrador/adminComunRegistrar.php'</script>";         

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
                        
                        echo '<script>alert('.$f1['correo'].')</script>';
    
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
            
            echo "<script>location.href='../Vista/html/Administrador/adminUsuConsu.php'</script>";

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
                echo '<script>location.href="../Vista/html/Administrador/adminCurConsu.php"</script>';

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
                echo '<script>location.href="../Vista/html/Administrador/adminAsigConsu.php"</script>';

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
                echo '<script>location.href="../Vista/html/Administrador/adminAulaConsu.php"</script>';

            }
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

        // Trae todos los cursos registrados
        public function mostrarCursosAdmin() {
            $f = null;

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT * FROM curso WHERE idCurso != '1' ORDER BY idCurso  DESC";
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

            $sql = "SELECT * FROM asignatura ORDER BY idAsignatura  DESC";
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

            $sql = "SELECT * FROM aula ORDER BY idAula  DESC";
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
            "SELECT usuario.nombres as nombre, usuario.apellidos as apellido, usuario.foto  as foto, 
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
            o.observacion AS Observacion, o.idObservador,
            CONCAT(a.nombres, ' ', a.apellidos) AS NombreAutor, a.foto AS fotoAutor,
            CONCAT(e.nombres, ' ', e.apellidos) AS NombreEstudiante,
            CONCAT(e.tipoDoc, ' ', e.documento) AS documentoEstudiante,
            o.fecha AS FechaObservacion
            FROM observador o
            INNER JOIN usuario a ON o.idAutor = a.documento
            INNER JOIN usuario e ON o.idEstudiante = e.documento
            WHERE o.idEstudiante = :documento";

            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':documento', $documento);
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

            $sql = 'SELECT * FROM curso WHERE 1=1';
            
            if (!empty($jornada) && $jornada != 'nada') {
                $sql .= " AND jornada LIKE :jornada";
            }

            if (!empty($nombre)) {
                $sql .= " AND nombre LIKE :nombre";
            }
            
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
            $sql = 'SELECT * FROM asignatura WHERE nombre LIKE :nombre';
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
            $sql = 'SELECT * FROM aula WHERE nombre LIKE :nombre';
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

        public function eliminarUsuAdmin($id) {
            
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'DELETE FROM usuario WHERE documento = :id';
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':id', $id);
            $consulta->execute();
            
            echo '<script>alert("El usuario a sido eliminado.")</script>';
            echo "<script>location.href='../Vista/html/administrador/adminUsuConsu.php'</script>";

        }

        // CONSULTAS PARA ESTUDIANTES 

        // Funcion para cargar las asignaturas correspondientes al estudiante
        public function cargarAsignaturas($documento){
            $rows = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT 
                    asignatura.nombre as asignatura,
                    asignatura.idAsignatura as idAsignatura
                    FROM estudiantecurso
                    INNER JOIN usuario
                    ON usuario.documento = estudiantecurso.idEstudiante
                    INNER JOIN curso
                    ON curso.idCurso = estudiantecurso.idCurso
                    INNER JOIN clase
                    ON clase.idCurso = curso.idCurso
                    INNER JOIN asignatura
                    ON asignatura.idAsignatura = clase.idAsignatura
                    WHERE usuario.documento = :documento";
            $statement = $conexion->prepare($sql);
            $statement->bindParam(':documento' , $documento);
            $statement->execute();

            while ($resultado = $statement->fetch()) {
                $rows[] = $resultado;
            }

            return $rows;
        }

        // Funcion para mostrar las tareas correspondientes a una Asignatura 
        public function cargarTareas($idAsignatura){
            $rows = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT 
            tarea.idTarea,
            asignatura.nombre as nombreAsignatura,
            asignatura.idAsignatura,
            usuario.foto,
            usuario.nombres,
            usuario.apellidos,
            tarea.fecha_vencimiento,
            tarea.titulo,
            tarea.descripcion
            FROM clase
            INNER JOIN asignatura
            ON asignatura.idAsignatura = clase.idAsignatura
            INNER JOIN tarea 
            ON tarea.idClase = clase.idClase
            INNER JOIN curso
            ON curso.idCurso = clase.idCurso
            INNER JOIN usuario
            ON usuario.documento = clase.idDocente
            WHERE asignatura.idAsignatura = :idAsignatura
            ORDER BY tarea.idTarea DESC";

            $statement = $conexion->prepare($sql);
            $statement->bindParam('idAsignatura' , $idAsignatura);
            $statement->execute();

            while($resultado = $statement->fetch()){
                $rows[] = $resultado;
            }

            return $rows;

        }

        // Funcion para mostrar las tareas correspondientes a una Asignatura 
        public function cargarTarea($idTarea){
            $rows = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT 
            tarea.idTarea,
            tarea.titulo,
            tarea.descripcion,
            tarea.fecha_creacion,
            tarea.fecha_vencimiento,
            tarea.archivos,
            asignatura.nombre as nombreAsignatura,
            asignatura.idAsignatura,
            usuario.foto,
            usuario.nombres,
            usuario.apellidos
            FROM clase
            INNER JOIN asignatura
            ON asignatura.idAsignatura = clase.idAsignatura
            INNER JOIN tarea 
            ON tarea.idClase = clase.idClase
            INNER JOIN curso
            ON curso.idCurso = clase.idCurso
            INNER JOIN usuario
            ON usuario.documento = clase.idDocente
            WHERE tarea.idTarea = :idTarea";

            $statement = $conexion->prepare($sql);
            $statement->bindParam('idTarea' , $idTarea);
            $statement->execute();

            while($resultado = $statement->fetch()){
                $rows[] = $resultado;
            }

            return $rows;

        }


        // Función para entregar actividades
        public function insertarEntregaTarea($descripcion, $archivos_str){
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "INSERT INTO entrega (descripcion, archivos)  VALUES (:descripcion, :archivos_str)";
            $statement = $conexion->prepare($sql);
            $statement->bindParam(':descripcion' , $descripcion);
            $statement->bindParam(':archivos_str' , $archivos_str);
            $statement->execute();

            echo '<script>alert("Entrega exitosa")</script>';
            echo '<script>location.href="../Vista/html/Estudiante/tareaAsignatura.php"</script>';

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

        public function mostrarCursosDoc($documento){
            
            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT curso.idCurso as idCur, curso.nombre as nomCur, curso.jornada as curJor,asignatura.nombre as asigNom 
            
            FROM clase

            INNER JOIN curso ON clase.idCurso = curso.idCurso
            INNER JOIN asignatura ON clase.idAsignatura = asignatura.idAsignatura
            WHERE clase.idDocente = :documento
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

            $sql = "SELECT * FROM curso

            WHERE idCurso = :id

            ";
            
            $result = $conexion->prepare($sql);

            $result->bindParam(':id',$id);

            $result->execute();

            //para que separe el result en un array
            while ($resultado = $result->fetch()){
                $f[] = $resultado;
            }

            return $f;


        }

        public function insertarTarDoc($titulo, $descripcion, $fecha_creacion, $fecha_vencimiento, $archivos) {

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'INSERT INTO tarea (titulo, descripcion, fecha_creacion, fecha_vencimiento, archivos) VALUES (:titulo, :descripcion, :fecha_C, :fecha_V, :archivos)';
            $consulta  = $conexion ->prepare($sql);

            $consulta->bindParam(':titulo',$titulo);
            $consulta->bindParam(':descripcion',$descripcion);
            $consulta->bindParam(':fecha_C',$fecha_creacion);
            $consulta->bindParam(':fecha_V',$fecha_vencimiento);
            $consulta->bindParam(':archivos',$archivos);

            $consulta->execute();

            echo '<script>alert("Tarea registrada exitosamente")</script>';
            echo '<script>location.href="../Vista/html/Docente/docTareaRegistro.php"</script>';
            
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
                                echo '<script>alert("Bienvenido rol estudiante")</script>';
                                echo "<script>location.href='../Vista/html/Estudiante/homeEstu.php'</script>";
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
                case "Estudiante":
                    echo "<script>location.href='../Vista/html/Estudiante/homeEstu.php?id=".$documento."'</script>";
                break;

            }
        }

    }

?> 
