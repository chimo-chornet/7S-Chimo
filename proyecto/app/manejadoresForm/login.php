<?php
session_start();
include("../libs/bGeneral.php");
if(!isset($_REQUEST['acceder'])) {
    include("../vistas/formLogin.php");
}else{
    $email=recoge('mail');
    $color=recoge('colorFondo');

    if($color=='beige'){
        setcookie("galletacolor","beige",time()+600,"/");
    }else{
        setcookie("galletacolor","white",time()+600,"/");
    }

        $passw=recoge('loginPass');
    $ruta="../ficheros/usuarios.txt";
    $usuario="";
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
        if($usuarioValido==true) {
            if($passwordValido==true) {
                $_SESSION["mail"]=$email;
                $_SESSION["usuario"]=$usuario;
                $_SESSION["password"]=$passw;
                $_SESSION["acceso"]=time();
                $_SESSION['ip']=$_SERVER['REMOTE_ADDR'];

                header("Location: ../vistas/privado.php");
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