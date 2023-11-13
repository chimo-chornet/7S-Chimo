<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>


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