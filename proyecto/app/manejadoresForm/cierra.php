<?php
session_start();
include("../libs/bGeneral.php");
cabecera("Cerrar");
//destruimos la sesión y la cookie
session_destroy();
setcookie("galletacolor","",time()-100);

echo("<h1>La sesión se ha cerrado</h1>");
//añadimos un botón para volver a la página principal
?>
<form action="../vistas/index.php" method="">
    <input type="submit" name="salir" value="Volver a la página principal">
</form>
<?php
pie();
?>