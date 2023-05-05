<?php

/* Example of counting leases from a specific IP Pool (using regexp) */

require('../routeros_api.class.php');

$API = new RouterosAPI();

$API->debug = true;

if ($API->connect('10.100.5.1', 'admin', 'aquirre2020123.')) {

   $ARRAY = $API->comm("/ip/dhcp-server/lease/print", array(
      "count-only"=> "",
      "~active-address" => "10.100.5.10",
   ));
   
   print_r($ARRAY);

   $API->disconnect();

}

?>