<?php 

include("../DB/Conexion.php");
// Obteniendo datos de inventario 
$sql = "SELECT * FROM usuarios_vencidos 
INNER JOIN usuarios_creados ON usuarios_vencidos.Usuarios_Creados_id = usuarios_creados.id_uc";
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
      'Estatus_Mikrotik' => $datos['Estatus_Mikrotik'],
      'Nota' => $datos['Nota'],
      'Usuario' => $datos['Usuario'],
      'Opciones'=>'
      <button type="button" class="btn btn-warning btnResuscribir" name="btnResuscribir" id="'.$datos['id'].'" ><i class="bi bi-arrow-counterclockwise"></i></button>
      <button type="button" class="btn btn-info btnInformacion" name="btnInformacion" id="'.$datos['id'].'" ><i class="bi bi-list-ul"></i></button>
      <button type="button" class="btn btn-danger btnEliminar" name="borrar" id="'.$datos['id'].'"><i class="bi bi-trash3"></i></button>'
      
    );
  
}
echo json_encode($json, JSON_UNESCAPED_UNICODE);




?>