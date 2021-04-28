
@extends('layouts.configuration')
@section('title','Opciones')
@section('css')
  <link type="text/css" rel="stylesheet" href="{{ asset('css/font-awesome.css') }}"/>
  <link type="text/css" rel="stylesheet" href="{{ asset('css/configuration.css') }}"/>
@endsection
@section('content')
  <script type="text/javascript">
    var user_list = JSON.parse('<?php echo json_encode($data["user_list"])?>');
  </script>
  <div class="row">
    <div class="col s12 text_center">
      <a href="#" data-target="side_nav" class="sidenav-trigger" onclick="cls_general.set_sidenav('../php/configuration/inc_opt_sideconfiguration.php')"><i class="material-icons fs_40">menu</i></a>
    </div>
  </div>
  <div class="row"> 
    <div class="col s12" id="container_target">
      
    </div>
  </div>

@endsection
@section('javascript')
  <script src="{{ asset('js/jquery.js') }}"></script>
  <script src="{{ asset('js/validCampoFranz.js') }}" defer></script>
  <script src="{{ asset('js/configuration.js') }}" ></script>
  <script type="text/javascript">
    const cls_general = new general_funct();
    const cls_configuration = new class_configuration();
    const cls_medic = new class_medic()
    document.addEventListener('DOMContentLoaded', function() {
        // MATERIALIZE INSTANCES
      var el_tab = document.querySelectorAll('.tabs');
      var instance_tab = M.Tabs.init(el_tab);
      var el_select = document.querySelectorAll('select');
      var instance_select = M.FormSelect.init(el_select);
      // var el_modal = document.querySelectorAll('.modal');
      // var instance_modal = M.Modal.init(el_modal);
    });
  </script>
@endsection
