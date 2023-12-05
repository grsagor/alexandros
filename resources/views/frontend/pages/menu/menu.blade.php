@extends('frontend.include.app')
@section('css')
    <style>
        #top-bg::before {
            background-image: url('assets/img/about-us/top.jpg');
        }
        .menu-1 {
            background: linear-gradient(270deg, #000 50%, rgba(15, 24, 7, 0.00) 100%), url('../../../../../../assets/img/menu/1.jpg');
        }
        .menu-2 {
            background: linear-gradient(90deg, #000 50%, rgba(15, 24, 7, 0.00) 100%), url('../../../../../../assets/img/menu/2.jpg');
        }
        .menu-3 {
            background: linear-gradient(270deg, #000 50%, rgba(15, 24, 7, 0.00) 100%), url('../../../../../../assets/img/menu/3.jpg');
        }
        .menu-4 {
            background: linear-gradient(90deg, #000 50%, rgba(15, 24, 7, 0.00) 100%), url('../../../../../../assets/img/menu/4.jpg');
        }
        .menu-5 {
            background: linear-gradient(270deg, #000 50%, rgba(15, 24, 7, 0.00) 100%), url('../../../../../../assets/img/menu/5.jpg');
        }
        .menu-container {
            position: relative;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            min-height: 200px;
            --bs-gutter-x: 0;
        }
        .menu-title {
            font-size: 40px;
            font-weight: 700;
        }
        .menu-subtitle {
            font-size: 22px;
        }
        .menu-item {
            font-size: 22px;
        }
        .included-tax {
            font-size: 22px;
        }
    </style>
@endsection
@section('content')
    <section id="top-bg">
        <h1 class="text-white">Menu</h1>
        <h5 class="text-white">20 years of Alexandros history and memories</h5>
    </section>
    <section id="menu" class="p-0 text-primary">
        <div class="menu-container menu-1 row p-5">
            <div class="col-6"></div>
            <div class="menu-card col-6">
                <div class="d-flex align-items-center mb-3">
                    <h1 class="menu-title">RoadHouse Burgers</h1>
                    <span class="menu-title-ext">With 100% Angus Beef</span>
                </div>
                <h3 class="menu-subtitle">Try these unique burger recipes for amazing burgers that will delight everyone</h3>
                <div class="menu-item-container my-3">
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">HamBurger</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">HamBurger</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">HamBurger</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                </div>
                <h3 class="included-tax">Prices Not Included 13% Tax</h3>
            </div>
        </div>
        <div class="menu-container menu-2 row p-5">
            <div class="menu-card col-6">
                <div class="d-flex align-items-center mb-3">
                    <h1 class="menu-title">RoadHouse Burgers</h1>
                    <span class="menu-title-ext">With 100% Angus Beef</span>
                </div>
                <h3 class="menu-subtitle">Try these unique burger recipes for amazing burgers that will delight everyone</h3>
                <div class="menu-item-container my-3">
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">HamBurger</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">HamBurger</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">HamBurger</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                </div>
                <h3 class="included-tax">Prices Not Included 13% Tax</h3>
            </div>
            <div class="col-6"></div>
        </div>
        <div class="menu-container menu-3 row p-5">
            <div class="col-6"></div>
            <div class="menu-card col-6">
                <div class="d-flex align-items-center mb-3">
                    <h1 class="menu-title">RoadHouse Burgers</h1>
                    <span class="menu-title-ext">With 100% Angus Beef</span>
                </div>
                <h3 class="menu-subtitle">Try these unique burger recipes for amazing burgers that will delight everyone</h3>
                <div class="menu-item-container my-3">
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">HamBurger</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">HamBurger</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">HamBurger</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                </div>
                <h3 class="included-tax">Prices Not Included 13% Tax</h3>
            </div>
        </div>
        <div class="menu-container menu-4 row p-5">
            <div class="menu-card col-6">
                <div class="d-flex align-items-center mb-3">
                    <h1 class="menu-title">RoadHouse Burgers</h1>
                    <span class="menu-title-ext">With 100% Angus Beef</span>
                </div>
                <h3 class="menu-subtitle">Try these unique burger recipes for amazing burgers that will delight everyone</h3>
                <div class="menu-item-container my-3">
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">HamBurger</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">HamBurger</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">HamBurger</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                </div>
                <h3 class="included-tax">Prices Not Included 13% Tax</h3>
            </div>
            <div class="col-6"></div>
        </div>
        <div class="menu-container menu-5 row p-5">
            <div class="col-6"></div>
            <div class="menu-card col-6">
                <div class="d-flex align-items-center mb-3">
                    <h1 class="menu-title">RoadHouse Burgers</h1>
                    <span class="menu-title-ext">With 100% Angus Beef</span>
                </div>
                <h3 class="menu-subtitle">Try these unique burger recipes for amazing burgers that will delight everyone</h3>
                <div class="menu-item-container my-3">
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">HamBurger</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">HamBurger</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">HamBurger</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                </div>
                <h3 class="included-tax">Prices Not Included 13% Tax</h3>
            </div>
        </div>
    </section>
@endsection
