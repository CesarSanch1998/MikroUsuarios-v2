<?php 

include("../DB/Conexion.php");
// Obteniendo datos de inventario 
$id_Usuario = $_POST['id_Usuario'];
$sql = "SELECT * FROM usuarios_vencidos  
INNER JOIN usuarios_creados ON usuarios_vencidos.Usuarios_Creados_id = usuarios_creados.id_uc 
WHERE id = '$id_Usuario'";

$resultado = $conexion->prepare($sql);
$resultado->execute();
// $datos=$resultado->fetch(PDO::FETCH_ASSOC);


  while($datos = $resultado->fetch()){
  
    $json[] = array( 
      'id' => $datos['id'],
      'Nombre_Cliente' => $datos['Nombre_Cliente'],
      'Mesa' => $datos['Mesa'],
      'Fecha_Venta' => $datos['Fecha_Venta'],
      'Fecha_Vencimiento' => $datos['Fecha_Vencimiento'],
      'Tipo' => $datos['Tipo'],
      'Usuario' => $datos['Usuario'],
      'Contraseña' => $datos['Contraseña'],
      'Nota' => $datos['Nota'],
      'Usuarios_Creados_id' => $datos['Usuarios_Creados_id']
    );
  
}
echo json_encode($json, JSON_UNESCAPED_UNICODE);




?>