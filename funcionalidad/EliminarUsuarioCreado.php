<?php 
include('../DB/Conexion.php');

$Id_Usuario_CreadoDB = $_POST['id_UsuarioCreado'];
$Usuario_Creado = $_POST['N_usuario'];

$sql = "DELETE FROM usuarios_creados WHERE id_uc  = '$Id_Usuario_CreadoDB'";
$resultado = $conexion->prepare($sql);


if($resultado->execute()){
echo "Ejecutado";
EliminarUsuarioCreadoMK($Usuario_Creado);
}else{
echo "no ejecutado";
}

function EliminarUsuarioCreadoMK($usuario){
    require('../routeros_api.class.php');

$API = new RouterosAPI();

if ($API->connect('10.100.5.1', 'admin', 'aquirre2020123.')) {

   $API->comm("/ip/hotspot/user/remove", array(
      "numbers"     => $usuario,
      
   ));
   $API->disconnect();

}
}

?>