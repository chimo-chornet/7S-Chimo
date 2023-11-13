<?php
session_start();
include("../libs/bGeneral.php");
if(!isset($_REQUEST['acceder'])) {
    include("../vistas/formLogin.php");
}else{
    $usuario=recoge('usuario');
    $passw=recoge('loginPass');
    $ruta="../ficheros/usuarios.txt";
if($usuario!="") {
    if(file_exists($ruta)) {
        $puntero=fopen("../ficheros/usuarios.txt", "r");
        $usuarioValido=false;
        $passwordValido=false;
        while(!feof($puntero)) {
            $linea=fgets($puntero);
            $separados=explode(":", $linea);
            if($separados[0]==$usuario) {
                $usuarioValido=true;
                if($separados[1]==$passw) {
                    $passwordValido=true;
                }
            }
        }
        fclose($puntero);
    } else {
        echo("El fichero no existe");
    }
    if($usuarioValido==true) {
        if($passwordValido==true) {
            $_SESSION["usuario"]=$usuario;
            echo("Bienvenido usuario".$usuario);
            header("Location: ../vistas/privado.php");
        } else {
            echo("Contraseña incorrecta");
            include("../vistas/formLogin.php");
        }
    } else {
        echo("Usuario no registrado");
        include("../vistas/formLogin.php");
    }
}else{
    echo("Debe introducir un usuario");
    include("../vistas/formLogin.php");
}

}
?>