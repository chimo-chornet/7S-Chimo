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
    //establecemos el color de fondo traido por la cookie
    echo("<Style>body{background-color:$color}</style>");
    }


echo("<h1>Bienvenido al Panel de administración</h1>");
echo("<h2>Añadir disponibilidad</h2>");
include('../vistas/formDisponibilidad.php');
echo("<h2>Eliminar disponibilidad</h2>");
include('../vistas/formEliminaDisponibilidad.php');
echo("<h2>Añadir idioma</h2>");
include('../vistas/formIdioma.php');
echo("<h2>Eliminar idioma</h2>");
include('../vistas/formEliminaIdioma.php');
//formulario con botón de salida segura y cierre de sesión
?>
<br>

<form action="" method="">

<input type="button" name="salir" value="Cerrar sesión y salir" onclick="location.href='../manejadoresForm/cierra.php'">
</form>
<?php

?>