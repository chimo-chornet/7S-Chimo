<?php
session_start();
if($_SESSION['nivel']<1){
    header("location:../manejadoresForm/cierra.php");
    }
    if(time()-($_SESSION['acceso'])>3600 || $_SESSION['ip']!=$_SERVER['REMOTE_ADDR']){
        echo("La sesión se cerrará");
        header("location:../manejadoresForm/cierra.php");
    }else{
        $_SESSION['acceso']=time();
    }
    //Si existe la cookie la recogemos y sanitizamos. Después la usamos para el color del fondo.

    if(isset($_COOKIE["galletacolor"])){
        $color=$_COOKIE["galletacolor"];
    }
    //establecemos el color de fondo traido por la cookie
echo("<Style>body{background-color:$color}</style>");


$mail=$_GET['mail'];
$sujeto='Solicitud de servicio';
$nombre=$_GET['nombre'];
$id=$_GET['id'];
$servicio=$_GET['servicio'];
$mensaje="El usuario: ".$_SESSION['usuario']." se ha interesado en su servicio ".$servicio." Puede contactar con el e-mail: ".$_SESSION['mail'];
include('../libs/enviarCorreo.php');
if(enviaCorreo($mail, $sujeto,$nombre,$mensaje)){
    echo("El mensaje se ha enviado con éxito<br>");
    echo("<a href='../manejadoresForm/paginaServicio.php?id_servicio=".$id."'>VOLVER</a>");


}


?>