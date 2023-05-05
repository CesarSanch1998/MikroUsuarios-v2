$(document).ready(function () {
// TABLA DE USUARIOS ACTIVOS ---------------------------------------
    var Tabla = $('#TablaActivos').DataTable({
        ajax: {
            url: '../funcionalidad/Consulta_Usuarios_Activos.php',
            dataSrc: '',
        },
        // Aqui definimos caracteristicas de la tabla y 
        // evitamos que la columna 0 y la 10 sean buscables y no se puedan ordenar
        columnDefs: [
            { width: "15%", targets: 0 }, //Nombre
            { width: "10%", targets: 1 }, //Mesa
            { width: "10%", targets: 2 }, //Usuario
            { width: "10%", targets: 3 }, //F.Venta
            { width: "45%", targets: 4 }, //Nota
            { width: "10%", targets: 5 }  //Opciones
          ],
        columns: [
            {
                data: 'Nombre_Cliente'
            },
            {
                data: 'Usuario'
            },
            {
                data: 'Fecha_Venta'
            },
            {
                data: 'Mesa'
            },
            {
                data: 'Nota'
            },
            {
                data: 'Opciones'
            },
        ],
        language: {
            url: '../lib/es-ES.json'
        },
        lengthMenu: [
            [5, 10, 15, 20, 25],
            ['5 Filas', '10 Filas', '15 Filas', '20 Filas', '25 Filas']
        ],
    });

    // TABLA USUARIOS VENCIDOS ----------------------------------------------------------
    var Tabla = $('#TablaVencidos').DataTable({
        ajax: {
            url: '../funcionalidad/Consulta_Usuarios_Vencidos.php',
            dataSrc: '',
        },
        // Aqui definimos caracteristicas de la tabla y 
        // evitamos que la columna 0 y la 10 sean buscables y no se puedan ordenar
        columnDefs: [
            { width: "15%", targets: 0 }, //Nombre
            { width: "10%", targets: 1 }, //Mesa
            { width: "10%", targets: 2 }, //Usuario
            { width: "10%", targets: 3 }, //F.Venta
            { width: "45%", targets: 4 }, //Nota
            { width: "10%", targets: 5 }  //Opciones
          ],
        columns: [
            {
                data: 'Nombre_Cliente'
            },
            {
                data: 'Usuario'
            },
            {
                data: 'Fecha_Venta'
            },
            {
                data: 'Mesa'
            },
            {
                data: 'Nota'
            },
            {
                data: 'Opciones'
            },
        ],
        language: {
            url: '../lib/es-ES.json'
        },
        lengthMenu: [
            [5, 10, 15, 20, 25],
            ['5 Filas', '10 Filas', '15 Filas', '20 Filas', '25 Filas']
        ],
    });



// TABLA USUARIOS DEUDORES ------------------------------------------

    $('#TablaDeudores').DataTable({
        ajax: {
            url: '../funcionalidad/Consulta_Usuarios_Deudores.php',
            dataSrc: ''
        },
        // Aqui definimos caracteristicas de la tabla y 
        // evitamos que la columna 0 y la 10 sean buscables y no se puedan ordenar
        columnDefs: [
            { width: "15%", targets: 0 }, //Nombre
            { width: "10%", targets: 1 }, //Mesa
            { width: "10%", targets: 2 }, //F.Venta
            { width: "10%", targets: 3 }, //Pagado
            { width: "10%", targets: 4 }, //Pendiente
            { width: "45%", targets: 5 }  //Opciones
          ],
        columns: [ {
                data: 'Nombre_Cliente'
            },
            {
                data: 'Mesa'
            },
            {
                data: 'Fecha_Venta'
            },
            {
                data: 'Pagado'
            },
            {
                data: 'Pendiente'
            },
            
            {
                data: 'BotonAbonar'
            }
            
        ],
        language: {
            url: '../lib/es-ES.json'
        },
        lengthMenu: [
            [5, 10, 15, 20, 25],
            ['5 Filas', '10 Filas', '15 Filas', '20 Filas', '25 Filas']
        ],
       
    });

});
       

