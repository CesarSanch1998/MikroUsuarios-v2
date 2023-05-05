<?php 

include("../DB/Conexion.php");
date_default_timezone_set('America/Caracas');
$FechaActual = date("Y-m-d");

// Obteniendo datos de inventario 
$sql = "SELECT * FROM usuarios_activos WHERE Fecha_Vencimiento <= '$FechaActual'";
$resultado = $conexion->prepare($sql);
$resultado->execute();
// $datos=$resultado->fetch(PDO::FETCH_ASSOC);


  while($datos = $resultado->fetch()){
    $id_Usuario = $datos['id'];
    $Nombre_Cliente = $datos['Nombre_Cliente'];
    $Mesa = $datos['Mesa'];
    $Fecha_Venta = $datos['Fecha_Venta'];
    $Fecha_Vencimiento = $datos['Fecha_Vencimiento'];
    $Nota = $datos['Nota'];
    $Usuarios_Creados_id = $datos['Usuarios_Creados_id'];

    CambiardeActivosAVencidos($id_Usuario,$Nombre_Cliente,$Mesa,$Fecha_Venta,$Fecha_Vencimiento,$Nota,$Usuarios_Creados_id);
}

function CambiardeActivosAVencidos($id_Usuario,$Nombre_Cliente,$Mesa,$Fecha_Venta,$Fecha_Vencimiento,$Nota,$Id_Usuario_Creado){ 
    // aqui se pasan los usuarios de la tabla de activos a vencidos cada vez que se inicia la aplicacion
    // verifica los vencidos de hoy y los pasa automaticamente a la otra tabla
    include("../DB/Conexion.php");
    $sql = "INSERT INTO usuarios_vencidos (Nombre_Cliente, Mesa, Fecha_Venta, Fecha_Vencimiento, Nota, Usuarios_Creados_id) 
    VALUES (?, ?, ?, ?, ?, ?)";

    $ejecutar = $conexion->prepare($sql);
// Bind

$ejecutar->bindParam(1,$Nombre_Cliente);
$ejecutar->bindParam(2,$Mesa);
$ejecutar->bindParam(3,$Fecha_Venta);
$ejecutar->bindParam(4,$Fecha_Vencimiento);
$ejecutar->bindParam(5,$Nota);
$ejecutar->bindParam(6,$Id_Usuario_Creado);

// Excecute
if($ejecutar->execute()){
    echo "Ejecutado";
    EliminarDeActivos($id_Usuario);
}else{
    echo "Error";
}

}

function EliminarDeActivos($id_Usuario){
    include("../DB/Conexion.php");
    $sql = "DELETE FROM usuarios_activos WHERE id  = '$id_Usuario'";
    $resultado = $conexion->prepare($sql);

    if($resultado->execute()){
        echo "Ejecutado";
        }else{
            echo "Error";
        }
}


?>