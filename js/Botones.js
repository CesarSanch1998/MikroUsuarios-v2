// Click Boton Agregar tabla usuarios activos ------------------

$(document).on("click", ".btnEditar", function () {
  var id_usuario = this.id;
  console.log(id_usuario);
  $("#ModalQR_Mostrar").modal("show"); //Abre modal
  const Datos = {
    id_usuario: id_usuario,
  };
  // $.post('./BackEnd/MostrarQr_Animal.php', Datos, function(
  //     respuesta) { // metodo post del query igualmente funcional que el anterior

  //     $('#ModalEditarInventarioRebaño').modal('hide'); //Abre modal
  //     $('#Mostrar_Qr_Animal').html(respuesta);
  //     $('#id_animal_qr').val(id_animal);

  // });
});
// CLICK BOTON RESUSCRIBIR TABLA VENCIDOS ------------------------------ ------------------

$(document).on("click", ".btnResuscribir", function () {
  //     // var moment = require('moment-with-locales')

  const Datos = {
    id_Usuario: this.id,
  };

  $("#ModalReSuscribirUsuario").modal("show"); //Abre modal

  $.post(
    "../funcionalidad/Consulta_Modal_Resuscribir.php",
    Datos,
    function (respuesta) {
      // metodo post del query igualmente funcional que el anterior

      let json = JSON.parse(respuesta); //Almacena el resultado del json en el let json
      json.forEach((json) => {
        //Se asignan los valores obtendios en json a su respectivo input

        $("#RS_id").val(json.id);
        $("#RS_nombre").val(json.Nombre_Cliente);
        $("#RS_mesa").val(json.Mesa);
        $("#RS_usuario").val(json.Usuario);
        $("#RS_contra").val(json.Contraseña);
        $("#RS_nota").val(json.Nota);
        $("#RS_id_usuario_creado").val(json.Usuarios_Creados_id);

        var Tipo = json.Tipo;
        switch (Tipo) {
          case "1s":
            $("#RS_tipo").val(Tipo);

            break;

          case "1m":
            $("#RS_tipo").val(Tipo);
            break;

          case "1d":
            $("#RS_tipo").val(Tipo);
            break;
        }
      });
    }
  );
});

// BOTON INFORMACION ADICIONAL DE LA TABLA VENCIDOS --------------------------------------------
$(document).on("click", ".btnInformacion", function () {
  const Datos = {
    id_Usuario: this.id,
  };
  $("#ModalInformacionAdicionalVencidos").modal("show"); //Abre modal

  $.post(
    "../funcionalidad/Consulta_InformacionAdicionalVencidos.php",
    Datos,
    function (respuesta) {
      // metodo post del query igualmente funcional que el anterior

      let json = JSON.parse(respuesta); //Almacena el resultado del json en el let json
      json.forEach((json) => {
        //Se asignan los valores obtendios en json a su respectivo input

        // $('#id').val(json.id);
        $("#IA_nombre").val(json.NombreCliente);
        $("#IA_mesa").val(json.Mesa);
        $("#IA_mac").val(json.Mac);
        $("#IA_ip").val(json.IP);
        $("#IA_stl").val(json.Tiempo_Restante);
        $("#IA_tit").val(json.Tiempo_Inactivo);
        $("#IA_usuario").val(json.UsuarioMK);
        var $icono = json.Icono;
        if ($icono == "s") {
          document.getElementById("icono").innerHTML =
            '<i class="bi bi-check-circle" style="font-size: 2em; color: green;"></i>';
        } else {
          document.getElementById("icono").innerHTML =
            '<i class="bi bi-x-circle" style="font-size: 2em; color: red;"></i>';
        }

        console.log(respuesta);
      });
    }
  );
});

