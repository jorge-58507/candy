<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name') }}</title>

    <link type="text/css" rel="stylesheet" href="{{ asset('css/material_icons.css') }}"  />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.min.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/insider.css') }}" />
    @yield('css')
    <script type="text/javascript" src="{{ asset('js/scrollreveal.min.js') }}"></script>
</head>
<body>
    <div id="app">
      <div id="" class="content" style="height:246vh">
        {{-- ###################   SIDENAV    ###################### --}}
         <div id="side_nav" class="sidenav">
           @php
             include 'php/inc_sidenav.php'
           @endphp
         </div>
         {{-- ###################   BUTTON SIDENAV    ###################### --}}
        <div id="div_border" style="" class="valign-wrapper">
          <div class="">
            <a id="btn_slide_panel"  data-target="side_nav" class="sidenav-trigger btn-floating btn-large waves-effect waves-light teal lighten-2 panel_button"><i class="material-icons">chevron_right</i></a>
          </div>
        </div>
        {{-- ###################   BOTTOM NAVBAR    ###################### --}}
        <div class="navbar-fixed">
          <nav class="teal lighten-2">
            <div class="nav-wrapper">
              <a href="#!" class="brand-logo hide-on-small-only">Logo</a>
              <span id="span_medic_logged">
                @php
                if(!empty($raw_history['medic_logged']['tx_medic_gender'])){
                  $gender_prefix = ($raw_history['medic_logged']['tx_medic_gender'] === 'femenina') ? 'Dra.' : 'Dr.';
                  echo $gender_prefix." ".$raw_history['medic_logged']['tx_medic_pseudonym']." - <em>".$raw_history['medic_logged']['tx_medic_speciality']."</em>";
                }
              @endphp
              </span>
              <ul class="right hide-on-med-and-down">
                <li><a href="/history">Historia M.</a></li>
                <li><a href="/configuration">Configuraci&oacute;n</a></li>
              </ul>
            </div>
          </nav>
        </div>

        @yield('content')
      </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/general.js') }}" defer></script>
    <script src="{{ asset('js/materialize.min.js') }}" defer></script>
        @yield('javascript')
    <script type="text/javascript">

      document.addEventListener('DOMContentLoaded', function() {
        var sidenav = document.querySelectorAll('.sidenav');
        var sidenav_instances = M.Sidenav.init(sidenav);
        var div_border = document.getElementsByClassName('drag-target');
        var btn_slide_panel = document.getElementById("btn_slide_panel");
        div_border[0].onmouseover = function() {
          btn_slide_panel.classList.add('active');
        }
        div_border[0].onmouseout = function() {
          btn_slide_panel.classList.remove('active');
        }
        btn_slide_panel.onmouseover = function() {
          btn_slide_panel.classList.add('active');
        }
        btn_slide_panel.onmouseout = function() {
          btn_slide_panel.classList.remove('active');
        }
        btn_slide_panel.onclick = function() {
          set_sidenav('/php/inc_sidenav.php');
          btn_slide_panel.classList.remove('active');
        }
      });
    </script>
  </body>
</html>
