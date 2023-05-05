function AlertarEliminar() {
Swal.fire({
    title: 'Eliminar Registro',
    text: "Al darle clik estaras eliminando el registro del usuario de la DB",
    icon: 'error',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, Eliminar!'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire(
        'Eliminado!',
        'El registro se elimino con exito.',
        'success'
      )
    }
  })
}
function AlertarUsuarioGenerado(){
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Usuario Creado con Exito!',
        showConfirmButton: false,
        timer: 1500
      })
}
function AlertarPausarUsuario() {
    Swal.fire({
        title: 'Pausar Usuario',
        text: "Al darle clik estaras Pausando el usuario",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Pausar!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Pausado!',
            'El usuario se pauso con exito.',
            'success'
          )
        }
      })
    }
    function AlertarEjecutadoCorrectamente(){
      Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Guardado Todo Correctamente',
        showConfirmButton: false,
        timer: 1500
      })
    }
    function AlertarEjecutadoError(){
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Error al Guardar!!',
        showConfirmButton: false,
        timer: 1500
      })
    }
    //############# Sweet Alert DEL REINICIO DE LOS USUARIOS ########################################################################################33
    function AlertaUsuarioReiniciadoMikrotik(){
      Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Usuario reiniciado con exito!!',
        showConfirmButton: false,
        timer: 1500
      })
    }
    function AlertaUsuarioActivoMikrotik(){
      Swal.fire({
        position: 'center',
        icon: 'info',
        title: 'Usuario Activo',
        showConfirmButton: false,
        timer: 1500
      })
    }

    function AlertaSinConexionMikrotik(){
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Error de Conexion Mikrotik',
        showConfirmButton: true,
      })
    }

    function AlertaUsuarioNoColocadoEnTlf(){
      Swal.fire({
        position: 'center',
        icon: 'info',
        title: 'Usuario no Encontrado!',
        showConfirmButton: false,
        timer: 1500
      })
    }

    function AlertaErrorEnDB(){
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Error de Conexion Mikrotik',
        showConfirmButton: true,
      })
    }
//############# Sweet Alert DEL DESCONEXION DE USUARIOS MIKROTIK ########################################################################################33
function AlertaUsuarioDesconectadoMikrotik(){
  Swal.fire({
    position: 'center',
    icon: 'success',
    title: 'Usuario Desconectado con exito!!',
    showConfirmButton: false,
    timer: 1500
  })
}
//############# ALERTA DE ELIMINAR USUARIO AL CERRAR MODAL DE CREACION DE USUARIO ########################################################################################33

function AlertaEliminarUsuario(){
  Swal.fire({
    position: 'center',
    icon: 'success',
    title: 'Usuario eliminado con exito!!',
    showConfirmButton: false,
    timer: 1500
  })
}