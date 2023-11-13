<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>


<h1>Acceso al área privada</h1>
<form action="../manejadoresForm/login.php" method="post">
  Usuario: <input type="text" name="usuario" value="<?=(isset($usuario))? $usuario:""?>"><br><br>
  Contraseña: <input type="password" name="loginPass"><br><br>
  <input type="submit" name="acceder" value="Acceder">
  <input type="button" name="salir" value=Salir onclick="location.href='../vistas/index.php'">


</form>
</body>
</html>