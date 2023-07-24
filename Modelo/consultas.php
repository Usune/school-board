<?php

    class Consultas{

        public function insertarUsuario($rol, $fechaCreacion, $usuario, $clave) {

            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $sql = 'INSERT INTO usuario (rol, fechaCreacion, usuario, clave) VALUES (:rol, :fechaCreacion, :usuario, :clave)';
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':rol', $rol);
            $consulta->bindParam(':fechaCreacion', $fechaCreacion);
            $consulta->bindParam(':usuario', $usuario);
            $consulta->bindParam(':clave', $clave);
            $consulta->excute();

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

    }

?> 