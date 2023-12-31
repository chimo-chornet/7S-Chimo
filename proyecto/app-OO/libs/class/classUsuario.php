<?php
require_once ('classModelo.php');

class Usuario extends modelo
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
    public function getUserId($email){
        $consulta="SELECT * FROM `usuario` WHERE email=:email";
        $con=$this->conexion->prepare($consulta);
        $con->bindParam(":email",$email);
        $con->execute();
        $resul=$con->fetchAll(PDO::FETCH_ASSOC);

        return  $resul[0]['id_user'];
    }
    public function registraUsuario($nombre,$mail,$pass,$fechaNac,$foto,$desc,$nivel,$activo,&$errores){

        $consulta="INSERT INTO `usuario`(nombre,email,pass,f_nacimiento,foto_perfil,descripción,nivel,activo) VALUES (?,?,?,?,?,?,?,?)";
    try {

        $con=$this->conexion->prepare($consulta);
        $con->bindParam(1, $nombre);
        $con->bindParam(2, $mail);
        $con->bindParam(3, $pass);
        $con->bindParam(4, $fechaNac);
        $con->bindParam(5, $foto);
        $con->bindParam(6, $desc);
        $con->bindParam(7, $nivel);
        $con->bindParam(8, $activo);
        if($con->execute()) {
            $this->$nombre=$nombre;
            $this->$mail=$mail;
            $this->$pass=$pass;
            $this->$fechaNac=$fechaNac;
            $this->$foto=$foto;
            $this->$desc=$desc;
            $this->$nivel=$nivel;
            $this->$activo=$activo;
            return true;
        }else{
            $errores['datos']="Error al registrar en la base de datos";
            return false;
        }

    }catch(PDOException $e){
        error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->getLine()."##Código: ".$e->getCode()."##Instante: ".microtime().PHP_EOL,3,"../logBd.txt");

    }
    }

    public function insertaIdiomaUsuario($idioma,$usuario,&$errores){

        $consulta="INSERT INTO `user-idioma`(id_idioma,id_user) VALUES (?,?)";
        try{
        $con=$this->conexion->prepare($consulta);
        $con->bindParam(1,$idioma);
        $con->bindParam(2,$usuario);
        if(!$con->execute()){
            $errores['token']="No se ha podido insertar idioma de usuario";
        }

        }catch(PDOException $e){
        error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->getLine()."##Código: ".$e->getCode()."##Instante: ".microtime().PHP_EOL,3,"../logBd.txt");
        }

    }
    function insertaToken($token,$validez,$idUsuario,&$errores){
        $consulta="INSERT INTO `tokens`(token,validez,id_user) VALUES (?,?,?)";
        try{
        $con=$this->conexion->prepare($consulta);
        $con->bindParam(1,$token);
        $con->bindParam(2,$validez);
        $con->bindParam(3,$idUsuario);
        if(!$con->execute()){
            $errores['token']="No se ha podido insertar el token";
        }

    }catch(PDOException $e){
        error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->getLine()."##Código: ".$e->getCode()."##Instante: ".microtime().PHP_EOL,3,"../logBd.txt");
        }
    }

}
?>