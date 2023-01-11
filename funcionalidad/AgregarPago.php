<?php
include('../DB/Conexion.php');


$id = $_POST['id'];

$monto = $_POST['monto'];




$sql_verificacion = "SELECT * FROM usuarios_deudores WHERE id='$id'";
$verificacion_ejecucion = mysqli_query($conexion, $sql_verificacion);
$almacenar_datos_verificacion = mysqli_fetch_array($verificacion_ejecucion);
$dinero_pendiente = $almacenar_datos_verificacion['Pendiente'];


if ($monto > $dinero_pendiente) {

    echo '<script>alert("Monto Superior");</script>';
    echo '
    <script>
    window.location ="../views/Deudores.php";
    </script>
    ';
} else if ($monto <= $dinero_pendiente) {

    $sql_insertar = "UPDATE usuarios_deudores SET  Pagado=Pagado +'$monto', Pendiente=Pendiente -'$monto' WHERE id='$id' ";
    $insertar_ejecucion = mysqli_query($conexion, $sql_insertar);

    echo '
    <script>
    window.location ="../views/Deudores.php";
    </script>
    ';



}



?>