// BOTON REINICIAR USUARIOS MIKROTIK DE EL MODAL RESUSCRIBIR  --------------------------------------------
$(document).on("click", ".btnReiniciarUsuarioMk", function () {
  const Datos = {
    usuario: $("#RS_usuario").val(),
  };
  $('#ModalCargando').modal('show');
  console.log('Cargando')
  $('#ModalReSuscribirUsuario').modal('hide');
  $.post(
    "../funcionalidad/ResetearUsersMikrotik.php",
    Datos,
    function (respuesta) {
      // metodo post del query igualmente funcional que el anterior
      console.log(respuesta);
      let json = JSON.parse(respuesta); //Almacena el resultado del json en el let json
      json.forEach((json) => {
        //Se asignan los valores obtendios en json a su respectivo input
        
        switch (json.UsuarioMK) {
          case "Usuario Activo":
            $('#ModalCargando').modal('hide');
            $('#ModalReSuscribirUsuario').modal('show');
            AlertaUsuarioActivoMikrotik();
            break;

          case "Sin Conexion":
            $('#ModalCargando').modal('hide');
            $('#ModalReSuscribirUsuario').modal('show');
            AlertaSinConexionMikrotik();
            break;
          case "Reseteado":
            $('#ModalCargando').modal('hide');
            $('#ModalReSuscribirUsuario').modal('show');
            AlertaUsuarioReiniciadoMikrotik();
            break;
          default:
            break;
        }
      });
    }
  );
});

// BOTON DESCONECTAR USUARIOS DEL MIKROTIK  --------------------------------------------
$(document).on("click", ".btnDesconectarUsuarioMK", function () {
  Swal.fire({
    title: "Desconectar Usuario",
    text: "Al darle clik el usuario sera desconectado del Mikrotik",
    icon: "info",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Si, Seguro!",
    cancelButtonText: "Mejor No!",
  }).then((result) => {
    if (result.isConfirmed) {
      const Datos = {
        usuario: $("#IA_usuario").val(),
      };

      $.post(
        "../funcionalidad/DesconectarUsuarioDelMikrotik.php",
        Datos,
        function (respuesta) {
          // metodo post del query igualmente funcional que el anterior

          let json = JSON.parse(respuesta); //Almacena el resultado del json en el let json
          json.forEach((json) => {
            //Se asignan los valores obtendios en json a su respectivo input

            switch (json.UsuarioMK) {
              case "Usuario No Encontrado":
                AlertaUsuarioNoColocadoEnTlf();
                break;

              case "Sin Conexion":
                AlertaSinConexionMikrotik();
                break;
              case "Usuario Desconectado":
                AlertaUsuarioDesconectadoMikrotik();
                break;
              default:
                break;
            }
          });
        }
      );
    }
  });
});

// BOTON DE ENVIAR FORMULARIA PARA RESUSCRIBIR EN LA TABLA DE VENCIDOS -----------
$("#FormularioReSuscribirUsuario").submit(function (e) {
  e.preventDefault();

  const Datos = {
    RS_id: $("#RS_id").val(),
    RS_nombre_cliente: $("#RS_nombre").val(),
    RS_mesa: $("#RS_mesa").val(),
    RS_Finicio: $("#RS_inicio").val(),
    RS_Ffinal: $("#RS_final").val(),
    RS_nota: $("#RS_nota").val(),
    RS_id_usuario_creado: $("#RS_id_usuario_creado").val(),
    RS_usuario: $("#RS_usuario").val(),
    RS_tipo: $("#RS_tipo").val(),
  };
  $('#ModalCargando').modal('show');
  console.log('Cargando')
  $('#ModalReSuscribirUsuario').modal('hide');

  $.post(
    "../funcionalidad/ReSuscribirUsuario.php",
    Datos,
    function (respuesta) {
      // metodo post del query igualmente funcional que el anterior

      console.log(respuesta);
      //document.getElementById("task-form").reset();  // este y el de abajo son metodos para resetear el formulario cuando se hace un submit

      let json = JSON.parse(respuesta); //Almacena el resultado del json en el let json
      json.forEach((json) => {
        //Se asignan los valores obtendios en json a su respectivo input

        switch (json.Resultado) {
          case "Usuario No Colocado":
            $('#ModalCargando').modal('hide');
            AlertaUsuarioNoColocadoEnTlf();
            $('#ModalReSuscribirUsuario').modal('show');
            break;

          case "Sin Conexion":
            $('#ModalCargando').modal('hide');
            AlertaSinConexionMikrotik();
            $('#ModalReSuscribirUsuario').modal('show');
            break;
          case "Ejecutado":
            $('#ModalCargando').modal('hide');
            AlertarEjecutadoCorrectamente();
            document.getElementById("FormularioReSuscribirUsuario").reset();
            $("#ModalReSuscribirUsuario").modal("hide");
            break;
          default:
            AlertaErrorEnDB();
            break;
        }
      });
    }
  );

  // Busca la tabla Inventario Rebaño y la recarga
  $("#TablaVencidos").DataTable().ajax.reload();
  //  RESETEAR FORMULARIO ------------------------------------------
});

