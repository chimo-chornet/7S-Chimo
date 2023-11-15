<?php
include("../libs/bGeneral.php");
$errores=[];

//variables para la subida de imágenes

$extensionesValidas=['jpg','png','gif'];
$max_file_size='5000000';
$dir="../ficheros/fotos";

//recogida sanitizada de datos del formulario

$titulo=recoge('titulo');
$categoria=recoge('categoria');
$descripcion=recoge('descripcion');
$tipo=recoge('tipo');
$precio=recoge('precio');
$ubicacion=recoge('ubicacion');
if(empty($_REQUEST['disponibilidad'])){

    $errores['disponibilidad']="Debe seleccionar al menos una opción de disponibilidad";
}else{
    $disponibilidad=$_REQUEST['disponibilidad'];
}
    $fotoServicio=recoge("fotoServicio");
$valores=['Mañanas','Tardes','Completo','FinesSemana'];

//comprobamos que son correctos y en caso contrario generamos los mensajes de error

if($titulo==""){
    $errores['titulo']="Debe introducir un título para el servicio";
}else{
    cTexto($titulo,'titulo',$errores);
}
if($categoria==""){
    $errores['categoria']="Debe seleccionar una categoría para el servicio";
}
if($descripcion==""){
    $errores['descripcion']="Debe escribir una descripción detallada del servicio";
}
if($ubicacion==""){
    $errores['ubicacion']="Debe señalar la ubicación donde se desarrolla el servicio";
}
if($tipo==""){
    $errores['tipo']="Debe indicar el tipo de servicio";
}


if ($_FILES['fotoServicio']['name'] =="") {
    $nombreCompleto='Sin imagen';
} else {

//si todo es correcto subimos la imágen

    if (($_FILES['fotoServicio']['error'] != 0)) {
        switch ($_FILES['fotoServicio']['error']) {
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
                break;
            case 7:
                $errores["imagen"] = "UPLOAD_ERR_CANT_WRITE. No se ha podido escribir en el disco<br>";

                break;
            default:
                $errores["imagen"] = 'Error indeterminado.';
        }
    } else {
        /**
         * Guardamos el nombre original del fichero
         **/
        $nombreArchivo = $_FILES['fotoServicio']['name'];
        /*
         * Guardamos nombre del fichero en el servidor
        */
        $directorioTemp = $_FILES['fotoServicio']['tmp_name'];
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


    $disponible="";
    foreach($disponibilidad as $disp){
        $disponible=$disponible."-".$disp."-";
    }
    $linea=$titulo.":".$categoria.":".$descripcion.":".$tipo.":".$precio.":".$ubicacion.":".$nombreCompleto.":".$disponible.":".time().PHP_EOL;
    $puntero=fopen("../ficheros/servicios.txt", "a+");
    fwrite($puntero, $linea);
    fclose($puntero);
    header("location:../vistas/privado.php");
//si hay errores los mostramos
} else {
    include("../vistas/formServicio.php");
    foreach($errores as $error) {

        echo($error."<br>");
    }
}
?>