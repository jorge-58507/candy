@extends('layouts.insider')
@section('title','¿Creará una Cita?')
@section('css')
  <link type="text/css" rel="stylesheet" href="{{ asset('css/font-awesome.css') }}"/>
  <link type="text/css" rel="stylesheet" href="{{ asset('css/date.css') }}"/>
@endsection
@section('content')
  @php
    $medic_option = json_decode($raw_admin_date['medic_logged']['tx_medic_option'],true);
  @endphp
  <div class="row">
    <div class="col s12">
      <div class="row">
        <div class="col s4"></div>
        <div class="col s4 center-align border_teal bs_2 radius_5">
          <h4>Listado de Citas</h4>
        </div>
        <div class="col s4"></div>
      </div>
      <div class="row">
        <div class="col s6 m4 l2 offset-s3 offset-m4 offset-l5 input-field">
          <i class="far fa-calendar-alt prefix"></i>
          <input type="text" id="txt_date_date" name="txt_date_date" class="datepicker" value="{{ date('d-m-Y') }}">
          <label for="txt_date_date">Fecha</label>
        </div>
        <div class="col s2 mt_15">
          <a id="btn_filter_date" class="btn-floating waves-effect waves-light btn teal"><i class="fa fa-search"></i></a>
        </div>
        <div class="col s12 center-align">
          <a class="waves-effect waves-light btn teal" id="btn_date_create"><i class="fa fa-list small left"></i> Crear Cita</a>
        </div>
      </div>
      <div class="row">
        <div class="col s12 border_teal bs_2 radius_10  toggle_off" id="div_create_date" >
          <form name="form_new_date" class="" action="" method="post" onsubmit="cls_date.save_new_date(event);">
            <div class="row">
              <div class="col s9 m10 l5">
                <div class="input-field">
                  <label for="txt_date_patient" id="lbl_date_patient">Paciente</label>
                  <input type="text" id="txt_date_patient" name="txt_date_patient" onfocus="cls_general.validFranz(this.id,['word','number'])" value="" class="autocomplete" autocomplete="off">
                </div>
              </div> 
              <div class="col s3 m2 l1">
                <div class="py_15">
                  <a id="btn_patient_create" data-target="side_nav" class="sidenav-trigger btn-floating waves-effect waves-light btn teal"><i class="material-icons">plus_one</i></a>
                </div>
              </div>
              <div class="col s12 m6 l3">
                <div class="input-field">
                  <label id="lbl_date_reason" for="txt_date_reason">Motivo de Consulta</label>
                  <input type="text" id="txt_date_reason" name="txt_date_reason" onfocus="cls_general.validFranz(this.id,['word','number','symbol'])" value="" autocomplete="off">
                </div>
              </div>
              <div class="col s3 m2 l1">
                <div class="py_15">
                  <a id="btn_reason_create" data-target="side_nav" class="sidenav-trigger btn-floating waves-effect waves-light btn teal"><i class="fa fa-plus"></i></a>
                </div>
              </div>
              <div class="col s12 m4 l2">
                <div class="input-field">
                  <i class="far fa-clock prefix teal-text"></i>
                  <input type="text" id="txt_date_time" name="txt_date_time" class="timepicker" value="">
                  <label for="txt_date_time">Hora</label>
                </div>
              </div>
              <div class="col s12 center-align">
                <button id="submit_newdate" class="btn waves-effect waves-light" type="submit" name="action" >Guardar Cita
                  <i class="material-icons right">send</i>
                </button>
              </div>
            </div>

          </form>

        </div>
      </div>

      <div class="row">
        <div class="col s12 border_teal bs_2 radius_10 ">    {{--   TABLE CONTAINER    --}}
          <div class="dtbl dtbl_bordered">

            <div class="row dtbl_caption">
              <div class="col s12"><span id="caption_date">Citas del D&iacute;a</span></div>
            </div>
            <div class="row dtbl_head">
              <div class="col s5 m4 teal">PACIENTE</div>
              <div class="col s1 m2 teal">HORA</div>
              <div class="col s2 teal">MOTIVO</div>
              <div class="col s2 hide-on-med-and-down teal">ESTADO</div>
              <div class="col s4 m4 l2 teal">&nbsp;</div>
            </div>
            <div class="row dtbl_body" id="dtbl_date">
              <div class="">
                <div class="col s12">&nbsp;</div>
              </div>
            </div>
            <div class="row dtbl_footer">
              <div class="col s12 teal"></div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
