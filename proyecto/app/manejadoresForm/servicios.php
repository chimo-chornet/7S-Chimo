<?php
session_start();
include("../libs/bGeneral.php");
include("../libs/config.php");
include('../libs/consultas.php');
$errores=[];
//si el usuario no está logeado no puede acceder

if($_SESSION['nivel']<1){
    header("location:../manejadoresForm/cierra.php");
    }
    if(time()-($_SESSION['acceso'])>3600 || $_SESSION['ip']!=$_SERVER['REMOTE_ADDR']){
        echo("La sesión se cerrará");
        header("location:../manejadoresForm/cierra.php");
    }else{
        $_SESSION['acceso']=time();
    }
    //Si existe la cookie la recogemos y sanitizamos. Después la usamos para el color del fondo.

    if(isset($_COOKIE["galletacolor"])){
        $color=$_COOKIE["galletacolor"];
    //establecemos el color de fondo traido por la cookie
echo("<Style>body{background-color:$color}</style>");
    }

//recogida sanitizada de datos del formulario

$titulo=recoge('titulo');
$categoria=recoge('categoria');
$descripcion=recoge('descripcion');
$tipo=recoge('tipo');
$precio=recoge('precio');
$disponibilidad=recogeArray('disponibilidad');

//comprobamos que son correctos y en caso contrario generamos los mensajes de error

    cTexto($titulo,'titulo',$errores);
    cTexto($descripcion,'descripcion',$errores,50,1);
    cNum($precio,'precio',$errores);
    $valTipo=['0','1'];
    cRadio($tipo,'tipo',$errores,$valTipo);
    $valores=[];
    $val=valoresDisponibilidad($errores);
    foreach($val as $clave=>$valor){
        $valores[]=$clave;
    }
    cCheck($disponibilidad,'disponibilidad',$errores,$valores);


if($_FILES['fotoServicio']['name']==""){
    $nombreCompleto="Sin imagen";
}else{
if (($nombreCompleto=cFile('fotoServicio', $errores, $extensionesValidas, $dir, $max_file_size)) ==false) {
    $nombreCompleto='Sin imagen';
}
}
//si no hay errores en la validación de los datos guardamos las modificaciones en el fichero

if(empty($errores)) {

    $idServicio=registraServicio($titulo,$_SESSION['id_usuario'],$descripcion,$precio,$tipo,$nombreCompleto,$errores);
    foreach($errores as $error) {
        echo($error."<br>");
    }

    foreach($disponibilidad as $disp){
        insertaDisponibilidadServicio($idServicio,$disp);
    }
    header("location:../vistas/privado.php");
} else {
//si hay errores los mostramos
    foreach($errores as $error) {

        echo($error."<br>");
    }
    include("../vistas/formServicio.php");
}
?>