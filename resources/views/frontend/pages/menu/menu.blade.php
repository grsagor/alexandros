@extends('frontend.include.app')
@section('title', 'Menu')
@section('css')
    <style>
        #top-bg::before {
            background-image: url('assets/img/about-us/top.jpg');
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

        @media screen and (max-width: 767px) {
            #menu .menu-container{
                flex-direction: column-reverse !important;
            }
        }
    </style>
@endsection
@section('content')
    <section id="top-bg">
        <h1 class="text-primary page-title">Menu</h1>
        <h5 class="page-subtitle">20 years of Alexandros history and memories</h5>
    </section>
    <section id="menu" class="p-0 text-primary container mt-5">
        @foreach ($menus as $menu)
            <div class="row menu-container mb-3">
                <div class="col-12 col-md-6">
                    <div class="border p-3 h-100">
                        <h1 class="menu-title">{{ $menu->title }}</h1>
                        <span class="menu-title-ext">{{ $menu->speciality }}</span>
                        @foreach ($menu->items as $item)
                            <div class="menu-item d-flex position-relative">
                                <p class="m-0">{{ $item->item }}</p>
                                <div class="fill-underline-container">
                                    <div class="fill-underline"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="border h-100">
                        <img class="w-100 h-100 object-fit-cover" src="{{ asset($menu->img) }}" alt="">
                    </div>
                </div>
            </div>
            {{-- <div class="menu-container menu-1 row p-5">
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
            </div> --}}
        @endforeach
    </section>
@endsection
