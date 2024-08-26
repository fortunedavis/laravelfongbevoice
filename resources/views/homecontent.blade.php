@extends('home')
@section('content')

<div class="action">
                <div class="speak_card animate__animated animate__backInLeft">
                    <div class="speak_text ">
                        <h4>Speak</h4>
                        <p>Participez en donnant votre voix</p>
                        <p  id="speak_complement"></p>
                    </div>
                    <div class="speak_icon">
                        <a>
                            <i class="fi fi-rr-circle-microphone"></i>
                        </a>
                    </div>
                </div>
                <div class="listen_card animate__animated animate__backInRight">
                    <div class="listen_text">
                        <h4>Listen</h4>
                        <p>Aidez nous à noter les participants</p>
                        <p id="listen_complement"></p>
                    </div>
                    <a class="listen_icon">
                        <i class="fi fi-rr-play"></i>
                    </a>
                </div>
            </div>
            <div class="purpose_super_card">
                <div class="purpose_card">
                    <p>Description du projet</p>
                    <p>
                    L'Afrique compte plus de 2000 langues et pourtant 
                    celles-ci sont parmi les moins représentées dans 
                    la recherche du traitement automatique de la voix.
                    L'augmentation des efforts de la communauté ML sur 
                    le continent africain à conduit à un intérêt croissant
                    pour le traitement du langage naturel,
                    En particulier pour les langues africaines qui sont généralement des langues à faibles ressources.
                    Nous travaillons dans un contexte ou les langues africaines ne sont pas favorisées par les technologies 
                    de l'intelligence artificiel à cause du manque de donnée.
                    Fongbevi est une initiative de collecte de voix afin d'apprendre aux machines à 
                    comprendre la langue Fongbe. Vous pouvez participer directement au projet sur ce site en participant
                    aux enregistrements ou en évaluant la contribution des autres afin d'aider à la validation du corpus.
                    </p>
                </div>
            </div>
            <div class="authors">
                <div class="authors_card">
                    <p>Auteurs</p>
                    <div class="author_card_text animate__animated  animate__bounceInDown animate__delay-1s">
                        <div class="image_card">
                            <img src="3.jpg" alt="">
                        </div>
                        <div class="author_text">
                            <p>
                             L'Afrique compte plus de 2000 langues et pourtant 
                             celles-ci sont parmi les moins représentées dans 
                             la recherche du traitement automatique de la voix.
                            </p>
                        </div>
                    </div>
                    <div class="author_card_text animate__animated  animate__bounceInDown animate__delay-2s">
                        <div class="image_card">
                            <img src="3.jpg" alt="">
                        </div>
                        <div class="author_text">
                            <p>
                             L'Afrique compte plus de 2000 langues et pourtant 
                             celles-ci sont parmi les moins représentées dans 
                             la recherche du traitement automatique de la voix.
                            </p>
                        </div>
                    </div>
                    <div class="author_card_text animate__animated  animate__bounceInDown animate__delay-3s">
                        <div class="image_card">
                            <img src="3.jpg" alt="">
                        </div>
                        <div class="author_text">
                            <p>
                             L'Afrique compte plus de 2000 langues et pourtant 
                             celles-ci sont parmi les moins représentées dans 
                             la recherche du traitement automatique de la voix.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
@stop