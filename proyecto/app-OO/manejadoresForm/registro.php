<?php
include("../libs/bGeneral.php");
include("../libs/config.php");
include('../libs/consultas.php');

$errores=[];

//recogemos los datos del formulario
$nombre=recoge('nombre');
$mail=recoge('email');
$passw=recoge('contrasenya');
$fechaNac=fechaCorrecta(recoge('nacimiento'),$errores);
$idioma=recoge('idioma');
$descripcion=recoge('descripcion');
//comprobamos que son correctos y en caso contrario generamos los mensajes de error
cTexto($nombre,'Nombre',$errores);
cTexto($descripcion,'Descripcion',$errores);
compruebaIdiomas($idioma,$errores);
cPassword($passw,$errores,'password',4);
$pass=encriptar($passw);
$nivel=1;
$activo=0;
$token=bin2hex(openssl_random_pseudo_bytes(64));
$validez=time()+(3600*24);
$mensaje='Para activar su cuenta pulse en el siguiente enlace http://localhost/dwes/7S-Chimo/proyecto/app-OO/public/activar_cuenta.php?token='.$token;
$sujeto='Activar cuenta';


if ($_FILES['foto']['name'] =="") {
    $nombreFoto='Sin imagen';

} else {
    //si todo es correcto subimos la imágen

    if(($nombreFoto=cFile('foto',$errores,$extensionesValidas,$dir,$max_file_size))==false){
        $errores['foto']="Error en la subida de la fotografía";
    }

    /**
    * Si hay errores volvemos a mostrar el formulario con los errores
    */

}
 //si no hay errores en la validación de los datos guardamos las mofdificaciones en el fichero

    if(empty($errores)) {

include('../libs/class/classUsuario.php');
$nuevoUsuario=new Usuario;


        if($nuevoUsuario->registraUsuario($nombre,$mail,$pass,$fechaNac,$nombreFoto,$descripcion,$nivel,$activo,$errores)){
           // $usuario=compruebaUsuarioDb($mail,$errores);
            $id=$nuevoUsuario->getUserId($mail);
            $nuevoUsuario->insertaIdiomaUsuario($idioma,$id,$errores);
            $nuevoUsuario->insertaToken($token,$validez,$id,$errores);
            echo("Usuario registrado con éxito<br>");
            include('../libs/enviarCorreo.php');
            if(enviaCorreo($mail,$sujeto,$nombre,$mensaje)){
                echo("Se ha enviado un mensaje a su sorreo electrónico con en enlace para activar la cuenta<br>");
            }
        }else {
            $errores['usuario']="El usuario ya existe";
           echo("<br>");
            foreach($errores as $error) {
                echo($error."<br>");
            }
            include("../vistas/formRegistro.php");

        }

?>
        <form action="../vistas/index.php" method="">
    <input type="submit" name="salir" value="Volver a la página principal">
</form>
<?php
//si hay errores los mostramos
    } else {
         foreach($errores as $error) {
            echo($error."<br>");
        }
        include("../vistas/formRegistro.php");
    }


?>
