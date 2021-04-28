@extends('layouts.insider')
@section('title','¡Elijamos!')
@section('content')
<div class="container height_100 valign-wrapper">
  <div class="row">
    <div class="col s12">
      <form method="POST" action="/logmedic" name="form_logmedic" onsubmit="event.preventDefault(); log_medic()">
      {{-- {!! @Form::open(['action' => 'logmedicController@log', 'method' => 'post', 'name' => 'form_logmedic']) !!} --}}
        <div class="row w_400">
          <div class="col s12">
            <div class="input-field col s12">
              <select id="sel_medic">
                <option value="" disabled selected>Seleccione</option>
                @foreach ($rs_medic as $key => $medic)
                  <option value="{{$medic['tx_medic_slug']}}">{{$medic['tx_medic_pseudonym']}}</option>
                @endforeach
              </select>
              <label>Elija un M&eacute;dico</label>
            </div>
          </div>
          <div class="col s12">
            <button class="btn waves-effect waves-light" type="submit" name="action">Ingresemos
              <i class="material-icons right">send</i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

</div>
@endsection
@section('javascript')
  <script type="text/javascript">
    const cls_general = new general_funct();
    document.addEventListener('DOMContentLoaded', function() {
       var elems = document.querySelectorAll('select');
       var instances = M.FormSelect.init(elems);
     });
     function log_medic(){
        var medic_slug = document.getElementById("sel_medic").value;
        if (medic_slug === '') { 
          M.toast({ html: 'Debe seleccionar un médico.' });         
        }
        var url = '/logmedic'; var method = 'POST';
        var body = JSON.stringify({ a : medic_slug });
        var funcion = function (ans_obj) {
          window.location.href = '/date/create';
        }
        cls_general.async_laravel_request(url, method, funcion, body);
     }
  </script>
@endsection
