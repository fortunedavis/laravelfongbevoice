<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FFAPP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flat-ui/2.3.0/css/flat-ui.min.css" 
    integrity="sha512-6f7HT84a/AplPkpSRSKWqbseRTG4aRrhadjZezYQ0oVk/B+nm/US5KzQkyyOyh0Mn9cyDdChRdS9qaxJRHayww==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ URL::asset('style.css') }}" />
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
</head>
<body>
    @include('layouts.header')
    <div class="form_veil" id="myForm">
      <div class="form form-popup" >
          <form method="POST" id="connexion_form" action="{{ route('login') }}" class="form-container">
            @csrf
            <h4>Login</h4>
            <label id="i_email" for="email"><b>Email</b></label>
            <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            
            <label id="i_password" for="psw"><b>Password</b></label>
            <input type="password" name="password" placeholder="Enter Password" name="psw" required autocomplete="current-password">
            
            <label id="i_checkbox" for="psw"><b>Remember Me</b></label>
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
            
            <div class="form_button">
                <button type="button" class="btn cancel" id="close" >Fermer</button>
                <button type="submit" id="connexion_submit" class="btn">Go!</button>
            </div>
        </form>
      </div>
    </div>
    
    <div class="form_veil" id="registerForm" >
      <div class="form form-popup" >
          <form method="POST"  id="reg_form"action="{{ route('register') }}" class="form-container">
              @csrf
              <label  for="name"><b>Nom Et Prénom</b></label>
              <input id="name" type="text" name="name" value="{{ old('name') }}"  required autocomplete="name" autofocus>

              <label for="email"><b>Email</b></label>
              <input id="email" type="email"  name="email" value="{{ old('email') }}" required autocomplete="email">
                        
              <label for="psw"><b>Password</b></label>
              <input id="password" type="password"  name="password" required autocomplete="new-password">
                        
              <label for="psw-conf"><b>Confirmer Password</b></label>
              <input id="password-confirm" name="password_confirmation" type="password"   required autocomplete="new-password">

              <div class="form_button">
                  <button type="button" class="btn cancel" id="register_close">Close</button>
                  <button type="submit" id="register_submit" class="btn">Register</button>
              </div>
          </form>
      </div>
    </div>

    <main class="main">
            @yield("content")
    </main>

   @include('layouts.footer')
   @include('sweetalert::alert')
    <script src="{{asset("script.js")}}"></script>
    
</body>
</html>