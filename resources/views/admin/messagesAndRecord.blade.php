@extends("admin.index")
@section("admin")

<div id="success-message" class="alert alert-success" style="display:none;"></div>


@foreach($records as $rec)

    <div class="admin_message">
        <div class="admin_message_content">
            <p class="admin_message_text">{{$rec->message->message}}</p>
            @php
               $storagePath = str_replace('public/', 'storage/', $rec->path);
                if (!function_exists('color')) {
                    function color($var) {
                        switch ($var) {
                            case 'rejected':
                                return "#c09ea2";
                            case 'validated':
                                return "#96E9C6";
                            default:
                                return "white";
                        }
                    }
                }
                $color = color($rec->state);
            @endphp
            <audio controls>
                <source controls src="{{asset($storagePath)}}">
            </audio>
        </div>
        <div class="admin_authors">
            Auteur
        </div>

        <div class="admin_actions">
            <div class="record_status" style="background-color: {{ $color }} !important">
                {{$rec->state}}
            </div>
            <ul class="admin_action_button">
                @if($rec->state =="neutral")
                <li>
                    <button  data-audio-id="{{$rec->id}}" class="valider admin_button admin_valider">
                        Valider
                    </button>
                </li>
                <li>
                    <button data-audio-id="{{$rec->id}}" class="rejeter admin_button admin_rejeter">
                        Rejeter
                    </button>
                </li>
                @endif
            </ul>
        </div>
    </div> 
@endforeach
<script src="{{asset("validateaudio.js")}}"></script>
@stop