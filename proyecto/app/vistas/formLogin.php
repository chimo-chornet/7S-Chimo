<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<h1>Acceso al área privada</h1>
<form action="../manejadoresForm/login.php" method="POST" enctype="multipart/form-data">
  Dirección E-mail: <input type="text" name="mail" value="<?=(isset($mail))? $mail:""?>"><br><br>
  Contraseña: <input type="password" name="loginPass"><br><br>
   Elija color de fondo:
  <input type="radio" name="colorFondo" id="beige" value="beige">Beige
  <input type="radio" name="colorFondo" id="white" value="white" checked>Blanco<br><br>
  <input type="submit" name="acceder" value="Acceder">
  <input type="button" name="salir" value=Salir onclick="location.href='../vistas/index.php'">
</form>
</body>
</html>