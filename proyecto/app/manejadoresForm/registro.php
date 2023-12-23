<?php
include("../libs/bGeneral.php");
include("../libs/config.php");
//include('../libs/conexion.php');
include('../libs/consultas.php');
//include("../vistas/formRegistro.php");

$errores=[];
//variables para la subida de imágenes
/****
En la parte privada de la aplicación tenemos que bloquear para que no pueda entrar por la URL un usuario no logueado, lo hacemos
con sesiones
En el login inicializamos las variables y por ejemplo con $_SESSION["mail"]=$email; hacemos la comprobación
if(!isset($_SESSION["mail"]=$email){
header("location: -----A login o a inicio ------)



En la página de registro todavía no ha pasado por el login.
****/
/*
Estas variables es mejor ponerlas en una librería de configuración config.php
*/

//recogemos los datos del formulario
$nombre=recoge('nombre');
$mail=recoge('email');
/*
La foto no se recoge porque no llega a $_REQUEST
*/

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
$mensaje='Para activar su cuenta pulse en el siguiente enlace http://localhost/dwes/7S-Chimo/proyecto/app/public/activar_cuenta.php?token='.$token;
$sujeto='Activar cuenta';

/*
No es necesario comprobar si los campos son vacíos. Podemos hacerlo con las propias funciones de validación.
Los campos como radio, select o check hay que validar que traen un valor de los de la lista para evitar un posible ataque.
*/

/**
Antes de subir la foto comprobamos sino hay errores en los campos anteriores
La foto la validamos con la función cFile
**/

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
/**
        Comprobamos los posibles errores en la apertura y escritura de ficheros
**/




        if(registraUsuario($nombre,$mail,$pass,$fechaNac,$nombreFoto,$descripcion,$nivel,$activo,$errores)){
            $usuario=compruebaUsuarioDb($mail,$errores,$errores);
            $id=$usuario[0]['id_user'];
            insertaIdiomaUsuario($idioma,$id,$errores);
            insertaToken($token,$validez,$id,$errores);
            echo("Usuario registrado con éxito<br>");
            include('../libs/enviarCorreo.php');
            if(enviaCorreo($mail,$sujeto,$nombre,$mensaje)){
                echo("Se ha enviado un mensaje a su sorreo electrónico con en enlace para activar la cuenta<br>");
            }
        }else {
            $errores['usuario']="El usuario ya existe";
           //include("../vistas/formRegistro.php");
            foreach($errores as $error) {
                echo($error."<br>");
            }
        }
       /* $linea=$nombre.":".$pass.":".$mail.":".$fechaNac.":".$idioma.":".$descripcion.":".$nombreFoto.":".time().PHP_EOL;
        if($puntero=fopen("../ficheros/usuarios.txt", "a+")) {
            fwrite($puntero, $linea);
            fclose($puntero);
        }else{
            $errores['fichero']="Error en la apertura del fichero";
        }
        */
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
