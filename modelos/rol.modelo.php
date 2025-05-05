<?php

require_once "conexion.php";

class ModeloRol {

    /*=============================================
    Registrar usuario
    =============================================*/
    static public function mdlRol($tabla, $datos){
        $sql = "INSERT INTO {$tabla} 
                    (nombre_rol) 
                    VALUES 
                    (:nombre_rol)";  // Cambié :? por :nombre_rol

        $stmt = Conexion::conectar()->prepare($sql);

        // Ahora el bindParam usa :nombre_rol
        $stmt->bindParam(":nombre_rol", $datos["nombre_rol"], PDO::PARAM_STR);

        $ok = $stmt->execute();
        $stmt->closeCursor();
        return $ok ? "ok" : "error";
    }

}
?>
