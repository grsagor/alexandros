/* Audio */
let clicked = 0;
var myaudio = document.getElementById("myAudio");
var playIcon = document.getElementById('play-icon');
playIcon.classList.toggle('fa-pause', myaudio.paused);
playIcon.classList.toggle('fa-play', !myaudio.paused);
function PlayStop(button) {
    console.log(myaudio.paused)
    var playIcon = document.getElementById('play-icon');
    playIcon.classList.toggle('fa-pause', myaudio.paused);
    playIcon.classList.toggle('fa-play', !myaudio.paused);

    if (myaudio.paused) {
        console.log('paused')
        myaudio.play().then(function() {
        }).catch(function(error) {
            console.error('Play failed:', error);
        });
    } else {
        console.log('played');
        myaudio.pause();
    }
}

// document.addEventListener('click', function() {
//     if (myaudio.paused) {
//         var playIcon = document.getElementById('play-icon');
//         playIcon.classList.toggle('fa-pause', myaudio.paused);
//         playIcon.classList.toggle('fa-play', !myaudio.paused);
//         myaudio.play();
//     }
//     clicked++;
// });