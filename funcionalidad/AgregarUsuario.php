<?php 
include('../DB/Conexion.php');

$nombre = $_POST['nombre'];
$mesa = $_POST['mesa'];
$perfiltiempo = $_POST['perfiltiempo'];
$usuario = $_POST['usuario'];
$contra = $_POST['contra'];
$fechainicio = $_POST['inicio'];
$fechafinal = $_POST['final'];
$tipo = $_POST['perfiltiempo'];
$nota= $_POST['nota'];
$fechaActual = date('Y/m/d');

//echo $nombre.$mesa.$perfiltiempo.$usuario.$contra.$fechainicio.$fechafinal.$nota;

$insertar_usuario_creados=mysqli_query($conexion,"INSERT INTO usuarios_creados(Usuario,Contraseña,Fecha_Creacion,Tipo) 
VALUE('$usuario','$contra','$fechaActual','$perfiltiempo')");

$consultar_id_usuario_creados=mysqli_query($conexion,"SELECT * FROM usuarios_creados WHERE Usuario='$usuario' AND Contraseña='$contra'");
$almacenar_id_usuario_creados = mysqli_fetch_array($consultar_id_usuario_creados);
$id_uscre = $almacenar_id_usuario_creados['id'];

$insertar_usuario_activo=mysqli_query($conexion,"INSERT INTO usuarios_activos(Nombre_Cliente,Mesa,Fecha_Venta,Fecha_Vencimiento,Nota,Usuarios_Creados_id)
VALUE('$nombre','$mesa','$fechainicio','$fechafinal','$nota','$id_uscre')");

if($tipo == "1s"){ //tipo de usuario semana 1$
    $insertar_usuario_deudor = mysqli_query($conexion,"INSERT INTO usuarios_deudores(Nombre_Cliente,Mesa,Pagado,Pendiente,Fecha_Venta,Fecha_Vencimiento,Usuarios_Creados_id ) 
    VALUES('$nombre','$mesa','0','1','$fechainicio','$fechafinal','$id_uscre')");
}else if($tipo=="1m"){ //tipo de usuario mensual 3$
    $insertar_usuario_deudor = mysqli_query($conexion,"INSERT INTO usuarios_deudores(Nombre_Cliente,Mesa,Pagado,Pendiente,Fecha_Venta,Fecha_Vencimiento,Usuarios_Creados_id ) 
VALUES('$nombre','$mesa','0','3','$fechainicio','$fechafinal','$id_uscre')");
}




if($conexion){
    echo '
    <script>
    window.location ="../views/Activos.php";
    </script>
    ';
}else{
    echo "ejecutada mal algo esta causando un problema  ";
}

?>