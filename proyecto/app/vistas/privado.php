<?php
session_start();
include("../libs/bGeneral.php");
include('../libs/consultas.php');
//cabecera("Modificar prefil");
if($_SESSION['nivel']==2){
header("location:../manejadoresForm/admin.php");
}
$separados=[];
$separa=[];
//Mecanismo de cierre de sesión en una hora después del último accesso

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
//si el usuario no está logeado no puede acceder
if($_SESSION["nivel"]==0){
echo("Esta zona es exculsiva para usuarios logueados");


}else{


      echo("Bienvenido usuario: ".$_SESSION["usuario"]."<br>");
        if($_SESSION['imagen']!=="Sin imagen") {
            echo("<br><img src=\"".$_SESSION['imagen']."\" alt=\"foto\" width=\"100px\"><br>");
        }else{
            echo($_SESSION['imagen']."<br>");
        }
        echo("<b>E-mail: </b>".$_SESSION['mail']."<br>");
        echo("<b>Fecha de nacimiento: </b>".$_SESSION['nacimiento']."<br>");
        echo("<b>Lenguaje preferido: </b>".$_SESSION['idioma']."<br>");
        echo("<b>Descripción: </b>".$_SESSION['descripcion']."<br>");




    //establecemos el color de fondo traido por la cookie
echo("<Style>body{background-color:$color}</style>");
//formulario con botón de salida segura y cierre de sesión
    ?>
    <br>
<a href="../vistas/formServicio.php">Alta de nuevo servicio</a><br><br>
<a href="../vistas/formPerfil.php">Modificar perfil</a><br><br>
<form action="" method="">

    <input type="button" name="salir" value="Cerrar sesión y salir" onclick="location.href='../manejadoresForm/cierra.php'">
</form>
<?php
//imprime la lista de servicios completa

$servicios=listaServicios($_SESSION['id_usuario']);
foreach($servicios as $linea){
    echo("<a href=\"../manejadoresForm/paginaServicio.php?id_servicio=".$linea['id_servicios']."\">".$linea['titulo']." - ".$linea['descripcion']."</a><br>");
}
   /* $puntero=fopen("../ficheros/servicios.txt", "r");
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
*/
}
?>