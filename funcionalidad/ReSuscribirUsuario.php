<?php 
include('../DB/Conexion.php');

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$mesa = $_POST['mesa'];
$fechainicio = $_POST['inicio'];
$fechafinal = $_POST['final'];
$nota= $_POST['nota'];
$tipo = $_POST['tipo'];
$fechaActual = date('Y/m/d');


$sql = "UPDATE usuarios_activos SET Nombre_Cliente='$nombre', Mesa='$mesa', Fecha_Venta='$fechainicio', Fecha_Vencimiento='$fechafinal', Nota='$nota' WHERE id='$id'";
$ejecutar = mysqli_query($conexion,$sql);

$sql_consulta = "SELECT * FROM usuarios_activos WHERE id='$id'";
$ejecutar2 = mysqli_query($conexion,$sql_consulta);
$obtener_Datos = mysqli_fetch_array($ejecutar2);

$Usuarios_Creados_id= $obtener_Datos['Usuarios_Creados_id']; 

if($tipo == "1s"){
 $sql2 = "UPDATE usuarios_deudores SET Pendiente= 1, Pagado= 0 WHERE Usuarios_Creados_id ='$Usuarios_Creados_id'";
 $ejecutar = mysqli_query($conexion,$sql2);

}else if($tipo == "1m"){
    $sql2 = "UPDATE usuarios_deudores SET Pendiente= 3, Pagado= 0 WHERE Usuarios_Creados_id ='$Usuarios_Creados_id'";
    $ejecutar = mysqli_query($conexion,$sql2);
}



if($ejecutar){
    echo '
    <script>
    window.location ="../views/Vencidos.php";
    </script>
    ';
}else{
    echo '<script>alert("Problemas al ejecutar script");</script>';
    echo '
    <script>
    window.location ="../views/Vencidos.php";
    </script>
    ';
}




?>