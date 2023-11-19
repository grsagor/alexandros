@extends('frontend.include.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/owl-carousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/owl-carousel/css/owl.theme.default.min.css') }}">

    <style>
        .owl-carousel .item {
            position: relative;
        }

        .owl-carousel .item img {
            filter: brightness(0.5);
        }

        .carousel-text--container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translateX(-50%);
        }

        .carousel-label {
            text-align: center;
        }

        .carousel-text {
            text-align: center;
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
            background-color: #3ac162 !important;
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

        #find{
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
    </style>
@endsection
@section('content')
    <section id="banner" class="p-0">
        <div class="owl-carousel owl-theme position-relative">
            <div class="item">
                <img src="{{ asset('assets\img\home\banner\1.jpg') }}" alt="">
                <div class="carousel-text--container">
                    <h5 class="carousel-label">First slide label</h5>
                    <p class="carousel-text">Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('assets\img\home\banner\1.jpg') }}" alt="">
                <div class="carousel-text--container">
                    <h5 class="carousel-label">First slide label</h5>
                    <p class="carousel-text">Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('assets\img\home\banner\1.jpg') }}" alt="">
                <div class="carousel-text--container">
                    <h5 class="carousel-label">First slide label</h5>
                    <p class="carousel-text">Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('assets\img\home\banner\1.jpg') }}" alt="">
                <div class="carousel-text--container">
                    <h5 class="carousel-label">First slide label</h5>
                    <p class="carousel-text">Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('assets\img\home\banner\1.jpg') }}" alt="">
                <div class="carousel-text--container">
                    <h5 class="carousel-label">First slide label</h5>
                    <p class="carousel-text">Some representative placeholder content for the first slide.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="introduction" class="container">
        <h1 class="text-center">Welcome To ALEXANDROS</h1>
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
            <div class="col-4">
                <div class="card position-relative">
                    <img src="{{ asset('assets\img\home\introduction\1.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body position-absolute top-50 start-50 translate-middle text-white text-primary">
                        <h5 class="card-title">Card title</h5>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card position-relative">
                    <img src="{{ asset('assets\img\home\introduction\2.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body position-absolute top-50 start-50 translate-middle text-white text-primary">
                        <h5 class="card-title">Card title</h5>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card position-relative">
                    <img src="{{ asset('assets\img\home\introduction\3.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body position-absolute top-50 start-50 translate-middle text-white text-primary">
                        <h5 class="card-title">Card title</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="find" class="pb-0">
        <div class="find-content--container container">
            <h1 class="text-center">Find Alexandros</h1>
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d14612.907889868366!2d90.44732798232423!3d23.70358739456398!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1700376094161!5m2!1sen!2sbd" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="background-container">
            <img class="w-100 bg-image" src="{{ asset('assets/img/home/find/1.jpg') }}" alt="">
        </div>
    </section>

    <section id="working-hours" class="pt-0">
        <div class="wokring-hours-content--container d-flex justify-content-end">
            <div class="w-50">
                <div class="working-hours-contents">
                    <h1 class="pb-5">Working Hours</h1>
                    <h5>Thank you for choosing us!</h5>
                    <h5 class="pb-5">Truly, it is our pleasure.</h5>
                    <div class="d-flex justify-content-between"><h5>Mon-Wed</h5><h5>11am-4am</h5></div>
                    <div class="d-flex justify-content-between"><h5>Friday</h5><h5>11am-5am</h5></div>
                    <div class="d-flex justify-content-between"><h5>Saturday</h5><h5>11am-5am</h5></div>
                    <div class="d-flex justify-content-between"><h5>Sunday</h5><h5>11am-5am</h5></div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{ asset('vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
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
    </script>
@endsection
