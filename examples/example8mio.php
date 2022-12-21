
   <?php

/* Eliminando usuario de user donde el nombre es 1h1 y si se ejecuta correctamente te manda a el login*/

require('../routeros_api.class.php');

$API = new RouterosAPI();
$hola = "1d1";
$API->debug = true;

if ($API->connect('10.100.5.1', 'admin', 'aquirre2020.')) {

   
    $ARRAY = $API->comm("/system/identity/print");
    // print_r($ARRAY);
     $hola = json_encode($ARRAY);
     var_dump($hola);
     
     $API->disconnect();

}
?>