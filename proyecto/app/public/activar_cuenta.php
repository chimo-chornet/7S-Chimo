<?php
if(isset($_GET['token'])) {
    $token = $_GET['token'];
    $errores=[];

    include('../libs/consultas.php');

    if(($resultado=compruebaToken($token,$errore))!=false) {
        $idUsuario=$resultado[0]['id_user'];
        $hasta=$resultado[0]['validez'];
        if(time()>$hasta){
            echo("El token ha expirado");
            echo("<br><a href='../vistas/formLogin.php'>Acceder</a>");
        }else{

            activaCuenta($idUsuario,$errores);
            echo("Cuenta activada<br>");
            echo("<a href='../vistas/formLogin.php'>Acceder</a>");
            eliminaToken($token,$errores);
        }
    }else{
        echo("El token no es válido");
        echo("<br><a href='../vistas/formLogin.php'>Acceder</a>");
    }
}else{
    echo("No hay token");
    echo("<br><a href='../vistas/formLogin.php'>Acceder</a>");
}

?>