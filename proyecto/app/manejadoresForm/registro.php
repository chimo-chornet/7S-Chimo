<?php
include("../libs/bGeneral.php");
//include("../vistas/formRegistro.php");

$errores=[];
//variables para la subida de imágenes
/****
En la parte privada de la aplicación tenemos que bloquear para que no pueda entrar por la URL un usuario no logueado, lo hacemos
con sesiones
En el login inicializamos las variables y por ejemplo con $_SESSION["mail"]=$email; hacemos la comprobación
if(!isset($_SESSION["mail"]=$email){
header("location: -----A login o a inicio ------)
****/
/*
Estas variables es mejor ponerlas en una librería de configuración config.php
*/

$extensionesValidas=['jpg','png','gif'];
$max_file_size='5000000';
$dir="../ficheros/fotos";
//recogemos los datos del formulario
$nombre=recoge('nombre');
$mail=recoge('email');
/*
La foto no se recoge porque no llega a $_REQUEST
*/
$foto=recoge('foto');
$pass=recoge('contrasenya');
$fechaNac=fechaCorrecta(recoge('nacimiento'),$errores);
$idioma=recoge('idioma');
$descripcion=recoge('descripcion');
//comprobamos que son correctos y en caso contrario generamos los mensajes de error
cTexto($nombre,'Nombre',$errores);
/*
No es necesario comprobar si los campos son vacíos. Podemos hacerlo con las propias funciones de validación.
Los campos como radio, select o check hay que validar que traen un valor de los de la lista para evitar un posible ataque.
*/
if($nombre==""){
    $errores['nombre']="Debe introducir un nombre";
}
if($mail==""){
    $errores['email']="Debe introducir una dirección de correo electrónico";
    }
    if($pass==""){
        $errores['password']="Debe introducir una constraseña";
    }
if($fechaNac==""){
    $errores['fecha']="Debe introducir una fecha";
}
if($fechaNac>'2005-11-13'){
    $errores['fecha']="Solo se pueden registrar personas mayores de 18 años";
}
if($idioma==""){
    $errores['idioma']="Debe introducir un idioma prederido";
}
/**
Antes de subir la foto comprobamos sino hay errores en los campos anteriores
La foto la validamos con la función cFile
**/

if ($_FILES['foto']['name'] =="") {
    $nombreCompleto='Sin imagen';

} else {
//si todo es correcto subimos la imágen
    if (($_FILES['foto']['error'] != 0)) {
        switch ($_FILES['foto']['error']) {
            case 1:
                $errores["imagen"] = "UPLOAD_ERR_INI_SIZE. Fichero demasiado grande";
                break;
            case 2:
                $errores["imagen"] = "UPLOAD_ERR_FORM_SIZE. El fichero es demasiado grande";
                break;
            case 3:
                $errores["imagen"] = "UPLOAD_ERR_PARTIAL. El fichero no se ha podido subir entero";
                break;
            case 4:
                $errores["imagen"] = "UPLOAD_ERR_NO_FILE. No se ha podido subir el fichero";

                break;
            case 6:
                $errores["imagen"] = "UPLOAD_ERR_NO_TMP_DIR. Falta carpeta temporal<br>";
                // no break
            case 7:
                $errores["imagen"] = "UPLOAD_ERR_CANT_WRITE. No se ha podido escribir en el disco<br>";

                // no break
            default:
                $errores["imagen"] = 'Error indeterminado.';
        }
    } else {
        /**
         * Guardamos el nombre original del fichero
         **/
        $nombreArchivo = $_FILES['foto']['name'];
        /*
         * Guardamos nombre del fichero en el servidor
        */
        $directorioTemp = $_FILES['foto']['tmp_name'];
        /*
         * Calculamos el tamaño del fichero
        */
        $tamanyoFile = filesize($directorioTemp);
        /*
        * Extraemos la extensión del fichero, desde el último punto. Si hubiese doble extensión, no lo
        * tendría en cuenta.
        */
        $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));

        /*
        * Comprobamos la extensión del archivo dentro de la lista que hemos definido al principio
        */
        if (!in_array($extension, $extensionesValidas)) {
            $errores["imagen"] = "La extensión del archivo no es válida";
        }
        /*
        * Comprobamos el tamaño del archivo
        */
        if ($tamanyoFile > $max_file_size) {
            $errores["imagen"] = "La imagen debe de tener un tamaño inferior a 50 kb";
        }

        /*
        * Si no ha habido errores, almacenamos el archivo en ubicación definitiva si no hay errores
        */
        if (empty($errores)) {
            /**
             * Tenemos que buscar un nombre único para guardar el fichero de manera definitiva
             * Añadimos microtime() al nombre del fichero si ya existe un archivo guardado con ese nombre.
             * */
            $nombreArchivo = is_file($dir . DIRECTORY_SEPARATOR . $nombreArchivo) ? time() . $nombreArchivo : $nombreArchivo;
            $nombreCompleto = $dir . DIRECTORY_SEPARATOR . $nombreArchivo;
            /**
             * Movemos el fichero a la ubicación definitiva.
             * */
            if (move_uploaded_file($directorioTemp, $nombreCompleto)) {
                //echo "<br> El fichero \"$nombreCompleto\" ha sido guardado";
            } else {
                $errores["imagen"]= "Ha habido un error al subir el fichero";
            }
        }
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
        $linea=$nombre.":".$pass.":".$mail.":".$fechaNac.":".$idioma.":".$descripcion.":".$nombreCompleto.":".time().PHP_EOL;
        $puntero=fopen("../ficheros/usuarios.txt", "a+");
        fwrite($puntero, $linea);
        fclose($puntero);?>
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
