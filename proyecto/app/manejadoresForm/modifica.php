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

$passw=recoge('contrasenya');
$idioma=recoge('idioma');
$descripcion=recoge('descripcion');

cTexto($descripcion,'Descripcion',$errores,300);
include_once('../libs/consultas.php');
compruebaIdiomas($idioma,$errores);
cPassword($passw,$errores,'password',4);

$pass=encriptar($passw);

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
        include_once('../libs/consultas.php');
        modificaUsuario($_SESSION['id_usuario'],$pass,$nombreFoto,$descripcion,$idioma,$errores);
        /*
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
        $_SESSION['imagen']=$nombreFoto;
        $_SESSION['descripcion']=$descripcion;
        $_SESSION['idioma']=$idioma;
        */
        header("location:../vistas/privado.php");

    } else {
        //si hay errores los mostramos
       // header("location:../vistas/privado.php");
        foreach($errores as $error) {
            echo($error."<br>");
        }
    }






?>
