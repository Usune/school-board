<?php

    class Consultas{

        public function insertarUsuAdmin($nombres, $apellidos, $rol, $tipoDoc, $usuario, $claveMd, $estado){

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            // SELECT DE USUARIO REGISTRADO EN EL SISTEMA
            $sql1 = 'SELECT * FROM usuario WHERE usuario = :usuario';
            $consulta1 = $conexion->prepare($sql1);
            $consulta1->bindParam(':usuario', $usuario);
            $consulta1->execute();
            // fetch() para corvertir un texto separado por comas en un array. Este no existira si en la consulta no se obtuvo nada.
            $f1 = $consulta1->fetch();

            if ($f1) {

                echo '<script>alert("El usuario ya existe en el sistema")</script>';
                echo "<script>location.href='../Vista/html/Administrador/adminUsuRegistro.html'</script>";

            } else {
            
                // SE CREA LA VARIABLE QUE CONTENDRÁ LA CONSULTA A EJECUTAR EN LA TABLA usuario
                $sql2 = 'INSERT INTO usuario (usuario, clave, rol, estado) VALUES (:usuario, :claveMd, :rol, :estado)';
                // PREPARAMOS TODO LO NOCESARIO PARA EJECUTAR LA FUNCION ANTERIOR
                $consulta2 = $conexion->prepare($sql2);
                // CONVERTIMOS LOS ARGUMENTOS EN PARAMETROS
                $consulta2->bindParam(':usuario', $usuario);
                $consulta2->bindParam(':claveMd', $claveMd);
                $consulta2->bindParam(':rol', $rol);
                $consulta2->bindParam(':estado', $estado);
                // EJECUTAMOS EL INSERT DE LA TABLA usuario
                $consulta2->execute();


                // SELECT PARA TRAER EL ID DEL USUARIO RECIEN REGISTRADO
                $sql3 = 'SELECT idUsuario FROM usuario WHERE usuario = :usuario';
                $consulta3 = $conexion->prepare($sql3);
                $consulta3->bindParam(':usuario', $usuario);
                $consulta3->execute();
                // fetch() para corvertir un texto separado por comas en un array. Este no existira si en la consulta no se obtuvo nada.
                $f2 = $consulta3->fetch();


                // SE CREA LA VARIABLE QUE CONTENDRÁ LA CONSULTA A EJECUTAR EN LA TABLA perfilUsuario
                $sql4 = 'INSERT INTO perfilUsuario (idPerfilUsuario, idUsuario, tipoDoc, documento, nombres, apellidos) VALUES (:idPerfilUsuario, :idUsuario, :tipoDoc, :usuario, :nombres, :apellidos)';
                // PREPARAMOS TODO LO NOCESARIO PARA EJECUTAR LA FUNCION ANTERIOR
                $consulta4 = $conexion->prepare($sql4);
                // CONVERTIMOS LOS ARGUMENTOS EN PARAMETROS $f['clave']
                $consulta4->bindParam(':idPerfilUsuario', $f2['idUsuario']);
                $consulta4->bindParam(':idUsuario', $f2['idUsuario']);
                $consulta4->bindParam(':tipoDoc', $tipoDoc);
                $consulta4->bindParam(':usuario', $usuario);
                $consulta4->bindParam(':nombres', $nombres);
                $consulta4->bindParam(':apellidos', $apellidos);
                // EJECUTAMOS EL INSERT DE LA TABLA perfilUsuario
                $consulta4->execute();

                echo '<script>alert("Usuario registrado con exito")</script>';
                echo "<script>location.href='../Vista/html/Administrador/adminUsuRegistro.html'</script>";

            }

        }
        
        public function insertarNombreEstudiante ($nombres, $apellidos) {

            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $sql = 'INSERT INTO estudiante (nombres, apellidos) VALUES (:nombres, :apellidos)';
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':nombres', $nombres);
            $consulta->bindParam(':apellidos', $apellidos);
            $consulta->excute();

        }

        public function validarInicioSesion($usuario, $claveMd) {

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql1 = 'SELECT * FROM usuario WHERE usuario = :usuario';

            $consulta1 = $conexion->prepare($sql1);
            $consulta1->bindParam(':usuario', $usuario);
            $consulta1->execute();

            $f = $consulta1->fetch();

            if ($f) {

                if ($f['clave'] == $claveMd) {
                    
                    if ($f['estado'] == 'activo'){
                        // SE REALIZA EL INICIO DE SESIÓN
                        session_start();
                        
                        switch ($f['rol']){

                            case "1":
                                echo '<script>alert("Bienvenido rol administrador")</script>';
                                echo "<script>location.href='../Vista/html/Administrador/homeAdmin.html'</script>";
                            break;
                            case "2":
                                echo '<script>alert("Bienvenido rol docente")</script>';
                                echo "<script>location.href='../Vista/html/Docente/homeDoc.html'</script>";
                            break;
                            case "3":
                                echo '<script>alert("Bienvenido rol estudiante")</script>';
                                echo "<script>location.href='../Vista/html/Estudiante/homeEstu.html'</script>";
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

    }

?> 