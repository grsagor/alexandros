/* Audio */
let clicked = 0;
var myaudio = document.getElementById("myAudio");
var playIcon = document.getElementById('play-icon');
playIcon.classList.toggle('fa-pause', myaudio.paused);
playIcon.classList.toggle('fa-play', !myaudio.paused);
function PlayStop(button) {
    var playIcon = document.getElementById('play-icon');
    playIcon.classList.toggle('fa-pause', myaudio.paused);
    playIcon.classList.toggle('fa-play', !myaudio.paused);
    return myaudio.paused ? myaudio.play() : myaudio.pause();
};

document.addEventListener('click', function() {
    if ((myaudio.paused || myaudio.ended) && clicked == 0) {
        var playIcon = document.getElementById('play-icon');
        playIcon.classList.toggle('fa-pause', myaudio.paused);
        playIcon.classList.toggle('fa-play', !myaudio.paused);
        myaudio.play();
    }
    clicked++;
});