<?php
session_start();
include("../libs/bGeneral.php");
$errores=[];
$fechaNac="";
$extensionesValidas=['jpg','png','gif'];
$max_file_size='5000000';
$dir="../ficheros/fotos";
$nombre=$_SESSION['usuario'];
$mail=$_SESSION['mail'];
$password=$_SESSION['password'];
$foto=recoge('foto');
$pass=recoge('contrasenya');
$idioma=recoge('idioma');
$descripcion=recoge('descripcion');


if($pass==""){
    $errores['password']="Debe introducir una constraseña";
}
if($idioma==""){
    $errores['idioma']="Debe introducir un idioma prederido";
}


if ($_FILES['foto']['name'] =="") {
    $nombreCompleto='Sin imagen';
    //$errores["imagen"] = "No hay imagen";
} else {

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
    if(empty($errores)) {
        $todo=file_get_contents("../ficheros/usuarios.txt","r");
        $lineas=explode(PHP_EOL,$todo);
        $clave=0;
        $a=0;
        foreach($lineas as $linea){
        $separados=explode(":",$linea);
            if($separados[2]==$mail&&$separados[1]==$password){
                $fechaNac=$separados[3];
                $clave=$a;
            }else{
                $a++;

            }
        }

        if(!isset($_FILES['foto'])){
            $nuevalinea=$nombre.":".$pass.":".$mail.":".$fechaNac.":".$idioma.":".$descripcion.":Sin imagen:".time();
        }else{
            $nuevalinea=$nombre.":".$pass.":".$mail.":".$fechaNac.":".$idioma.":".$descripcion.":".$nombreCompleto.":".time();
        }
        $lineas[$clave]=$nuevalinea;

        $nuevoTodo=implode(PHP_EOL,$lineas);
        file_put_contents("../ficheros/usuarios.txt",$nuevoTodo);





        header("location:../vistas/privado.php");

    } else {
        header("location:../vistas/privado.php");
        foreach($errores as $error) {
            //include("../vistas/formRegistro.php");
            echo($error."<br>");
        }
    }






?>