
<?php

/* Example for adding a VPN user */

require('../routeros_api.class.php');

$API = new RouterosAPI();

//$API->debug = true;

if ($API->connect('10.100.5.1', 'admin', 'aquirre2020.')) {

   $API->comm("/ip/hotspot/user/comment", array(
      "numbers"     => "1d",
      "comment"     => "Hola mundo",
      
   ));
   $API->disconnect();

}
?>

