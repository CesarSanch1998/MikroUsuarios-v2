<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
                <li class="nav-item"><a href="../views/Activos.php" class="nav-link">Activos</a></li>
                <li class="nav-item"><a href="../views/Vencidos.php" class="nav-link">Vencidos</a></li>
                <li class="nav-item"><a href="#" class="nav-link active">Deudores</a></li>
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
            </ul>
        </header>
    </div>
    <div class="b-example-divider"></div>
    <!--Cabecera en donde estan las opciones proncipales---------------------------------------->
    <!--Tabla de usuarios----------------------------------------------------------------->
    <div class="container">
        <div class="col-12">
            <h2 class="h2 pb-2 mb-5 text-warning border-bottom border-warning">Usuarios Deudores</h2>
            <table id="TablaDatos" class="table table-striped display responsive nowrap" style="width:100%" data-page-length='50'>
                <thead>
                    <tr>
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
                    <!--PHP OBTENER DATOS DE TABLA EN LA BASE DE DATOS-------------------------------->

                    <!--Finaliza codigo php sin cerrar llaves del while -->
                    <!--Mostrar datos de la tabla con codigo php adentro para obtener cada consulta por separado-->
                    <tr>
                        <td>Prueba</td>
                        <td>000</td>
                        <td>ninguna</td>
                        <td>ninguna</td>
                        <td>abcd</td>
                        <td>1234</td>
                        <td>1 Semana</td>
                        <td><img src="../images/x.png" width="35" height="35"></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalAbonarPago">Abonar Pago</button>
                                <button type="button" href="#" class="btn btn-primary">Otra Opcion</button>

                            </div>
                        </td>

                    </tr>
                    <?php include('../modal/ModalAbonarPago.php'); ?>
                    <!--Mostrar datos de la tabla con codigo php adentro para obtener cada consulta por separado-->


                    <!--PHP OBTENER DATOS DE TABLA EN LA BASE DE DATOS-------------------------------->
                </tbody>
                <tfoot>
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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="../js/bootstrap-datepicker.min.js"></script>

    <!--Script TABLA---------------------------------------------------->
    <script>
        $(document).ready(function() {
            TablaDatos = $('#TablaDatos').DataTable({});
        });
    </script>
    <!--Script TABLA---------------------------------------------------->
    <!--SweetAlert----------------------------------->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/MostrarAlertas.js"></script>
    <!--SweetAlert----------------------------------->

    <!--Scripts-------------------------------------------------------------------------->
</body>

</html>