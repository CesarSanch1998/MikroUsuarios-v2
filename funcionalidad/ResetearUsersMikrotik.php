<?php

    $usuario = $_POST['Usuario'];
    require('../routeros_api.class.php');

    $ejecutado = "";
    $json ="";
    $API = new RouterosAPI();
    #$API->debug = true;
    if ($API->connect('10.100.5.1', 'admin', 'aquirre2020.')) {
        
        $ARRAY = $API->comm("/ip/hotspot/user/reset-counters", array(
            "numbers" => $usuario,
        ));

        if (empty($ARRAY)) {
            
             $json = json_encode($ARRAY);
             echo "ejecutado";
          
        } else {

            echo "no ejecutado";
            $json = json_encode($ARRAY);  
            
        }

        $API->disconnect();
    }
    

