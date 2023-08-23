<?php
// Verifica si se envio el dato del usuario
if (isset($_POST['id_Usuario_Vencido'])) {
    $id_Usuario_Vencido = $_POST['id_Usuario_Vencido'];
    ConsultarRegistroTablaVencidos($id_Usuario_Vencido);

} else if (isset($_POST['id_Usuario_Activos'])) {
    $id_Usuario_Activos = $_POST['id_Usuario_Activos'];
    ConsultarRegistroTablaActivos($id_Usuario_Activos);

} else if (isset($_POST['id_Usuario_Deudores'])) {
   
    $id_Usuario_Deudores = $_POST['id_Usuario_Deudores'];

    EliminarUsuarioDBDeudores($id_Usuario_Deudores);
}
//     // Se verifica si se envio el dato trabajador
// }else if (isset($_POST['id_Usuario_Activo'])){
//     $id_Usuario_Activo = $_POST['id_Usuario_Activo'];
// }
// else if (isset($_POST['id_Usuario_Deudor'])){
//     $id_Usuario_Deudor = $_POST['id_Usuario_Deudor'];
// }

//------CONSULTA DE TABLAS PARA VERIFICAR DATOS ----------------------

function ConsultarRegistroTablaVencidos($id_Usuario_Vencido)
{
    include("../DB/Conexion.php");
    include('./DatosInicioMikrotik.php');
    require('../routeros_api.class.php');
    include('../funcionalidad/DesconectarUsuarioDelMikrotik.php');
    // Obteniendo datos de inventario 
    $sql = "SELECT * FROM usuarios_vencidos 
    INNER JOIN usuarios_creados ON usuarios_vencidos.Usuarios_Creados_id = usuarios_creados.id_uc WHERE id ='$id_Usuario_Vencido'";
    $resultado = $conexion->prepare($sql);
    if ($resultado->execute()) {
        $datos = $resultado->fetch();
        $Usuario = $datos['Usuario'];
        $id_usuario_creado = $datos['id_uc'];
        $id_Usuario_Venc = $id_Usuario_Vencido;
        
        
        $API = new RouterosAPI();

        if ($API->connect($IPRB, $UsuarioEnRB, $ContraseñaEnRB)) {

            $DATOS = $API->comm("/ip/hotspot/user/remove", array(
                "numbers"     => $Usuario,

            ));

            if (empty($DATOS)) {
                //Si el usuario es eliminado ejecute esta parte  
                EliminarUsuarioDBVencidos($id_usuario_creado, $id_Usuario_Venc);
            } else {
                //Si el usuario no es eliminado ejecute esta parte  
                echo ("NO SE BORRO DEL MIKROTIK");
                $API->disconnect();
            }
        }
    }



}

function ConsultarRegistroTablaActivos($id_Usuario_Activos)
{
    include("../DB/Conexion.php");
    include('./DatosInicioMikrotik.php');
    require('../routeros_api.class.php');
    // Obteniendo datos de inventario 
    $sql = "SELECT * FROM usuarios_activos 
    INNER JOIN usuarios_creados ON usuarios_activos.Usuarios_Creados_id = usuarios_creados.id_uc WHERE id ='$id_Usuario_Activos'";
    $resultado = $conexion->prepare($sql);

    if ($resultado->execute()) {
        $datos = $resultado->fetch();

        $Usuario = $datos['Usuario'];
        $id_usuario_creado = $datos['id_uc'];
        $id_Usuario_Acti = $id_Usuario_Activos;

        $API = new RouterosAPI();

        if ($API->connect($IPRB, $UsuarioEnRB, $ContraseñaEnRB)) {

            $DATOS = $API->comm("/ip/hotspot/user/remove", array(
                "numbers"     => $Usuario,

            ));

            if (empty($DATOS)) {
                //Si el usuario es eliminado ejecute esta parte  
                EliminarUsuarioDBActivos($id_usuario_creado, $id_Usuario_Acti);
            } else {
                //Si el usuario no es eliminado ejecute esta parte  
                echo ("NO SE BORRO DEL MIKROTIK");
                $API->disconnect();
            }
        }
    } else {
    }


   
}


///ELIMINAR USUARIO DE LA BASE DE DATOS-----------------------------------
function EliminarUsuarioDBVencidos($id_usu_creado, $id_usu_venc)
{
    include("../DB/Conexion.php");


    $sql = "DELETE FROM usuarios_deudores WHERE Usuarios_Creados_id  = '$id_usu_creado'";
    $resultado = $conexion->prepare($sql);

    if ($resultado->execute()) {

        $sql = "DELETE FROM usuarios_vencidos WHERE id  = '$id_usu_venc'";
        $resultado = $conexion->prepare($sql);

        if ($resultado->execute()) {
            $sql = "DELETE FROM usuarios_creados WHERE id_uc  = '$id_usu_creado'";
            $resultado = $conexion->prepare($sql);

            if ($resultado->execute()) {
                echo "Ejecutado";
                /// else de usuarios creados
            } else {
                echo "NO SE BORRO DE LA TABLA CREADOS";
            }
            //else de vencidos 
        } else {
            //
            echo "NO SE BORRO DE LA TABLA VENCIDOS";
        }
        //Else de deudores
    } else {
        //
        echo "NO SE BORRO DE LA TABLA VENCIDOS";
    }
}
//-----------------ACTIVOS ELIMINAR DE LA DB-------------------------------------------------------------------
function EliminarUsuarioDBActivos($id_usu_creado, $id_usu_acti)
{
    include("../DB/Conexion.php");


    $sql = "DELETE FROM usuarios_deudores WHERE Usuarios_Creados_id  = '$id_usu_creado'";
    $resultado = $conexion->prepare($sql);

    if ($resultado->execute()) {

        $sql = "DELETE FROM usuarios_activos WHERE id  = '$id_usu_acti'";
        $resultado = $conexion->prepare($sql);

        if ($resultado->execute()) {
            $sql = "DELETE FROM usuarios_creados WHERE id_uc  = '$id_usu_creado'";
            $resultado = $conexion->prepare($sql);

            if ($resultado->execute()) {
                echo "Ejecutado";
                /// else de usuarios creados
            } else {
                echo "NO SE BORRO DE LA TABLA CREADOS";
            }
            //else de vencidos 
        } else {
            //
            echo "NO SE BORRO DE LA TABLA ACTIVOS";
        }
        //Else de deudores
    } else {
        //
        echo "NO SE BORRO DE LA TABLA ACTIVOS";
    }
}

//ELIMINAR A DEUDORES DE LA TABLA -----------------------------------------------------

//-----------------ACTIVOS ELIMINAR DE LA DB-------------------------------------------------------------------
function EliminarUsuarioDBDeudores($id_Usuario_Deudores)
{
    include("../DB/Conexion.php");
    

    $sql = "DELETE FROM usuarios_deudores WHERE id  = '$id_Usuario_Deudores'";
    $resultado = $conexion->prepare($sql);

    if ($resultado->execute()) {
        echo "Ejecutado";
    
        //Else de deudores
    } else {
        //
        echo "NO SE BORRO DE LA TABLA ACTIVOS";
    }
}

?>