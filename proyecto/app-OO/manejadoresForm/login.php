<?php
session_start();
include("../libs/bGeneral.php");
include('../libs/consultas.php');
$errores=[];
$_SESSION["nivel"]=0;
if(!isset($_REQUEST['acceder'])) {
    include("../vistas/formLogin.php");
}else{
    $email=recoge('mail');
    $color=recoge('colorFondo');
    //inicializamos la cookie
    if($color=='beige') {
        setcookie("galletacolor", "beige", time()+600, "/");
    } else {
        setcookie("galletacolor", "white", time()+600, "/");
    }
    //comprobamos que el usuario y la contraseña coinciden con los almacenados en el fichero
    $passw=recoge('loginPass');
    cPassword($passw, $errores, 'password', 1);
    cMail($email, 'Email', $errores);
    $valores=['beige','white'];
    cRadio($color, 'color de fondo', $errores, $valores);
    $ruta="../ficheros/usuarios.txt";
    $usuario="";

    /***
    El código te queda más claro y más fácil de actualizar si pones esto en una función que devuelva false o u array con los datos
    En el momento del login sacamos todos los datos del usuario y nos guardamos en una variable de sesión la ruta de la imagen,
    así ya no tenemos que consultarla más adelante
    ***/
//comprobamos que el usuario y la contraseña coinciden con los almacenados en la base de datos
    //Si el usuario es válido generamos los valores de la sesión
    if(($usuario=compruebaUsuarioDb($email, $errores))!=false) {
if(comprobarhash($passw, $usuario[0]['pass'])) {


    $_SESSION["usuario"]=$usuario[0]['nombre'];
    $_SESSION["id_usuario"]=$usuario[0]['id_user'];
    $_SESSION["imagen"]=$usuario[0]['foto_perfil'];
    $_SESSION["mail"]=$usuario[0]['email'];
    $_SESSION["nacimiento"]=$usuario[0]['f_nacimiento'];
    $_SESSION['idioma']=devuelveIdioma(consultaIdiomaUsuario($_SESSION['id_usuario'],$errores),$errores);
    $_SESSION["descripcion"]=$usuario[0]['descripción'];
    $_SESSION["activo"]=$usuario[0]['activo'];
    $_SESSION["nivel"]=$usuario[0]['nivel'];
    $_SESSION["acceso"]=time();
    $_SESSION['ip']=$_SERVER['REMOTE_ADDR'];
if($_SESSION['activo']==0){
    $errores['cuenta']="La cuenta no está activada";
}

}else{
    $errores['password']="Password incorrecto";
}

}else{
    $errores['usuario']="Usuario incorrecto";
}

    /*fclose($puntero);

        $_SESSION["mail"]=$email;
        $_SESSION["usuario"]=$usuario;
        $_SESSION["password"]=$passw;
        $_SESSION["acceso"]=time();
        $_SESSION['ip']=$_SERVER['REMOTE_ADDR'];
     */   //enviamos a la páginma de area privada
if(empty($errores)) {
    header("Location: ../vistas/privado.php");
}else{
    include("../vistas/formLogin.php");
    foreach($errores as $error){
        echo($error."<br>");
    }

}
    //Si el usuario no está registrado o la contrasseña es incorrecta, añadimos esta información al fichero logLogin.txt
    /*} else {

        file_put_contents("../ficheros/logLogin.txt", "ACCESO incorrecto: Con el usuario ".$email."  con password ".$passw.time().PHP_EOL, FILE_APPEND);
        include("../vistas/formLogin.php");
    }
    */

}


?>
