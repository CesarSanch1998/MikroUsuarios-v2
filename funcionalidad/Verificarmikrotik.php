
<?php

/* Example for adding a VPN user */

require('../routeros_api.class.php');
include('./DatosInicioMikrotik.php');
$API = new RouterosAPI();

//$API->debug = true;

if ($API->connect($IPRB, $UsuarioEnRB, $ContraseñaEnRB)) {

   $API->comm("/ip/hotspot/user/comment", array(
      "numbers"     => "1d",
      "comment"     => "Hola mundo",
      
   ));
   $API->disconnect();

}
?>

