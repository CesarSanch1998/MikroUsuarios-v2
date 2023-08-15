<?php 
include('../DB/Conexion.php');
include('./DatosInicioMikrotik.php');

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

if ($API->connect($IPRB, $UsuarioEnRB, $ContraseñaEnRB)) {

   $API->comm("/ip/hotspot/user/remove", array(
      "numbers"     => $usuario,
      
   ));
   $API->disconnect();

}
}

?>