<?php
//Mecanismo de cierre de sesión en una hora después del último accesso
if(isset($_SESSION['acceso'])){
if(time()-($_SESSION['acceso'])>3600){
  echo("La sesión se cerrará");
  header("location:../manejadoresForm/cierra.php");
}
}


?>
<h1>Formulario de registro</h1>
<form action="../manejadoresForm/registro.php" method="POST" enctype="multipart/form-data">
  Nombre completo: <input type="text" name="nombre" value="<?=(isset($nombre))? $nombre:""?>"><br><br>
  Dirección E-mail: <input type="email" name="email" value="<?=(isset($mail))? $mail:""?>"><br><br>
  Contraseña: <input type="password" name="contrasenya"><br><br>
  Fecha nacimiento (aaaa-mm-dd): <input type="text" name="nacimiento" value="<?=(isset($fechaNac))? $fechaNac:""?>"><br><br>
  Foto del perfil: <input type="file" name="foto"><br><br>
  Idioma preferente: <select name="idioma" id="" multiple >
   <option value="esp" selected>Español</option>
    <option value="eng">Inglés</option>
  </select><br><br>
  Descripción personal:<br><textarea name="descripcion" id="" cols="30" rows="10" ><?=(isset($descripcion))? $descripcion:""?></textarea><br><br>
  <input type="submit" name="enviar" value="Alta usario">
  <input type="reset" name="salir" value="Cancelar y salir" onclick="location.href='../vistas/index.php'">
</form>
