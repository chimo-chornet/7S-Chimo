<?php


function listaEmpleados(&$errores){
$consulta="SELECT * FROM `empleados`";
try {
    include("../libs/config.php");
    $con=$pdo->prepare($consulta);

    if($con->execute()) {
        $resultado=$con->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }else{
        $errores['listado']="No se ha podido ejecutar la consulta";
        return false;
    }

}catch (PDOException $e){
    error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->$getLine()."##Código: ".$e->getCode()."##Instante: ".mircotime().PHP_EOL,3,"../logBd.txt");
}
$pdo=null;
}

function listaLocalidades(&$errores){
    $consulta="SELECT * FROM `localidades`";
try {
    include("../libs/config.php");
    $con=$pdo->prepare($consulta);

    if($con->execute()) {
        $resultado=$con->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }else{
        $errores['listado']="No se ha podido ejecutar la consulta";
        return false;
    }

}catch (PDOException $e){
    error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->$getLine()."##Código: ".$e->getCode()."##Instante: ".mircotime().PHP_EOL,3,"../logBd.txt");
}
$pdo=null;
}
function insertaEmpleado($nombre,$puesto,$fecha,$salario,$localidad,$usuario,$passw,&$errores){
    $consulta="INSERT INTO `empleados`(nombre,puesto,fecha_nacimiento, salario,localidad,usuario,passw) VALUES (?,?,?,?,?,?,?)";
    if(compruebaUsuarioDb($usuario,$errores)==true){
        $errores['usuario']="El usuario ya existe";
        return false;
    }
            try {
                include("../libs/config.php");
                $con=$pdo->prepare($consulta);
                $con->bindParam(1, $nombre);
                $con->bindParam(2, $puesto);
                $con->bindParam(3, $fecha);
                $con->bindParam(4, $salario);
                $con->bindParam(5, $localidad);
                $con->bindParam(6, $usuario);
                $con->bindParam(7, $passw);
                if($con->execute()){
                return true;
                }
            }catch (PDOException $e){
                // En este caso guardamos los errores en un archivo de errores log
                error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");

                // guardamos en ·errores el error que queremos mostrar a los usuarios
                $errores['datos'] = "Ha habido un error <br>";
                return false;
            }
            $pdo=null;
    }

function compruebaUsuarioDb($usuario,&$errores){
    include("../libs/conexion.php");
    $consulta="SELECT * FROM `usuario` WHERE email=?";
try {
    $con=$pdo->prepare($consulta);
    $con->bindParam(1, $usuario);
    $con->execute();
    $resultado=$con->fetchAll(PDO::FETCH_ASSOC);
    if((count($resultado))!=0) {
        //$errores['usuario']="El usuario ya existe";
        return $resultado;
    } else {
        return false;
    }
}catch (PDOException $e){
    error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->$getLine()."##Código: ".$e->getCode()."##Instante: ".mircotime().PHP_EOL,3,"../logBd.txt");

}
        $pdo=null;
    }
