<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <h1 class="logo me-auto"><a href="{{ route('frontend.home') }}">ALEXANDROS</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="{{ request()->routeIs('frontend.home') ? 'active' : '' }}"
                        href="{{ route('frontend.home') }}">Home</a></li>
                <li><a class="{{ request()->routeIs('frontend.about.us') ? 'active' : '' }}"
                        href="{{ route('frontend.about.us') }}">About Us</a></li>
                <li><a class="{{ request()->routeIs('frontend.menu') ? 'active' : '' }}"
                        href="{{ route('frontend.menu') }}">Menu</a></li>
                <li><a class="{{ request()->routeIs('frontend.contact.us') ? 'active' : '' }}"
                        href="{{ route('frontend.contact.us') }}">Contact Us</a></li>
            </ul>
            <i class="fa-solid fa-bars mobile-nav-toggle"></i>
        </nav>
        <!-- .navbar -->

        {{-- @if (Auth::user())
            <form action="{{ route('logout') }}" method="POST">@csrf <button type="submit"
                    class="get-started-btn">Logout</button></form>
        @else
            <a href="{{ route('login') }}" class="get-started-btn">Login</a>
        @endif --}}

    </div>
</header>
<iframe src="{{ asset('assets\audio\silence.mp3') }}" type="audio/mp3" allow="autoplay" id="audio"
    style="display:none"></iframe>
<audio id="myAudio" controls preload="auto" autoplay loop>
    <source src="{{ asset('assets\audio\ZORBA-ORIGINAL.mp3') }}" type="audio/mp3">
</audio>
<button style="margin: 100px;" onclick="PlayStop()">Play Audio</button>
<button style="margin: 100px;" onclick="pauseAudio()">Pause Audio</button>
<script>
    var myaudio = document.getElementById("myAudio");
    function PlayStop() {
        return myaudio.paused ? myaudio.play() : myaudio.pause();
    };
</script>
    