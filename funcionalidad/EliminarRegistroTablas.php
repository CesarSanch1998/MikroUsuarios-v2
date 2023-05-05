<?php 

function EliminarRegistroUsuarioTablaVencidos($id_Usuario){
    include('../DB/Conexion.php');
    
    $sql = "DELETE FROM maquinaria WHERE ID_maquinaria = $id_Maquinaria";
    $resultado = $conexion->prepare($sql);


if($resultado->execute()){
    echo "Ejecutado";
    }else{
    echo "no ejecutado";
    }
}
?>