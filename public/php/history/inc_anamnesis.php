<!-- VITAL SIGN AT ANAMNESIS  -->
        <div class="col s12 pl_0">    
          <div class="col s12">
            <span class="font_bolder">Signos Vitales</span>
          </div>
          <div class="input-field col s6 m4 l1">
            <input id="txt_pe_fc" name="txt_pe_fc" type="text" class="" onblur="set_state_vital('fc',this.value)" value="<?php echo $history['history']['vital_sign']['fc']; ?>">
            <label for="txt_pe_fc">F.C.</label>
          </div>
          <div class="input-field col s6 m4 l1">
            <input id="txt_pe_fr" name="txt_pe_fr" type="text" class="" onblur="set_state_vital('fr',this.value)" value="<?php echo $history['history']['vital_sign']['fr']; ?>">
            <label for="txt_pe_fr">F.R.</label>
          </div>
          <div class="input-field col s6 m4 l1">
            <input id="txt_pe_tas" name="txt_pe_tas" type="text" class="" onblur="set_state_vital('tas',this.value)" value="<?php echo $history['history']['vital_sign']['tas']; ?>">
            <label for="txt_pe_tas">TAS</label>
          </div>
          <div class="input-field col s6 m4 l1">
            <input id="txt_pe_tad" name="txt_pe_tad" type="text" class="" onblur="set_state_vital('tad',this.value)" value="<?php echo $history['history']['vital_sign']['tad']; ?>">
            <label for="txt_pe_tad">TAD</label>
          </div>
          <div class="input-field col s6 m4 l1">
            <input id="txt_pe_temp" name="txt_pe_temp" type="text" class="" onblur="set_state_vital('temp',this.value)" value="<?php echo $history['history']['vital_sign']['temp']; ?>">
            <label for="txt_pe_temp">Temp.</label>
          </div>
          <div class="input-field col s6 m4 l1">
            <input id="txt_pe_gc" name="txt_pe_gc" type="text" class="" onblur="set_state_vital('gc',this.value)" value="<?php echo $history['history']['vital_sign']['gc']; ?>">
            <label for="txt_pe_gc">G.C.</label>
          </div>
        </div>
        <?php //echo json_encode($raw_condition); return false; ?>
        <div class="row">
          <div class="input-field col s4 l2">
            <select id="sel_ef_condition">
<?php         foreach ($raw_condition['condiciones'] as $key => $value){
                if ($key == $history['physical_exam']['condition']) { 
                  echo "<option value='$key' selected>$value</option>";
                } else { 
                  echo "<option value='$key'>$value</option>";
                }
              }         ?>
            </select>
            <label>Condiciones</label>
          </div>
          <div class="input-field col s4 l2">
            <select id="sel_ef_breathing">
<?php         foreach($raw_condition['respiracion'] as $key => $value){
                if ($key == $history['physical_exam']['breathing']) {
                  echo "<option value='$key' selected>$value</option>";
                } else { 
                  echo "<option value='$key'>$value</option>";
                } 
              }       ?>
            </select>
            <label>Respiraci&oacute;n</label>
          </div>
          <div class="input-field col s4 l2">
            <select id="sel_ef_hydration">
<?php         foreach($raw_condition['hidratacion'] as $key => $value){
                if ($key == $history['physical_exam']['hydration']) {
                  echo "<option value='$key' selected>$value</option>";
                }else{
                  echo "<option value='$key'>$value</option>";
                }       
              } ?>
            </select>
            <label>Hidrataci&oacute;n</label>
          </div>
          <div class="input-field col s4 l2">
            <select id="sel_ef_fever">
<?php         foreach ($raw_condition['fiebre'] as $key => $value){
                if ($key == $history['physical_exam']['fever']) {
                  echo "<option value='$key' selected>$value</option>";
                } else {
                  echo "<option value='$key'>$value</option>";
                }         
              }       ?>
            </select>
            <label>Fiebre</label>
          </div>
          <div class="input-field col s5 l2">
            <select id="sel_ef_pupils">
<?php         foreach ($raw_condition['pupilas'] as $key => $value){
                if ($key == $history['physical_exam']['pupils']) { 
                  echo "<option value='$key' selected>$value</option>";
                } else { 
                  echo "<option value='$key'>$value</option>";
                } 
              }       ?>
            </select>
            <label>Pupilas</label>
          </div>
        </div>

        <div class="s12">
<!-- {{-- @@@@@@@@@@@@@@@@@@@@@@           SKIN         @@@@@@@@@@@@@@@@@@@@@@@@@@    --}} -->
          <div class="pt_10 col s4">
            <span class="font_bolder">Piel</span>
            <div class="col s12 history_filter">
              <input id="txt_ef_filter_skin" type="text" class="h_30" placeholder="Buscar..." onkeyup="ef_filter_list('skin',this.value);">
            </div>
            <div id="ef_skin_list" class="col s12 list h_100">
