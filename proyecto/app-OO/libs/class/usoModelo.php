<?php

require ('classEmpleado.php');
require ('classLocalidad.php');

try {
    
    $db = new empleado();
    if ($Arrayresultado = $db->getEmpleado(18)) {
        print_r($Arrayresultado);
        echo"<br>";
        echo"<br>";
    } else{
        echo"<br>";
        echo "No hay nada que mostrar";
        echo"<br>";
    }
        $db = new localidad();
        if ($Arrayresultado = $db->getLocalidad(1)) {
            echo"<br>";
            print_r($Arrayresultado);
            echo"<br>";
            
        } else{
            echo"<br>";
            echo "No hay nada que mostrar";
            echo"<br>";
    }       
} 
catch (PDOException $e) {

    // Usar error_log para guardar errores para el administrador
    // Para realizar esta acción sería conveniente crear una clase para manejar el archivo log
    error_log($e->getMessage() . "## Fichero: " . $e->getFile()  .
        "##Código: " . $e->getCode() . "##Instante: " . microtime() . PHP_EOL, 3, "logBD.txt");
    // guardamos en ·errores el error que queremos mostrar a los usuarios
    $errores['datos'] = "Ha habido un error <br>";
} catch (Error $e) {

    error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logerr.txt");
    // echo $e->getMessage();
}
/**
 * Mostramos los errores si tenemos (hemos entrado en catch)
 */
if (isset($errores))
print_r($errores);


?>