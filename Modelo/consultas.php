<?php

    class Consultas{

        // CONSULTAS PARA ADMINISTRADORES

        public function insertarUsuAdmin($nombres, $apellidos, $rol, $tipoDoc, $documento, $claveMd, $estado){

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            // SELECT DE USUARIO REGISTRADO EN EL SISTEMA
            $sql1 = 'SELECT * FROM usuario WHERE documento = :documento';
            $consulta1 = $conexion->prepare($sql1);
            $consulta1->bindParam(':documento', $documento);
            $consulta1->execute();
            // fetch() para corvertir un texto separado por comas en un array. Este no existira si en la consulta no se obtuvo nada.
            $f = $consulta1->fetch();

            if ($f) {

                echo '<script>alert("Ya existe un usuario en el sistema con el número de documento ingresado")</script>';
                echo "<script>location.href='../Vista/html/Administrador/adminUsuRegistro.php'</script>";

            } else {
            
                // SE CREA LA VARIABLE QUE CONTENDRÁ LA CONSULTA A EJECUTAR EN LA TABLA usuario
                $sql2 = 'INSERT INTO usuario (documento, clave, rol, estado, tipoDoc, nombres, apellidos) VALUES (:documento, :claveMd, :rol, :estado, :tipoDoc, :nombres, :apellidos)';

                // PREPARAMOS TODO LO NOCESARIO PARA EJECUTAR LA FUNCION ANTERIOR
                $consulta2 = $conexion->prepare($sql2);

                // CONVERTIMOS LOS ARGUMENTOS EN PARAMETROS
                $consulta2->bindParam(':documento', $documento);
                $consulta2->bindParam(':claveMd', $claveMd);
                $consulta2->bindParam(':rol', $rol);
                $consulta2->bindParam(':estado', $estado);
                $consulta2->bindParam(':tipoDoc', $tipoDoc);
                $consulta2->bindParam(':nombres', $nombres);
                $consulta2->bindParam(':apellidos', $apellidos);

                // EJECUTAMOS EL INSERT DE LA TABLA usuario
                $consulta2->execute();


                // // SELECT PARA TRAER EL ID DEL USUARIO RECIEN REGISTRADO
                // $sql3 = 'SELECT idUsuario FROM usuario WHERE usuario = :usuario';
                // $consulta3 = $conexion->prepare($sql3);
                // $consulta3->bindParam(':usuario', $usuario);
                // $consulta3->execute();
                // // fetch() para corvertir un texto separado por comas en un array. Este no existira si en la consulta no se obtuvo nada.
                // $f2 = $consulta3->fetch();


                // // SE CREA LA VARIABLE QUE CONTENDRÁ LA CONSULTA A EJECUTAR EN LA TABLA perfilUsuario
                // $sql4 = 'INSERT INTO perfilUsuario (idPerfilUsuario, idUsuario, tipoDoc, documento, nombres, apellidos) VALUES (:idPerfilUsuario, :idUsuario, :tipoDoc, :usuario, :nombres, :apellidos)';
                // // PREPARAMOS TODO LO NOCESARIO PARA EJECUTAR LA FUNCION ANTERIOR
                // $consulta4 = $conexion->prepare($sql4);
                // // CONVERTIMOS LOS ARGUMENTOS EN PARAMETROS $f['clave']
                // $consulta4->bindParam(':idPerfilUsuario', $f2['idUsuario']);
                // $consulta4->bindParam(':idUsuario', $f2['idUsuario']);
                // $consulta4->bindParam(':tipoDoc', $tipoDoc);
                // $consulta4->bindParam(':usuario', $usuario);
                // $consulta4->bindParam(':nombres', $nombres);
                // $consulta4->bindParam(':apellidos', $apellidos);
                // // EJECUTAMOS EL INSERT DE LA TABLA perfilUsuario
                // $consulta4->execute();

                echo '<script>alert("Usuario registrado con exito")</script>';
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
                echo '<script>location.href="../Vista/html/Administrador/adminCurRegistro.php"</script>';
                
            }else {

                $sql = 'INSERT INTO asignatura(nombre) VALUES (:nombre)';
                $resultado = $conexion->prepare($sql);
                $resultado->bindParam(':nombre', $nombre);
    
                $resultado->execute();
    
                echo '<script>alert("La asignatura fue creada correctamente")</script>';
                echo '<script>location.href="../Vista/html/Administrador/adminAsigRegistro.php"</script>';

            }

        }
        
        public function insertarComunAdmin($titulo, $descripcion, $archivo) {

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'INSERT INTO comunicado (titulo, descripcion, archivos) VALUES (:titulo, :descripcion, :archivo)';
            $consulta = $conexion->prepare($sql);

            $consulta->bindParam(':titulo',$titulo);
            $consulta->bindParam(':descripcion',$descripcion);
            $consulta->bindParam(':archivo',$archivo);

            $consulta->execute();

            echo '<script>alert("Comunicado subido correcamente")</script>';
            echo "<script>location.href='../Vista/html/Administrador/adminComunRegistrar.php'</script>";         

        }

        public function actualizarUsuAdmin($nombres, $apellidos, $rol, $tipoDoc, $documento, $estado, $claveMD, $id){
            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            if ($id != $documento) {

                // SELECT DE USUARIO REGISTRADO EN EL SISTEMA
                $sql1 = 'SELECT * FROM usuario WHERE documento = :documento';
                $consulta1 = $conexion->prepare($sql1);
                $consulta1->bindParam(':documento', $documento);
                $consulta1->execute();
    
                // fetch() para corvertir un texto separado por comas en un array. Este no existira si en la consulta no se obtuvo nada.
                $f = $consulta1->fetch();

                if($f){

                    echo '<script>alert("Ya existe un usuario en el sistema con el número de documento ingresado")</script>';
                    echo "<script>location.href='../Vista/html/Administrador/adminUsuModificar.php?id=".$id."'</script>";

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
                            echo "<script>location.href='../Vista/html/Administrador/adminUsuConsu.php'</script>";
        
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
                            echo "<script>location.href='../Vista/html/Administrador/adminUsuConsu.php'</script>";
                
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
                        echo "<script>location.href='../Vista/html/Administrador/adminUsuConsu.php'</script>";
    
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
                        echo "<script>location.href='../Vista/html/Administrador/adminUsuConsu.php'</script>";
            
                    }

                }

            }

            
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

        public function actualizarPerfilAdmin($telefono, $direccion, $correo, $documento){

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
            echo '<script>location.href="../Vista/html/Administrador/adminPerfil.php?id='.$documento.'"</script>';

        }

        public function actualizarFotoAdmin($documento, $foto){

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'UPDATE usuario SET foto=:foto WHERE documento=:documento';
            $consulta = $conexion->prepare($sql);
            
            $consulta->bindParam(':documento', $documento);
            $consulta->bindParam(':foto', $foto);

            $consulta->execute();

            echo '<script>alert("Foto actualizada con exito")</script>';
            echo '<script>location.href="../Vista/html/Administrador/adminPerfil.php?id='.$documento.'"</script>';

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
            echo '<script>location.href="../Vista/html/Administrador/adminPerfil.php?id='.$documento.'"</script>';

        }

        // Trae todos los usuarios registrados
        public function mostrarUsuariosAdmin() {
            $f = null;

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT * FROM usuario WHERE rol = 'Docente' OR rol = 'Estudiante'";
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

            $sql = "SELECT * FROM curso ORDER BY idCurso  DESC";
            $consulta = $conexion->prepare($sql);
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
                    
                    if ($f['estado'] == 'activo'){
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
                                echo '<script>alert("Bienvenido rol docente")</script>';
                                echo "<script>location.href='../Vista/html/Docente/homeDoc.php'</script>";
                            break;
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
                    echo "<script>location.href='../Vista/html/Docente/homeDoc.php?id=".$documento."'</script>";
                break;
                case "Estudiante":
                    echo "<script>location.href='../Vista/html/Estudiante/homeEstu.php?id=".$documento."'</script>";
                break;

            }
        }

    }

?> 
