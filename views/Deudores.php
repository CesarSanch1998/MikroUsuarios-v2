
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.jqueryui.min.css">


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
            <table id="TablaDatos" class="table responsive nowrap" style="width:100%" data-page-length='50'>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nombre</th>
                        <th>Mesa</th>
                        <th>Pagado</th>
                        <th>Pendiente</th>
                        <th>F.Venci</th>
                        <th>AMK</th>
                        <th>Opciones</th>
                    </tr>
                </thead>

                <tfoot>
                    <th>id</th>
                    <th>F.Venci</th>
                    <th>F.Venci</th>
                    <th>F.Venci</th>
                    <th>F.Venci</th>
                    <th>Pendiente</th>
                    <th>AMK</th>
                    <th>Opciones</th>
                </tfoot>
            </table>
        </div>
    </div>
    <!--Tabla de usuarios----------------------------------------------------------------->


    <!--Scripts-------------------------------------------------------------------------->

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.jqueryui.min.js"></script>
    <!--Script TABLA---------------------------------------------------->

    <!--Script TABLA---------------------------------------------------->
    <!--SweetAlert----------------------------------->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/MostrarAlertas.js"></script>


    <!--SweetAlert----------------------------------->
    <script>
        $(document).ready(function() {
            $('#TablaDatos').DataTable({
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function(row) {
                                var data = row.data();
                                return 'Detalles de ' + data['nombre'] + ' / Mesa ' + data['mesa'];
                            }
                        }),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                            tableClass: 'table'
                        })
                    }
                },
                ajax: {
                    url: '/funcionalidad/UsuariosDeudoresMostrar.php',
                    dataSrc: ''
                },
                columns: [{
                        data: 'usu_creado_id'
                    }, {
                        data: 'nombre'
                    },
                    {
                        data: 'mesa'
                    },
                    {
                        data: 'pagado'
                    },
                    {
                        data: 'pendiente'
                    },
                    {
                        data: 'fventa'
                    },
                    {
                        data: function(data, type, JsonResultRow, meta) {
                            return '<img src="../images/x.png"  width="35" height="35">';
                        }
                    },
                    {
                        data: "botonAbonar"
                    }
                    
                ],
                /*
                columnDefs: [{
                    target: 0,
                    visible: false,
                    searchable: false,
                }],*/ //esconder id
            });

        });
    </script>
    
    <!--Scripts-------------------------------------------------------------------------->
</body>

</html>