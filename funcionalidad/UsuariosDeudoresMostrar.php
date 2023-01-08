<?php 
include('../DB/Conexion.php'); // Incluir conexion con base de datos

$sql = "SELECT * FROM usuarios_deudores";

$json = array();
$consulta_deudores = mysqli_query($conexion,$sql);
while ($Datos_deudores = mysqli_fetch_array($consulta_deudores)) {

    $json[] = array(
        'id' => $Datos_deudores['id'],
        'nombre' => $Datos_deudores['Nombre_Cliente'],
        'mesa' => $Datos_deudores['Mesa'],
        'pagado' => $Datos_deudores['Pagado'],
        'pendiente' => $Datos_deudores['Pendiente'],
        'fventa' => $Datos_deudores['Fecha_Venta'],
        'fvenci' => $Datos_deudores['Fecha_Vencimiento'],
        'usu_creado_id' => $Datos_deudores['Usuarios_Creados_id'],
        'botonAbonar' => '<div class="btn-group" role="group" aria-label="Basic mixed styles example">
        <button type="button" name="editar" id="'.$Datos_deudores['id'].'" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalAbonarPago">Abonar</button>
        <button type="button" name="borrar" id="'.$Datos_deudores['id'].'" class="btn btn-danger" onclick="AlertarEliminar();">Borrar</button>

        </div>'
      );
}

    
    

$json_resultado = json_encode($json);
    echo $json_resultado;
