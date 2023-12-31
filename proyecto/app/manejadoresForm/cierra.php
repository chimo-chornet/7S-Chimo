<?php
session_start();
include("../libs/bGeneral.php");
cabecera("Cerrar");
//si el usuario no está logueado no puede acceder
if(!isset($_SESSION["usuario"])) {
    echo("Esta zona es exculsiva para usuarios logueados");
}else{

//destruimos la sesión y la cookie
session_unset();
session_destroy();
setcookie("galletacolor","",time()-100);

echo("<h1>La sesión se ha cerrado</h1>");
}
//añadimos un botón para volver a la página principal
?>
<form action="../vistas/index.php" method="">
    <input type="submit" name="salir" value="Volver a la página principal">
</form>
<?php
pie();
?>