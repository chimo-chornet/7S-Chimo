<?php
session_start();
include("../libs/bGeneral.php");
cabecera();
if(isset($_COOKIE['galletacolor'])){
  $color=strip_tags($_COOKIE['galletacolor']);
   echo("<Style>body{background-color:$color}</style>");
}
if(time()-($_SESSION['acceso'])>3600 || $_SESSION['ip']!=$_SERVER['REMOTE_ADDR']){
  echo("La sesión se cerrará");
  header("location:../manejadoresForm/cierra.php");
}else{
  $_SESSION['acceso']=time();
}
?>
<h1>Perfil de usuario</h1>


<form action="../manejadoresForm/modifica.php" method="POST" enctype="multipart/form-data">


  Contraseña: <input type="password" name="contrasenya" value="<?=(isset($_SESSION['password']))? $_SESSION['password']:""?>"><br><br>
  Foto del perfil: <input type="file" name="foto"><br><br>
  Idioma preferente: <select name="idioma" id="" >
   <option value="esp" selected>Español</option>
    <option value="eng">Inglés</option>
  </select><br><br>
  Descripción personal:<br><textarea name="descripcion" id="" cols="30" rows="10" ><?=(isset($_SESSION['descripcion']))? $_SESSION['descripcion']:""?></textarea><br><br>
  <input type="submit" name="modificar" value="Modificar usario">
  <input type="reset" name="salir" value="Cancelar y salir" onclick="location.href='../vistas/privado.php'">
</form>
<?php

pie();
?>