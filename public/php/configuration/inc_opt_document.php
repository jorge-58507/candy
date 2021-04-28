<div class="row mhp_100">
  <div class="col s12 m12 l3 br_1 border_gray py_5 ">
    <a id="btn_opt_drug"      class="waves-effect waves-light btn btn-large teal col s12">Medicamentos</a>
    <a id="btn_opt_treatment" class="waves-effect waves-light btn btn-large col s12 blue lighten-2">Tratamientos</a>
    <a id="btn_opt_order" class="waves-effect waves-light btn btn-large teal col s12">Ordenes</a>
  </div>
  <div class="col s12 m12 l9 py5" id="container_render">
  </div>
  <div>
    <!-- ################   MODALS   ####################### -->
        <!-- Modal Structure  NEW DOSE-->
    <div id="drug_new_dose" class="modal">
      <div class="modal-content">
        <h4>Nueva Dosis</h4>
        <div class="input-field col s10">
          <input id="txt_modal_dose" name="txt_modal_dose" type="text" class="">
          <label for="txt_modal_dose">Dosis</label>
        </div>
      </div>
      <div class="modal-footer">
        <a href="" class="modal-close waves-effect waves-green btn teal" onclick="cls_recipe.drug_save_dose(event)">Guardar</a>
      </div>
    </div>
    <!-- Modal Structure -->
        <!-- Modal Structure  NEW FRECUENCY-->
    <div id="drug_new_frecuency" class="modal">
      <div class="modal-content">
        <h4>Nueva Frecuencia</h4>
        <div class="input-field col s10">
          <input id="txt_modal_frecuency" name="txt_modal_frecuency" type="text" class="">
          <label for="txt_modal_frecuency">Frecuencia</label>
        </div>
      </div>
      <div class="modal-footer">
        <a href="" class="modal-close waves-effect waves-green btn teal" onclick="cls_recipe.drug_save_frecuency(event)">Guardar</a>
      </div>
    </div>
    <!-- Modal Structure -->

  </div>
</div>