<?php 
include('../DB/Conexion.php'); // Incluir conexion con base de datos

$sql = "SELECT * FROM usuarios_deudores";
$resultado = $conexion->prepare($sql);
$resultado->execute();
// $datos=$resultado->fetch(PDO::FETCH_ASSOC);


while ($Datos_deudores = $resultado->fetch()) {

    $json[] = array(
        'id' => $Datos_deudores['id'],
        'Nombre_Cliente' => $Datos_deudores['Nombre_Cliente'],
        'Mesa' => $Datos_deudores['Mesa'],
        'Pagado' => $Datos_deudores['Pagado'],
        'Pendiente' => $Datos_deudores['Pendiente'],
        'Fecha_Venta' => $Datos_deudores['Fecha_Venta'],
        'fvenci' => $Datos_deudores['Fecha_Vencimiento'],
        'usu_creado_id' => $Datos_deudores['Usuarios_Creados_id'],
        'BotonAbonar' => '<div class="btn-group" role="group" aria-label="Basic mixed styles example">
        <button type="button" name="Abonar" id="'.$Datos_deudores['id'].'" class="btn btn-warning btnAbonarPago">Abonar</button>
        <button type="button" name="borrar" id="'.$Datos_deudores['id'].'" class="btn btn-danger">Borrar</button>

        </div>'
      );
}

    
    

echo json_encode($json, JSON_UNESCAPED_UNICODE);
?>