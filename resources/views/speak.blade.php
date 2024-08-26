@extends('home')
@section('content')
            <div class="register_card">

                <div class="principal">
                    <div class="register_text" id="register_text">
                        <p id="user_text" >
                        </p>
                    </div>

                    <div class="user_audio_list">
                        <ul id="audioList"></ul>
                    </div>
                </div>
                
                <div class="speak_buttons">
                    <button class="speak_button mic_button_icon" id="buttonStart">
                        <i class="fi fi-rr-circle-microphone"></i>
                    </button>

                    <button class="pause record" id="buttonStop">
                        <div class="small-red_circle"></div>
                    </button>

                    <button class="speak_button submit_button_icon" id="submitButton" disabled>
                        <i class="fi fi-rr-navigation"></i>
                    </button>

                    <button class="speak_button" id="skipped">
                        <i class="fi fi-rr-angle-double-small-right"></i>
                    </button>
                    
                </div>
                <!-- <form id="Form" action="#" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="audioFile" name="audioFile">
                    <button type="submit">Submit Audio</button>
                </form> -->
                <script src="encode-audio.js"></script>
                <script src="audio-controller.js"></script>
                 <!-- <script src="real_audio.js"></script> -->
            </div>
@stop