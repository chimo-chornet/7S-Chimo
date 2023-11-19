<?php
session_start();
include("../libs/bGeneral.php");
if(!isset($_REQUEST['acceder'])) {
    include("../vistas/formLogin.php");
}else{
    $email=recoge('mail');
    $color=recoge('colorFondo');
//inicializamos la cookie
    if($color=='beige'){
        setcookie("galletacolor","beige",time()+600,"/");
    }else{
        setcookie("galletacolor","white",time()+600,"/");
    }
//comprobamos que el usuario y la contraseña coinciden con los almacenados en el fichero
        $passw=recoge('loginPass');
    $ruta="../ficheros/usuarios.txt";
    $usuario="";
    
    /***
    El código te queda más claro y más fácil de actualizar si pones esto en una función que devuelva false o u array con los datos
    ***/
    
    if(cMail($email)!=0) {
        if(file_exists($ruta)) {
            $puntero=fopen($ruta, "r");
            $usuarioValido=false;
            $passwordValido=false;
            while(!feof($puntero)) {
                $linea=fgets($puntero);
                $separados=explode(":", $linea);
                if(isset($separados[2])) {
                    if($separados[2]==$email) {
                        $usuarioValido=true;
                        if($separados[1]==$passw) {
                            $passwordValido=true;
                            $usuario=$separados[0];
                        }
                    }

                }
                }

        fclose($puntero);
        } else {
            echo("El fichero no existe");
        }
        //Si el usuario es válido generamos los valores de la sesión
        if($usuarioValido==true) {
            if($passwordValido==true) {
                
                $_SESSION["mail"]=$email;
                $_SESSION["usuario"]=$usuario;
                $_SESSION["password"]=$passw;
                $_SESSION["acceso"]=time();
                $_SESSION['ip']=$_SERVER['REMOTE_ADDR'];
                //enviamos a la páginma de area privada
                header("Location: ../vistas/privado.php");

                //Si el usuario no está registrado o la contrasseña es incorrecta, añadimos esta información al fichero logLogin.txt
            } else {
                echo("Contraseña incorrecta");

                file_put_contents("../ficheros/logLogin.txt","password incorrecto: ".$passw." con el usuario ".$email." ".time().PHP_EOL,FILE_APPEND);
                include("../vistas/formLogin.php");
            }
    } else {
        echo("Usuario no registrado");
        file_put_contents("../ficheros/logLogin.txt","Usuario no registrado: ".$email." con password ".$passw." ".time().PHP_EOL,FILE_APPEND);
        include("../vistas/formLogin.php");
    }
}else{
    echo("Debe introducir un correo electrónico");
    include("../vistas/formLogin.php");
}

}
?>
