<?php

require_once ('classModelo.php');
class localidad extends modelo
{
/**
 * En esta clase crearemos las consultas relacionadas con la tabla usuarios
 */
private $conexion;
public function __construct()
    {
        
        /*Los datos de la conexión los tomamos de config*/
        $this->conexion=parent::GetInstance();
      
    }
public function getLocalidad($localidad)
    {
      

            $consulta = "SELECT * FROM localidades WHERE id_localidad=:localidad";
            $result = $this->conexion->prepare($consulta);
            $result->bindParam(':localidad', $localidad);
            $result->execute();
            $resultado = $result->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
      
    }
}
?>