@extends('frontend.include.app')
@section('css')
    <style>
        #top-bg::before {
            background-image: url('assets/img/about-us/top.jpg');
        }
        .modal-open-btn, .modal-open-btn:hover {
            border: 15px solid #000;
            padding: 0;
            border-radius: 0;
        }
        .fa-solid.fa-circle-play {
            font-size: 100px;
        }
    </style>
@endsection
@section('content')
    <section id="top-bg">
        <h1 class="text-white">About Us</h1>
        <h5 class="text-white">20 years of Alexandros history and memories</h5>
    </section>
    <section id="video" class="bg-primary">
        <div class="row container mx-auto">
            <div class="col-6">
                <h1>Our Success Story</h1>
                <p>It’s not easy to bring something new to the table, but when the ingredients are fresh, the recipe is
                    inspired with the right combination of tradition and personal talent it’s only a matter of time before
                    what was once new turns into a preferred culinary delight and a staple of any table</p>
                <p>In this very way Alexandros has taken a new approach to local Greek cooking and warmed the hearts and
                    stomachs of many happy lover of quality cuisine. Established in 1997, Alexandros has maintained its
                    commitment to quality ingredients and skillful recipes despite being less conventional and typical to
                    most Toronto Greek food.</p>
            </div>
            <div class="col-6">
                <button type="button" class="btn modal-open-btn position-relative" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <img class="img-fluid" src="{{ asset('assets/img/about-us/video.jpg') }}" alt="">
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <i class="fa-solid fa-circle-play"></i>
                    </div>
                </button>
            </div>
        </div>
    </section>

    <section id="chef" class="container">
        <h1>Our Chef</h1>
        <div class="row">
            <div class="col-8">
                <p>Through the confidence that our chef and owner Angelo Velonis has infused into his recipes, his cooking and his business operations today Alexandros is known a well-loved and consistently sought out addition to the tables of countless appreciative diners in Toronto.</p>
                <p>When Angelos began in 1997 Alexandros first location in Danforth did not allow for an easy beginning to the business; the look of the gyro was new and different – the chef’s omission of frozen ingredients to create meals that are as close to natural as possible, the way they are filled with an abundance of fresh herbs and personally sliced, it was and is still a completely unprocessed style of the food that had set in apart from other Greek establishments in Toronto that had come to be relied upon for a consistent and expected Greek taste. Alexandros was distinctly set apart right from the start and today that is its strength. Angelo’s personalized recipes and commitment to high quality ingredients and homespun approach in the kitchen are the reasons why Alexandros has come to be known as the place in Toronto where diners can get world famous gyros, our signature mouthwatering Roadhouse burger, and a scrumptious chicken souvlaki made exclusively with real chicken breast, guaranteed!</p>
            </div>
            <div class="col-4">
                <div>
                    <img class="img-fluid" src="{{ asset('assets/img/about-us/chef.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </section>

    @include('shared.toastr.working-hours.working_hours')




    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Our Success Story</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Close</button>
                </div>
                <div class="modal-body">
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/uHxYEUYuiB0" title="&quot;Warfaze&quot; Rupkotha | Guitar Rendition | A Tribute To Ibrahim Ahmed Kamal" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-primary text-white" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
