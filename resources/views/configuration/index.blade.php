@extends('layouts.configuration')
@section('title','Opciones')
@section('css')
  <link type="text/css" rel="stylesheet" href="{{ asset('css/font-awesome.css') }}"/>
  <link type="text/css" rel="stylesheet" href="{{ asset('css/configuration.css') }}"/>
@endsection
@section('content')
@php
  $raw_druglist = array();
  foreach ($raw_configuration['druglist'] as $key => $rs_drug) {
    $raw_druglist[$rs_drug['ai_drug_id']]['generic'] = $rs_drug['tx_drug_generic'];
    $raw_druglist[$rs_drug['ai_drug_id']]['comertial'] = $rs_drug['tx_drug_comertial'];
    $raw_druglist[$rs_drug['ai_drug_id']]['slug'] = $rs_drug['tx_drug_slug'];
    $raw_druglist[$rs_drug['ai_drug_id']]['status'] = $rs_drug['tx_drug_status'];
  }
  $raw_treatmentlist = array();
  foreach ($raw_configuration['treatmentlist'] as $key => $rs_treatment) {
    $raw_treatmentlist[$rs_treatment['ai_treatment_id']]['title'] = $rs_treatment['tx_treatment_title'];
    $raw_treatmentlist[$rs_treatment['ai_treatment_id']]['json'] = $rs_treatment['tx_treatment_json'];
    $raw_treatmentlist[$rs_treatment['ai_treatment_id']]['slug'] = $rs_treatment['tx_treatment_slug'];
    $raw_treatmentlist[$rs_treatment['ai_treatment_id']]['status'] = $rs_treatment['tx_treatment_status'];
  }
  $raw_orderlist = array();
  foreach ($raw_configuration['orderlist'] as $key => $rs_order) {
    $raw_orderlist[$rs_order['ai_order_id']]['id'] = $rs_order['ai_order_id'];
    $raw_orderlist[$rs_order['ai_order_id']]['value'] = $rs_order['tx_order_value'];
    $raw_orderlist[$rs_order['ai_order_id']]['type'] = $rs_order['tx_order_type'];
  }
@endphp
<div class="row mhp_100">
  <div class="col s12">
    <ul class="tabs transparent">
      <li class="tab col s3"><a href="#tab_opt_anamnesis">Examen F&iacute;sico</a></li>
      <li class="tab col s3"><a href="#tab_opt_history">Historia M&eacute;dica</a></li>
      <li class="tab col s3"><a href="#tab_opt_laboratory">Laboratorio</a></li>
      <li class="tab col s3"><a class="active" href="#tab_opt_document">Papeler&iacute;a</a></li>
    </ul>
  </div>
  <div id="tab_opt_anamnesis" class="col s12 py_5 mhp_100">
    @php
      include 'php/configuration/inc_opt_anamnesis.php'
    @endphp
  </div>
  <div id="tab_opt_history" class="col s12 py_5 mhp_100">
    @php
      include 'php/configuration/inc_opt_history.php'
    @endphp
  </div>
  <div id="tab_opt_laboratory" class="col s12 py_5 mhp_100">
    @php
      include 'php/configuration/inc_opt_laboratory.php'
    @endphp
  </div>
  <div id="tab_opt_document" class="col s12 py_5 mhp_100">
    @php
      include 'php/configuration/inc_opt_document.php'
    @endphp
  </div>
</div>
@endsection
@section('javascript')
  <script src="{{ asset('js/jquery.js') }}"></script>
  <script src="{{ asset('js/validCampoFranz.js') }}" defer></script>
  <script src="{{ asset('js/configuration.js') }}" ></script>
  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        // MATERIALIZE INSTANCES
      var el_tab = document.querySelectorAll('.tabs');
      var instance_tab = M.Tabs.init(el_tab);
      var el_select = document.querySelectorAll('select');
      var instance_select = M.FormSelect.init(el_select);
      var el_modal = document.querySelectorAll('.modal');
      var instance_modal = M.Modal.init(el_modal);

    });   
    const cls_recipe = new class_opt_recipe(<?php echo json_encode($raw_druglist) ?>,<?php echo json_encode($raw_treatmentlist) ?> );
    const cls_order = new class_opt_order(<?php echo json_encode($raw_orderlist) ?>);
    document.getElementById('btn_opt_treatment').addEventListener('click', function (e) {
      e.preventDefault();
      cls_recipe.render_opt_treatment(cls_recipe.generate_drug_list('treatment_drug_picklist','sidenav',1));
    });
    document.getElementById('btn_opt_drug').addEventListener('click', function (e) {
      e.preventDefault();
      cls_recipe.render_opt_drug(cls_recipe.generate_drug_list('drug_option_picklist','',0));
    });
    document.getElementById('btn_opt_order').addEventListener('click', function (e) {
      e.preventDefault();
      cls_order.render_opt_order(cls_order.array_opt_order['orderlist']);
    });
  </script>
@endsection
