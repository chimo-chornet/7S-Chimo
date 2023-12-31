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
   //establecemos el color de fondo traido por la cookie
    echo("<Style>body{background-color:$color}</style>");
    }

include('../libs/consultas.php');
$id=$_GET['id_servicio'];
$servicios=muestraServicio($id);
$usuarios=devuelveUsuario($servicios['id_user']);
$fotoServicio=$servicios['foto_servicio'];
$tipo=$servicios['tipo'];
$disponible=consultaDisponibilidadServicio($id);
echo("Servicio ofrecido por: ".$usuarios[0]['nombre']."<br>");
echo("<a href='../manejadoresForm/envioSolicitud.php?mail=".$usuarios[0]['email']."&nombre=".$usuarios[0]['nombre']."&servicio=".$servicios['titulo']."&id=".$id."'>Enviar Solicitud</a><br>");
echo("<h2> ".$servicios['titulo']."</h2><br>");
if($fotoServicio=='Sin imagen'){
    echo($fotoServicio);
    }else{
        echo("<img src=".$fotoServicio." width=\"255px\">");
    }
echo("<br><h3>Descripción: </h3>".$servicios['descripcion']."<br>");
echo("Precio por hora: ".$servicios['precio']."<br>");
if($tipo==0){
    echo("Tipo: PAGO<br>");
}else{
    echo("Tipo: INTERCAMBIO<br>");
}
echo("<br><h3>Disponibilidad: </h3>");
foreach($disponible as $linea){
    echo(devuelveDisponibilidad($linea['id_disponibilidad'])."<br>");
}
echo("<br><a href='../vistas/privado.php'>SALIR</a>");




?>