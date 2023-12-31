

<form action="../manejadoresForm/eliminaDisponibilidad.php" method="POST">
  <label>Disponibilidad: </label>
  <?php
  include_once('../libs/consultas.php');
  include_once('../libs/bComponentes.php');
    $errores=[];
    $valor= ($errores);
    $valores=valoresDisponibilidad($errores);
    foreach($valor as $linea){
        $valores[$linea['id_disponibilidad']]=$linea['disponibilidad'];
    }
    pintaSelect($valores,'disponibilidad')
    ?>
  <input type="submit" name="enviar" value="Eliminar disponibilidad">
  </form>