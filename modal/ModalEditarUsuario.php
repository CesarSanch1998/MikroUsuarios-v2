<div class="modal fade" id="ModalEditarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #ffc107  !important;">
        <h1 class="modal-title fs-5" style="color: #fff; text-align: center;" id="exampleModalLabel">Editar Usuario</h1>
        <button type="button" onclick="limpiarFormulario();" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="FormularioEditarUsuario">
          <div class="row">
            <div class="col-5">
              <label for="recipient-name" class="col-form-label fw-semibold">Nombre:</label>
              <input type="text" class="form-control" id="nombre" required minlength="4" maxlength="25">
            </div>
            <div class="col-3">
              <label for="recipient-name" class="col-form-label fw-semibold" id="MensajeAyuda">Mesa:</label>
              <input type="number" class="form-control" id="mesa" min="0" max="412" step="1" required>
            </div>
            <div class="col-4">
              <label for="recipient-name" class="col-form-label fw-semibold">Tipo:</label>
              <select class="form-select" id="tipo" required>
                <option selected>Elegir</option>
                <option value="1d">1 Dia</option>
                <option value="2d">2 Dias</option>
                <option value="3d">3 Dias</option>
                <option value="1s">1 Semana</option>
                <option value="1m">1 Mes</option>

              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-3">
              <label for="recipient-name" class="col-form-label fw-semibold">Usuario:</label>
              <input type="text" class="form-control" id="nombre" required minlength="2" maxlength="8">
            </div>
            <div class="col-3">
              <label for="recipient-name" class="col-form-label fw-semibold">Contraseña:</label>
              <input type="text" class="form-control" id="mesa" required minlength="2" maxlength="8">
            </div>

            <div class="col-6">
              <label for="recipient-name" class="col-form-label fw-semibold">Fecha Inicial y Fecha Final</label>
              <div class="input-daterange input-group" id="DPEditarUsuario" required>
                <input type="text" class="input-sm form-control" name="start"   />
                <span class="input-group-addon">to</span>
                <input type="text" class="input-sm form-control" name="end"  />
              </div>
            </div>

          </div>

          <div class="mb-3">
            <label for="message-text" class="col-form-label">Nota:</label>
            <textarea class="form-control" id="nota" required minlength="2" maxlength="50"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="limpiarFormulario();" class="btn btn-secondary" data-bs-dismiss="modal" >Cerrar</button>
        <button type="button" class="btn btn-warning">Modificar</button>
      </div>
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