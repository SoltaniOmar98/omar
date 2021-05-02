@extends('admin.dashboard')
@section('title')
Home
@endsection
@section('content')
<input type="hidden" id="mytext" value="Bonjour cher admin dans votre espace en INIASS">
<div class="center-home">
    <div class="row">
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Audits</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">  Experts  </h5>
                    <p><h5>  </h5></p>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h5>Établissement</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Demandes</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                </div>
            </div>
        </div>
    </div>
 
</div>

<script type="text/javascript">
var mytext = document.getElementById('mytext');
var options;
var voiceMap = [];
var x = 0 ;

function loadVoices() {
    var voices = speechSynthesis.getVoices();
    for (var i = 0; i < voices.length; i++) {
        var voice = voices[i];
        var option = document.createElement('option');
        option.value = voice.name;
        option.innerHTML = voice.name;
        options.appendChild(Option);
        voiceMap[voice.name] = voice;

    };
};
window.speechSynthesis.onvoiceschanged = function(e) {
    loadVoices();
    
};
if(x== 0){
    window.onload = function() {
    var msg = new SpeechSynthesisUtterance();
    msg.volume = 7;
    msg.rate = 1;
    msg.pitch = 1;
    msg.text = mytext.value;
    window.speechSynthesis.speak(msg);
    x = x +1;
};
}
</script>

@endsection