@endsection
@section('javascript') 
  {{-- <script src="{{ asset('js/jquery.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/jquery-ui.min.js') }}"></script> --}}
  <script src="{{ asset('js/validCampoFranz.js') }}" defer></script>
  <script src="{{ asset('js/date.js') }}" ></script>
  <script src="{{ asset('js/patient.js') }}" ></script>
  <script src="{{ asset('js/reason.js') }}" ></script>
  <script type="text/javascript">
    const cls_general = new general_funct();
    const cls_patient = new patient_funct();
    const cls_date = new date_funct();
    // const cls_date = new class_date();
    document.addEventListener('DOMContentLoaded', function() {
    // MATERIALIZE INSTANCES
      var datepicker = document.querySelectorAll('.datepicker');
      var instances_datepicker = M.Datepicker.init(datepicker,{"autoClose":true,"format":'dd-mm-yyyy'});

      var timepicker = document.querySelectorAll('.timepicker');
      var instances_timepicker = M.Timepicker.init(timepicker,{"autoClose":true});

      // AUTOCOMPLETADO DE PACIENTE
      var patient_autocomplete = document.getElementById('txt_date_patient');
      var onAutocomplete = function(val) {
        var val_splited = val.split("--");
        var url = '/verify_historynumber/'+val_splited[1]; var method = 'GET';
        var funcion = function(patient_obj) { 
        $('#txt_date_patient').prop("alt",patient_obj['data'][0]['ai_patient_id']); }
        cls_general.laravel_request(url,method,funcion);
      };

      var options = JSON.parse('<?php echo json_encode(	$raw_patient_list=['data'=>$raw_admin_date['patient_list']]); ?>');
      options['onAutocomplete']=onAutocomplete;
      var patient_instance = M.Autocomplete.init(patient_autocomplete,options);
      // AUTOCOMPLETADO DE PACIENTE


      // AUTOCOMPLETADO DE MOTIVO
      var reason_autocomplete = document.getElementById('txt_date_reason');
      var onAutocomplete = function(val) {
        var url = '/reason_id_by_value/'+reason_autocomplete.value; var method = 'GET';
        var funcion = function(reason_obj) { reason_autocomplete.setAttribute("alt",reason_obj['reason_id']); }
        cls_general.laravel_request(url,method,funcion);
      };
      var options = <?php echo json_encode(	$raw_patient_list=["data"=>$raw_admin_date['reason_list']]); ?>;
      options['onAutocomplete']=onAutocomplete;
      var reason_instance = M.Autocomplete.init(reason_autocomplete,options);
      // MATERIALIZE INSTANCES

      document.getElementById("btn_date_create").onclick = function () {
        cls_general.toggle('div_create_date');  
      }
      document.getElementById("btn_filter_date").onclick = function () {  cls_date.filter_date (document.getElementById("txt_date_date").value);  }
      document.getElementById("btn_patient_create").onclick = function () {
        var url = '/patient/last/'; var method = 'GET'; var body = '';
        var funcion = function (data) {
          patient_name = (document.getElementById("txt_date_patient").value).replace(/\b\w/g, function(l){ return l.toUpperCase() });
          var defaultDate = "<?php if(empty($medic_option['defaultDate'])) { echo '-30'; } else { echo $medic_option['defaultDate']; } ?>";
          cls_general.set_sidenav('/php/side_panel/inc_patient_create.php?name='+patient_name+'&defaultDate='+defaultDate+'&h='+data['next_h']);
          setTimeout(function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);
            document.getElementById("txt_patient_name").focus();
            M.updateTextFields();
          },500)
        }
        cls_general.laravel_request(url,method,funcion);
      }
      document.getElementById("btn_reason_create").onclick = function () {
        reason_value = document.getElementById("txt_date_reason").value;
        cls_general.set_sidenav('/php/side_panel/inc_reason_create.php?value='+reason_value);
      }
      document.getElementById("txt_date_reason").onkeyup = function () {  this.setAttribute("alt","");  }
      document.getElementById("txt_date_patient").onkeyup = function () {  this.setAttribute("alt",""); }
      document.getElementById("txt_date_date").onchange = function () {  $("#btn_filter_date").click(); }
      cls_date.render_table_dates(<?php echo $raw_admin_date['date_list'] ?>);
    });

  </script>
  <script type="text/javascript">

  </script>
@endsection
