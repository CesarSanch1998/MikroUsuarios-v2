<!--Modal de abonar pago ---------------------------------->
<div class="modal fade" id="ModalAbonarPago" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #ffc107  !important;">
        <h1 class="modal-title fs-5" style="color: #fff;" id="exampleModalLabel">Abonar pago</h1>
        <button type="button" onclick="limpiarFormulario();" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form id="FormularioAbonarPago" >
          <div class="row">
            <div class="col">
              <input type="text" class="form-control" id="id_usuario_creados" name="id_usuario_creados" value="<?php echo $mostrar['Usuarios_Creados_id']; ?>" required hidden>
              <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $mostrar['Nombre_Cliente']; ?>" required hidden>
              <input type="text" class="form-control" id="mesa" name="mesa" value="<?php echo $mostrar['Mesa']; ?>" required hidden>
              <label for="recipient-name" class="col-form-label fw-semibold">Cantidad:</label>
              <input type="number" class="form-control" id="monto" name="monto" min="0" step="0.1" required>
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
                <input class="form-check-input" type="radio" name="PBolivares" id="pagobolivares" required disabled>
                <label class="form-check-label" for="flexRadioDefault2">
                  Bolivares (Bs)
                </label>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="limpiarFormulario();" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" id="abonar" class="btn btn-success">Abonar Pago</button>

      </div>
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

<!--Modal de abonar pago ------------------------------------------------------>

<script src="../js/LimpiarFormulario.js"></script>
<!--SweetAlert----------------------------------->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!--SCRIPT PARA ABONAR PAGO CON AJAX Y MENSAJE DE CONFIRMACION EN SWEETALERT-->

<script>
  $(document).ready(function(){
  $('#FormularioAbonarPago').submit(function(e) {
const Datos = {
  id_usu_creado: $('#id_usuario_creados').val(),
  nombre: $('#nombre').val(),
  mesa: $('#mesa').val(),
  monto: $('#monto').val(),
};
$.post('../funcionalidad/AgregarPago.php', Datos, function(respuesta) { // metodo post del query igualmente funcional que el anterior
  
  
  if (respuesta == "ejecutado") {
    $('#ModalAbonarPago<?php echo $mostrar['id']; ?>').modal('hide');  //cierra modal 
    Swal.fire({
      position: 'center',
      icon: 'success',
      title: 'Pago abonado con exito!!',
      showConfirmButton: true,
      timer: 1500

    })
    $('#FormularioAbonarPago').trigger('reset');
  } else if (respuesta == "monto superior") {
    Swal.fire({
      position: 'center',
      icon: 'error',
      title: 'Problemas!! Monto superior',
      showConfirmButton: false,
      timer: 1500
    })
    $('#FormularioAbonarPago').trigger('reset');
  }

  
  
});


e.preventDefault(); // evita que al darle submit la pagina se refresque sola
});
});
</script>