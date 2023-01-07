<?php 
include('../DB/Conexion.php');

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$mesa = $_POST['mesa'];
$fechainicio = $_POST['inicio'];
$fechafinal = $_POST['final'];
$nota= $_POST['nota'];



$sql = "UPDATE usuarios_activos SET Nombre_Cliente='$nombre', Mesa='$mesa', Fecha_Venta='$fechainicio', Fecha_Vencimiento='$fechafinal', Nota='$nota' WHERE id='$id'";
$ejecutar = mysqli_query($conexion,$sql);

echo '
    <script>
    window.location ="../views/Vencidos.php";
    </script>
    ';

?>