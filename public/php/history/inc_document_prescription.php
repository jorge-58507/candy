            <div class="row">
              <div class="col s4">
                <div class="row">
                  <div class="input-field col s10">
                    <input id="txt_recipe_medicine" type="text" onkeyup="cls_document.filter_medicine(this.value)">
                    <label for="txt_recipe_medicine">Medicamentos</label>
                  </div>
                  <div class="col s2 pt_10">
                    <a id="btn_medicine_plus" class="btn-floating waves-effect waves-light btn btn-small modal-trigger" onclick="cls_recipe.new_medicine('txt_recipe_medicine','txt_modal_document_medicine')" href="#document_medicine_modal"><i class="fa fa-plus left"></i></a>
                    <!-- Modal Structure MEDICINE -->
                    <div id="document_medicine_modal" class="modal">
                      <div class="modal-content">
                        <h4>Nuevo Medicamento</h4>
                        <div class="input-field col s10">
                          <input id="txt_modal_document_medicine" name="txt_modal_document_medicine" type="text" class="">
                          <label for="txt_modal_document_medicine">Ex&aacute;men de Laboratorio</label>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <a href="" class="modal-close waves-effect waves-green btn teal" onclick="cls_recipe.history_save_recipe(event,'txt_modal_document_medicine','recipe','recipe_medicine_list')">Guardar</a>
                      </div>
                    </div>
                    <!-- Modal Structure -->
                  </div>
                  <div id="recipe_medicine_list" class="col s12 list h_100">
                    <?php foreach($raw_druglist as $key => $rs_druglist){ ?>
                      <div id="<?php echo $key; ?>" data-target="side_nav" class="sidenav-trigger item compact" onclick="cls_document.medicine_picklist(this)" title="<?php echo $rs_druglist['comertial']; ?>"><?php echo $rs_druglist['generic']; ?></div>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="col s8 recipe_container">
                <span class="font_bolder">Receta M&eacute;dica</span>
                <textarea id="ta_recipe_medicine" class="bs_1 border_teal"><?php echo $document['prescription']['recipe']; ?></textarea>
              </div>            
            </div>

            <div class="row">
              <div class="col s4">
                <div class="row">
                  <div class="col s12">
                    <input id="txt_recipe_treatment" type="text" onkeyup="cls_document.filter_treatment(this.value)">
                    <label for="txt_recipe_treatment">Plan de Tto.</label>
                  </div>
                  <div id="recipe_treatment_list" class="col s12 list h_100">
                  </div>
                </div>
              </div>
              <div class="col s8 recipe_container">
                <span class="font_bolder">Indicaciones</span>
                <textarea id="ta_recipe_indication" class="bs_1 border_teal"><?php echo $document['prescription']['indication']; ?></textarea>
              </div>            
            </div>
            <div class="col s12 center-align py_5">
              <a id="btn_save_prescription" class="waves-effect waves-light btn btn-large"><i class="fa fa-save left"></i>Guardar</a>
              <a class="waves-effect waves-light btn btn-large blue dropdown-trigger"  data-target='dropdown_printrecipe'><i class="fa fa-print left"></i>Imprimir</a>
              <!-- Dropdown Structure -->
              <ul id='dropdown_printrecipe' class='dropdown-content'>
                <li><a href="#!" id="print_recipe_half">Media Pagina</a></li>
                <?php // <li><a href="#!" id="print_medicalorder">Pagina Completa</a></li> ?>
              </ul>
            </div>