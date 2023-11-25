<?php
session_start();
include("../libs/bGeneral.php");
$errores=[];
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

    //Si el usuario es válido generamos los valores de la sesión
    if(($usuario=compruebaUsuario($passw, $email,$ruta, $errores))!=false) {

        $_SESSION["mail"]=$email;
        $_SESSION["usuario"]=$usuario;
        $_SESSION["password"]=$passw;
        $_SESSION["acceso"]=time();
        $_SESSION['ip']=$_SERVER['REMOTE_ADDR'];
        //enviamos a la páginma de area privada
        header("Location: ../vistas/privado.php");

    //Si el usuario no está registrado o la contrasseña es incorrecta, añadimos esta información al fichero logLogin.txt
    } else {

        file_put_contents("../ficheros/logLogin.txt", "ACCESO incorrecto: Con el usuario ".$email."  con password ".$passw.time().PHP_EOL, FILE_APPEND);
        include("../vistas/formLogin.php");
    }
if(!empty($errores)){
    foreach($errores as $error){
        echo($error."<br>");
    }
}
}


?>
