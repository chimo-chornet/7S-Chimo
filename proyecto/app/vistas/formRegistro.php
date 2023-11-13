<?php
include("../libs/bGeneral.php");
cabecera();

?>
<h1>Formulario de registro</h1>
<form action="" method="">
  Nombre completo: <input type="text" name="nombre" value=""><br><br>
  Dirección E-mail: <input type="email" name="email"><br><br>
  Cosntraseña: <input type="password" name="contrasenya"><br><br>
  Fecha nacimiento: <input type="date" name="nacimiento"><br><br>
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