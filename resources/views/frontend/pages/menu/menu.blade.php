@extends('frontend.include.app')
@section('css')
    <style>
        #top-bg::before {
            background-image: url('assets/img/about-us/top.jpg');
        }

        .menu-container {
            position: relative;
            min-height: 200px;
            --bs-gutter-x: 0;
        }
        #menu .menu-container:nth-child(even) {
            flex-direction: row-reverse;
        }

        .menu-bg-container {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }

        .shade-container {
            position: absolute;
            top: 0;
            left: auto;
            width: 100%;
            background: linear-gradient(to left, rgba(0, 0, 0, 1), transparent);
            bottom: 0;
        }

        #menu .menu-container:nth-child(even) .shade-container {
            background: linear-gradient(to right, rgba(0, 0, 0, 1), transparent);
        }

        .shade {

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
        @foreach ($menus as $menu)
            <div class="menu-container menu-1 row p-5">
                <div class="menu-bg-container">
                    <img class="w-100 h-100 object-fit-cover" src="{{ asset($menu->img) }}" alt="">
                    <div class="shade-container"></div>
                </div>
                <div class="col-6"></div>
                <div class="menu-card col-6 z-1">
                    <div class="d-flex align-items-center mb-3">
                        <h1 class="menu-title">{{ $menu->title }}</h1>
                        <span class="menu-title-ext">{{ $menu->speciality }}</span>
                    </div>
                    <h3 class="menu-subtitle">{{ $menu->subtitle }}</h3>
                    <div class="menu-item-container my-3">
                        @foreach ($menu->items as $item)
                            <div class="menu-item d-flex position-relative">
                                <p class="m-0">{{ $item->item }}</p>
                                <div class="fill-underline-container">
                                    <div class="fill-underline"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <h3 class="included-tax">{{ $menu->tax }}</h3>
                </div>
            </div>
        @endforeach


        {{-- <div class="menu-container menu-2 row p-5">
            <div class="menu-card col-6">
                <div class="d-flex align-items-center mb-3">
                    <h1 class="menu-title">Dinners</h1>
                    <span class="menu-title-ext"></span>
                </div>
                <h3 class="menu-subtitle">All Diners served with fries</h3>
                <div class="menu-item-container my-3">
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">Gyros in a Box <small>(Just Meat)</small></p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">Gyros on Greek Salad</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">Gyros on Greek Fries</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">Chicken Souvlaki Dinner</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">Chicken Gyros Dinner</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">Pork gyros dinner</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">Chicken souvlaki stick</p>
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
                    <h1 class="menu-title">World’s Famous Gyros</h1>
                    <span class="menu-title-ext"></span>
                </div>
                <h3 class="menu-subtitle">Gyros that taste very much like what you would eat in Greece. Well seasoned, succulent meat that unapologetically still has some fat in the meat mix.</h3>
                <div class="menu-item-container my-3">
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">Gyros on a Pita</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">Greek Veggie Pita</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">Chicken Souvlaki Stick</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">Tzatziki</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">Gravy</p>
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
                    <h1 class="menu-title">Sides</h1>
                    <span class="menu-title-ext"></span>
                </div>
                <h3 class="menu-subtitle">Try these unique burger recipes for amazing burgers that will delight everyone</h3>
                <div class="menu-item-container my-3">
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">Fries Regular</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">Fries Large</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">Greek Poutine regular</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">Greek Poutine large</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">Greek Salad</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">Onion Rings</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">Gravy</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">Tzatziki</p>
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
                    <h1 class="menu-title">Combos</h1>
                    <span class="menu-title-ext"></span>
                </div>
                <h3 class="menu-subtitle"></h3>
                <div class="menu-item-container my-3">
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">Dinner wrap</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">Dinner for 2</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">Greek burger Combo</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                    <div class="menu-item d-flex position-relative">
                        <p class="m-0">Vegetarian Combo Greek veggie pita</p>
                        <div class="fill-underline-container">
                            <div class="fill-underline"></div>
                        </div>
                    </div>
                </div>
                <h3 class="included-tax">Prices Not Included 13% Tax</h3>
            </div>
        </div> --}}
    </section>
@endsection
