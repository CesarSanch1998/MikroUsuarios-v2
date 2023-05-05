<?php

/* Example for adding a VPN user */

require('../routeros_api.class.php');

$API = new RouterosAPI();

$API->debug = true;

if ($API->connect('10.100.5.1', 'admin', 'aquirre2020123.')) {

   $API->comm("/ip/hotspot/user/add", array(
      "name" => "cesaralfonso",
      "password" => "cesaralfonso",
      "profile" => "1 SEM",
      "limit-uptime" => "7d12:00:00",
   ));
   
   $API->disconnect();

}

?>