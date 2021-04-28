@extends('layouts.outer') 
@section('title','Bienvenido')
@section('content')
<div class="container height_100">
  <div class="row">
    <div class="col s7 height_100 valign-wrapper">
      <div class="">
        <img src="{{ asset('image/logo_panama.jpg')}}" alt="">
      </div>
    </div>
    <div class="col s5 height_100 valign-wrapper">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div id="container_auth" class="row white">
            <div class="input-field col s12 center-align">
                <p> <h4>Bienvenido</h4> </p> <p> <h5>Ingresemos</h5> </p>
            </div>
            <div class="input-field col s12">
                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('Usuario') }}" required autocomplete="email" autofocus>
                <label for="email">{{ __('E-Mail') }}</label>
            </div>
            <div class="input-field col s12">
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                <label for="password">{{ __('Contraseña') }}</label>
            </div>
            <div class="input-field col s12">
                <button class="btn waves-effect waves-light" type="submit" name="action">Ingresemos
                    <i class="material-icons right">send</i>
                </button>
            </div>
            <div class="input-field col s12">
                <label>
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span>{{ __('Remember Me') }}</span>
                </label>
                {{-- <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label> --}}
            </div>
            <div class="input-field col s12 right-align">
                @if (Route::has('password.request'))
                    <a class="" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
            </div>
        </form>
    </div>
  </div>
</div>
@endsection
@section('javascript')
  {{-- <script type="text/javascript" src="{{asset('js/jshash-2.2/sha1.js')}}"></script> --}}

  <script type="text/javascript">
//   function hashPassword(event,form){
//     event.preventDefault();
//     const user_name = form.elements.tx_user_name;
//     const user_pass = form.elements.tx_user_password;
//     user_name.className = (user_name.value === '') ? 'invalid' : 'valid';
//     user_pass.className = (user_pass.value === '') ? 'invalid' : 'valid';
//     var input = ['tx_user_name','tx_user_password'];
//     valid = check_invalid(input);
//     if(valid === false){
//       return false;
//     }
//     form.elements.tx_user_password.value = hex_sha1(form.elements.tx_user_password);
//     form.submit();
//       // event.preventDefault();
//   }
  
  </script>
@endsection
