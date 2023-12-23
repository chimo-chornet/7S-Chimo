<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<?php
//Mecanismo de cierre de sesión en una hora después del último accesso
/*
Tanto el control de las sesiones como lo de las cookies mejor ponerlo en los manejadores form que en las vistas.
En las vistas intentamos no poner el menor código php posible.
El echo que pones no se verá nunca porque después hay un header
*/

if(isset($_SESSION['acceso'])) {
  if(time()-($_SESSION['acceso'])>3600 || $_SESSION['ip']!=$_SERVER['REMOTE_ADDR']) {
      echo("La sesión se cerrará");
      header("location:../manejadoresForm/cierra.php");
  }else{
    $_SESSION['acceso']=time();
  }
}
//Si existe la cookie la recogemos y sanitizamos. Después la usamos para el color del fondo.

if(isset($_COOKIE['galletacolor'])){
  $color=strip_tags($_COOKIE['galletacolor']);
   echo("<Style>body{background-color:$color}</style>");
}
?>

<h1>Alta de servicios</h1>
<form action="../manejadoresForm/servicios.php" method="POST" enctype="multipart/form-data">
  Titulo o nombre del servicio: <input type="text" name="titulo" value="<?=(isset($titulo))? $titulo:""?>"><br><br>
  Categoría: <select name="categoria" value="<?=(isset($categoria))? $categoria:""?>"><br><br>
  <option value="Trabajo">Trabajo</option>
  <option value="Ocio">Ocio</option>
  <option value="Alimentacion">Alimentación</option>
  <option value="Ensenanza">Enseñanza</option>
</select><br><br>
  Descripción:<br> <textarea name="descripcion" id="Descripción" cols="46" rows="3"><?=(isset($descripcion))? $descripcion:""?></textarea><br><br>
  Tipo:
  <input type="radio" name="tipo" id="Tipo" value="Pago">Pago
  <input type="radio" name="tipo" id="Tipo" value="Intercambio">Intercambio <br><br>

  Precio por hora: <input type="number" name="precio" value="<?=(isset($precio))? $precio:""?>"><br><br>
  Ubicación: <input type="text" name="ubicacion" value="<?=(isset($ubicacion))? $ubicacion:""?>"><br><br>
  Disponibilidad:
  Mañanas <input type="checkbox" name="disponibilidad[]" value="Mañanas">
  Tardes <input type="checkbox" name="disponibilidad[]" value="Tardes">
  Completo <input type="checkbox" name="disponibilidad[]" value="Completo">
  Fines de semana <input type="checkbox" name="disponibilidad[]" value="FinesSemana"><br><br>
  Foto del servicio: <input type="file" name="fotoServicio"><br><br>
  <input type="submit" name="alta" value="Dar de alta el servicio">
  <input type="reset" name="salir" value="Cancelar y salir" onclick="location.href='../vistas/privado.php'">

</form>
</body>
</html>
