<?php
include('../DB/Conexion.php');

$id_tabla_deudores = $_POST['id_tabla_deudores'];
// $nombre = $_POST['nombre'];
// $mesa = $_POST['mesa'];
$monto = $_POST['Monto'];
$sql = "SELECT * FROM usuarios_deudores WHERE id = '$id_tabla_deudores'";

$resultado = $conexion->prepare($sql);
$resultado->execute();
$datos = $resultado->fetch();

$MontoPagadoActual = $datos['Pagado'];
$MontoPendienteActual = $datos['Pendiente'];

$MontoPagadoFinal = $MontoPagadoActual + $monto;
$MontoPendienteFinal = $MontoPendienteActual - $monto;

//Agrega el usuario resuscrito en la tabla de usuarios activos -----------------------------------
$sql2 = "UPDATE usuarios_deudores SET Pagado = '$MontoPagadoFinal', Pendiente = '$MontoPendienteFinal' WHERE id  = '$id_tabla_deudores'";
$ejecutar = $conexion->prepare($sql2);



// Excecute
if ($ejecutar->execute()) {

    $json[] = array(
        'Resultado' => 'Ejecutado',
    );

    echo json_encode($json, JSON_UNESCAPED_UNICODE);
    VerificarUsuarioConDeudas($id_tabla_deudores);
    // var_dump($MontoPagadoFinal) ;


} else {
    $json[] = array(
        'Resultado' => 'Error',
    );

    echo json_encode($json, JSON_UNESCAPED_UNICODE);
    // print_r($conexion->errorInfo());
}

function VerificarUsuarioConDeudas($id_tabla_deudores)
{
    include('../DB/Conexion.php');
    $sql = "SELECT * FROM usuarios_deudores WHERE id = '$id_tabla_deudores'";

    $resultado = $conexion->prepare($sql);
    $resultado->execute();
    $datos = $resultado->fetch();
    
    $VerificarPendientes = $datos['Pendiente'];

    if ($VerificarPendientes <= 0) {

        $sql2 = "DELETE FROM usuarios_deudores WHERE id = $id_tabla_deudores";
        $resultado2 = $conexion->prepare($sql2);
        $resultado2->execute();
    }
}