// Click Boton Generar usuario Aleatorio tabla usuarios activos ------------------------------

$("#FormularioCrearUsuarioAleatorio").submit(function (e) {
  e.preventDefault();

  const Datos = {
    LongitudDatos: $("#longituddatos").val(),
    FormatoDatos: $("#formatodatos").val(),
    TipoUsuario: $("#TipoUsuario").val(),
    TiempoDias: $("#TiempoDias").val(),
    TiempoHoras: $("#TiempoHoras").val(),
  };
  $.post(
    "../funcionalidad/UsuariosAleatorios.php",
    Datos,
    function (respuesta) {
      // metodo post del query igualmente funcional que el anterior

      console.log(respuesta);
      let json = JSON.parse(respuesta); //Almacena el resultado del json en el let json
      json.forEach((json) => {
        //Se asignan los valores obtendios en json a su respectivo input

        $("#GenerarUsuarioAleatorio").modal("hide");
        $("#N_usuario").val(json.UsuarioCreado);
        $("#N_contra").val(json.ContraseñaCreada);
        $("#N_id_usuario_creado").val(json.id_UsuarioCreado);
        $("#ModalAgregarUsuario").modal("show");
      });
      console.log(respuesta);
    }
  );
  //  RESETEAR FORMULARIO ------------------------------------------
  document.getElementById("FormularioCrearUsuarioAleatorio").reset();
});

// CERRAR MODAL USUARIO NUEVO -----------------------------------------
$(document).on("click", ".btnCerrarModalAgregarUsuario", function () {
  if ($("#N_usuario").val() != "" && $("#N_contra").val() != "") {
    Swal.fire({
      title: "Cancelar Usuario Creado",
      text: "Al darle clik el usuario creado se eliminara del Mikrotik",
      icon: "info",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Si, Salir!",
      cancelButtonText: "Seguir Editando",
    }).then((result) => {
      if (result.isConfirmed) {
        const Datos = {
          id_UsuarioCreado: $("#N_id_usuario_creado").val(),
          N_usuario: $("#N_usuario").val(),
        };
        console.log(Datos);
        $.post(
          "../funcionalidad/EliminarUsuarioCreado.php",
          Datos,
          function (respuesta) {
            // metodo post del query igualmente funcional que el anterior
            if (respuesta == "Ejecutado") {
              document.getElementById("FormularioAgregarUsuario").reset();
              AlertaEliminarUsuario();
              $("#ModalAgregarUsuario").modal("hide");
            } else {
            }
          }
        );
      }
    });
  } else {
    document.getElementById("FormularioAgregarUsuario").reset();
    $("#ModalAgregarUsuario").modal("hide");
  }
});

// #####################################################################################################################################
// #########BOTON ELIMINAR REGISTRO DE LA TABLA########################################################################

