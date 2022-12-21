<!--Modal de abonar pago ---------------------------------->
<div class="modal fade" id="ModalAbonarPago" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #ffc107  !important;">
        <h1 class="modal-title fs-5" style="color: #fff;" id="exampleModalLabel">Abonar pago</h1>
        <button type="button" onclick="limpiarFormulario();" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="FormularioAbonarPago">
          <div class="row">
            <div class="col">
            <label for="recipient-name" class="col-form-label fw-semibold">Cantidad:</label>
              <input type="number" class="form-control" id="cantidaddinero" min="0" step="0.1" required>
            </div>
            <div class="col">
              <p></p>
              <p></p>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="pagodolares" require>
                <label class="form-check-label" for="flexRadioDefault1">
                  Dolares ($)
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="pagobolivares" require>
                <label class="form-check-label" for="flexRadioDefault2">
                  Bolivares (Bs)
                </label>
              </div>
            </div>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" onclick="limpiarFormulario();" data-bs-target="#ModalAgregarUsuario" data-bs-toggle="modal">Regresar</button>
        <button type="button" class="btn btn-success">Abonar Pago</button>

      </div>
    </div>
  </div>
</div>
<!--Modal de abonar pago ------------------------------------------------------>

<script src="../js/LimpiarFormulario.js"></script>