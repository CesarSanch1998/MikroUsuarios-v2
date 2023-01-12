<!--Modal de abonar pago ---------------------------------->
<div class="modal fade" id="ModalAbonarPago<?php echo $mostrar['id'];?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #ffc107  !important;">
        <h1 class="modal-title fs-5" style="color: #fff;" id="exampleModalLabel">Abonar pago</h1>
        <button type="button" onclick="limpiarFormulario();" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
        <form id="FormularioAbonarPago" action="../funcionalidad/AgregarPago.php" method="POST">
          <div class="row">
            <div class="col">
            <input type="number" class="form-control" name="id" id="id" value="<?php echo $mostrar['id'];?>" required hidden>

            <label for="recipient-name" class="col-form-label fw-semibold">Cantidad:</label>
              <input type="number" class="form-control" name="monto" id="monto" min="0" step="0.1" required>
            </div>
            <div class="col">
              <p></p>
              <p></p>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="PDolares" id="pagodolares" required>
                <label class="form-check-label" for="flexRadioDefault1">
                  Dolares ($)
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="PBolivares" id="pagobolivares" require disabled>
                <label class="form-check-label" for="flexRadioDefault2">
                  Bolivares (Bs)
                </label>
              </div>
            </div>
          </div>

        
      </div>
      <div class="modal-footer">
      <button type="button" onclick="limpiarFormulario();" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" id="AbonarPago" class="btn btn-success">Abonar Pago</button>

      </div>
      </form>
    </div>
  </div>
</div>
<!--Modal de abonar pago ------------------------------------------------------>

<script src="../js/LimpiarFormulario.js"></script>
