<?php
session_start();
include("../libs/bGeneral.php");
cabecera("Cerrar");
session_destroy();
setcookie("galletacolor","",time()-100);
//header("location:../vistas/index.php");
echo("<h1>La sesión se ha cerrado</h1>");
?>
<form action="../vistas/index.php" method="">
    <input type="submit" name="salir" value="Volver a la página principal">
</form>
<?php
pie();
?>