// BOTON ELIMINAR DE VENCIDOS ------------ -------------------------------------
function EliminarRegistroTablaVencidos(id_Usuario) {
  Swal.fire({
    title: "Estas Seguro?",
    text: "Estas a punto de eliminar al Usuario del Registro!",
    icon: "error",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      const Datos = {
        id_Usuario: id_Usuario,
      };
      $.post(DirEliminarRegistro, Datos, function (respuesta) {
        // metodo post del query igualmente funcional que el anterior
        console.log(respuesta);
        if (respuesta == "Ejecutado") {
          Swal.fire(
            "Eliminado!",
            "La Maquinaria fue eliminado de la Base de Datos por completo.",
            "success"
          );
          // Busca la tabla Maquinaria y la recarga
          $("#InventarioMaquina").DataTable().ajax.reload();
        } else {
          Swal.fire("ERROR!", "El registro no se elimino.", "error");
        }
      });
    }
  });
}

//   ##############################################################################################################################
// ################### BOTONES TABLAS DEUDORES ##############################################################################3

// BOTON ABONAR PAGO --------------------------------------------
$(document).on("click", ".btnAbonarPago", function () {
  const id_tabla_deudores = this.id;

  $("#ModalAbonarPago").modal("show"); //Abre modal
  $("#id_tabla_deudores").val(id_tabla_deudores);
});

// CLICK BOTON ENVIAR FORMULARIO PARA REGISTRAR PAGO ------------------------------

$("#ModalAbonarPago").submit(function (e) {
  e.preventDefault();

  const Datos = {
    id_tabla_deudores: $("#id_tabla_deudores").val(),
    Monto: $("#monto").val(),
  };
  console.log(Datos);
  $.post("../funcionalidad/AgregarPago.php", Datos, function (respuesta) {
    // metodo post del query igualmente funcional que el anterior

    let json = JSON.parse(respuesta); //Almacena el resultado del json en el let json
    json.forEach((json) => {
      //Se asignan los valores obtendios en json a su respectivo input

      if ((json.Resultado = "Ejecutado")) {
        AlertarEjecutadoCorrectamente();
      } else {
        AlertarEjecutadoError();
      }
    });
    $("#ModalAbonarPago").modal("hide");
    $("#TablaDeudores").DataTable().ajax.reload();
    // console.log(respuesta);
  });
  //  RESETEAR FORMULARIO ------------------------------------------
  document.getElementById("ModalAbonarPago").reset();
});

// BOTON DE ENVIAR FORMULARIA PARA SUSCRIBIR USUARIO NUEVO ----------------------
$("#FormularioAgregarUsuario").submit(function (e) {
  e.preventDefault();

  const Datos = {
    N_nombre: $("#N_nombre").val(),
    N_mesa: $("#N_mesa").val(),
    N_inicio: $("#N_inicio").val(),
    N_final: $("#N_final").val(),
    N_nota: $("#N_nota").val(),
    N_id_usuario_creado: $("#N_id_usuario_creado").val(),
    N_perfiltiempo: $("#N_perfiltiempo").val(),
    N_usuario: $("#N_usuario").val(),
  };

  $.post(
    "../funcionalidad/SuscribirUsuarioNuevo.php",
    Datos,
    function (respuesta) {
      // metodo post del query igualmente funcional que el anterior

      console.log(respuesta);
      //document.getElementById("task-form").reset();  // este y el de abajo son metodos para resetear el formulario cuando se hace un submit

      let json = JSON.parse(respuesta); //Almacena el resultado del json en el let json
      json.forEach((json) => {
        //Se asignan los valores obtendios en json a su respectivo input

        switch (json.Resultado) {
          case "Usuario No Colocado":
            AlertaUsuarioNoColocadoEnTlf();
            break;

          case "Sin Conexion":
            AlertaSinConexionMikrotik();
            break;
          case "Ejecutado":
            AlertarEjecutadoCorrectamente();
            document.getElementById("FormularioAgregarUsuario").reset();
            $("#ModalAgregarUsuario").modal("hide");
            // Busca la tabla Inventario Rebaño y la recarga
            $("#TablaActivos").DataTable().ajax.reload();
            break;
          default:
            AlertaErrorEnDB();
            break;
        }
      });
    }
  );

  //  RESETEAR FORMULARIO ------------------------------------------
});

