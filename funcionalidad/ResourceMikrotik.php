<?php

require('../routeros_api.class.php');
include('./DatosInicioMikrotik.php');
$API = new RouterosAPI();

//$API->debug = true;



if ($API->connect($IPRB, $UsuarioEnRB, $ContraseñaEnRB)) {  //Verifica la conexion con los datos pasados 


  // get system resource MikroTik
  $getresource = $API->comm("/system/resource/print");
  $resource = $getresource[0];

  $getusersactive = $API->comm("/ip/hotspot/active");

  $getusersactive = $API->comm("/ip/hotspot/active/print", array(
    "count-only" => "",
  ));

  $getusers = $API->comm("/ip/hotspot/user/print", array(
    "count-only" => "",
  ));

  #conseguir cantidad de usuarios en ip binding y almacenar en $getuserip-binding
  $getusersipbinding = $API->comm("/ip/hotspot/ip-binding/print", array(
    "count-only" => "",
  ));


  #en este punto se llaman a leer todos los datos de 
  $Activosip_bindin = 0;
  $API->write('/ip/hotspot/ip-binding/print');
  $ips = $API->read();
  #bucle for en el cual como los datos estan en arrays de 2 dimenciones [i][e] el primer dato i es el dato id
  #de posicion usuario y el segundo dato e es el dato que quiero extraer ya sea "comments","type","name","mac-address"
  #entre otros del ip-binding
  for ($i = 0; $i < $getusersipbinding; $i++) {
    #condicion que si todos los usuario en la parte de disabled es falso agregue 1 numero a ipbinding
    if ($ips[$i]['disabled'] == "false") {   // false muestra los que no estas apagados, true muestra los que estan apagados
      $Activosip_bindin += 1;
    }
  }

  #para obtener temperatura del mikrotik
  $API->write('/system/health/print');
  $temperatura = $API->read();

  $json[] = array(
    'TEncendido' => $resource['uptime'],
    'Temperatura' => "Sin Datos",//
    'CPU' => $resource['cpu-load'],
    'NombreMK' => $resource['board-name']
  );

  echo json_encode($json, JSON_UNESCAPED_UNICODE);
  $API->disconnect();
  
}else { //SI LA CONEXION CON EL MIKROTIK FALLA SE DEBOLVERAN LOS SIGUIENTES VALORES 
  $json[] = array(
    'TEncendido' => 'Sin conexion',
    'Temperatura' => 'Sin conexion',
    'CPU' => 'Sin conexion',
    'NombreMK' => 'Sin conexion'
  );
  echo json_encode($json, JSON_UNESCAPED_UNICODE);
  $API->disconnect();
}
