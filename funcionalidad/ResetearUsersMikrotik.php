<?php

    $usuario = $_POST['usuario'];
    // $usuario = '4h';
    require('../routeros_api.class.php');
    include('./DatosInicioMikrotik.php');

    $API = new RouterosAPI();
    
  
    if ($API->connect($IPRB, $UsuarioEnRB, $ContraseñaEnRB)) {
  
  
        $ARRAY = $API->comm("/ip/hotspot/active/print", array("?user" => $usuario));
    
        if(!empty($ARRAY)){ // si el $array retorna jun dato es porque esta activo si no pasara al else
    
          $json[] = array(
            'UsuarioMK' => 'Usuario Activo',
          );
          
          echo json_encode($json,JSON_UNESCAPED_UNICODE); //Imprime el valor de json para retornar al ajax
          $API->disconnect(); // finaliza la session de la api
        }else{

        ResetearUsuarioMK($usuario);
      }
      
    }else {
    
        $json[] = array(
            'UsuarioMK' => 'Sin Conexion',
          );
          echo json_encode($json,JSON_UNESCAPED_UNICODE);
        
    }



    function ResetearUsuarioMK($usuario){
        $API = new RouterosAPI();
        if ($API->connect('10.100.5.1', 'admin', 'aquirre2020123.')) {
        
            $ARRAY = $API->comm("/ip/hotspot/user/reset-counters", array(
                "numbers" => $usuario,
            ));
    
            if (empty($ARRAY)) {
                
                 
              
                 $json[] = array(
                    'UsuarioMK' => 'Reseteado',
                  );
                  echo json_encode($json,JSON_UNESCAPED_UNICODE);
            } else {
    
                $json[] = array(
                    'UsuarioMK' => 'No Reseteado',
                  );
                  echo json_encode($json,JSON_UNESCAPED_UNICODE);
                
            }
    
            $API->disconnect();
        }
    }
    
    

