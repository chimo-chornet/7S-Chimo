<?php
include_once ('classConfig.php');

class modelo extends PDO
{

    private static $instance = null;
//El constructor se encarga de crear la conexión
    private function __construct()
    {
       
        /*Los datos de la conexión los tomamos de config*/
        parent::__construct('mysql:host=' . Config::$hostname . ';dbname=' . Config::$nombre . '', Config::$usuario, Config::$clave);
        parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        parent::exec("set names utf8");
        //echo"Constructor Modelo <br>";
    }
/*Para crear el objeto usando SINGLETON se utiliza este metodo 
 * que comprueba si existe una conexión a la BD para aprovecharla, sino 
 * existe llama al constructor para que cree la conexión
*/
    public static function GetInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        
        return self::$instance;
    }
        
    }

     

?>