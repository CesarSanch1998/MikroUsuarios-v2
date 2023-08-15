<?php 

include("../DB/Conexion.php");

$Usuario = $_POST['IS_Usuario'];
$contraseña = $_POST['IS_Contraseña'];


$consulta = $conexion->prepare("SELECT * FROM administrador WHERE Usuario =:usuario AND Contraseña=:contra");
$consulta->bindValue(':usuario', $Usuario);
$consulta->bindValue(':contra', $contraseña);
$consulta->execute();
$count = $consulta->rowCount();
$datos=$consulta->fetch();

// echo $count;
if ($count > 0) {
    $json[] = array( 
        'Usuario' => $datos['Usuario'],
        'Privilegios' => $datos['Permisos'],
        'Error' => '0',
      );
    
  
  echo json_encode($json, JSON_UNESCAPED_UNICODE);
  
    //   header('Location: ../Principal.php');
} else {
    $json[] = array( 
        'Error' => '1',
      );
    
  
  echo json_encode($json, JSON_UNESCAPED_UNICODE);
}

?>