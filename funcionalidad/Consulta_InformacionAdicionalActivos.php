<?php 

include("../DB/Conexion.php");

$id_usuario = $_POST['id_Usuario'];

// Obteniendo datos de inventario 
$sql = "SELECT * FROM usuarios_activos 
INNER JOIN usuarios_creados ON usuarios_activos.Usuarios_Creados_id = usuarios_creados.id_uc  WHERE id='$id_usuario'";
$resultado = $conexion->prepare($sql);
$resultado->execute();
// $datos=$resultado->fetch(PDO::FETCH_ASSOC);


  while($datos = $resultado->fetch()){
  
    $usuario = $datos['Usuario'];
    $nombrecliente = $datos['Nombre_Cliente'];
    $mesa = $datos['Mesa'];
    InformacionMK($usuario,$nombrecliente,$mesa);
  
}


function InformacionMK($usuariomk,$nombrecliente,$mesa){
  require('../routeros_api.class.php');
  include('./DatosInicioMikrotik.php');
  $API = new RouterosAPI();
  
  //$API->debug = true;
  
  if ($API->connect($IPRB, $UsuarioEnRB, $ContraseñaEnRB)) {
  
  
    $ARRAY = $API->comm("/ip/hotspot/active/print", array("?user" => $usuariomk));

    if(!empty($ARRAY)){

      $json[] = array(
        'UsuarioMK' => $usuariomk,
        'NombreCliente' => $nombrecliente,
        'Mesa' => $mesa,
        'Mac' => $ARRAY[0]['mac-address'],
        'IP' => $ARRAY[0]['address'],
        'Tiempo_Restante' => $ARRAY[0]['session-time-left'],
        'Tiempo_Inactivo' => $ARRAY[0]['idle-time'],
        'Icono' => 's',
      );
      // var_dump($ARRAY);
    
    
    }else{
    $json[] = array(
      'UsuarioMK' => 'No activo',
      'NombreCliente' => 'No activo',
      'Mesa' => '0',
      'Mac' => 'No activo',
      'IP' => 'No activo',
      'Tiempo_Restante' => 'No activo',
      'Tiempo_Inactivo' => 'No activo',
      'Icono' => 'x',
    );
  }
  echo json_encode($json,JSON_UNESCAPED_UNICODE);
      $API->disconnect();
}
}

?>