<h1>Formulario de registro</h1>
<form action="../manejadoresForm/registro.php" method="POST" enctype="multipart/form-data">

  Dirección E-mail: <input type="email" name="email" value="<?=(isset($mail))? $mail:""?>"><br><br>
  Contraseña: <input type="password" name="contrasenya"><br><br>
  Foto del perfil: <input type="file" name="foto"><br><br>
  Idioma preferente: <select name="idioma" id="" >
   <option value="esp" selected>Español</option>
    <option value="eng">Inglés</option>
  </select><br><br>
  Descripción personal:<br><textarea name="descripcion" id="" cols="30" rows="10" ><?=(isset($descripcion))? $descripcion:""?></textarea><br><br>
  <input type="submit" name="enviar" value="Alta usario">
  <input type="reset" name="salir" value="Cancelar y salir" onclick="location.href='../vistas/index.php'">
</form>