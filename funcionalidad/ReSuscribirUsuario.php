<?php 

include('./DatosInicioMikrotik.php');
$id = $_POST['RS_id'];//id obtenido de la tabla de vencidos
$nombre = $_POST['RS_nombre_cliente'];
$mesa = $_POST['RS_mesa'];
$fechainicio = $_POST['RS_Finicio'];
$fechafinal = $_POST['RS_Ffinal'];
$Tipo = $_POST['RS_tipo'];
$nota= $_POST['RS_nota'];
$id_Usuario= $_POST['RS_id_usuario_creado'];
$usuario= $_POST['RS_usuario'];
// -------------------------------------------------------------------------------------------------------
// ---------SE VERIFICARA SI EL USUARIO YA FUE COLOCADO EN EL TLF ANTES DE AGREGAR EL REGISTRO A LA BASE DE DATOS----------

require('../routeros_api.class.php');

    $API = new RouterosAPI();
    
  
    if ($API->connect($IPRB, $UsuarioEnRB, $ContraseñaEnRB)) {
  
  
        $ARRAY = $API->comm("/ip/hotspot/active/print", array("?user" => $usuario));
    
        if(!empty($ARRAY)){ // si el $array retorna jun dato es porque esta activo si no pasara al else
    
         AgregarEnActivos($id,$nombre,$mesa,$fechainicio,$fechafinal,$nota,$id_Usuario,$Tipo);

        }else{
            $json[] = array(
                'Resultado' => 'Usuario No Colocado',
              );
              echo json_encode($json,JSON_UNESCAPED_UNICODE); //Imprime el valor de json para retornar al ajax
            $API->disconnect(); // finaliza la session de la api
      }
      
    }else {
    
        $json[] = array(
            'Resultado' => 'Sin Conexion',
          );
          echo json_encode($json,JSON_UNESCAPED_UNICODE);
        
    }


function AgregarEnActivos($id_tabla_vencidos,$nombre,$mesa,$fechainicio,$fechafinal,$nota,$id_Usuario,$Tipo){
    include('../DB/Conexion.php');
//Agrega el usuario resuscrito en la tabla de usuarios activos -----------------------------------
$sql = "INSERT INTO usuarios_activos (Nombre_Cliente, Mesa, Fecha_Venta, Fecha_Vencimiento, Nota, Usuarios_Creados_id) 
VALUES (?, ?, ?, ?, ?, ?)";

$ejecutar = $conexion->prepare($sql);
// Bind

$ejecutar->bindParam(1,$nombre);
$ejecutar->bindParam(2,$mesa);
$ejecutar->bindParam(3,$fechainicio);
$ejecutar->bindParam(4,$fechafinal);
$ejecutar->bindParam(5,$nota);
$ejecutar->bindParam(6,$id_Usuario);

// Excecute
if($ejecutar->execute()){
    // echo "Ejecutado";
    // echo $id_tabla_vencidos;
    switch ($Tipo) {
        case '1d':
            AgregarADeudores($nombre,$mesa,'0.2',$fechainicio,$nota,$id_Usuario,$id_tabla_vencidos);
            break;
         case '1s':
            AgregarADeudores($nombre,$mesa,'1',$fechainicio,$nota,$id_Usuario,$id_tabla_vencidos);
            break;
        case '1m':
            AgregarADeudores($nombre,$mesa,'3',$fechainicio,$nota,$id_Usuario,$id_tabla_vencidos);
            break;
        default:
            # code...
            break;
    }
    // EliminarDeTablaVencidos($id_tabla_vencidos);
    
}else{
    echo "Error en insertar usuario en tabla activos archivo resuscribir usuarios";
}
}

function AgregarADeudores($nombre,$mesa,$Monto,$fechainicio,$nota,$id_Usuario,$id_tabla_vencidos){
    include('../DB/Conexion.php');

    $MontoInicial = 0;
    //Agrega el usuario resuscrito en la tabla de usuarios activos -----------------------------------
    $sql = "INSERT INTO usuarios_deudores (Nombre_Cliente, Mesa, Pagado, Pendiente, Fecha_Venta, Usuarios_Creados_id) 
    VALUES (?, ?, ?, ?, ?, ?)";
    
    $ejecutar = $conexion->prepare($sql);
    // Bind
    
    $ejecutar->bindParam(1,$nombre);
    $ejecutar->bindParam(2,$mesa);
    $ejecutar->bindParam(3,$MontoInicial);
    $ejecutar->bindParam(4,$Monto);
    $ejecutar->bindParam(5,$fechainicio);
    $ejecutar->bindParam(6,$id_Usuario);
    
    // Excecute
    if($ejecutar->execute()){
        // echo "Ejecutado";
        // echo $id_tabla_vencidos;
        EliminarDeTablaVencidos($id_tabla_vencidos);
        
    }else{
        echo "Error en insertar usuario en tabla activos archivo resuscribir usuarios";
    }
    }


function EliminarDeTablaVencidos($id_en_tabla_vencidos){
    include('../DB/Conexion.php');
    $sql = "DELETE FROM usuarios_vencidos WHERE id  = '$id_en_tabla_vencidos'";
    $resultado = $conexion->prepare($sql);

    if($resultado->execute()){
        
        $json[] = array(
            'Resultado' => 'Ejecutado',
          );
          echo json_encode($json,JSON_UNESCAPED_UNICODE); //Imprime el valor de json para retornar al ajax
        }else{
            echo "Error al eliminar de la tabla de vencidos resuscribir usuario";
        }

}
?>