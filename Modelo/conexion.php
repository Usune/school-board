<?php

    class Conexion{
        public function get_conexion(){

            $user = 'root';
            $pass = '';
            $host = 'localhost';
            $db = 'schoolboard';
            
            $conexion = new PDO("mysql:host=$host;dbname=$db;", $user, $pass);

            if ($conexion instanceof PDO) {
                echo "Bien";
                return $conexion;
            } else {
                echo "Mal";
            }
        }
    }

?>