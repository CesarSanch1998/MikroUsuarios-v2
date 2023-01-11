<?php

?>
<div class="modal fade" id="ModalAgregarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #198754  !important;">
        <h1 class="modal-title fs-5" style="color: #fff;" id="exampleModalLabel">Agregar Nuevo Usuario</h1>
        <button type="button" onclick="limpiarFormulario();" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="FormularioAgregarUsuario" action="../funcionalidad/AgregarUsuario.php" method="POST">
          <div class="row">
            <div class="col-5">
              <label for="recipient-name" class="col-form-label fw-semibold">Nombre:</label>
              <input type="text" class="form-control" name="nombre" required minlength="4" maxlength="25">
            </div>
            <div class="col-3">
              <label for="recipient-name" class="col-form-label fw-semibold" id="MensajeAyuda">Mesa:</label>
              <input type="number" class="form-control" name="mesa" min="0" max="412" step="1" required>
            </div>
            <div class="col-4">
              <label for="recipient-name" class="col-form-label fw-semibold">Tipo:</label>
              <select class="form-select" name="perfiltiempo" required>
                <option selected>Elegir</option>
                <option value="1s">1 Semana</option>
                <option value="1m">1 Mes</option>

              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-3">
              <label for="recipient-name" class="col-form-label fw-semibold">Usuario:</label>
              <input type="text" class="form-control" name="usuario" value="" required minlength="2" maxlength="6">
            </div>
            <div class="col-3">
              <label for="recipient-name" class="col-form-label fw-semibold">Contraseña:</label>
              <input type="text" class="form-control" name="contra" value="" required minlength="2" maxlength="6">
            </div>

            <div class="col-6">
              <label for="recipient-name" class="col-form-label fw-semibold">Fecha Inicial y Fecha Final</label>
              <div class="input-daterange input-group" name="DPAgregarUsuario" required>
                <input type="text" class="input-sm form-control" name="inicio" name="start" autocomplete="off"/>
                <span class="input-group-addon">-</span>
                <input type="text" class="input-sm form-control" name="final" name="end" autocomplete="off"/>
              </div>
            </div>

          </div>

          <div class="mb-3">
            <label for="message-text" class="col-form-label">Nota:</label>
            <textarea class="form-control" name="nota" required minlength="0" maxlength="50"></textarea>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" onclick="limpiarFormulario();" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#GenerarUsuarioAleatorio">Generar Usuario</button>
        <button type="submit" class="btn btn-success">Guardar Informacion</button>

      </div>
      </form>
    </div>
  </div>
</div>


<!--Modal de crear usuario nuevo aleatorio ---------------------------------->
<div class="modal fade" id="GenerarUsuarioAleatorio" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #0d6efd  !important;">
        <h1 class="modal-title fs-5" style="color: #fff;" id="exampleModalLabel">Generar Usuario Aleatorio</h1>
        <button type="button" onclick="limpiarFormulario();" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="FormularioCrearUsuarioAleatorio">
          <div class="row">
            <label for="recipient-name" class="col-form-label fw-semibold">Longitud Datos:</label>
            <select class="form-select" id="longituddatos" required>
              <option selected>Longitud</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
            </select>
          </div>
          <div class="row">
            <label for="recipient-name" class="col-form-label fw-semibold">Formato de Datos:</label>
            <select class="form-select" id="formatodatos" required>
              <option selected>Formato</option>
              <option value="1">abcde</option>
              <option value="2">ABCDE</option>
              <option value="3">a1b2c3</option>
              <option value="4">12345</option>
            </select>
          </div>
          <div class="row">
            <label for="recipient-name" class="col-form-label fw-semibold">Limite de Tiempo:</label>
            <div class="input-group mb-3">
              <input type="number" class="form-control" placeholder="Dias" min="0" max="31" step="1">
              <span class="input-group-text">/</span>
              <input type="number" class="form-control" placeholder="Horas" min="0" max="23" step="1" required>
            </div>
          </div>
          <div class="row">
            <label for="recipient-name" class="col-form-label fw-semibold">Perfil de Tiempo:</label>
            <select class="form-select" id="perfiltiempo" required>
              <option selected>Elige el perfil..</option>
              <!--Obtener Perfil de tiempo del mikrotik y mostralo en el select-->

              <?php include('../funcionalidad/PerfildeTiempoMikrotik.php');
              include('../funcionalidad/UsuariosAleatorios.php');

              for ($i = 0; $i < $getuserprofile; $i++) {
                $almacenarperfilesnombres = $userprofile[$i]['name'];
              ?>
                <option value="<?php echo $almacenarperfilesnombres ?>"><?php echo $almacenarperfilesnombres ?></option>
              <?php
              }
              ?>

            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" onclick="limpiarFormulario();" data-bs-target="#ModalAgregarUsuario" data-bs-toggle="modal">Regresar</button>
        <button type="button" class="btn btn-success">Generar</button>

      </div>
    </div>
  </div>
</div>
<?php

?>
<!--Modal de crear usuario nuevo aleatorio ------------------------------------------------------>


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