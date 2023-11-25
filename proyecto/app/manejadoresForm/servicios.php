<?php

include("../libs/bGeneral.php");
include("../libs/config.php");
$errores=[];
//si el usuario no está logeado no puede acceder
if(!isset($_SESSION["usuario"])) {
    echo("Esta zona es exculsiva para usuarios logueados");
}

//recogida sanitizada de datos del formulario

$titulo=recoge('titulo');
$categoria=recoge('categoria');
$descripcion=recoge('descripcion');
$tipo=recoge('tipo');
$precio=recoge('precio');
$ubicacion=recoge('ubicacion');
$disponibilidad=recogeArray('disponibilidad');

//comprobamos que son correctos y en caso contrario generamos los mensajes de error


    cTexto($titulo,'titulo',$errores);
    cTexto($descripcion,'descripcion',$errores,50,1);
    cNum($precio,'precio',$errores);
    $valTipo=['Pago','Intercambio'];
    cRadio($tipo,'tipo',$errores,$valTipo);
    $valores=['Mañanas','Tardes','Completo','FinesSemana'];
    cCheck($disponibilidad,'disponibilidad',$errores,$valores);
    cTexto($ubicacion,'ubicacion',$errores);

if($_FILES['fotoServicio']['name']==""){
    $nombreCompleto="Sin imagen";
}else{
if (($nombreCompleto=cFile('fotoServicio', $errores, $extensionesValidas, $dir, $max_file_size)) ==false) {
    $nombreCompleto='Sin imagen';
}
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