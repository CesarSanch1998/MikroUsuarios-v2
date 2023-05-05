<?php 

include("../DB/Conexion.php");
// Obteniendo datos de inventario 
$sql = "SELECT * FROM usuarios_activos INNER JOIN usuarios_creados ON usuarios_activos.Usuarios_Creados_id = usuarios_creados.id_uc";
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
      'Nota' => $datos['Nota'],
      'Usuario' => $datos['Usuario'],
      'Contraseña' => $datos['Contraseña'],
      'Usuarios_Creados_id' => $datos['Usuarios_Creados_id'],
      'Opciones'=>'
      <button type="button" class="btn btn-warning btnEditar" name="btnEditar" id="'.$datos['id'].'" ><i class="bi bi-pencil"></i></button>
      <button type="button" class="btn btn-info btnInformacion" name="btnInformacion" id="'.$datos['id'].'" ><i class="bi bi-list-ul"></i></button>
      <button type="button" class="btn btn-danger btnEliminar" name="borrar" id="'.$datos['id'].'"><i class="bi bi-trash3"></i></button>'
      
    );
  
}
echo json_encode($json, JSON_UNESCAPED_UNICODE);




?>