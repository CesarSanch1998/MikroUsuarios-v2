<?php 

include("../DB/Conexion.php");
// Obteniendo datos de inventario 
$id_tabla_deudores = $_POST['id_tabla_deudores'];
$sql = "SELECT * FROM usuarios_deudores  
INNER JOIN usuarios_creados ON usuarios_deudores.Usuarios_Creados_id = usuarios_creados.id_uc 
WHERE id = '$id_tabla_deudores'";

$resultado = $conexion->prepare($sql);
$resultado->execute();
// $datos=$resultado->fetch(PDO::FETCH_ASSOC);


  while($datos = $resultado->fetch()){
  
    $json[] = array( 
      'id' => $datos['id'],
      'Nombre_Cliente' => $datos['Nombre_Cliente'],
      'Mesa' => $datos['Mesa'],
      'Fecha_Venta' => $datos['Fecha_Venta'],
      'Pagado' => $datos['Pagado'],
      'Pendiente' => $datos['Pendiente'],
      'Usuarios_Creados_id' => $datos['Usuarios_Creados_id']
    );
  
}
echo json_encode($json, JSON_UNESCAPED_UNICODE);




?>