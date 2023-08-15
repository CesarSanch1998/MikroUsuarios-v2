<?php 
$FormatoDatos = $_POST['FormatoDatos'];
$LongitudDatos = $_POST['LongitudDatos'];
$TipoUsuario = $_POST['TipoUsuario'];
$TiempoDias = $_POST['TiempoDias'];
$TiempoHoras = $_POST['TiempoHoras'];
$TiempoTotal = $TiempoDias."d ".$TiempoHoras.":00:00";

if($FormatoDatos == "ab"){
Usuario_ab($LongitudDatos);

} else if($FormatoDatos == "ABC"){
Usuario_ABC($LongitudDatos);

}else if($FormatoDatos == "a1"){
  Usuario_a1($LongitudDatos);
  
}else if($FormatoDatos== "12"){
  Usuario_12($LongitudDatos);
}


function Usuario_ab($longitud){//Minuscula
  $caracteres_permitidos = 'abcdefghijklmnopqrstuvwxyz';
  $UsuarioCreado = substr(str_shuffle($caracteres_permitidos), 0, $longitud);
  GenerarContraseña($UsuarioCreado,$longitud);

}
function Usuario_ABC($longitud){//Mayuscula
  $caracteres_permitidos = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $UsuarioCreado = substr(str_shuffle($caracteres_permitidos), 0, $longitud);
  GenerarContraseña($UsuarioCreado,$longitud);
}
function Usuario_a1($longitud){//Lecha minuscula y numeros
    $caracteres_permitidos = '0123456789abcdefghijklmnopqrstuvwxyz';
    $UsuarioCreado = substr(str_shuffle($caracteres_permitidos), 0, $longitud);
    GenerarContraseña($UsuarioCreado,$longitud);
}
function Usuario_12($longitud){ //solo numeros
  $caracteres_permitidos = '0123456789';
  $UsuarioCreado = substr(str_shuffle($caracteres_permitidos), 0, $longitud);
  GenerarContraseña($UsuarioCreado,$longitud);
}

// Contraseña despues de crear el usuario--------------------------------------------------------------
function GenerarContraseña($UsuarioCreado,$longitud){
  $caracteres_permitidos = '0123456789';
  $UsuarioCreado = $UsuarioCreado;
  $ContraseñaCreada = substr(str_shuffle($caracteres_permitidos), 0, $longitud);

  global $TipoUsuario;
  $TipoUsuarioLocal = $TipoUsuario;

  GenerarUsuarioDB($UsuarioCreado,$ContraseñaCreada,$TipoUsuario,$TipoUsuarioLocal);
}

function GenerarUsuarioDB($UsuarioCreado,$ContraseñaCreada,$TipoUsuario){
  include('../DB/Conexion.php');
  date_default_timezone_set('America/Caracas');
 
  $fecha_actual = date("Y-m-d");
  //Agrega el usuario resuscrito en la tabla de usuarios activos -----------------------------------
  $sql = "INSERT INTO usuarios_creados (Usuario, Contraseña, Fecha_Creacion, Tipo) 
  VALUES (?, ?, ?, ?)";
  
  $ejecutar = $conexion->prepare($sql);
  // Bind
  
  $ejecutar->bindParam(1,$UsuarioCreado);
  $ejecutar->bindParam(2,$ContraseñaCreada);
  $ejecutar->bindParam(3,$fecha_actual);
  $ejecutar->bindParam(4,$TipoUsuario);
  
  // Excecute
  if($ejecutar->execute()){
    global $TiempoTotal;
    switch ($TipoUsuario) {
      case '1d':
        AgregarUsuarioMK($UsuarioCreado,$ContraseñaCreada,"1 DIAS",$TiempoTotal);
        break;
      case '1s':
        AgregarUsuarioMK($UsuarioCreado,$ContraseñaCreada,"1 SEM",$TiempoTotal);
        break;
      case '1m':
        AgregarUsuarioMK($UsuarioCreado,$ContraseñaCreada,"1 MES",$TiempoTotal);
        break;
      default:
        # code...
        break;
    }
    
      // EliminarDeTablaVencidos($id_tabla_vencidos);
      MostrarResultado($UsuarioCreado,$ContraseñaCreada);
  }else{
      echo "Error en insertar crear el usuario en usuarios creados";
  }
}

// Mostrar resultados de la creacion del usuario y contraseña para pasar al modal nuevo usuario----------
function MostrarResultado($UsuarioCreado,$ContraseñaCreada){

  include('../DB/Conexion.php');
$sql = "SELECT * FROM usuarios_creados WHERE Usuario = '$UsuarioCreado'";

$resultado = $conexion->prepare($sql);
$resultado->execute();
$datos = $resultado->fetch();


  $json[] = array(
    'UsuarioCreado'=> $UsuarioCreado,
    'ContraseñaCreada'=> $ContraseñaCreada,
    'id_UsuarioCreado'=> $datos['id_uc'],
  );

  echo json_encode($json,JSON_UNESCAPED_UNICODE);
}

function AgregarUsuarioMK($Usuario,$Contraseña,$Tipo,$TiempoTotal){
  

  require('../routeros_api.class.php');
  include('./DatosInicioMikrotik.php');
  $API = new RouterosAPI();
  
  
  if ($API->connect($IPRB, $UsuarioEnRB, $ContraseñaEnRB)) {
  
     $API->comm("/ip/hotspot/user/add", array(
        "name" => $Usuario,
        "password" => $Contraseña,
        "profile" => $Tipo,
        "limit-uptime" => $TiempoTotal,
     ));
     
     $API->disconnect();
  
  }
}
?>