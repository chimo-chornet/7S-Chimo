<?php
session_start();
if($_SESSION['nivel']<2){
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


include('../libs/bGeneral.php');
include('../libs/consultas.php');
$errores=[];
$idioma=recoge('idioma');
cTexto($idioma,'idioma',$errores);
if(empty($errores)) {
    if(insertaIdioma($idioma)) {
        echo("Idioma añadido<br>");
         }
}else{
    foreach($errores as $error){
        echo($error."<br>");
    }
}
echo("<a href='../manejadoresForm/admin.php'>VOLVER AL PANEL DE CONTROL</a>");

?>