// #############################################################################################################################
// ############BOTONES DE ELIMINAR REGISTRO DE USUARIO Y PERSONA EN LA DB Y MIKROTIK ###################################

// BOTON ELIMINAR REGISTROS VENCIDOS-------------------------------------
$(document).on("click", ".btnEliminarVencidos", function () {
    Swal.fire({
      title: "Estas Seguro?",
      text: "Estas a punto de eliminar este cliente y usuario?!",
      icon: "error",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Eliminar",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {

        const Datos = {
            id_Usuario_Vencido: this.id,
        };

        $.post('../funcionalidad/BotonBorrar.php', Datos, function (respuesta) {
          // metodo post del query igualmente funcional que el anterior
          console.log(respuesta);

          if (respuesta == "Ejecutado") {
            Swal.fire(
              "Eliminado!",
              "El Usuario y Cliente fue eliminado por completo.",
              "success"
            );
            // Busca la tabla Inventario Rebaño y la recarga
            $("#Inventario_Rebaño").DataTable().ajax.reload();
          } else {
            Swal.fire("ERROR!", "El registro no se elimino.", "error");
          }
        });
      }
    });
});

// BOTON ELIMINAR REGISTROS ACTIVOS-------------------------------------
$(document).on("click", ".btnEliminarActivos", function () {
  Swal.fire({
    title: "Estas Seguro?",
    text: "Estas a punto de eliminar este cliente y usuario?!",
    icon: "error",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Eliminar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {

      const Datos = {
          id_Usuario_Vencido: this.id,
      };

      $.post('../funcionalidad/BotonBorrar.php', Datos, function (respuesta) {
        // metodo post del query igualmente funcional que el anterior
        console.log(respuesta);

        if (respuesta == "Ejecutado") {
          Swal.fire(
            "Eliminado!",
            "El Usuario y Cliente fue eliminado por completo.",
            "success"
          );
          // Busca la tabla Inventario Rebaño y la recarga
          $("#Inventario_Rebaño").DataTable().ajax.reload();
        } else {
          Swal.fire("ERROR!", "El registro no se elimino.", "error");
        }
      });
    }
  });
});


// ##############################################################################################################################3
// BOTON INFORMACION ADICIONAL DE LA TABLA ACTIVOSSS --------------------------------------------
$(document).on("click", ".btnInformacion", function () {
  const Datos = {
    id_Usuario: this.id,
  };
  $("#ModalInformacionAdicionalActivos").modal("show"); //Abre modal

  $.post(
    "../funcionalidad/Consulta_InformacionAdicionalActivos.php",
    Datos,
    function (respuesta) {
      // metodo post del query igualmente funcional que el anterior

      let json = JSON.parse(respuesta); //Almacena el resultado del json en el let json
      json.forEach((json) => {
        console.log(respuesta)
        //Se asignan los valores obtendios en json a su respectivo input

        // $('#id').val(json.id);
        $("#IA_nombre").val(json.NombreCliente);
        $("#IA_mesa").val(json.Mesa);
        $("#IA_mac").val(json.Mac);
        $("#IA_ip").val(json.IP);
        $("#IA_stl").val(json.Tiempo_Restante);
        $("#IA_tit").val(json.Tiempo_Inactivo);
        $("#IA_usuario").val(json.UsuarioMK);
        var $icono = json.Icono;
        if ($icono == "s") {
          document.getElementById("icono").innerHTML =
            '<i class="bi bi-check-circle" style="font-size: 2em; color: green;"></i>';
        } else {
          document.getElementById("icono").innerHTML =
            '<i class="bi bi-x-circle" style="font-size: 2em; color: red;"></i>';
        }

        console.log(respuesta);
      });
    }
  );
});

// ##############################################################################################################################3
// BOTON ACTUALIZAR TABLA VENCIDOS DE USUARIOS ACTIVOS --------------------------------------------

