@extends("admin.index")
@section("admin")

<div class="" >
          <form method="POST"  id="reg_form"action="{{ route('admin.updatesentence') }}" class="form-container">
              @csrf
              <label for="name"><b>message</b></label>
              <input id="name" type="textarea" name="message" value="{{ $message->message }}">
            <input type="hidden" name="id" value ="{{$message->id}}">
              <div class="form_button">
                  <button type="submit" id="register_submit" class="btn">Valider</button>
              </div>
          </form>
        </form>
      </div>

@stop