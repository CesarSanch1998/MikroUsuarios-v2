<?php

require('../routeros_api.class.php');

$API = new RouterosAPI();

//$API->debug = true;



if ($API->connect('10.100.5.1', 'admin', 'aquirre2020.')) {


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