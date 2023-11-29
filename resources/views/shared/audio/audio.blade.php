{{-- <iframe src="{{ asset('assets\audio\silence.mp3') }}" type="audio/mp3" allow="autoplay" id="audio"
    style="display:none"></iframe> --}}
<div class="myAudio--conatiner">
    <audio id="myAudio" controls preload="auto" autoplay loop>
        <source src="{{ asset('assets\audio\ZORBA-ORIGINAL.mp3') }}" type="audio/mp3">
    </audio>
</div>