<?php
session_start();
include("../libs/bGeneral.php");
include("../libs/config.php");
$errores=[];
$fechaNac="";

//variables de sesión
/**
No es necesario volcar las variables de sesión en otras variables
Los mismos comentarios con respecto a confog.php, control de zona privada y la función cFile

**/
//recogida sanitizada de datos del formulario

$pass=recoge('contrasenya');
$idioma=recoge('idioma');
$descripcion=recoge('descripcion');


if($pass==""){
    $errores['password']="Debe introducir una constraseña";
}
if($idioma==""){
    $errores['idioma']="Debe introducir un idioma prederido";
}


if ($_FILES['foto']['name']=="") {
    $nombreFoto='Sin imagen';

   } else {
    $nombreFoto=cFile('foto', $errores, $extensionesValidas, $dir, $max_file_size);
}
if($nombreFoto==false){
    echo("FALSO".$nombreFoto);

    $errores['foto']="error al cargar la fotografía";
}
  //si no hay errores en la validación de los datos guardamos las modificaciones en el fichero


    if(empty($errores)) {
        $todo=file_get_contents("../ficheros/usuarios.txt","r");
        $lineas=explode(PHP_EOL,$todo);
        $clave=0;
        $a=0;
        foreach($lineas as $linea) {
          if($linea!="") {
            $separados=explode(":", $linea);
            if($separados[2]==$_SESSION['mail']&&$separados[1]==$_SESSION['password']) {
                $fechaNac=$separados[3];
                $clave=$a;
            } else {
                $a++;
            }
         }
        }
        if(!isset($_FILES['foto'])){
            $nuevalinea=$_SESSION['usuario'].":".$pass.":".$_SESSION['mail'].":".$fechaNac.":".$idioma.":".$descripcion.":Sin imagen:".time();
        }else{
            $nuevalinea=$_SESSION['usuario'].":".$pass.":".$_SESSION['mail'].":".$fechaNac.":".$idioma.":".$descripcion.":".$nombreFoto.":".time();
        }
        $lineas[$clave]=$nuevalinea;

        $nuevoTodo=implode(PHP_EOL,$lineas);
        file_put_contents("../ficheros/usuarios.txt",$nuevoTodo);


        header("location:../vistas/privado.php");

    } else {
        //si hay errores los mostramos
        header("location:../vistas/privado.php");
        foreach($errores as $error) {
            echo($error."<br>");
        }
    }






?>
