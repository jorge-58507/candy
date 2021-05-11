@extends('layouts.history')
@section('title','Historia Médica')
@section('css')
  <link type="text/css" rel="stylesheet" href="{{ asset('css/font-awesome.css') }}"/>
  <link type="text/css" rel="stylesheet" href="{{ asset('css/history.css') }}"/>
@endsection
@section('content')
  @php
    $raw_reasonlist = array();
    foreach ($raw_history['reasonlist'] as $key => $rs_reason) {
      $raw_reasonlist[$rs_reason['ai_reason_id']] = $rs_reason['tx_reason_value'];
    }
    $raw_currentlist = array();
    foreach ($raw_history['currentlist'] as $key => $rs_reason) {
      $raw_currentlist[$rs_reason['tx_current_title']] = $rs_reason['tx_current_value'];
    }
    $raw_antecedentlist = array();
    foreach ($raw_history['antecedentlist'] as $key => $rs_antecedent) {
      $raw_antecedentlist[$rs_antecedent['ai_antecedent_id']] = $rs_antecedent['tx_antecedent_value'];
    }
    $raw_examinationlist = array();
    foreach ($raw_history['examinationlist'] as $key => $rs_examination) {
      $raw_examinationlist[$rs_examination['tx_examination_title']] = $rs_examination['tx_examination_value'];
    }
    $raw_diagnosticlist = array();
    foreach ($raw_history['diagnosticlist'] as $key => $recordset) {
      $raw_diagnosticlist[$recordset['ai_diagnostic_id']] = $recordset['tx_diagnostic_value'];
    }
    $raw_planlist = array();
    foreach ($raw_history['planlist'] as $key => $recordset) {
      $raw_planlist[$recordset['tx_plan_title']] = $recordset['tx_plan_value'];
    }
    $raw_condition = array();
    // $raw_condition['condicion']=[];
    // $raw_condition['respiracion']=[];
    // $raw_condition['hidratacion']=[];
    // $raw_condition['fiebre']=[];
    // $raw_condition['pupilas']=[];
    foreach ($raw_history['condition'] as $key => $value) {
      $raw_condition[$value['tx_ef_title']] = json_decode($value['tx_ef_value'],true);
    }
    $raw_efdatabase = array();
    foreach ($raw_history['efdatabase'] as $selector => $json) {
      $raw_efdatabase[$selector] = json_decode($json,true);
    }
    $raw_order = array();
    $raw_order['laboratory']=array();
    foreach ($raw_history['laboratory_order'] as $order_id => $value) {
      $raw_order['laboratory'][$order_id] = $value;
    }
    $raw_order['complementary']=array();
    foreach ($raw_history['complementary_order'] as $order_id => $value) {
      $raw_order['complementary'][$order_id] = $value;
    }
    $raw_order['profile']=array();
    foreach ($raw_history['profile_order'] as $order_id => $value) {
      $raw_order['profile'][$order_id] = $value;
    }
    // echo json_encode($raw_order); return false;

    $raw_decoded = json_decode($raw_history['json_history'], true); 
    $rs_history = json_decode($raw_decoded['tx_history_value'],true);
    $history = $rs_history[$raw_history['dateopened']['ai_date_id']];
    $rs_document = json_decode($raw_decoded['tx_history_document'],true);
    $document = $rs_document[$raw_history['dateopened']['ai_date_id']];
    
    $raw_druglist = array();
    foreach ($raw_history['druglist'] as $key => $rs_drug) {
      $raw_druglist[$rs_drug['ai_drug_id']]['generic'] = $rs_drug['tx_drug_generic'];
      $raw_druglist[$rs_drug['ai_drug_id']]['comertial'] = $rs_drug['tx_drug_comertial'];
    }
    $raw_treatmentlist = array();
    foreach ($raw_history['treatmentlist'] as $key => $rs_treatment) {
      $raw_treatmentlist[$rs_treatment['ai_treatment_id']]['title'] = $rs_treatment['tx_treatment_title'];
      $raw_treatmentlist[$rs_treatment['ai_treatment_id']]['json'] = json_decode($rs_treatment['tx_treatment_json'], true);
      $raw_treatmentlist[$rs_treatment['ai_treatment_id']]['slug'] = $rs_treatment['tx_treatment_slug'];
    }
  @endphp
  <div class="row content">
    <div class="col s12">
      <div class="row">
        <div class="col s12 bs_2 radius_5 border_teal fs_20 center-align mt_15">
          <p>
            ( <?php echo date('d-m-Y',strtotime($raw_history['dateopened']['tx_date_date']));  ?> ) -
    	      <b>ID:</b> <?php echo $raw_history['patientsdate']['tx_patient_identification']; ?>&nbsp;&nbsp;
    	      <b>H:</b> <?php echo $raw_history['patientsdate']['tx_patient_history']; ?>&nbsp;&nbsp;
    				<b>Nombre:</b> <?php echo $raw_history['patientsdate']['tx_patient_name']; ?>&nbsp;&nbsp;
    				<b>Edad:</b> <?php echo $raw_history['patientsage']; ?>
          </p>
        </div>
      </div>
      <ul id="" class="tabs transparent bb_1 border_gray">
        <li class="tab col s2 font_bolder"><a id="li_pe" href="#tab_anamnesis">Examen F&iacute;sico</a></li>
        <li class="tab col s3 font_bolder"><a id="li_history"  href="#tab_history">Historia M&eacute;dica</a></li>
        <li class="tab col s2 font_bolder"><a id="li_laboratory" href="#tab_laboratory">Laboratorio</a></li>
        {{-- <li class="tab col s3 font_bolder"><a class="" href="#tab_history">Estudio Complementario</a></li> --}}
        <li class="tab col s2 font_bolder"><a id="li_document" class="active" href="#tab_document">Papeler&iacute;a</a></li>
      </ul>
{{-- ###############################    TAB ANAMNESIS     ############################# --}}
      <div id="tab_anamnesis" class="col s12 py_5">
        <?php
          include 'php/history/inc_anamnesis.php'
        ?>
      </div>
{{-- ###############################    TAB HISTORY     ############################# --}}
      <div id="tab_history" class="col s12 py_5 mb_15">
        <div class="col s12 pl_0">
          <div class="col s12">
            <span class="font_bolder">Signos Vitales</span>
          </div>
          <div class="input-field col s6 m4 l1">
            <input id="txt_ef_fc" name="txt_ef_fc" type="text" class="" onkeyup="set_state_vital('fc',this.value)" value="<?php echo $history['history']['vital_sign']['fc']; ?>">
            <label for="txt_ef_fc">F.C.</label>
          </div>
          <div class="input-field col s6 m4 l1">
            <input id="txt_ef_fr" name="txt_ef_fr" type="text" class="" onkeyup="set_state_vital('fr',this.value)" value="<?php echo $history['history']['vital_sign']['fr']; ?>" >
            <label for="txt_ef_fr">F.R.</label>
          </div>
          <div class="input-field col s6 m4 l1">
            <input id="txt_ef_tas" name="txt_ef_tas" type="text" class="" onkeyup="set_state_vital('tas',this.value)" value="<?php echo $history['history']['vital_sign']['tas']; ?>">
            <label for="txt_ef_tas">TAS</label>
          </div>
          <div class="input-field col s6 m4 l1">
            <input id="txt_ef_tad" name="txt_ef_tad" type="text" class="" onkeyup="set_state_vital('tad',this.value)" value="<?php echo $history['history']['vital_sign']['tad']; ?>">
            <label for="txt_ef_tad">TAD</label>
          </div>
          <div class="input-field col s6 m4 l1">
            <input id="txt_ef_temp" name="txt_ef_temp" type="text" class="" onkeyup="set_state_vital('temp',this.value)" value="<?php echo $history['history']['vital_sign']['temp']; ?>">
            <label for="txt_ef_temp">Temp.</label>
          </div>
          <div class="input-field col s6 m4 l1">
            <input id="txt_ef_gc" name="txt_ef_gc" type="text" class="" onkeyup="set_state_vital('gc',this.value)" value="<?php echo $history['history']['vital_sign']['gc']; ?>">
            <label for="txt_ef_gc">G.C.</label>
          </div>
        </div>
        <div class="row">
          <div class="pt_10 col s4">{{-- @@@@@@@@@@     SELECTOR       --}}
            <span class="font_bolder truncate">Motivo de Consulta  </span>
            <div class="col s12 history_filter">{{-- @@@@@@@@@@     FILTRADOR       --}}
              <input id="txt_filter_reason" type="text" class="h_30" placeholder="Buscar..." onkeyup="filter_list('reason',this.value);">
            </div>
            <div id="reason_list" class="col s12 list h_100">
              @foreach ($raw_reasonlist as $key => $reason)
                <div id="{{ $key }}" class="item compact" onclick="pick_list('reason',this.id,this.innerHTML)">{{ $reason }}</div>
              @endforeach
            </div>
          </div>
          <div class="col s8 history_container">
            <?php $reason_txt = ($history['history']['reason']['content'] != '') ? $history['history']['reason']['content'] : $raw_history['dateopened']['tx_reason_value']; ?>
            <textarea id="txt_history_reason" class="bs_1 border_teal">{{ $reason_txt }}</textarea>
          </div>
        </div>
{{-- @@@@@@@@@@@@@@@@@@@@@@           ENFERMEDAD ACTUAL     @@@@@@@@@@@@@@@@@@@@@@@@@@    --}}
        <div class="pt_10 col s4">
          <span class="font_bolder truncate">Enfermedad Actual</span>
          <div class="col s12 history_filter">
            <input id="txt_filter_currentillness" type="text" class="h_30" placeholder="Buscar..." onkeyup="filter_list('currentillness',this.value);">
          </div>
          <div id="current_list" class="col s12 list h_100">
            @foreach ($raw_currentlist as $title => $value)
              <div id="{{ $value }}" title="{{ $value }}" class="item compact" onclick="pick_list('current',this.id)">{{ $title }}</div>
            @endforeach
          </div>
        </div>
        <div class="col s8 history_container">
            <textarea id="txt_history_currentillness" class="bs_1 border_teal"><?php echo $history['history']['current']['content']; ?></textarea>
        </div>
{{-- @@@@@@@@@@@@@@@@@@@@@@           ANTECEDENTES     @@@@@@@@@@@@@@@@@@@@@@@@@@    --}}
        <div class="pt_10 col s4">
          <span class="font_bolder">Antecedentes</span>
          <div class="col s12 history_filter">
            <input id="txt_filter_antecedent" type="text" class="h_30" placeholder="Buscar..." onkeyup="filter_list('antecedent',this.value);">
          </div>
          <div id="antecedent_list" class="col s12 list h_100">
            @foreach ($raw_antecedentlist as $id => $value)
              <div id="{{ $id }}" class="item compact" onclick="pick_list('antecedent',this.id,this.innerHTML)">{{ $value }}</div>
            @endforeach
          </div>
        </div>
        <div class="col s8 history_container">
          <textarea id="txt_history_antecedent" class="bs_1 border_teal"><?php echo $history['history']['antecedent']['content']; ?></textarea>
        </div>
{{-- @@@@@@@@@@@@@@@@@@@@@@           EXAMEN FISICO     @@@@@@@@@@@@@@@@@@@@@@@@@@    --}}
        <div class="pt_10 col s4">
          <span class="font_bolder truncate">Examen F&iacute;sico</span>
          <div class="col s12 history_filter">
            <input id="txt_filter_examination" type="text" class="h_30" placeholder="Buscar..." onkeyup="filter_list('examination',this.value);">
          </div>
          <div id="examination_list" class="col s12 list h_100">
            @foreach ($raw_examinationlist as $id => $value)
              <div id="{{ $id }}" class="item compact" title="{{ $value }}" onclick="pick_list('examination',this.id,this.innerHTML)">{{ $value }}</div>
            @endforeach
          </div>
        </div>
        <div class="col s8 history_container">
          <textarea id="txt_history_examination" class="bs_1 border_teal"><?php echo $history['history']['examination']['content']; ?></textarea>
        </div>
{{-- @@@@@@@@@@@@@@@@@@@@@@           DIAGNOSTICO     @@@@@@@@@@@@@@@@@@@@@@@@@@    --}}
        <div class="pt_10 col s4">
          <span class="font_bolder">Diagn&oacute;stico</span>
          <div class="col s12 history_filter">
            <input id="txt_filter_diagnostic" type="text" class="h_30" placeholder="Buscar..." onkeyup="filter_list('diagnostic',this.value);">
          </div>
          <div id="diagnostic_list" class="col s12 list h_100">
            @foreach ($raw_diagnosticlist as $id => $value)
              <div id="{{ $id }}" class="item compact" onclick="pick_list('diagnostic',this.id,this.innerHTML)">{{ $value }}</div>
            @endforeach
          </div>
        </div>
        <div class="col s8 history_container">
          <textarea id="txt_history_diagnostic" class="bs_1 border_teal"><?php echo $history['history']['diagnostic']['content']; ?></textarea>
        </div>
{{-- @@@@@@@@@@@@@@@@@@@@@@           COMENTARIO     @@@@@@@@@@@@@@@@@@@@@@@@@@    --}}
        <div class="col s12 history_container">
          <span class="font_bolder">Comentario</span>
          <textarea id="txt_history_comment" class="bs_1 border_teal"><?php echo $history['history']['comment']['content']; ?></textarea>
        </div>
{{-- @@@@@@@@@@@@@@@@@@@@@@           PLAN     @@@@@@@@@@@@@@@@@@@@@@@@@@    --}}
        <div class="pt_10 col s4">
          <span class="font_bolder">Plan</span>
          <div class="col s12 history_filter">
            <input id="txt_filter_plan" type="text" class="h_30" placeholder="Buscar..." onkeyup="filter_list('plan',this.value);">
          </div>
          <div id="plan_list" class="col s12 list h_100">
            @foreach ($raw_planlist as $title => $value)
              <div id="{{ $value }}" class="item compact" onclick="pick_list('plan',this.id,this.innerHTML)">{{ $title }}</div>
            @endforeach
          </div>
        </div>
        <div class="col s8 history_container">
          <textarea id="txt_history_plan" class="bs_1 border_teal"><?php echo $history['history']['plan']['content']; ?></textarea>
        </div>
        <div class="col s12 center-align py_5">
          <a id="btn_save_history" class="waves-effect waves-light btn btn-large"><i class="fa fa-save left"></i>Guardar</a>
          <a id="btn_print_report" class="waves-effect waves-light btn btn-large blue"><i class="fa fa-print left"></i>Imprimir</a>
        </div>
      </div>
{{-- @@@@@@@@@@@@@@@@@@@@@@     LABOORATORIOS     @@@@@@@@@@@@@@@@@@@@@@@@@@    --}}
      <div id="tab_laboratory" class="col s12 py_5 mb_15">
        <div class="row">
          <div class="input-field col s3 m2 mb_0">
            <input id="txt_laboratory_hemoblobin" name="txt_laboratory_hemoblobin" type="text" class="" value="<?php echo $history['laboratory']['hemoglobin'][0]; ?>">
            <label for="txt_laboratory_hemoblobin">Hemoglobina</label>
            <div class="switch">
              <label>
                Off
                <?php $checked = ($history['laboratory']['hemoglobin'][1]) ? 'checked' : '' ?>
                <input type="checkbox" id="cb_hemoglobin" {{ $checked }}>
                <span class="lever"></span>
                Alerta
              </label>
            </div>
          </div>
          <div class="input-field col s3 m2 mb_0">
            <input id="txt_laboratory_hematocrit" name="txt_laboratory_hematocrit" type="text" class="" value="<?php echo $history['laboratory']['hematocrit'][0] ?>">
            <label for="txt_laboratory_hematocrit">Hematocrito</label>
            <div class="switch">
              <label>
                Off
                <?php $checked = ($history['laboratory']['hematocrit'][1]) ? 'checked' : '' ?>
                <input type="checkbox" id="cb_hematocrit" {{ $checked }}>
                <span class="lever"></span>
                Alerta
              </label>
            </div>
          </div>
          <div class="input-field col s3 m2 mb_0">
            <input id="txt_laboratory_platelet" name="txt_laboratory_platelet" type="text" class="" value="<?php echo $history['laboratory']['platelet'][0] ?>">
            <label for="txt_laboratory_platelet">Plaqueta</label>
            <div class="switch">
              <label>
                Off
                <?php $checked = ($history['laboratory']['platelet'][1]) ? 'checked' : '' ?>
                <input type="checkbox" id="cb_platelet" {{ $checked }}>
                <span class="lever"></span>
                Alerta
              </label>
            </div>
          </div>
          <div class="input-field col s3 m2 mb_0">
            <input id="txt_laboratory_redbloodcell" name="txt_laboratory_redbloodcell" type="text" class="" value="<?php echo $history['laboratory']['redbloodcell'][0] ?>">
            <label for="txt_laboratory_redbloodcell">G. Rojos</label>
            <div class="switch">
              <label>
                Off
                <?php $checked = ($history['laboratory']['redbloodcell'][1]) ? 'checked' : '' ?>
                <input type="checkbox" id="cb_redbloodcell" {{ $checked }}>
                <span class="lever"></span>
                Alerta
              </label>
            </div>
          </div>
          <div class="input-field col s3 m2 mb_0">
            <input id="txt_laboratory_urea" name="txt_laboratory_urea" type="text" class="" value="<?php echo $history['laboratory']['urea'][0] ?>">
            <label for="txt_laboratory_urea">Urea</label>
            <div class="switch">
              <label>
                Off
                <?php $checked = ($history['laboratory']['urea'][1]) ? 'checked' : '' ?>
                <input type="checkbox" id="cb_urea" {{ $checked }}>
                <span class="lever"></span>
                Alerta
              </label>
            </div>
          </div>
          <div class="input-field col s3 m2 mb_0">
            <input id="txt_laboratory_creatinine" name="txt_laboratory_creatinine" type="text" class="" value="<?php echo $history['laboratory']['creatinine'][0] ?>">
            <label for="txt_laboratory_creatinine">Creatinina</label>
            <div class="switch">
              <label>
                Off
                <?php $checked = ($history['laboratory']['creatinine'][1]) ? 'checked' : '' ?>
                <input type="checkbox" id="cb_creatinine" {{ $checked }}>
                <span class="lever"></span>
                Alerta
              </label>
            </div>
          </div>
          <div class="input-field col s3 m2 mb_0">
            <input id="txt_laboratory_whitebloodcell" name="txt_laboratory_whitebloodcell" type="text" class="" value="<?php echo $history['laboratory']['whitebloodcell'][0] ?>">
            <label for="txt_laboratory_whitebloodcell">G. Blancos</label>
            <div class="switch">
              <label>
                Off
                <?php $checked = ($history['laboratory']['whitebloodcell'][1]) ? 'checked' : '' ?>
                <input type="checkbox" id="cb_whitebloodcell" {{ $checked }}>
                <span class="lever"></span>
                Alerta
              </label>
            </div>
          </div>
          <div class="input-field col s3 m2 mb_0">
            <input id="txt_laboratory_lymphocytes" name="txt_laboratory_lymphocytes" type="text" class="" value="<?php echo $history['laboratory']['lymphocytes'][0] ?>">
            <label for="txt_laboratory_lymphocytes">Linfocitos</label>
            <div class="switch">
              <label>
                Off
                <?php $checked = ($history['laboratory']['lymphocytes'][1]) ? 'checked' : '' ?>
                <input type="checkbox" id="cb_lymphocytes" {{ $checked }}>
                <span class="lever"></span>
                Alerta
              </label>
            </div>
          </div>
          <div class="input-field col s3 m2 mb_0">
            <input id="txt_laboratory_neutrophils" name="txt_laboratory_neutrophils" type="text" class="" value="<?php echo $history['laboratory']['neutrophils'][0] ?>">
            <label for="txt_laboratory_neutrophils">Neutrofilos</label>
            <div class="switch">
              <label>
                Off
                <?php $checked = ($history['laboratory']['neutrophils'][1]) ? 'checked' : '' ?>
                <input type="checkbox" id="cb_neutrophils" {{ $checked }}>
                <span class="lever"></span>
                Alerta
              </label>
            </div>
          </div>
          <div class="input-field col s3 m2 mb_0">
            <input id="txt_laboratory_monocytes" name="txt_laboratory_monocytes" type="text" class="" value="<?php echo $history['laboratory']['monocytes'][0] ?>">
            <label for="txt_laboratory_monocytes">Monocitos</label>
            <div class="switch">
              <label>
                Off
                <?php $checked = ($history['laboratory']['monocytes'][1]) ? 'checked' : '' ?>
                <input type="checkbox" id="cb_monocytes" {{ $checked }}>
                <span class="lever"></span>
                Alerta
              </label>
            </div>
          </div>
          <div class="input-field col s3 m2 mb_0">
            <input id="txt_laboratory_basophils" name="txt_laboratory_basophils" type="text" class="" value="<?php echo $history['laboratory']['basophils'][0] ?>">
            <label for="txt_laboratory_basophils">Bas&oacute;filos</label>
            <div class="switch">
              <label>
                Off
                <?php $checked = ($history['laboratory']['basophils'][1]) ? 'checked' : '' ?>
                <input type="checkbox" id="cb_basophils" {{ $checked }}>
                <span class="lever"></span>
                Alerta
              </label>
            </div>
          </div>
          <div class="input-field col s3 m2 mb_0">
            <input id="txt_laboratory_eosinophils" name="txt_laboratory_eosinophils" type="text" class="" value="<?php echo $history['laboratory']['eosinophils'][0] ?>">
            <label for="txt_laboratory_eosinophils">Eosin&oacute;filos</label>
            <div class="switch">
              <label>
                Off
                <?php $checked = ($history['laboratory']['eosinophils'][1]) ? 'checked' : '' ?>
                <input type="checkbox" id="cb_eosinophils" {{ $checked }}>
                <span class="lever"></span>
                Alerta
              </label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col s12 m4">
            <div class="row">
              <div class="input-field col s8">
                <i class="fa fa-vials prefix"></i>
                <input id="txt_filter_laboratory" name="txt_filter_laboratory" type="text" class="" value="" onkeyup="cls_laboratory.filter_laboratory(this.value)">
                <label for="txt_filter_laboratory">Ex&aacute;menes de Laboratorio</label>
              </div>
              <div class="input-field col s1 pt_10">
                <a id="btn_laboratory_plus" class="btn-floating waves-effect waves-light btn btn-small modal-trigger" onclick="cls_order.new_order('txt_filter_laboratory','txt_modal_order')" href="#laboratory_modal"><i class="fa fa-plus left"></i></a>
                <!-- Modal Structure -->
                <div id="laboratory_modal" class="modal">
                  <div class="modal-content">
                    <h4>Nueva Orden</h4>
                    <div class="input-field col s10">
                      <input id="txt_modal_order" name="txt_modal_order" type="text" class="">
                      <label for="txt_modal_order">Ex&aacute;men de Laboratorio</label>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <a href="" class="modal-close waves-effect waves-green btn teal" onclick="cls_order.history_save_order(event,'txt_modal_order','laboratory','laboratory_list')">Guardar</a>
                  </div>
                </div>
                <!-- Modal Structure -->
              </div>
              <div class="col s3">
                <div class="switch ">
                  <label>
                    Alerta
                    <?php $checked = ($history['laboratory']['result'][1]) ? 'checked' : '' ?>
                    <input type="checkbox" id="cb_result" {{ $checked }}>
                    <span class="lever"></span>
                  </label>
                </div>
              </div>
              <div id="laboratory_list" class="col s12 list h_100">
                @foreach ($raw_order['laboratory'] as $key => $reason)
                  <div id="{{ $key }}" class="item compact" onclick="cls_laboratory.pick_laboratory_list(this.innerHTML)">{{ $reason }}</div>
                @endforeach
              </div>
            </div>
          </div>
          <div class="col s12 m8 laboratory_container">
            <textarea id="txt_laboratory_result" class="bs_1 border_teal"><?php echo $history['laboratory']['result'][0] ?></textarea>
          </div>
        </div>
        <div class="col s12 center-align py_5">
          <a id="btn_save_laboratory" class="waves-effect waves-light btn btn-large"><i class="fa fa-save left"></i>Guardar</a>
          <a id="btn_print_laboratory" class="waves-effect waves-light btn btn-large blue"><i class="fa fa-print left"></i>Imprimir</a>
        </div>
        <!-- HISTORIAL DE RESULTADOS DE LABORATORIO -->
        <div class="col s12" id="card_container">
          @foreach ($raw_history['raw_lab'] as $key => $obj_lab)
            <?php $alarm = ($obj_lab['alarm'] === 1) ?  'Resultados Anormales' : 'Resultados Normales'; ?>
            <?php $background = ($obj_lab['alarm'] === 1) ?  'red accent-2' : 'teal lighten-3'; ?>
            <div class="col s3">
              <div class="card  {{ $background }} ">
                <div class="card-image card_laboratory waves-effect waves-block waves-light activator">
                  <div class="activator right-align">
                    <h3 class="activator"><?php echo date('d-m-Y',strtotime($obj_lab['date'])); ?></h3>
                  </div>
                  <div class="activator">
                    <span class="font_bolder">
                      Alarma:
                    </span>
                    <h5 class="activator sanson_title">{{ $alarm }}</h5>
                  </div>
                </div>
                <div class="card-reveal">
                  <span class="card-title grey-text text-darken-4 bolder"><?php echo date('d-m-Y',strtotime($obj_lab['date'])); ?><i class="material-icons right">close</i></span>
                  <p>
                    <?php echo $obj_lab['content']; ?>
                  </p>
                </div>
              </div>
            </div>
          @endforeach
            
        </div>
      </div>
      {{-- ##########################    PAPELERIA     ############################# --}}
      <div id="tab_document" class="col s12 py_5">

        <div class="row">
          <div class="col s12">
            <ul class="tabs">
              <li class="tab col s3"><a href="#tab_documentmedicalorder">Ordenes M&eacute;dicas</a></li>
              <li class="tab col s3"><a href="#tab_documentrecipe">Receta</a></li>
              <li class="tab col s3"><a class="active" href="#tab_documentincapacity">Constancia e Incapacidad</a></li>
            </ul>
          </div>
          {{-- ########### ORDENES MEDICAS ############ --}}
          <div id="tab_documentmedicalorder" class="col s12">
            <div class="row">
{{-- @@@@   LABORATORIOS  @@@ --}}
{{-- laboratorio --}}
              <div class="col s2">
                <div class="row">
                  <div class="input-field col s10">
                    <input id="txt_medicalorder_laboratory" type="text" onkeyup="cls_document.filter_laboratory(this.value)">
                    <label for="txt_medicalorder_laboratory">Ex&aacute;menes</label>
                  </div>
                  <div class="col s1 pt_10">
                    <a id="btn_laboratory_plus" class="btn-floating waves-effect waves-light btn btn-small modal-trigger" onclick="cls_order.new_order('txt_medicalorder_laboratory','txt_modal_document_order')" href="#document_laboratory_modal"><i class="fa fa-plus left"></i></a>
                    <!-- Modal Structure -->
                    <div id="document_laboratory_modal" class="modal">
                      <div class="modal-content">
                        <h4>Nueva Orden</h4>
                        <div class="input-field col s10">
                          <input id="txt_modal_document_order" name="txt_modal_document_order" type="text" class="">
                          <label for="txt_modal_document_order">Ex&aacute;men de Laboratorio</label>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <a href="" class="modal-close waves-effect waves-green btn teal" onclick="cls_order.history_save_order(event,'txt_modal_document_order','laboratory','medicalorder_laboratory_list')">Guardar</a>
                      </div>
                    </div>
                    <!-- Modal Structure -->
                  </div>
                  <div id="medicalorder_laboratory_list" class="col s12 list h_100">
                    @foreach ($raw_order['laboratory'] as $key => $value)
                      <div id="{{ $key }}" class="item compact truncate" onclick="cls_document.laboratory_pick_list(this.innerHTML,'')">{{ $value }}</div>
                    @endforeach
                  </div>
                </div>
              </div>
{{-- laboratorio --}}
{{-- profile --}}
              <div class="col s2">
                <div class="row">
                  <div class="input-field col s10">
                    <input id="txt_medicalorder_profile" type="text" onkeyup="cls_document.filter_profile(this.value)">
                    <label for="txt_medicalorder_profile">Perfiles</label>
                  </div>
                  <div id="medicalorder_profile_list" class="col s12 list h_100">
                    @foreach ($raw_order['profile'] as $key => $value)
                      <div id="{{ $key }}" class="item compact truncate" onclick="cls_document.laboratory_pick_list(this.innerHTML,'\n')">{{ $value }}</div>
                    @endforeach
                  </div>
                </div>
              </div>
              <div class="col s8  document_container">
                <textarea id="txt_document_laboratory" class="bs_1 border_teal">{{ $document['medicalorder']['laboratory'] }}</textarea>
              </div>
{{-- profile --}}
            </div>
            <div class="row">
{{-- ESTUDIOS COMPLEMENTARIOS --}}
              <div class="col s4">
                <div class="row">
                  <div class="input-field col s10">
                    <input id="txt_medicalorder_complementary" type="text" onkeyup="cls_document.filter_complementary(this.value)">
                    <label for="txt_medicalorder_complementary">Otros Estudios</label>
                  </div>
                  <div class="input-field col s1 pt_10">
                    <a id="btn_complementary_plus" class="btn-floating waves-effect waves-light btn btn-small modal-trigger" onclick="cls_order.new_order('txt_medicalorder_complementary','txt_modal_ordercomplementary')" href="#complementary_modal"><i class="fa fa-plus left"></i></a>
                    <!-- Modal Structure -->
                    <div id="complementary_modal" class="modal">
                      <div class="modal-content">
                        <h4>Nuevo Estudio Complementario</h4>
                        <div class="input-field col s10">
                          <input id="txt_modal_ordercomplementary" type="text" class="">
                          <label for="txt_modal_ordercomplementary">Ex&aacute;men de Laboratorio</label>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <a href="" class="modal-close waves-effect waves-green btn teal" onclick="cls_order.history_save_order(event,'txt_modal_ordercomplementary','complementary','medicalorder_complementary_list')">Guardar</a>
                      </div>
                    </div>
                    <!-- Modal Structure -->
                  </div>
                  <div id="medicalorder_complementary_list" class="col s12 list h_100">
                    @foreach ($raw_order['complementary'] as $key => $value)
                      <div id="{{ $key }}" class="item compact" onclick="cls_document.complementary_pick_list(this.innerHTML,'')">{{ $value }}</div>
                    @endforeach
                  </div>
                </div>
              </div>
              <div class="col s8  document_container">
                <textarea id="txt_document_complementary" class="bs_1 border_teal">{{ $document['medicalorder']['complementary'] }}</textarea>
              </div>            
{{-- ESTUDIOS COMPLEMENTARIOS --}}
            </div>
            <div class="col s12 center-align py_5">
              <a id="btn_save_medicalorder" class="waves-effect waves-light btn btn-large"><i class="fa fa-save left"></i>Guardar</a>
              <a class="waves-effect waves-light btn btn-large blue dropdown-trigger"  data-target='dropdown_printmedicalorder'><i class="fa fa-print left"></i>Imprimir</a>
              <!-- Dropdown Structure -->
              <ul id='dropdown_printmedicalorder' class='dropdown-content'>
                <li><a href="#!" id="print_medicalorder_half">Media Pagina</a></li>
                <li><a href="#!" id="print_medicalorder">Pagina Completa</a></li>
              </ul>
            </div>
          </div>
          <div id="tab_documentrecipe" class="col s12">
            {{-- ###################     RECIPE    ###################### --}}
<?php       include 'php/history/inc_document_prescription.php';  ?>            
          </div>
          <div id="tab_documentincapacity" class="col s12">
            {{-- ###################     CONSTANCIA e INCAPACIDAD    ###################### --}}
            <div class="row">
              <div class="col s12 center-align pt_25">
                <a id="btn_documentconstancy" class="btn btn-large waves-effect waves-light blue lighten-1">Constancia</a>&nbsp;
                <a id="btn_documentincapacity" class="btn btn-large waves-effect waves-light blue lighten-1 modal-trigger" href="#incapacity_modal">Incapacidad</a>
                <!-- Modal Structure -->
                <div id="incapacity_modal" class="modal">
                  <div class="modal-content">
                    <h4>Otorgar Incapacidad</h4>
                    <div class="row">
                      <div class="input-field col s12 m6 l6">
                        <input id="txt_modal_incapacity_firstdate" name="txt_modal_incapacity_firstdate" type="text" class="datepicker" value="{{ date('d-m-Y') }}">
                        <label for="txt_modal_incapacity_firstdate">Fecha de Inicio</label>
                      </div>
                      <div class="input-field col s12 m6 l6">
                        <input id="txt_modal_incapacity_firsthour" name="txt_modal_incapacity_firsthour" type="text" class="timepicker" value="{{ date('h:i A') }}">
                        <label for="txt_modal_incapacity_firsthour">Hora de Inicio</label>
                      </div>
                      <div class="input-field col s12 m6 l6">
                        <input id="txt_modal_incapacity_lastdate" name="txt_modal_incapacity_lastdate" type="text" class="datepicker" value="{{ date('d-m-Y',strtotime('+1 day')) }}">
                        <label for="txt_modal_incapacity_lastdate">Fecha de Finalizaci&oacute;n</label>
                      </div>
                      <div class="input-field col s12 m6 l6">
                        <input id="txt_modal_incapacity_lasthour" name="txt_modal_incapacity_lasthour" type="text" class="timepicker" value="{{ date('h:i A') }}">
                        <label for="txt_modal_incapacity_lasthour">Hora de Finalizaci&oacute;n</label>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <a id="btn_modal_incapacitycancel" class="modal-close waves-effect waves-green btn orange accent-2">Cancelar</a>&nbsp;
                    <a id="btn_modal_incapacitysave" href="" class="modal-close waves-effect waves-green btn teal">Guardar</a>
                  </div>
                </div>
                <!-- Modal Structure -->

              </div>
            </div>
          </div>
        </div>

      </div>
      {{-- ##########################    FIN DE PAPELERIA    ############################### --}}
    </div>
  </div>
@endsection
@section('javascript')
  <script src="{{ asset('js/jquery.js') }}"></script>
  <script src="{{ asset('js/validCampoFranz.js') }}" defer></script>
  <script src="{{ asset('js/history.js') }}" ></script>

  
  <script type="text/javascript">
    const cls_general = new general_funct();


    
    document.addEventListener('DOMContentLoaded', function() {

      // MATERIALIZE INSTANCES
      var el_tab = document.querySelectorAll('.tabs');
      var instance_tab = M.Tabs.init(el_tab);
      var el_select = document.querySelectorAll('select');
      var instance_select = M.FormSelect.init(el_select);
      var el_modal = document.querySelectorAll('.modal');
      var instance_modal = M.Modal.init(el_modal);
      var el_carousel = document.querySelectorAll('.carousel');
      var instance_carousel = M.Carousel.init(el_carousel);
      var el_dropdown = document.querySelectorAll('.dropdown-trigger');
      var instance_dropdown = M.Dropdown.init(el_dropdown);
      var el_datepicker = document.querySelectorAll('.datepicker');
      var instances_datepicker = M.Datepicker.init(el_datepicker,{"autoClose":true,"format":'dd-mm-yyyy',"container":"body"});
      var el_timepicker = document.querySelectorAll('.timepicker');
      var instances_timepicker = M.Timepicker.init(el_timepicker,{"autoClose":true});

      // MATERIALIZE INSTANCES
      cls_document.filter_treatment('');
    });
    var raw_reasonlist = JSON.parse('<?php echo json_encode($raw_reasonlist); ?>');
    const cls_reason = new class_reason ('<?php echo json_encode($history['history']['reason']['selected']); ?>');
    var raw_currentlist = JSON.parse('<?php echo json_encode($raw_currentlist); ?>');
    const cls_current = new class_current;
    var raw_antecedentlist = JSON.parse('<?php echo json_encode($raw_antecedentlist); ?>');
    const cls_antecedent = new class_antecedent('<?php echo json_encode($history['history']['antecedent']['selected']); ?>');
    var raw_examinationlist = JSON.parse('<?php echo json_encode($raw_examinationlist); ?>','<?php echo json_encode($raw_examinationlist); ?>');
    const cls_examination = new class_examination;
    var raw_diagnosticlist = JSON.parse('<?php echo json_encode($raw_diagnosticlist); ?>');
    const cls_diagnostic = new class_diagnostic('<?php echo json_encode($history['history']['diagnostic']['selected']); ?>');
    var raw_planlist = JSON.parse('<?php echo json_encode($raw_planlist); ?>');
    const cls_plan = new class_plan;

    var raw_laboratorylist = JSON.parse('<?php echo json_encode($raw_order['laboratory']); ?>');
    var raw_eflist = JSON.parse('<?php echo json_encode($raw_efdatabase); ?>');
    
    const cls_order = new class_order;
    const cls_medical_history = new class_medical_history('<?php echo $raw_history['dateopened']['ai_date_id']; ?>');
    const cls_laboratory = new class_laboratory;

    const cls_document = new class_document(<?php echo $raw_history['dateopened']['ai_date_id']; ?>,'<?php echo json_encode($document['prescription']['drug_selected']); ?>');
    var raw_complementarylist = JSON.parse('<?php echo json_encode($raw_order['complementary']); ?>');
    var raw_profilelist = JSON.parse('<?php echo json_encode($raw_order['profile']); ?>');
    var raw_druglist = JSON.parse('<?php echo json_encode($raw_druglist); ?>');
    var raw_treatmentlist = JSON.parse('<?php echo json_encode($raw_treatmentlist); ?>')
    
    document.getElementById('paste_pe')
        .addEventListener('click', function (e) {
          cls_medical_history.paste_pe();
          e.preventDefault();
    });
  // HISTORIA
  document.getElementById('btn_save_history')
  .addEventListener('click', function (e) {
    const obj_physical_exam = cls_medical_history.make_json_pe();
    const obj_history = cls_medical_history.make_json_history();
    const obj_laboratory = cls_laboratory.make_json_laboratory();
    if (obj_physical_exam === false || obj_history === false || obj_laboratory === false) { return false; }
    cls_medical_history.save_history(<?php echo $raw_history['dateopened']['ai_date_id']; ?>,obj_physical_exam,obj_history,obj_laboratory);
    e.preventDefault();
  });
  
  document.getElementById('btn_print_report')
  .addEventListener('click', function (e) {
    print_html('/print_report/<?php echo $raw_history['dateopened']['tx_date_slug']; ?>')
    e.preventDefault();
  });
// LABORATORIO
  document.getElementById('btn_save_laboratory')
  .addEventListener('click', function (e) {
    if (document.getElementById('txt_ef_fc').value < 0.01 || document.getElementById('txt_ef_fr').value < 0.01) { 
      document.getElementById('txt_ef_fc').value = 1;
      document.getElementById('txt_ef_fr').value = 1;
      document.getElementById('txt_pe_fc').value = 1;
      document.getElementById('txt_pe_fr').value = 1;
      M.updateTextFields();
    }
    const obj_physical_exam = cls_medical_history.make_json_pe();
    const obj_history = cls_medical_history.make_json_history();
    const obj_laboratory = cls_laboratory.make_json_laboratory();
    cls_medical_history.save_history(<?php echo $raw_history['dateopened']['ai_date_id']; ?>,obj_physical_exam,obj_history,obj_laboratory);
    e.preventDefault();
  });
  document.getElementById('btn_print_laboratory')
  .addEventListener('click', (e) => {
    e.preventDefault();
    document.getElementById('btn_save_laboratory').click();
    setTimeout(() => {
      print_html('/print_lab/<?php echo $raw_history['dateopened']['tx_date_slug']; ?>')
    }, 500);
  })
  // MEDICAL ORDER
  document.getElementById('btn_save_medicalorder')
  .addEventListener('click', function (e) {
    if (document.getElementById('txt_ef_fc').value < 0.01 || document.getElementById('txt_ef_fr').value < 0.01) { 
      document.getElementById('txt_ef_fc').value = 1;
      document.getElementById('txt_ef_fr').value = 1;
      document.getElementById('txt_pe_fc').value = 1;
      document.getElementById('txt_pe_fr').value = 1;
      M.updateTextFields();
    } 
    const obj_document_medicalorder = cls_document.make_json_medicalorder();
    const obj_document_prescription = cls_document.make_json_prescription();
    const obj_document_incapacity = cls_document.make_json_incapacity();

    cls_document.save_document(<?php echo $raw_history['dateopened']['ai_date_id']; ?>,obj_document_medicalorder,obj_document_prescription);
    e.preventDefault();
  });

  document.getElementById('print_medicalorder_half')
  .addEventListener('click', (e) => {
    print_html('/print_medicalorder_half/<?php echo $raw_history['dateopened']['tx_date_slug']; ?>')
    e.preventDefault();
  })
  document.getElementById('print_medicalorder')
  .addEventListener('click', (e) => {
    print_html('/print_medicalorder/<?php echo $raw_history['dateopened']['tx_date_slug']; ?>')
    e.preventDefault();
  })
// RECIPE
    document.getElementById('btn_save_prescription')
  .addEventListener('click', function (e) {
    if (document.getElementById('txt_ef_fc').value < 0.01 || document.getElementById('txt_ef_fr').value < 0.01) { 
      document.getElementById('txt_ef_fc').value = 1;
      document.getElementById('txt_ef_fr').value = 1;
      document.getElementById('txt_pe_fc').value = 1;
      document.getElementById('txt_pe_fr').value = 1;
      M.updateTextFields();
    } 
    const obj_document_medicalorder = cls_document.make_json_medicalorder();
    const obj_document_prescription = cls_document.make_json_prescription();
    const obj_document_incapacity = cls_document.make_json_incapacity();
    cls_document.save_document(<?php echo $raw_history['dateopened']['ai_date_id']; ?>,obj_document_medicalorder,obj_document_prescription);
    e.preventDefault();
  });
// INCAPACITY
    document.getElementById('btn_documentconstancy')
  .addEventListener('click', function() {
    print_html('/print_constancy/<?php echo $raw_history['dateopened']['tx_date_slug']; ?>')
  })

    document.getElementById('btn_modal_incapacitysave')
  .addEventListener('click', function (e) {
    if (document.getElementById('txt_modal_incapacity_firstdate').value > document.getElementById('txt_modal_incapacity_lastdate').value) {
      M.toast({ html: history_obj['message'] });
      return false;
    }
    const obj_document_medicalorder = cls_document.make_json_medicalorder();
    const obj_document_prescription = cls_document.make_json_prescription();
    const obj_document_incapacity = cls_document.make_json_incapacity();
    cls_document.save_document(<?php echo $raw_history['dateopened']['ai_date_id']; ?>, obj_document_medicalorder, obj_document_prescription, obj_document_incapacity);
    setTimeout(function(){
      print_html('/print_incapacity/<?php echo $raw_history['dateopened']['tx_date_slug']; ?>')
    },500);
    e.preventDefault();
  });
  document.getElementById('btn_modal_incapacitycancel')
  .addEventListener('click', function (e) {
    var instance = M.Modal.getInstance(elem);
    instance.close();

    e.preventDefault();
  });


</script>
{{-- ##############    JQUERY   ############### --}}
<script type="text/javascript">
$(document).on("ready", function(){
  $("#txt_ef_fc,#txt_ef_fr,#txt_ef_tas,#txt_ef_tad,#txt_ef_gc,#txt_pe_fc,#txt_pe_fr,#txt_pe_tas,#txt_pe_tad,#txt_pe_gc").validCampoFranz('0123456789');
  $("#txt_ef_temp,#txt_pe_temp").validCampoFranz('0123456789.');
  $("#txt_laboratory_hemoblobin,#txt_laboratory_hematocrit,#txt_laboratory_platelet,#txt_laboratory_redbloodcell,#txt_laboratory_urea,#txt_laboratory_creatinine,#txt_laboratory_whitebloodcell,#txt_laboratory_lymphocytes,#txt_laboratory_neutrophils,#txt_laboratory_monocytes,#txt_laboratory_basophils,#txt_laboratory_eosinophils").validCampoFranz('0123456789.');
})
</script>
@endsection