function compruebaLocalidad($localidad,&$errores){
    include("../libs/config.php");
    $consulta="SELECT * FROM `localidades` WHERE id_localidad=?";
    try{
    $con=$pdo->prepare($consulta);
    $con->bindParam(1,$localidad);
    $con->execute();
    $resultado=$con->fetchAll(PDO::FETCH_ASSOC);
    if(count($resultado)!=0){
        //$errores['usuario']="El usuario ya existe";
        return $resultado;
    }else{
        return false;
    }
}catch (PDOException $e){
    error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->$getLine()."##Código: ".$e->getCode()."##Instante: ".mircotime().PHP_EOL,3,"../logBd.txt");

}
    $pdo=null;
}
function eliminarEmpleado($id,&$errores)
{
    require("../libs/config.php");
    $consulta="DELETE FROM `empleados` WHERE id=?";
    try {
        $con=$pdo->prepare($consulta);
        $con->bindParam(1, $id);
        if(!$con->execute()){
            $errores['datos']="No se ha podido eliminar el empleado";
            return false;
        }else{
            return true;
        }
    } catch (PDOException $e) {
        error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->getLine()."##Código: ".$e->getCode()."##Instante: ".microtime().PHP_EOL, 3, "../logBd.txt");

    }
}
function valorEmpleados(){
    require("../libs/config.php");
$consulta="SELECT id FROM `empleados`";
$cons=$pdo->query($consulta);
$resul=$cons->fetchAll(PDO::FETCH_ASSOC);
$valores=[];
foreach($resul as $linea){
    $valores[]=$linea['id'];
    }
    return $valores;
    $pdo=null;
}
function registraUsuario($nombre,$mail,$pass,$fechaNac,$foto,$desc,$nivel,$activo,&$errores){

    $consulta="INSERT INTO `usuario`(nombre,email,pass,f_nacimiento,foto_perfil,descripción,nivel,activo) VALUES (?,?,?,?,?,?,?,?)";
try {
    include('conexion.php');

    $con=$pdo->prepare($consulta);
    $con->bindParam(1, $nombre);
    $con->bindParam(2, $mail);
    $con->bindParam(3, $pass);
    $con->bindParam(4, $fechaNac);
    $con->bindParam(5, $foto);
    $con->bindParam(6, $desc);
    $con->bindParam(7, $nivel);
    $con->bindParam(8, $activo);
    if($con->execute()) {
        return true;
    }else{
        $errores['datos']="Error al registrar en la base de datos";
        return false;
    }
}catch(PDOException $e){
    error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->getLine()."##Código: ".$e->getCode()."##Instante: ".microtime().PHP_EOL,3,"../logBd.txt");

}
}
function listaIdiomas(&$errores){
    $consulta="SELECT * FROM `idioma`";
    try{
        include('conexion.php');
        $con=$pdo->prepare($consulta);
            if($con->execute()) {
                $resultado=$con->fetchAll(PDO::FETCH_ASSOC);
                return $resultado;
            }else{
                $errores['idioma']=["El idioma no está registrado"];
            }
    }catch(PDOException $e){
    error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->getLine()."##Código: ".$e->getCode()."##Instante: ".microtime().PHP_EOL,3,"../logBd.txt");
    }
}
function compruebaIdiomas($id,&$errores){
    include('conexion.php');
    $consulta="SELECT * FROM `idioma` WHERE id_idioma=?";
    try{
    $con=$pdo->prepare($consulta);
    $con->bindParam(1,$id);
    if($con->execute()){
        $resul=$con->fetchAll(PDO::FETCH_ASSOC);
        if(count($resul)==1);
        return true;
    }else{
        $errores['idioma']=["El idioma no está registrado"];
    }
    }catch(PDOException $e){
    error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->getLine()."##Código: ".$e->getCode()."##Instante: ".microtime().PHP_EOL,3,"../logBd.txt");
    }

}
function insertaIdiomaUsuario($idioma,$usuario,&$errores){
    include('conexion.php');
    $consulta="INSERT INTO `user-idioma`(id_idioma,id_user) VALUES (?,?)";
    try{
    $con=$pdo->prepare($consulta);
    $con->bindParam(1,$idioma);
    $con->bindParam(2,$usuario);
    if(!$con->execute()){
        $errores['token']="No se ha podido insertar idioma de usuario";
    }

    }catch(PDOException $e){
    error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->getLine()."##Código: ".$e->getCode()."##Instante: ".microtime().PHP_EOL,3,"../logBd.txt");
    }

}
function consultaIdiomaUsuario($usuario,&$errores){
    include('conexion.php');
    $consulta="SELECT * FROM `user-idioma` WHERE id_user=?";
    try{
    $con=$pdo->prepare($consulta);
    $con->bindParam(1,$usuario);
if($con->execute()) {
    $resul=$con->fetchAll(PDO::FETCH_ASSOC);
    return $resul[0]['id_idioma'];
}else{
    $errores['idioma']="No se ha podido comprobar el idioma del usuario";
}
}catch(PDOException $e){
    error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->getLine()."##Código: ".$e->getCode()."##Instante: ".microtime().PHP_EOL,3,"../logBd.txt");
    }


}
function devuelveIdioma($id,&$errores){
    include('conexion.php');
    $consulta="SELECT * FROM `idioma` WHERE id_idioma=?";
    try{
    $con=$pdo->prepare($consulta);
    $con->bindParam(1,$id);
if($con->execute()) {
    $resul=$con->fetchAll(PDO::FETCH_ASSOC);
    return $resul[0]['idioma'];
}else{
    $errores['idioma']="No se ha podido comprobar el idioma";
}
}catch(PDOException $e){
    error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->getLine()."##Código: ".$e->getCode()."##Instante: ".microtime().PHP_EOL,3,"../logBd.txt");
    }
}
function insertaToken($token,$validez,$idUsuario,&$errores){
    include('conexion.php');
    $consulta="INSERT INTO `tokens`(token,validez,id_user) VALUES (?,?,?)";
    try{
    $con=$pdo->prepare($consulta);
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
function compruebaToken($token,&$errores){

    include('conexion.php');
    $consulta="SELECT * FROM `tokens` WHERE token=?";
    try{
    $con=$pdo->prepare($consulta);
    $con->bindParam(1,$token);
    if($con->execute()){
        $resul=$con->fetchAll(PDO::FETCH_ASSOC);
    return $resul;
    }else{
        $errores['token']="No se ha podido comprobar el token";
        return false;
    }
    }catch(PDOException $e){
    error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->getLine()."##Código: ".$e->getCode()."##Instante: ".microtime().PHP_EOL,3,"../logBd.txt");
    }
}
function eliminaToken($token,&$errores){
    include('conexion.php');
    $consulta="DELETE FROM `tokens` WHERE token=?";
    try{
    $con=$pdo->prepare($consulta);
    $con->bindParam(1,$token);
        if($con->execute()) {
        return true;
         }else{
            $errores['token']="No se ha podido eliminar el token";
         }
}catch(PDOException $e){
    error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->getLine()."##Código: ".$e->getCode()."##Instante: ".microtime().PHP_EOL,3,"../logBd.txt");
    }

}
function activaCuenta($usuario,&$errores){
    include('conexion.php');
    $consulta="UPDATE `usuario` SET activo=1 WHERE id_user=?";
    try{
    $con=$pdo->prepare($consulta);
    $con->bindParam(1,$usuario);
    if(!$con->execute()){
        $errores['activar']="No se ha podido activar la cuenta";
    }
    }catch(PDOException $e){
    error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->getLine()."##Código: ".$e->getCode()."##Instante: ".microtime().PHP_EOL,3,"../logBd.txt");
    }
}

