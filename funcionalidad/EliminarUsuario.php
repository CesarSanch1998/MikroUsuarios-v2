<?php 
include('../DB/Conexion.php');

$id=$_POST['id'];
$nombre=$_POST['Nombre'];

$sql = "DELETE FROM usuarios_activos WHERE Usuarios_Creados_id ='$id' AND Nombre_Cliente='$nombre'";
$ejecutar_eliminar=mysqli_query($conexion,$sql);

$sql3 = "DELETE FROM usuarios_deudores WHERE Usuarios_Creados_id ='$id' AND Nombre_Cliente='$nombre'";
$ejecutar_eliminar3=mysqli_query($conexion,$sql3);

$sql2 = "DELETE FROM usuarios_creados WHERE id ='$id'";
$ejecutar_eliminar2=mysqli_query($conexion,$sql2);




if($ejecutar_eliminar == true && $ejecutar_eliminar2 == true && $ejecutar_eliminar3 == true){
echo "ejecutado";
echo mysqli_error($conexion);
}else{
echo "no ejecutado";
echo mysqli_error($conexion);
}


?>