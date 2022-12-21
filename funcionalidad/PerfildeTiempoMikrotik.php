<?php

require('../routeros_api.class.php');

$API = new RouterosAPI();

//$API->debug = true;



if ($API->connect('10.100.5.1', 'admin', 'aquirre2020.')) {


  #conseguir cantidad de usuarios  y almacenar en $getusers
$getuserprofile = $API->comm("/ip/hotspot/user/profile/print", array(
  "count-only"=> "",
));

#en este punto se llaman a leer todos los datos de 
$almacenarperfilesnombres="";
  $API->write('/ip/hotspot/user/profile/print');
  $userprofile = $API->read();
  for ($i=0; $i < $getuserprofile; $i++) { 
    //print_r($userprofile[$i]['name']." ");
    $almacenarperfilesnombres = $userprofile[$i]['name'];
  }

 
  $API->disconnect();
  
}


?>