<?php
include('../DB/Conexion.php');

$id_usu_creados = $_POST['id_usu_creado'];
$nombre = $_POST['nombre'];
$mesa = $_POST['mesa'];
$monto = $_POST['monto'];



$sql_verificacion = "SELECT * FROM usuarios_deudores WHERE Usuarios_Creados_id='$id_usu_creados'";
$verificacion_ejecucion = mysqli_query($conexion, $sql_verificacion);
$almacenar_datos_verificacion = mysqli_fetch_array($verificacion_ejecucion);
$dinero_pendiente = $almacenar_datos_verificacion['Pendiente'];


if ($monto > $dinero_pendiente) {

    //echo "monto superior";
} else if ($monto <= $dinero_pendiente) {

    $sql_insertar = "UPDATE usuarios_deudores SET  Pagado=Pagado +'$monto', Pendiente=Pendiente -'$monto' WHERE Usuarios_Creados_id='$id_usu_creados' ";
    $insertar_ejecucion = mysqli_query($conexion, $sql_insertar);

        echo "ejecutado";
    

   
}



