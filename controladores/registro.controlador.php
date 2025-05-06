<?php
#require_once "./modelos/conexion.php";
require_once "./modelos/registro.modelos.php";
class ControladorRegistro{

    static public function ctrRegistro(){

        if(isset($_POST["registroNombre"])){

            $tabla = "personas";

            $datos = array(
                "pers_nombre" => $_POST["registroNombre"],
                "pers_telefono" => $_POST["registroTelefono"],
                "pers_correo" => $_POST["registroCorreo"],
                "pers_clave" => $_POST["registroPassword"]            

            );

            $respuesta = ModeloRegistro::mdlRegistro($tabla, $datos);

            return $respuesta;

        }

    }
/*=============================================
    registrar Usuario
    =============================================*/

    public function ctrIngreso(){
         
        if(isset ($_POST["ingresoCorreo"])){

            $tabla = "personas";
            $item = "pers_correo";
            $valor = $_POST["ingresoCorreo"];

            $respuesta = ModeloRegistro::mdlSeleccionarRegistro($tabla, $item, $valor);

            if($respuesta["pers_correo"] == $_POST["ingresoCorreo"] && $respuesta["pers_clave"] == $_POST["ingresoClave"]){ 
                
                session_start();

                $_SESSION["validarIngreso"] = "ok";

                echo '<script>

                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }

                    window.location = "index.php?modulo=contenido";

                </script>';

            } else {

                echo '<script>

                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }

                </script>';

                echo '<div class="alert alert-success">la contraseña no es valida</div>';
            }


        }

    }
   /*=============================================
    Seleccionar Registros
    =============================================*/

    static public function ctrSeleccionarRegistro(){

        $tabla = "personas";

        $respuesta = ModeloRegistro::mdlseleccionarregistro($tabla, null,null);

        return $respuesta;
    }
    /*=============================================
    Actualizar Usuario
    =============================================*/

    public static function ctrActualizar() {
        if (isset($_POST['actualizarNombre'], $_POST['actualizarTelefono'], $_POST['actualizarCorreo'], $_POST['actualizarClave'])) {

            $tabla = "registro";

            $datos = array(
                "id" => $_GET["id"], 
                "nombre" => $_POST["actualizarNombre"],
                "telefono" => $_POST["actualizarTelefono"],
                "correo" => $_POST["actualizarCorreo"],
                "clave" => password_hash($_POST["actualizarClave"], PASSWORD_DEFAULT)
            );

            $respuesta = ModeloRegistro::mdlActualizarRegistro($tabla, $datos);

            return $respuesta;
        }

        return null;
    }
    
     /*=============================================
    Actualizar Registros
    =============================================*/

    public static function mdlActualizarRegistro($tabla, $datos) {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET pers_nombre = :nombre, pers_telefono = :telefono, pers_correo = :correo, pers_clave = :clave WHERE pk_id_personas = :id");

        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":clave", $datos["clave"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }


}