<?php         foreach($raw_efdatabase['skin'] as $key => $value){
                echo '<div class="item compact" onclick="ef_pick_list(\'skin\',this.innerHTML)">'.$value['tx_skin_value'].'</div>';
              }         ?>
            </div>
          </div>
          <div class="col s8 history_container">
            <textarea id="txt_ef_skin" class="bs_1 border_teal"><?php echo $history['physical_exam']['skin']; ?></textarea>
          </div>
<!-- {{-- @@@@@@@@@@@@@@@@@@@@@@           HEAD         @@@@@@@@@@@@@@@@@@@@@@@@@@    --}}  -->
          <div class="pt_10 col s4">
            <span class="font_bolder">Cabeza</span>
            <div class="col s12 history_filter">
              <input id="txt_ef_filter_head" type="text" class="h_30" placeholder="Buscar..." onkeyup="ef_filter_list('head',this.value);">
            </div>
            <div id="ef_head_list" class="col s12 list h_100">
<?php         foreach ($raw_efdatabase['head'] as $key => $value){
                echo '<div class="item compact" onclick="ef_pick_list(\'head\',this.innerHTML)">'.$value['tx_head_value'].'</div>';
              }     ?>
            </div>
          </div>
          <div class="col s8 history_container">
            <textarea id="txt_ef_head" class="bs_1 border_teal"><?php echo $history['physical_exam']['head']; ?></textarea>
          </div>
<!-- {{-- @@@@@@@@@@@@@@@@@@@@@@           ORL         @@@@@@@@@@@@@@@@@@@@@@@@@@    --}}  -->
          <div class="pt_10 col s4">
            <span class="font_bolder">ORL y Boca</span>
            <div class="col s12 history_filter">
              <input type="text" class="h_30" placeholder="Buscar..." onkeyup="ef_filter_list('orl',this.value);">
            </div>
            <div id="ef_orl_list" class="col s12 list h_100">
<?php         foreach ($raw_efdatabase['orl'] as $key => $value){
                echo '<div class="item compact" onclick="ef_pick_list(\'orl\',this.innerHTML)">'.$value['tx_orl_value'].'</div>';
              }     ?>
            </div>
          </div>
          <div class="col s8 history_container">
            <textarea id="txt_ef_orl" class="bs_1 border_teal"><?php echo $history['physical_exam']['orl']; ?></textarea>
          </div>
<!-- {{-- @@@@@@@@@@@@@@@@@@@@@@           CUELLO         @@@@@@@@@@@@@@@@@@@@@@@@@@    --}}  -->
          <div class="pt_10 col s4">
            <span class="font_bolder">Cuello</span>
            <div class="col s12 history_filter">
              <input type="text" class="h_30" placeholder="Buscar..." onkeyup="ef_filter_list('neck',this.value);">
            </div>
            <div id="ef_neck_list" class="col s12 list h_100">
<?php         foreach ($raw_efdatabase['neck'] as $key => $value){
                echo '<div class="item compact" onclick="ef_pick_list(\'neck\',this.innerHTML)">'.$value['tx_neck_value'].'</div>';
              }     ?>
            </div>
          </div>
          <div class="col s8 history_container">
            <textarea id="txt_ef_neck" class="bs_1 border_teal"><?php echo $history['physical_exam']['neck']; ?></textarea>
          </div>
<!-- {{-- @@@@@@@@@@@@@@@@@@@@@@           TORAX         @@@@@@@@@@@@@@@@@@@@@@@@@@    --}}  -->
          <div class="pt_10 col s12 sanson_title">
                    <h5>Torax</h5>
          </div>
<!-- {{-- @@@@@@@@@@@@@@@@@@@@@@           RESPIRATORY         @@@@@@@@@@@@@@@@@@@@@@@@@@    --}}  -->
          <div class="pt_10 col s4 l3">
            <span class="font_bolder">Respiratorio</span>
            <div class="col s12 history_filter">
              <input type="text" class="h_30" placeholder="Buscar..." onkeyup="ef_filter_list('respiratory',this.value);">
            </div>
            <div id="ef_respiratory_list" class="col s12 list h_100">
<?php         foreach ($raw_efdatabase['respiratory'] as $key => $value){
                echo '<div class="item compact" onclick="ef_pick_list(\'respiratory\',this.innerHTML)">'.$value['tx_respiratory_value'].'</div>';
              }       ?>
            </div>
          </div>
          <div class="col s8 l3 history_container">
            <textarea id="txt_ef_respiratory" class="bs_1 border_teal"><?php echo $history['physical_exam']['respiratory']; ?></textarea>
          </div>
<!-- {{-- @@@@@@@@@@@@@@@@@@@@@@           CARDIAC         @@@@@@@@@@@@@@@@@@@@@@@@@@    --}}  -->
          <div class="pt_10 col s4 l3">
            <span class="font_bolder">Cardiaco</span>
            <div class="col s12 history_filter">
              <input type="text" class="h_30" placeholder="Buscar..." onkeyup="ef_filter_list('cardiac',this.value);">
            </div>
            <div id="ef_cardiac_list" class="col s12 list h_100">
