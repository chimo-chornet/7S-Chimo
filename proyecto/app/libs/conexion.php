<?php
$db_hostname="localhost";
$db_nombre = "evaluable_7w";
$db_usuario = "chimo";
$db_clave = "@7RJwOyYLSfA0[H4";
$pdo=NEW PDO('mysql:host='.$db_hostname.';dbname='.$db_nombre.'',$db_usuario,$db_clave);
$pdo->exec("set names utf8");
    //Accionamos el uso de excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


?>