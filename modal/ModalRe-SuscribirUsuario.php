<?php 
date_default_timezone_set('America/Caracas');
$fechaActual = date('Y-m-d');
echo $fechaActual;


?>
<div class="modal fade" id="ModalRe-SuscribirUsuario<?php echo $mostrar['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #ffc107  !important;">
        <h1 class="modal-title fs-5" style="color: #fff;" id="exampleModalLabel">Re-Suscribir Usuario</h1>
        <button type="button" onclick="limpiarFormulario();" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="FormularioEditarUsuario" action="../funcionalidad/ReSuscribirUsuario.php" method="POST">
          <div class="row">
            <div class="col-5">
              <input type="text" class="form-control" id="id"  name="id" value="<?php echo $mostrar['id'] ?>" required hidden>
              <label for="recipient-name" class="col-form-label fw-semibold">Nombre:</label>
              <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $mostrar['Nombre_Cliente'] ?>" required minlength="4" maxlength="25">
            </div>
            <div class="col-3">
              <label for="recipient-name" class="col-form-label fw-semibold" id="MensajeAyuda">Mesa:</label>
              <input type="number" class="form-control" id="mesa" name="mesa" value="<?php echo $mostrar['Mesa']; ?>" min="0" max="412" step="1" required>
            </div>
            <div class="col-4">
              <label for="recipient-name" class="col-form-label fw-semibold">Tipo:</label>
              <select class="form-select" id="tipo" name="tipo" required disabled>
                <option selected><?php if ($almacen_datos_usuarios_creados['Tipo'] == "1s") {
                                    echo "1 semana";
                                  } else {
                                    echo "1 mes";
                                  } ?></option>

              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-3">
              <label for="recipient-name" class="col-form-label fw-semibold">Usuario:</label>
              <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $almacen_datos_usuarios_creados['Usuario'] ?>" required minlength="2" maxlength="8" disabled>
            </div>
            <div class="col-3">
              <label for="recipient-name" class="col-form-label fw-semibold">Contraseña:</label>
              <input type="text" class="form-control" id="contra" name="contra" value="<?php echo $almacen_datos_usuarios_creados['Contraseña'] ?>" required minlength="2" maxlength="8" disabled>
            </div>

            <div class="col-6">
              <label for="recipient-name" class="col-form-label fw-semibold">Fecha Inicial y Fecha Final</label>
              <div class="input-daterange input-group" id="DPEditarUsuario">
                <input type="text" class="input-sm form-control" name="inicio" value="<?php echo $fechaActual?>" autocomplete="off" required />
                <span class="input-group-addon">-</span>
                <input type="text" class="input-sm form-control" name="final" value="<?php if ($almacen_datos_usuarios_creados['Tipo'] == "1s") {
                                    echo date('Y-m-d',strtotime($fechaActual."+ 7 days"));
                                  } else {
                                    echo date('Y-m-d',strtotime($fechaActual."+ 31 days"));
                                  } ?>" autocomplete="off" required />
              </div>
            </div>

          </div>

          <div class="mb-3">
            <label for="message-text" class="col-form-label">Nota:</label>
            <textarea class="form-control" id="nota" name ="nota" value="" required minlength="2" maxlength="50"><?php echo $mostrar['Nota']; ?></textarea>
          </div>
        
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-info" id="reiniciarusuario">Reiniciar Usuario</button>

        <button type="button" onclick="limpiarFormulario();" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Re-Suscribir</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!--Script de tippy para toolstip en la palabra mesa---------------------------------------->
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
<script>
  tippy('#MensajeAyuda', {
    content: 'Coloca 0 para un lugar fuera de la cancha',
  });
</script>

<!--Script de tippy para toolstip en la palabra mesa---------------------------------------->
<script src="../js/LimpiarFormulario.js"></script>
<script src="../js/MostrarAlertas.js"></script>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<!--JS PARTA EJECUTAR REINICIO DE USUARIO ------------------------->
<script>
  $("#reiniciarusuario").click(function(e) {

    const Datos = { // almacenara en esta variable los datos del input nombre y descripcion
      Usuario: $('#usuario').val(), // obtiene el valor donde el input con id Nombre
    };
    $.post('../funcionalidad/ResetearUsersMikrotik.php', Datos, function(respuesta) {
      //alert(respuesta);
      if (respuesta == "ejecutado") {
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Usuario reiniciado en el MIKROTIK con exito!!',
          showConfirmButton: false,
          timer: 1500
        })
      } else {
        Swal.fire({
          position: 'center',
          icon: 'error',
          title: 'Reiniciado Incorrecto verifique los datos!!',
          showConfirmButton: false,
          timer: 1500
        })
      }

    });
  });
</script>


<!--JS PARTA EJECUTAR REINICIO DE USUARIO ------------------------->