<?php
include("../libs/bGeneral.php");
cabecera("Página principal");
?>
<h1>Oferta de servicios entre usuarios</h1>
<a href="../vistas/formLogin.php">Acceso al área privada<a><br><br>
  <a href="../vistas/formRegistro.php">Registro<a><br>
    <h2>Listado de servicios</h2>
<?php
//imprimimos una muestra de la lista de servicios con links.

include('../libs/consultas.php');
$servicios=listaServiciosIndex();
foreach($servicios as $linea){
    echo("<a href=\"../manejadoresForm/paginaServicio.php?id_servicio=".$linea['id_servicios']."\">".$linea['titulo']." - ".$linea['descripcion']."</a><br>");
}
pie();
?>
