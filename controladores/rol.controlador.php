<?php
#require_once "./modelos/conexion.php";
require_once "./modelos/rol.modelo.php";

class ControladorRol{
    static public function ctrRol(){

        if(isset($_POST["nombreRol"])){

            $tabla = "roles";

            $datos = array(
                "nombre_rol" => $_POST["nombreRol"]
            );

            $respuesta = ModeloRol::mdlRol($tabla, $datos);

            return $respuesta;

        }

    }

}