<?php         foreach ($raw_efdatabase['cardiac'] as $key => $value){
                echo '<div class="item compact" onclick="ef_pick_list(\'cardiac\',this.innerHTML)">'.$value['tx_cardiac_value'].'</div>';
              }       ?>
            </div>
          </div>
          <div class="col s8 l3 history_container">
            <textarea id="txt_ef_cardiac" class="bs_1 border_teal"><?php echo $history['physical_exam']['cardiac']; ?></textarea>
          </div>
<!-- {{-- @@@@@@@@@@@@@@@@@@@@@@           ABDOMEN         @@@@@@@@@@@@@@@@@@@@@@@@@@    --}}  -->
          <div class="pt_10 col s12 sanson_title">
                    <h5>Abdomen</h5>
          </div>
<!-- {{-- @@@@@@@@@@@@@@@@@@@@@@           AUSCULTATION         @@@@@@@@@@@@@@@@@@@@@@@@@@    --}}  -->
          <div class="pt_10 col s4 l2">
            <span class="font_bolder">Auscultaci&oacute;n</span>
            <div class="col s12 history_filter">
              <input type="text" class="h_30" placeholder="Buscar..." onkeyup="ef_filter_list('auscultation',this.value);">
            </div>
            <div id="ef_auscultation_list" class="col s12 list h_100">
<?php         foreach ($raw_efdatabase['auscultation'] as $key => $value){
                echo '<div class="item compact truncate" title="'.$value['tx_auscultation_value'].'" onclick="ef_pick_list(\'auscultation\',this.innerHTML)">'.$value['tx_auscultation_value'].'</div>';
              }       ?>
            </div>
          </div>
          <div class="col s8 l2 history_container">
            <textarea id="txt_ef_auscultation" class="bs_1 border_teal"><?php echo $history['physical_exam']['auscultation']; ?></textarea>
          </div>
<!--  {{-- @@@@@@@@@@@@@@@@@@@@@@           INSPECTION         @@@@@@@@@@@@@@@@@@@@@@@@@@    --}}  -->
          <div class="pt_10 col s4 l2">
            <span class="font_bolder">Inspecci&oacute;n</span>
            <div class="col s12 history_filter">
              <input type="text" class="h_30" placeholder="Buscar..." onkeyup="ef_filter_list('inspection',this.value);">
            </div>
            <div id="ef_inspection_list" class="col s12 list h_100">
<?php         foreach ($raw_efdatabase['inspection'] as $key => $value){
                echo '<div class="item compact" title="'.$value['tx_inspection_value'].'" onclick="ef_pick_list(\'inspection\',this.innerHTML)">'.$value['tx_inspection_value'].'</div>';
              }   ?>
            </div>
          </div>
          <div class="col s8 l2 history_container">
            <textarea id="txt_ef_inspection" class="bs_1 border_teal"><?php echo $history['physical_exam']['inspection']; ?></textarea>
          </div>
<!--  {{-- @@@@@@@@@@@@@@@@@@@@@@           PALPATIONS        @@@@@@@@@@@@@@@@@@@@@@@@@@    --}}  -->
          <div class="pt_10 col s4 l2">
            <span class="font_bolder">Palpaci&oacute;n</span>
            <div class="col s12 history_filter">
              <input type="text" class="h_30" placeholder="Buscar..." onkeyup="ef_filter_list('palpation',this.value);">
            </div>
            <div id="ef_palpation_list" class="col s12 list h_100">
<?php         foreach ($raw_efdatabase['palpation'] as $key => $value){
                echo '<div class="item compact" title="'.$value['tx_palpation_value'].'" onclick="ef_pick_list(\'palpation\',this.innerHTML)">'.$value['tx_palpation_value'].'</div>';
              }       ?>
            </div>
          </div>
          <div class="col s8 l2 history_container">
            <textarea id="txt_ef_palpation" class="bs_1 border_teal"><?php echo $history['physical_exam']['palpation']; ?></textarea>
          </div>
<!--  {{-- @@@@@@@@@@@@@@@@@@@@@@           PELVIS         @@@@@@@@@@@@@@@@@@@@@@@@@@    --}}  -->
          <div class="pt_10 col s4">
            <span class="font_bolder">Pelvis</span>
            <div class="col s12 history_filter">
              <input type="text" class="h_30" placeholder="Buscar..." onkeyup="ef_filter_list('hip',this.value);">
            </div>
            <div id="ef_hip_list" class="col s12 list h_100">
<?php         foreach ($raw_efdatabase['hip'] as $key => $value){
                echo '<div class="item compact" onclick="ef_pick_list(\'hip\',this.innerHTML)">'.$value['tx_hip_value'].'</div>';
              }     ?>
            </div>
          </div>
          <div class="col s8 history_container">
            <textarea id="txt_ef_hip" class="bs_1 border_teal"><?php echo $history['physical_exam']['hip']; ?></textarea>
          </div>
          <div class="col s12 center-align py_5">
            <a id="paste_pe" class="waves-effect waves-light btn btn-large"><i class="fas fa-paste left"></i>Agregar Ex. Fisico</a>
          </div>
        </div>
