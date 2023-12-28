@extends('frontend.include.app')
@section('title', 'Contact Us')
@section('css')
    <style>
        #top-bg::before {
            background-image: url('assets/img/about-us/top.jpg');
        }
        #map {
            margin-bottom: 250px;
        }
        .map-container {
            width: 75%;
            position: absolute;
            top: 0;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .fa-solid.fa-location-dot {
            font-size: 64px;
        }

        #contact-form {
            background: var(--primary-color);
        }

        .contact-form-bg--container {
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 75%;
            margin: auto auto;
            padding: 48px;
        }

        .contact-form-bg--container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('assets/img/contact-us/form-bg.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            z-index: 0;
        }
    </style>
@endsection
@section('content')
<section id="top-bg">
    <h1 class="text-primary page-title">Find Alexandros</h1>
    <h5 class=" page-subtitle">Alexandros is located in the heart of Toronto near sugar beach its very easy to find</h5>
</section>

<section id="map" class="p-0 position-relative">
    <div class="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2885.5467975017286!2d-79.3493661!3d43.6783945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89d4cc9c5e593669%3A0x82ee0eca3829d2e5!2sAlexandros%20Take-Out!5e0!3m2!1sen!2sca!4v1702799372810!5m2!1sen!2sca" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>

<section id="address">
    <div class="address-container container d-flex flex-column justify-content-center align-items-center">
        <i class="fa-solid fa-location-dot text-primary"></i>
        <h3 class="city-name text-center">Toronto</h3>
        <p class="street-address m-0 text-center">484 Danforth Ave, Toronto, ON M4K 1P6, Canada</p>
        <p class="contact-number m-0 text-center">+1 (416) 461-3073</p>
    </div>
</section>

<section id="contact-form">
    <div class="contact-form-bg--container">
        <div class="contact-form--container z-1 text-white-secondary ">
            <h1>Get In Touch</h1>
            <p>Whether you want to make a reservation or place a delivery order you can do it by phone on +1 416-367-0633 Please fill out the form below to inquire about our restaurant, or to give any feedback about our food or service.</p>
            <form class="w-100">
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
                  </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" placeholder="Message" rows="3"></textarea>
                  </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
              </form>
        </div>
    </div>
</section>
@endsection