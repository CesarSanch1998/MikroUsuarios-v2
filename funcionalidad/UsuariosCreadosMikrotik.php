<?php

require('../routeros_api.class.php');
include('./DatosInicioMikrotik.php');
$API = new RouterosAPI();

//$API->debug = true;



if ($API->connect($IPRB, $UsuarioEnRB, $ContraseñaEnRB)) {


  #conseguir cantidad de usuarios  y almacenar en $getusers
$getusers = $API->comm("/ip/hotspot/user/print", array(
  "count-only"=> "",
));

#en este punto se llaman a leer todos los datos de 
  $API->write('/ip/hotspot/user/print');
  $users = $API->read();

 
  $API->disconnect();
  
}


?>