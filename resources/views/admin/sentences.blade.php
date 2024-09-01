@extends("admin.index")
@section("admin")

<div id="success-message" class="alert alert-success" style="display:none;"></div>


@foreach($messages as $message)

    <div class="admin_message">
        <div class="admin_message_content">
            <p class="admin_message_text">{{$message->message}}</p>
        </div>
        
        <div class="admin_actions">
            
            <ul class="admin_action_button">
                <li>
                    <a href="{{ route('admin.messagedit', ['id' => $message->id]) }}">
                        modifier
                    </a>
                    <!-- <button  data-audio-id="{{$message->record->id}}" class="valider admin_button admin_valider">
                    </button> -->
                </li>
            </ul>
        </div>
    </div> 
@endforeach

@stop