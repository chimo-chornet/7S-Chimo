<?php
session_start();
include("../libs/bGeneral.php");
include("../libs/config.php");
$errores=[];
$fechaNac="";

//recogida sanitizada de datos del formulario

$passw=recoge('contrasenya');
$idioma=recoge('idioma');
$descripcion=recoge('descripcion');
cTexto($descripcion,'Descripcion',$errores,300);
include_once('../libs/consultas.php');
compruebaIdiomas($idioma,$errores);
cPassword($passw,$errores,'password',4);
$pass=encriptar($passw);
if(empty($errores)) {
    if ($_FILES['foto']['name']=="") {
        $nombreFoto='Sin imagen';

    } else {
        $nombreFoto=cFile('foto', $errores, $extensionesValidas, $dir, $max_file_size);
    }
    if($nombreFoto==false) {
        echo("FALSO".$nombreFoto);

        $errores['foto']="error al cargar la fotografía";
    }
}
  //si no hay errores en la validación de los datos guardamos las modificaciones en la base de datos


    if(empty($errores)) {
        include_once('../libs/consultas.php');
        modificaUsuario($_SESSION['id_usuario'],$pass,$nombreFoto,$descripcion,$idioma,$errores);

        header("location:../vistas/privado.php");

    } else {
        //si hay errores los mostramos
       // header("location:../vistas/privado.php");
        foreach($errores as $error) {
            echo($error."<br>");
        }
    }






?>
