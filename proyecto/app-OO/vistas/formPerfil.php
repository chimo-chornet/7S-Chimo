<?php
session_start();
include("../libs/bGeneral.php");
cabecera();
//Si existe la cookie la recogemos y sanitizamos. Después la usamos para el color del fondo.
if(isset($_COOKIE['galletacolor'])){
  $color=strip_tags($_COOKIE['galletacolor']);
   echo("<Style>body{background-color:$color}</style>");
}
//Mecanismo de cierre de sesión en una hora después del último accesso
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
  Idioma preferente: <?php
  include_once('../libs/consultas.php');

  include('../libs/bComponentes.php');
    $errores=[];
    $valor=listaIdiomas($errores);
    $valores=[];
    foreach($valor as $linea){
        $valores[$linea['id_idioma']]=$linea['idioma'];
    }
    pintaSelect($valores,'idioma')
    ?>
  <br>Descripción personal:<br><textarea name="descripcion" id="" cols="30" rows="10" ><?=(isset($_SESSION['descripcion']))? $_SESSION['descripcion']:""?></textarea><br><br>
  <input type="submit" name="modificar" value="Modificar usario">
  <input type="reset" name="salir" value="Cancelar y salir" onclick="location.href='../vistas/privado.php'">
</form>
<?php

pie();
?>