@extends('frontend.include.app')
@section('title', 'Catering')
@section('css')
    <style>
        #top-bg::before {
            background-image: url('assets/img/about-us/top.jpg');
        }

        .card {
            background: var(--primiary);
            height: 100%;
        }

        .catering-img-container {
            width: 100%;
            aspect-ratio: 1/1;
            overflow: hidden;
        }
        .card-text {
            text-align: center;
        }
    </style>
@endsection
@section('content')
    <section id="top-bg">
        <h1 class="text-white">Catering</h1>
        <h5 class="text-white">We also do South Asian and Indian Cuisine</h5>
    </section>
    <section>
        <h1 class="text-center mb-5 text-primary">Our South Asian and Indian Items</h1>
        <div class="row container mx-auto justify-content-center">
            <div class="col-lg-3 mb-4">
                <div class="card w-100">
                    <div class="catering-img-container">
                        <img src="{{ asset('assets/img/catering/1.jpg') }}" class="card-img-top w-100 h-100 object-fit-cover"
                            alt="...">
                    </div>
                    <div class="card-body">
                        <p class="card-text">Beef Palm Oil Stew</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div class="card w-100">
                    <div class="catering-img-container">
                        <img src="{{ asset('assets/img/catering/2.jpg') }}" class="card-img-top w-100 h-100 object-fit-cover"
                            alt="...">
                    </div>
                    <div class="card-body">
                        <p class="card-text">Brinjal fry with masala</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div class="card w-100">
                    <div class="catering-img-container">
                        <img src="{{ asset('assets/img/catering/3.jpg') }}" class="card-img-top w-100 h-100 object-fit-cover"
                            alt="...">
                    </div>
                    <div class="card-body">
                        <p class="card-text">Peshawari Motton Karahi</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div class="card w-100">
                    <div class="catering-img-container">
                        <img src="{{ asset('assets/img/catering/4.jpg') }}" class="card-img-top w-100 h-100 object-fit-cover"
                            alt="...">
                    </div>
                    <div class="card-body">
                        <p class="card-text">Koral fish Bhuna</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div class="card w-100">
                    <div class="catering-img-container">
                        <img src="{{ asset('assets/img/catering/5.jpg') }}" class="card-img-top w-100 h-100 object-fit-cover"
                            alt="...">
                    </div>
                    <div class="card-body">
                        <p class="card-text">Chicken with Black Limes Recipe</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div class="card w-100">
                    <div class="catering-img-container">
                        <img src="{{ asset('assets/img/catering/6.jpg') }}" class="card-img-top w-100 h-100 object-fit-cover"
                            alt="...">
                    </div>
                    <div class="card-body">
                        <p class="card-text">Kata Mashlay Mangsho</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div class="card w-100">
                    <div class="catering-img-container">
                        <img src="{{ asset('assets/img/catering/7.jpg') }}" class="card-img-top w-100 h-100 object-fit-cover"
                            alt="...">
                    </div>
                    <div class="card-body">
                        <p class="card-text">Indian Fried Rice</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div class="card w-100">
                    <div class="catering-img-container">
                        <img src="{{ asset('assets/img/catering/8.jpg') }}" class="card-img-top w-100 h-100 object-fit-cover"
                            alt="...">
                    </div>
                    <div class="card-body">
                        <p class="card-text">Colour full pulao</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div class="card w-100">
                    <div class="catering-img-container">
                        <img src="{{ asset('assets/img/catering/9.jpg') }}" class="card-img-top w-100 h-100 object-fit-cover"
                            alt="...">
                    </div>
                    <div class="card-body">
                        <p class="card-text">Dam Aloo</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div class="card w-100">
                    <div class="catering-img-container">
                        <img src="{{ asset('assets/img/catering/10.jpg') }}" class="card-img-top w-100 h-100 object-fit-cover"
                            alt="...">
                    </div>
                    <div class="card-body">
                        <p class="card-text">Saffron Rice</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div class="card w-100">
                    <div class="catering-img-container">
                        <img src="{{ asset('assets/img/catering/11.jpg') }}" class="card-img-top w-100 h-100 object-fit-cover"
                            alt="...">
                    </div>
                    <div class="card-body">
                        <p class="card-text">Roast Chicken</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div class="card w-100">
                    <div class="catering-img-container">
                        <img src="{{ asset('assets/img/catering/12.jpg') }}" class="card-img-top w-100 h-100 object-fit-cover"
                            alt="...">
                    </div>
                    <div class="card-body">
                        <p class="card-text">Fried Fish</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div class="card w-100">
                    <div class="catering-img-container">
                        <img src="{{ asset('assets/img/catering/13.jpg') }}" class="card-img-top w-100 h-100 object-fit-cover"
                            alt="...">
                    </div>
                    <div class="card-body">
                        <p class="card-text">Tandoori Chicken</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div class="card w-100">
                    <div class="catering-img-container">
                        <img src="{{ asset('assets/img/catering/14.jpg') }}" class="card-img-top w-100 h-100 object-fit-cover"
                            alt="...">
                    </div>
                    <div class="card-body">
                        <p class="card-text">Vegetables Sauté in butter</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
