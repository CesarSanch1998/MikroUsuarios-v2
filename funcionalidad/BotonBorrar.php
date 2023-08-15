<?php 
// Verifica si se envio el dato del inventario rebaño
if(isset($_POST['id_Usuario_Vencido'])){
    $id_Usuario_Vencido = $_POST['id_Usuario_Vencido'];
    ConsultarRegistroTablaVencidos($id_Usuario_Vencido);

    // Se verifica si se envio el dato trabajador
}
// else if(isset($_POST['id_trabajador'])){
//     $id_trabajador=$_POST['id_trabajador'];
    

//     // Se verifica si se envio un dato de maquinaria
// }else if(isset($_POST['id_Maquinaria'])){
//     $id_Maquinaria=$_POST['id_Maquinaria'];
//     ConsultarRegistroTablaDeudores($id_Maquinaria);

    
// }


// function ConsultarRegistroTablaActivos($){
//     include('./conexion_be.php');
//     $sql = "DELETE FROM inventario_rebaño WHERE ID_animal  = '$id_animal'";
//     $resultado = $conexion->prepare($sql);

//     if($resultado->execute()){
//         echo "Ejecutado";
//         }else{
//             echo "Error";
//         }

// }

function ConsultarRegistroTablaVencidos($id_Usuario_Vencido){
    include("../DB/Conexion.php");
   // Obteniendo datos de inventario 
$sql = "SELECT * FROM usuarios_vencidos 
INNER JOIN usuarios_creados ON usuarios_vencidos.Usuarios_Creados_id = usuarios_creados.id_uc WHERE id ='$id_Usuario_Vencido'";
$resultado = $conexion->prepare($sql);
$resultado->execute();
$datos=$resultado->fetch();

}

function ConsultarRegistroTablaDeudores($){
    include('./conexion_be.php');
    $sql = "DELETE FROM maquinaria WHERE ID_maquinaria = $id_Maquinaria";
    $resultado = $conexion->prepare($sql);


if($resultado->execute()){
    echo "Ejecutado";
    }else{
    echo "no ejecutado";
    }
}

EliminarUsuarioDB(){
    include('../DB/Conexion.php');

    $Id_Usuario_CreadoDB = $_POST['id_UsuarioCreado'];
    $Usuario_Creado = $_POST['N_usuario'];
    
    $sql = "DELETE FROM usuarios_creados WHERE id_uc  = '$Id_Usuario_CreadoDB'";
    $resultado = $conexion->prepare($sql);
    
    
    if($resultado->execute()){
    echo "Ejecutado";
    EliminarUsuarioCreadoMK($Usuario_Creado);
    }else{
    echo "no ejecutado";
    }
}


   
?>