function registraServicio($titulo,$idUsuario,$descripcion,$precio,$tipo,$fotoServicio,&$errores){

    $consulta="INSERT INTO `servicios`(titulo,id_user,descripcion,precio,tipo,foto_servicio) VALUES (?,?,?,?,?,?)";
try {
    include('conexion.php');

    $con=$pdo->prepare($consulta);
    $con->bindParam(1, $titulo);
    $con->bindParam(2, $idUsuario);
    $con->bindParam(3, $descripcion);
    $con->bindParam(4, $precio);
    $con->bindParam(5, $tipo);
    $con->bindParam(6, $fotoServicio);
    if($con->execute()) {
        $idServicio=$pdo->lastInsertId();
        return $idServicio;
    }else{
        $errores['servicio']="Error al registrar el servicio";
        return false;
    }
}catch(PDOException $e){
    error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->getLine()."##Código: ".$e->getCode()."##Instante: ".microtime().PHP_EOL,3,"../logBd.txt");

}
}
function valoresDisponibilidad($errores){
    $consulta="SELECT * FROM `disponibilidad`";
    try{
        include('conexion.php');
        $con=$pdo->prepare($consulta);
        if($con->execute()){
        $resul=$con->fetchAll(PDO::FETCH_ASSOC);

        $resultado=[];
        foreach($resul as $clave=> $linea){
            $resultado[$linea['id_disponibilidad']]=$linea['disponibilidad'];
        }


        return $resultado;
        }else{
            $errores['disponibilidad']="Error en valores de Disponibilidad";

        }
    }catch(PDOException $e){
    error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->getLine()."##Código: ".$e->getCode()."##Instante: ".microtime().PHP_EOL,3,"../logBd.txt");

}
}
function listaServicios($idUsuario){
    $consulta="SELECT * FROM `servicios` WHERE id_user!=? ORDER BY fecha_alta DESC";
    try{
        include('conexion.php');
        $con=$pdo->prepare($consulta);
        $con->bindParam(1,$idUsuario);
        $con->execute();
        $resultado=$con->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }catch(PDOException $e){
        error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->getLine()."##Código: ".$e->getCode()."##Instante: ".microtime().PHP_EOL,3,"../logBd.txt");

    }
}function listaServiciosIndex(){
    $consulta="SELECT * FROM `servicios` LIMIT 10";
    try{
        include('conexion.php');
        $con=$pdo->prepare($consulta);
        $con->execute();
        $resultado=$con->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }catch(PDOException $e){
        error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->getLine()."##Código: ".$e->getCode()."##Instante: ".microtime().PHP_EOL,3,"../logBd.txt");

    }
}
function muestraServicio($id){
    $consulta="SELECT * FROM `servicios` WHERE id_servicios=?";
    try{
        include('conexion.php');
        $con=$pdo->prepare($consulta);
        $con->bindParam(1,$id);
        $con->execute();
        $resultado=$con->fetchAll(PDO::FETCH_ASSOC);
        return $resultado[0];
    }catch(PDOException $e){
        error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->getLine()."##Código: ".$e->getCode()."##Instante: ".microtime().PHP_EOL,3,"../logBd.txt");

    }
}
function devuelveUsuario($id){
    $consulta="SELECT * FROM `usuario` WHERE id_user=?";
        try{
        include('conexion.php');
        $con=$pdo->prepare($consulta);
        $con->bindParam(1,$id);
        $con->execute();
        $resultado=$con->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }catch(PDOException $e){
        error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->getLine()."##Código: ".$e->getCode()."##Instante: ".microtime().PHP_EOL,3,"../logBd.txt");

    }
}
function insertaDisponibilidadServicio($idServicio,$disponibilidad){
    include('conexion.php');

        $consulta="INSERT INTO `disp_servicio`(id_servicio,id_disponibilidad) VALUES (?,?)";
        try{
            $con=$pdo->prepare($consulta);
            $con->bindParam(1,$idServicio);
            $con->bindParam(2,$disponibilidad);
if($con->execute()) {
    return true;
}
        }catch(PDOException $e){
            error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->getLine()."##Código: ".$e->getCode()."##Instante: ".microtime().PHP_EOL,3,"../logBd.txt");

        }


}
function devuelveIdServicio($servicio){
    $consulta="SELECT * FROM `servicios` WHERE titulo=?";
    try{
        include('conexion.php');
        $con=$pdo->prepare($consulta);
        $con->bindParam(1,$servicio);
        $con->execute();


        $resultado=$con->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }catch(PDOException $e){
        error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->getLine()."##Código: ".$e->getCode()."##Instante: ".microtime().PHP_EOL,3,"../logBd.txt");

    }
}
function consultaDisponibilidadServicio($idServicio){
    include('conexion.php');

        $consulta="SELECT * FROM  `disp_servicio` WHERE id_servicio=?";
        try{
            $con=$pdo->prepare($consulta);
            $con->bindParam(1,$idServicio);
if($con->execute()) {
    $resultado=$con->fetchAll(PDO::FETCH_ASSOC);
    return $resultado;
}
        }catch(PDOException $e){
            error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->getLine()."##Código: ".$e->getCode()."##Instante: ".microtime().PHP_EOL,3,"../logBd.txt");

        }
    }
    function devuelveDisponibilidad($idDisponibilidad){
        $consulta="SELECT * FROM `disponibilidad` WHERE id_disponibilidad=?";
        try{
            include('conexion.php');
            $con=$pdo->prepare($consulta);
            $con->bindParam(1,$idDisponibilidad);
if($con->execute()) {
    $resultado=$con->fetchAll(PDO::FETCH_ASSOC);
    return $resultado[0]['disponibilidad'];
}
        }catch(PDOException $e){
            error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->getLine()."##Código: ".$e->getCode()."##Instante: ".microtime().PHP_EOL,3,"../logBd.txt");

        }

    }
    function modificaUsuario($idUsuario,$pass,$foto,$desc,$idioma,&$errores){

        $consulta="UPDATE `usuario` SET foto_perfil =? WHERE id_user =?";
    try {
        include('conexion.php');
        $consulta="UPDATE `usuario` SET foto_perfil =? WHERE id_user =?";
        $con=$pdo->prepare($consulta);
        $con->bindParam(1, $foto);
        $con->bindParam(2, $idUsuario);
$con->execute();
$consulta="UPDATE `usuario` SET pass =? WHERE id_user =?";
$con=$pdo->prepare($consulta);
        $con->bindParam(1, $pass);
        $con->bindParam(2, $idUsuario);
        $con->execute();

        $consulta="UPDATE `usuario` SET descripción =? WHERE id_user =?";
$con=$pdo->prepare($consulta);
        $con->bindParam(1, $desc);
        $con->bindParam(2, $idUsuario);

        if($con->execute()) {
            modificaIdioma($idioma,$idUsuario);
            return true;
        }else{

            $errores['datos']="Error al actualizar el usuario";
            return false;
        }
    }catch(PDOException $e){
        error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->getLine()."##Código: ".$e->getCode()."##Instante: ".microtime().PHP_EOL,3,"../logBd.txt");

    }
    }
    function modificaIdioma($idIdioma,$idUsuario){
        include('conexion.php');
        $consulta="UPDATE `user-idioma` SET id_idioma =? WHERE id_user =?";
        $con=$pdo->prepare($consulta);
        $con->bindParam(1, $idIdioma);
        $con->bindParam(2, $idUsuario);
        $con->execute();
    }
    function eliminaDisponibilidad($idDisponibilidad){


            $consulta="DELETE FROM `disponibilidad` WHERE id_disponibilidad=?";
            try{
                include('conexion.php');
                $con=$pdo->prepare($consulta);
                $con->bindParam(1,$idDisponibilidad);
    if($con->execute()) {
        return true;
    }
            }catch(PDOException $e){
                error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->getLine()."##Código: ".$e->getCode()."##Instante: ".microtime().PHP_EOL,3,"../logBd.txt");

            }


    }
    function insertaDisponibilidad($disponibilidad){
        include('conexion.php');

            $consulta="INSERT INTO `disponibilidad` (disponibilidad) VALUES (?)";
            try{
                $con=$pdo->prepare($consulta);
                $con->bindParam(1,$disponibilidad);
    if($con->execute()) {
        return true;
    }
            }catch(PDOException $e){
                error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->getLine()."##Código: ".$e->getCode()."##Instante: ".microtime().PHP_EOL,3,"../logBd.txt");

            }


    }
    function insertaIdioma($idioma){
        include('conexion.php');

            $consulta="INSERT INTO `idioma` (idioma) VALUES (?)";
            try{
                $con=$pdo->prepare($consulta);
                $con->bindParam(1,$idioma);
    if($con->execute()) {
        return true;
    }
            }catch(PDOException $e){
                error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->getLine()."##Código: ".$e->getCode()."##Instante: ".microtime().PHP_EOL,3,"../logBd.txt");

            }


    }
    function eliminaIdioma($idioma){

        $consulta="DELETE FROM `idioma` WHERE id_idioma=?";
        try{
            include('conexion.php');
            $con=$pdo->prepare($consulta);
            $con->bindParam(1,$idioma);
if($con->execute()) {
    return true;
}
        }catch(PDOException $e){
            error_log("##Fichero: ".$e->getFile()."##Línea: ".$e->getLine()."##Código: ".$e->getCode()."##Instante: ".microtime().PHP_EOL,3,"../logBd.txt");

        }


}
?>