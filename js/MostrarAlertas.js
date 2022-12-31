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
    function AlertaUsuarioReiniciadoMikrotik(){
      Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Usuario reiniciado en el MIKROTIK con exito!!',
        showConfirmButton: false,
        timer: 1500
      })
    }
    function AlertaUsuarioNoReiniciadoMikrotik(){
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Reiniciado Incorrecto',
        showConfirmButton: false,
        timer: 1500
      })
    }
