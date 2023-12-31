
<form action="../manejadoresForm/eliminaIdioma.php" method="POST">
  <label>Idioma: </label>
  <?php
  include_once('../libs/consultas.php');
  include_once('../libs/bComponentes.php');
    $errores=[];
    $valor=listaIdiomas($errores);
    $valores=[];
    foreach($valor as $linea){
        $valores[$linea['id_idioma']]=$linea['idioma'];
    }
    pintaSelect($valores,'idioma')
    ?>
  <input type="submit" name="enviar" value="Eliminar idioma">
  </form>