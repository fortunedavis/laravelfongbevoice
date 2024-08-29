@extends("admin.index")
@section("admin")
<div class="admin_user_left">
    <table class="table-fill">
    <thead>
        <tr>
            <th class="text-left">Nom</th>
            <th class="text-left">Audio recorded</th>
            <th class="text-left">recorded accepted</th>
            <th class="text-left">Validateur</th>
            <th class="text-left">Actions</th>
        </tr>
    </thead>
    <tbody class="table-hover">
            @foreach($users as $user)
                <tr>
                    <td class="text-left">
                        {{ $user->name}}
                    </td>
                    <td class="text-left">
                        <p>10 Audios </p>
                        <p>5 Validés </p>
                    </td>
                    <td class="text-left">
                        <p>5 Validés </p>
                    </td>
                    <td>

                    </td>
                    <td class="text-left">
                        <button>modifier</button>
                        <button>delete</button>
                    </td> 
                </tr>
    
            @endforeach
        </tbody>
    </table>
</div>

<div class="admin_user_right">
      <div class="form form-popup" >
          <form method="POST"  id="reg_form"action="{{ route('register') }}" class="form-container">
              @csrf
              <label for="name"><b>Nom et prénoms</b></label>
              <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

              <label for="email"><b>Email</b></label>
              <input id="email" type="email"  name="email" value="{{ old('email') }}" required autocomplete="email">
                        
              <label for="psw"><b>Password</b></label>
              <input id="password" type="password"  name="password" required autocomplete="new-password">
                        
              <label for="psw-conf"><b>Confirmer Password</b></label>
              <input id="password-confirm" type="password"  required autocomplete="new-password">

              <div class="form_button">
                  <button type="submit" id="register_submit" class="btn">Valider</button>
              </div>
          </form>
        </form>
      </div>
</div>
@stop