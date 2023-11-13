<?php
session_start();
include("../libs/bGeneral.php");
$usuario=$_SESSION["usuario"];
echo("Bienvenido usuario: ".$usuario."<br>");
$puntero=fopen("../ficheros/usuarios.txt","r");
while(!feof($puntero)){
    $linea=fgets($puntero);
    $separados=explode(":",$linea);
    if($separados[0]==$usuario) {
        if($separados[6]!=="Sin imagen") {
            echo("<br><img src=\"$separados[6]\" alt=\"foto\" width=\"100px\"><br>");
        }
        echo("<b>E-mail: </b>".$separados[2]."<br>");
        echo("<b>Fecha de nacimiento: </b>".$separados[3]."<br>");
        echo("<b>Lenguaje preferido: </b>".$separados[4]."<br>");
        echo("<b>Descripción: </b>".$separados[5]."<br>");

    }

}
fclose($puntero);
?>
<a href="../vistas/formServicio.php">Alta de servicio</a>
<?php
$puntero=fopen("../ficheros/servicios.txt","r");
echo("<h1>Lista de servicios disponibles</h1>");
echo("<ul>");
while(!feof($puntero)){
$linea=fgets($puntero);
$separados=explode(":",$linea);
echo("<li>".$separados[0]."</li>");
}
echo("</ul>");
fclose($puntero);

?>