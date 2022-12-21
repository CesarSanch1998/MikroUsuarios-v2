<?php

/* Example of counting leases from a specific IP Pool (using regexp) */

require('../routeros_api.class.php');

$API = new RouterosAPI();

//$API->debug = true;

if ($API->connect('10.100.5.1', 'admin', 'aquirre2020.')) {

   #conseguir cantidad de usuarios en ip binding y almacenar en $getuserip-binding
   $getusersipbinding = $API->comm("/ip/hotspot/ip-binding/print", array(
      "count-only" => "",
   ));

   #en este punto se llaman a leer todos los datos de de ip-binding y almacenarlos en $ips
   $API->write('/ip/hotspot/ip-binding/print');
   $ips = $API->read();
   #bucle for en el cual como los datos estan en arrays de 2 dimenciones [i][e] el primer dato i es el dato id
   #de posicion usuario y el segundo dato e es el dato que quiero extraer ya sea "comments","type","name","mac-address"
   #entre otros del ip-binding
   for ($i = 0; $i < $getusersipbinding; $i++) {

      var_dump($ips[$i]);
   }




   $API->disconnect();
}
