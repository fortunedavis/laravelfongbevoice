@extends("admin.index")
@section("admin")

<div id="success-message" class="alert alert-success" style="display:none;"></div>


@foreach($messages as $message)

    <div class="admin_message">
        <div class="admin_message_content">
            <p class="admin_message_text">{{$message->message}}</p>
            <!-- <audio controls>
                <source src="{{$message->record->path}}" type="audio/wav">
            </audio> -->
        </div>
        <div class="authors">
            <p>
                Auteur Auteur
            </p>
        </div>
        <div class="admin_actions">
            <div class="record_status">
                Validé
            </div>
            <ul class="admin_action_button">
                <li>
                    <button  data-audio-id="{{$message->record->id}}" class="valider admin_button admin_valider">
                        Valider
                    </button>
                </li>
                <li><button data-audio-id="{{$message->record->id}}" class="rejeter admin_button admin_rejeter">Rejeter</button></li>
            </ul>
        </div>
    </div> 
@endforeach

@stop