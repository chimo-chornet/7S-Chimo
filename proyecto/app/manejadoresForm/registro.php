<?php
include("../libs/bGeneral.php");
include("../libs/config.php");
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

$pass=recoge('contrasenya');
$fechaNac=fechaCorrecta(recoge('nacimiento'),$errores);
$idioma=recoge('idioma');
$descripcion=recoge('descripcion');
//comprobamos que son correctos y en caso contrario generamos los mensajes de error
cTexto($nombre,'Nombre',$errores);
cTexto($descripcion,'Descripcion',$errores);
$valores=['esp','eng'];
cRadio($idioma,'idioma',$errores,$valores);
cPassword($pass,$errores,'password',4);

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

        echo("Usuario registrado con éxito<br>");
        $linea=$nombre.":".$pass.":".$mail.":".$fechaNac.":".$idioma.":".$descripcion.":".$nombreFoto.":".time().PHP_EOL;
        if($puntero=fopen("../ficheros/usuarios.txt", "a+")) {
            fwrite($puntero, $linea);
            fclose($puntero);
        }else{
            $errores['fichero']="Error en la apertura del fichero";
        }
?>
        <form action="../vistas/index.php" method="">
    <input type="submit" name="salir" value="Volver a la página principal">
</form>
<?php
//si hay errores los mostramos
    } else {
        include("../vistas/formRegistro.php");
        foreach($errores as $error) {
                        echo($error."<br>");
        }
    }

?>
