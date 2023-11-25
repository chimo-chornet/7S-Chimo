<?php
include("../libs/bGeneral.php");
cabecera("Página principal");
?>
<h1>Oferta de servicios entre usuarios</h1>
<a href="../vistas/formLogin.php">Acceso al área privada<a><br><br>
  <a href="../vistas/formRegistro.php">Registro<a><br>
    <h2>Listado de servicios</h2>
<?php
//imprimimos la lista de servicios. Sólo títulos

/**
  Te falta hacer las comprobaciones para evitar errores en los ficheros, como en los ejemplos.
  Comprobar si existe, si la lectura ha ido bien, ...
**/
if(is_file("../ficheros/servicios.txt")) {
    if(($puntero=fopen("../ficheros/servicios.txt", "r"))){
    echo("<ul>");
    while(!feof($puntero)) {
        $linea=fgets($puntero);
        $separados=explode(":", $linea);
        if($linea!="") {
            echo("<li>".$separados[0]."</li>");
        }
    }
    }
echo("</ul>");
fclose($puntero);
}
pie();
?>
