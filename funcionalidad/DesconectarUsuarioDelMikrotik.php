<?php

    $usuario = $_POST['usuario'];
    // $usuario = '4h';
    require('../routeros_api.class.php');
    include('./DatosInicioMikrotik.php');

    $API = new RouterosAPI();
    
  
    if ($API->connect($IPRB, $UsuarioEnRB, $ContraseñaEnRB)) {
  
  
        $ARRAY = $API->comm("/ip/hotspot/active/print", array("?user" => $usuario));
    
        if(!empty($ARRAY)){ // si el $array retorna jun dato es porque esta activo si no pasara al else
          
          $id_numbers_mk = $ARRAY[0]['.id'];
          $ARRAY2 = $API->comm("/ip/hotspot/active/remove", array("numbers" => $id_numbers_mk));
    
          if(empty($ARRAY2)){ // si el $array retorna jun dato es porque esta activo si no pasara al else
      
            $json[] = array(
              'UsuarioMK' => 'Usuario Desconectado',
            );
            
            echo json_encode($json,JSON_UNESCAPED_UNICODE); //Imprime el valor de json para retornar al ajax
            $API->disconnect(); // finaliza la session de la api
          }else{
  
            $json[] = array(
              'UsuarioMK' => 'Usuario No Desconectado',
            );
            
            echo json_encode($json,JSON_UNESCAPED_UNICODE); //Imprime el valor de json para retornar al ajax
            $API->disconnect(); // finaliza la session de la api
        }
        // DesconectarUsuarioMk($ARRAY[0]['.id']);
        
        }else{

          $json[] = array(
            'UsuarioMK' => 'Usuario No Encontrado',
          );
          
          echo json_encode($json,JSON_UNESCAPED_UNICODE); //Imprime el valor de json para retornar al ajax
          $API->disconnect(); // finaliza la session de la api
      }
      
    }else {
    
        $json[] = array(
            'UsuarioMK' => 'Sin Conexion',
          );
          echo json_encode($json,JSON_UNESCAPED_UNICODE);
        
    }

    
?>
