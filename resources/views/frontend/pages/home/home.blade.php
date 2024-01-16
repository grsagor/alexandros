@extends('frontend.include.app')
@section('title', 'Home')
@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/owl-carousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/owl-carousel/css/owl.theme.default.min.css') }}">

    <style>
        #banner {
            margin-top: 115px;
        }

        .owl-carousel .item {
            position: relative;
            height: 80vh;
        }

        .owl-carousel .item img {
            /* filter: brightness(0.5); */
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .carousel-text--container {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .carousel-label {
            text-align: center;
            font-size: 116px;
            color: var(--primary-color);
            font-weight: 700;
        }

        .carousel-text {
            text-align: center;
            font-size: 24px;
            background: var(--primary-color);
            color: var(--white-primary-color);
            border-radius: 16px;
            width: fit-content;
        }

        .owl-theme .owl-nav {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            display: flex;
            justify-content: space-between;
            margin-top: 0;
        }

        .owl-carousel .owl-dots {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .owl-carousel .owl-nav button.owl-next,
        .owl-carousel .owl-nav button.owl-prev {
            background-color: var(--primary-color) !important;
            color: var(--white-primary-color);
            padding: 12px !important;
            font-size: 60px;
            margin: 0;
        }

        .introduction-card--container .card {
            border: none;
        }

        .introduction-card--container .card .card-img-top {
            filter: brightness(0.5);
            transition: all 0.5s ease-in-out;
        }

        .introduction-card--container .card .card-title {
            font-size: 32px;
            color: #fff;
        }

        .introduction-card--container .card:hover>.card-body {
            opacity: 0;
            transition: all 0.5s ease-in-out;
        }

        .introduction-card--container .card:hover>img {
            filter: brightness(1);
            transition: all 0.5s ease-in-out;
        }

        .card-body {
            opacity: 1;
            transition: all 0.5s ease-in-out;
        }

        #find {
            position: relative;
            margin-top: 150px;
        }

        #find .background-container {
            height: 400px;
            background-position: center;
            background-size: cover;
            overflow: hidden;
        }

        .find-content--container {
            position: absolute;
            bottom: 100px;
            left: 50%;
            transform: translate(-50%);
            margin: 0 auto;
            z-index: 9;
        }

        .bg-image {
            filter: blur(3px);
        }

        @media screen and (max-width: 992px) {
            .carousel-label {
                font-size: 92px;
            }

            .carousel-text {
                font-size: 13px;
            }
        }

        @media screen and (max-width: 768px) {
            .carousel-label {
                font-size: 66px;
            }

            .carousel-text {
                font-size: 16px;
            }
        }

        @media screen and (max-width: 576px) {
            .carousel-label {
                font-size: 46px;
            }

            .carousel-text {
                font-size: 10px;
            }
        }
    </style>
@endsection
@section('content')
    <section id="banner" class="p-0">
        <div class="owl-carousel owl-theme position-relative">
            <div class="item">
                <img src="{{ asset('assets\img\home\banner\1.jpg') }}" alt="">
                <div class="carousel-text--container">
                    <h5 class="carousel-label">ALEXANDROS</h5>
                    <p class="carousel-text">Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('assets\img\home\banner\2.jpg') }}" alt="">
                <div class="carousel-text--container">
                    <h5 class="carousel-label">ALEXANDROS</h5>
                    <p class="carousel-text">Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('assets\img\home\banner\3.jpg') }}" alt="">
                <div class="carousel-text--container">
                    <h5 class="carousel-label">ALEXANDROS</h5>
                    <p class="carousel-text">Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('assets\img\home\banner\4.jpg') }}" alt="">
                <div class="carousel-text--container">
                    <h5 class="carousel-label">ALEXANDROS</h5>
                    <p class="carousel-text">Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('assets\img\home\banner\5.jpg') }}" alt="">
                <div class="carousel-text--container">
                    <h5 class="carousel-label">ALEXANDROS</h5>
                    <p class="carousel-text">Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('assets\img\home\banner\6.jpg') }}" alt="">
                <div class="carousel-text--container">
                    <h5 class="carousel-label">ALEXANDROS</h5>
                    <p class="carousel-text">Some representative placeholder content for the first slide.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="introduction" class="container">
        <h1 class="text-center mb-0">Welcome To</h1>
        <h1 class="text-center text-primary pb-3">ALEXANDROS</h1>
        <p class="text-center">Angelo Velonis unravels the science of gyros cooking at Alexandros Take Out.</p>

        <p class="text-center">Alexandros success is based on controlling three vital elements when it comes to preparing
            its gyros: Seasoning, which includes fresh herbs, fat and temperature. Our authentic gyros is made on a vertical
            rotisserie which allows fat and blood to dribble down to make meal healthier.</p>

        <p class="text-center">Our gyros is made of whole pieces of first quality lean meat or chicken. The pieces of
            thinly-sliced marinated pork or chicken are skewed in a large stack on the rotisserie before being cooked at the
            proper temperature. What makes the difference when it comes to Alexandros gyros, is the texture of the meat
            mixture. And of course, the key factor is that no preservatives and frozen ingredients are being used in our
            kitchen.</p>

        <div class="row introduction-card--container mt-5">
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="card position-relative ratio ratio-1x1 overflow-hidden">
                    <img src="{{ asset('assets\img\home\introduction\1.jpg') }}" class="card-img-top" alt="...">
                    <div
                        class="card-body position-absolute top-50 start-50 translate-middle text-white text-primary d-flex flex-column justify-content-center">
                        <h5 class="card-title text-center">Gyros</h5>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="card position-relative ratio ratio-1x1 overflow-hidden">
                    <img src="{{ asset('assets\img\home\introduction\2.jpg') }}" class="card-img-top" alt="...">
                    <div
                        class="card-body position-absolute top-50 start-50 translate-middle text-white text-primary d-flex flex-column justify-content-center">
                        <h5 class="card-title text-center">Combos</h5>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="card position-relative ratio ratio-1x1 overflow-hidden">
                    <img src="{{ asset('assets\img\home\introduction\3.jpg') }}" class="card-img-top" alt="...">
                    <div
                        class="card-body position-absolute top-50 start-50 translate-middle text-white text-primary d-flex flex-column justify-content-center">
                        <h5 class="card-title text-center">Dinner</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="find" class="pb-0">
        <div class="find-content--container container">
            <h1 class="text-center text-primary">Find Alexandros</h1>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2885.5467975017286!2d-79.3493661!3d43.6783945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89d4cc9c5e593669%3A0x82ee0eca3829d2e5!2sAlexandros%20Take-Out!5e0!3m2!1sen!2sca!4v1702799372810!5m2!1sen!2sca"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="background-container">
            <img class="w-100 bg-image" src="{{ asset('assets/img/home/find/1.jpg') }}" alt="">
        </div>
    </section>

    @include('shared.working-hours.working_hours')
@endsection
@section('js')
    <script src="{{ asset('vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.0/anime.min.js"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            autoplay: true,
            autoplayTimeout: 3000,
            onTranslated: startAnimation,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        })

        function startAnimation() {
            let h5 = document.querySelector('.active .carousel-label');
            h5.innerHTML = h5.textContent.replace(/\S/g, "<span class='letter' style='display: inline-block'>$&</span>");

            let timeline = anime.timeline({
                autoplay: true,
                loop: false
            }).add({
                targets: '.active .carousel-label .letter',
                scale: [4, 1],
                opacity: [0, 1],
                easing: "easeOutExpo",
                duration: 1000,
                delay: (el, i) => 70 * i,
                endDelay: 500
            });
        }
        startAnimation();
    </script>
@endsection
