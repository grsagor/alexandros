<footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-6 col-md-6 footer-contact d-flex flex-column align-items-center justify-content-center text-center">
            <a href="{{ route('frontend.home') }}" class="header-logo-container">
              <img src="{{ asset('uploads/settings/' . Helper::getSettings('site_logo')) }}" alt="" class="img-fluid">
            </a>
            <p>
              484 Danforth Ave <br>
              Toronto, ON M4K 1P6<br>
              Canada <br><br>
              <strong>Phone:</strong> {{ Helper::getSettings('application_phone') }} <br>
              <strong>Email:</strong> {{ Helper::getSettings('application_email') }}<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a target="_blank" href="https://www.ubereats.com/ca/store/alexandros-takeout-danforth/a2hmjyG8TZWCemO4HziDMw">Uber</a></li>
              <li><i class="bx bx-chevron-right"></i> <a target="_blank" href="https://ritual.co/order/alexandros-take-out-danforth-logan-toronto/ff40">Ritual</a></li>
              <li><i class="bx bx-chevron-right"></i> <a target="_blank" href="https://www.skipthedishes.com/alexandros-danforth">Skip the dishes</a></li>
              <li><i class="bx bx-chevron-right"></i> <a target="_blank" href="https://www.doordash.com/en-CA/store/alexandros-toronto-37536">Doordash</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a>Catering</a></li>
              <li><i class="bx bx-chevron-right"></i> <a>Pickup</a></li>
              <li><i class="bx bx-chevron-right"></i> <a>Dine-in</a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>ALEXANDROS</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/ -->
          Designed by <a href="https://bootstrapmade.com/">GR Sagor</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0 d-flex">
        <a target="_blank" href="{{ Helper::getSettings('facebook_link') }}" class="d-flex flex-column justify-content-center align-items-center facebook"><i class="fa-brands fa-facebook"></i></a>
        <a target="_blank" href="{{ Helper::getSettings('instagram_link') }}" class="d-flex flex-column justify-content-center align-items-center instagram"><i class="fa-brands fa-square-instagram"></i></a>
      </div>
    </div>
  </footer>