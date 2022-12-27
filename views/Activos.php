<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="../css/bootstrap-datepicker.css">
    <title>Document</title>
</head>

<body>

    <!--Cabecera en donde estan las opciones proncipales---------------------------------------->
    <h1 class="visually-hidden">Headers examples</h1>

    <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <span class="fs-4">MikroUsuarios</span>
            </a>

            <ul class="nav nav-pills">

                <li class="nav-item"><a href="../views/Principal.php" class="nav-link" aria-current="page">Principal</a></li>
                <li class="nav-item"><a href="#" class="nav-link active">Activos</a></li>
                <li class="nav-item"><a href="../views/Vencidos.php" class="nav-link">Vencidos</a></li>
                <li class="nav-item"><a href="../views/Deudores.php" class="nav-link">Deudores</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Pausados</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Historial
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Creados-Registros</a></li>
                        <li><a class="dropdown-item" href="#">Pagos-Registros</a></li>
                    </ul>
                </li>
        </header>
    </div>
    <div class="b-example-divider"></div>
    <!--Cabecera en donde estan las opciones proncipales---------------------------------------->
    <!--Boton Agregar usuario---------------------------------------->
    <div class="container">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalAgregarUsuario">Nuevo Usuario</button>
        <?php include('../modal/ModalAgregarUsuario.php'); ?>
    </div>


    <!--Boton Agregar usuario---------------------------------------->

    <!--Tabla de usuarios----------------------------------------------------------------->
    <div class="container">
        <div class="col-12">
            <h2 class="h2 pb-2 mb-5 text-success border-bottom border-success">Usuarios Activos</h2>
            <table id="TablaDatos" class="table table-striped display responsive nowrap" style="width:100%" data-page-length='50'>
                <thead>
                    <tr>
                        <th hidden>Id</th>
                        <th>Nombre</th>
                        <th>Mesa</th>
                        <th>F.Venta</th>
                        <th>F.Venci</th>
                        <th>Usuario</th>
                        <th>Contra</th>
                        <th>Tipo</th>
                        <th>AMK</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('../DB/Conexion.php'); // Incluir conexion con base de datos
                    $sql = "SELECT * FROM usuarios_activos WHERE Fecha_Vencimiento > CURRENT_DATE"; //Obtener de la tabla usuariosdatos 
                    $resultados = mysqli_query($conexion, $sql); // retornar resultados de la conexion y ejecutar script
                    while ($mostrar = mysqli_fetch_array($resultados)) { // bucle que cada vez que encuentre una columna con datos

                        $id_relacion = $mostrar['Usuarios_Creados_id'];
                        $obtener_datos_usuarios_creados = mysqli_query($conexion, "SELECT * FROM usuarios_creados WHERE id='$id_relacion'");
                        $almacen_datos_usuarios_creados = mysqli_fetch_array($obtener_datos_usuarios_creados);
                    ?>

                        <!--PHP OBTENER DATOS DE TABLA EN LA BASE DE DATOS-------------------------------->

                        <!--Finaliza codigo php sin cerrar llaves del while -->
                        <!--Mostrar datos de la tabla con codigo php adentro para obtener cada consulta por separado-->
                        <tr>
                            <td hidden><?php echo $id_relacion ?></td>
                            <!--Funcion hidden usada para esconder los datos de la columna esten alli pero no se muestren-->
                            <td><?php echo $mostrar['Nombre_Cliente'] ?></td>
                            <td><?php echo $mostrar['Mesa'] ?></td>
                            <td><?php echo $mostrar['Fecha_Venta'] ?></td>
                            <td><?php echo $mostrar['Fecha_Vencimiento'] ?></td>
                            <td><?php echo $almacen_datos_usuarios_creados['Usuario'] ?></td>
                            <td><?php echo $almacen_datos_usuarios_creados['Contraseña'] ?></td>
                            <td><?php echo $almacen_datos_usuarios_creados['Tipo'] ?></td>
                            <td><img src="../images/comprobado.png" width="35" height="35"></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <button type="button" href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalEditarUsuario<?php echo $mostrar['id'];?>" data-bs-id="<?php echo $almacen_datos_usuarios_creados['id'];?>">Editar</button>
                                    <button type="button" href="#" class="btn btn-primary" onclick="AlertarPausarUsuario();">Pausar</button>
                                    <button type="button" href="#" class="btn btn-danger" onclick="AlertarEliminar();">Eliminar</button>
                                </div>
                            </td>

                        </tr>

                        <?php include('../modal/ModalEditarUsuario.php'); ?>
                        <!--Mostrar datos de la tabla con codigo php adentro para obtener cada consulta por separado-->


                        <!--PHP OBTENER DATOS DE TABLA EN LA BASE DE DATOS-------------------------------->
                        <?php } ?>
                </tbody>
            
            <tfoot>
                <th hidden>Id</th>
                <th>Nombre</th>
                <th>Mesa</th>
                <th>F.Venta</th>
                <th>F.Venci</th>
                <th>Usuario</th>
                <th>Contra</th>
                <th>Tipo</th>
                <th>AMK</th>
                <th>Opciones</th>
            </tfoot>
            </table>
        </div>
    </div>
    <!--Tabla de usuarios----------------------------------------------------------------->






    <!--Scripts-------------------------------------------------------------------------->
    <script src="../js/bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="../js/bootstrap-datepicker.min.js"></script>

    <!--Script Modal AgregarUsuario---------------------------------------------------->
    <script>
        const exampleModal = document.getElementById('ModalAgregarUsuario')
        exampleModal.addEventListener('show.bs.modal', event => {})
    </script>
    <!--Script Modal AgregarUsuario---------------------------------------------------->
    <!--Script TABLA---------------------------------------------------->
    <script>
        $(document).ready(function() {
            TablaDatos = $('#TablaDatos').DataTable({});
        });
    </script>
    <!--Script TABLA---------------------------------------------------->
    <!--Script selector de fecha modal----------------------------------------------------->
    <script>
        $('.input-daterange').datepicker({
            format: "yyyy-mm-dd",
            language: "es",
            orientation: "bottom auto",
            startDate: "2022-07-01",
            todayBtn: "linked",
            orientation: "bottom auto"
        });
    </script>
    <!--Script selector de fecha modal----------------------------------------------------->
    <!--SweetAlert----------------------------------->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/MostrarAlertas.js"></script>
    <!--SweetAlert----------------------------------->

    <!--Scripts-------------------------------------------------------------------------->
</body>

</html>