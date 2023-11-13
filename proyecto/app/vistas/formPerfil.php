<?php
include("../libs/bGeneral.php");
cabecera();

?>
<h1>Perfil de usuario</h1>
<form action="" method="">

  Contraseña: <input type="password" name="contrasenya"><br><br>
  Foto del perfil: <input type="file" name="foto"><br><br>
  Idioma preferente: <select name="idioma" id="Idioma">
   <option value="esp">Español</option>
    <option value="eng">Inglés</option>
  </select><br><br>
  Descripción personal:<br><textarea name="personal" id="" cols="30" rows="10"></textarea>
</form>
<?php
pie();
?>