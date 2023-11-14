<?php
session_start();
include("../libs/bGeneral.php");
//cabecera("Modificar prefil");
$separados=[];
$separa=[];

if(time()-($_SESSION['acceso'])>3600 || $_SESSION['ip']!=$_SERVER['REMOTE_ADDR']){
    echo("La sesión se cerrará");
    header("location:../manejadoresForm/cierra.php");
}
if(isset($_COOKIE["galletacolor"])){
    $color=$_COOKIE["galletacolor"];
}

if(!isset($_SESSION["usuario"])){
echo("Esta zona es exculsiva para usuarios logeados");


}else{
    $usuario=$_SESSION["usuario"];
    $mail=$_SESSION["mail"];
    echo("Bienvenido usuario: ".$usuario."<br>");
    $puntero=fopen("../ficheros/usuarios.txt", "r");
    while(!feof($puntero)) {
        $lin=fgets($puntero);
        $separa=explode(":", $lin);
if(isset($separa[2])) {
    if($separa[2]===$mail) {
        if($separa[6]!=="Sin imagen") {
            echo("<br><img src=\"$separa[6]\" alt=\"foto\" width=\"100px\"><br>");
        }
        echo("<b>E-mail: </b>".$separa[2]."<br>");
        echo("<b>Fecha de nacimiento: </b>".$separa[3]."<br>");
        echo("<b>Lenguaje preferido: </b>".$separa[4]."<br>");
        echo("<b>Descripción: </b>".$separa[5]."<br>");
        $_SESSION["descripcion"]=$separa[5];
    } else {

    }
}
    }

    fclose($puntero);
echo("<Style>body{background-color:$color}</style>");

    ?>
    <br>
<a href="../vistas/formServicio.php">Alta de nuevo servicio</a><br><br>
<a href="../vistas/formPerfil.php">Modificar perfil</a><br><br>
<form action="" method="">
    <input type="button" name="salir" value="Cerrar sesión y salir" onclick="location.href='../manejadoresForm/cierra.php'">
</form>
<?php
    $puntero=fopen("../ficheros/servicios.txt", "r");
    echo("<h2>Lista de servicios disponibles</h2>");
    echo("<ul>");
    while(!feof($puntero)) {
        $linea=fgets($puntero);
        $separados=explode(":", $linea);
if($linea!="") {
    $imagen=$separados[6];
    if($imagen=="Sin imagen") {
        echo("<li>".$separados[0]." - ".$separados[1]." - ".$separados[2]." - ".$separados[3]." - ".$separados[4]." - ".$separados[5]." - "."$imagen"."</li>");
    } else {
        echo("<li>".$separados[0]." - ".$separados[1]." - ".$separados[2]." - ".$separados[3]." - ".$separados[4]." - ".$separados[5]." - "."<img src=\"$imagen\"width=\"45px\">"." - <b>Disponibilidad</b>: ".$separados[7]." - "."<b>Desde el</b> ".date('d-m-Y',$separados[8])."</li>");
    }
}
    }
    echo("</ul>");
    fclose($puntero);
}
?>