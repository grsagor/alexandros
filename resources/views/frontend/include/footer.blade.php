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
              <strong class="text-danger">Phone: {{ Helper::getSettings('application_phone') }}</strong> <br>
              <strong>Email:</strong> {{ Helper::getSettings('application_email') }}<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4 class="text-center text-md-start">Useful Links</h4>
            <ul>
              <li class="justify-content-center justify-content-md-start"><i class="bx bx-chevron-right"></i> <a class="d-flex align-items-center gap-2" target="_blank" href="https://www.ubereats.com/ca/store/alexandros-takeout-danforth/a2hmjyG8TZWCemO4HziDMw">
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" aria-label="Uber" role="img" viewBox="0 0 512 512"><rect width="512" height="512" rx="15%"/><path d="M119.8,303.6c17.6,0,31.3-13.6,31.3-33.8V191.3h19.1V318.6H151.3V306.8a45.9,45.9,0,0,1-33.6,14c-27.3,0-48.2-19.8-48.2-49.8V191.4H88.6v78.5c0,20.5,13.4,33.7,31.2,33.7m64.6-112.3h18.4v46.4a46.11,46.11,0,0,1,32.9-13.8,48.45,48.45,0,0,1,0,96.9A46.52,46.52,0,0,1,202.6,307v11.6H184.4V191.3Zm50,113.2a32.2,32.2,0,1,0-32-32.4v.2a32,32,0,0,0,31.8,32.2h.2M339.3,224c26.7,0,46.4,20.5,46.4,48.2v6H310.3A31.09,31.09,0,0,0,341,304.6c10.7,0,19.8-4.4,26.7-13.6l13.3,9.8c-9.3,12.4-23.1,19.8-40,19.8-27.8,0-49.3-20.7-49.3-48.4-.1-26.2,20.5-48.2,47.6-48.2m-28.8,39.6H367c-3.1-14.2-14.5-23.6-28.2-23.6-13.5,0-25,9.5-28.3,23.6m124.4-21.4c-12,0-20.7,9.3-20.7,23.6v52.7H395.8V225.8H414v11.5c4.5-7.5,12-12.2,22.2-12.2h6.4v17.1Z" fill="#ffffff"/></svg>
                Uber</a></li>
              <li class="justify-content-center justify-content-md-start"><i class="bx bx-chevron-right"></i> <a class="d-flex align-items-center gap-2" target="_blank" href="https://ritual.co/order/alexandros-take-out-danforth-logan-toronto/ff40">
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" id="katman_1" x="0px" y="0px" viewBox="0 0 600 450" style="enable-background:new 0 0 600 450;" xml:space="preserve">
                  <style type="text/css">
                    .st0{fill:#253367;}
                  </style>
                  <path class="st0" d="M177.4,294.7l-28.7-43c17.4-8.7,27.2-24.1,27.2-43.1c0-28.5-21.2-49.9-58.9-49.9H73.3v136h24.4v-36.3h26.6  l23.8,36.3H177.4z M119.5,233.4H97.7v-49.7h21.7c17.3,0,30.8,7.7,30.8,24.9C150.2,225.7,136.8,233.4,119.5,233.4 M502.5,158.7h24.4  v136h-24.4V158.7z M260.3,219.2v45.1c0.4,6,3.1,8.8,8.4,8.8c5.3,0,9.2-2.3,12.4-4.9v23c-4.7,3.3-12.6,5.7-21.4,5.1  c-5.9-0.3-12.7-2.9-17.6-7.8c-4.2-5.2-6.3-10.4-6.3-19.2v-50.2h-12.5v-22.1h12.5v-31.7h24.4v31.7H277v22.1H260.3z M381.6,294.6  h-21.9l-2.3-11.1c-4.5,5.9-13.7,12.3-27.2,12.3c-24.2,0-40.6-14.2-40.6-40.2v-58.5h24.2v50.3c0,17.2,7.7,24.6,21.7,24.6  c14,0,21.9-10.1,21.9-24.6v-50.3h24.2L381.6,294.6L381.6,294.6z M489.9,197.3v97.4h-19.5l-2.3-10.1c-4.1,5.3-14.8,11.3-27.9,11.3  c-27.9,0-48.9-20.6-48.9-49.9c0-29.2,21-49.9,48.9-49.9c12.9,0,23.8,6,27.9,11.3l2.3-10.1L489.9,197.3L489.9,197.3z M441,219.2  c-14.8,0-26.3,12.2-26.3,26.8c0,14.6,11.4,26.8,26.3,26.8c14.5,0,25.6-12.1,25.6-26.8C466.6,231.3,455.5,219.2,441,219.2   M187.7,197.2h24.4v97.5h-24.4V197.2z M215.7,170c0,8.9-7.1,16.1-15.9,16.1c-8.8,0-15.9-7.2-15.9-16.1c0-8.9,7.1-16.1,15.9-16.1  C208.5,153.9,215.7,161.1,215.7,170"/>
                  </svg>
                Ritual</a></li>
              <li class="justify-content-center justify-content-md-start"><i class="bx bx-chevron-right"></i> <a class="d-flex align-items-center gap-2" target="_blank" href="https://www.skipthedishes.com/alexandros-danforth">
                <svg fill="#ff8000" id="root-loading-svg" height="24" width="24" viewBox="0 0 64 68" xmlns="http://www.w3.org/2000/svg"><title>SkipTheDishes logo</title><path fill="E1E5E8" fill-rule="evenodd" d="M63.368 33.05a99.854 99.854 0 00-6.901-10.536l-.06-.084c-.126-.168-.454-.592-.576-.76-1.147-1.643-.986-2.84-.986-2.84-.322-4.35-.88-8.68-1.669-12.964-.185-1.144-.497-2.333-2.077-2.51-1.264-.14-3.181-.366-5.284-.476-1.76-.093-1.98 1.793-1.98 1.793-.038 1.913 0 2.832 0 3.052a.484.484 0 01-.375.557.595.595 0 01-.383-.12 81.38 81.38 0 00-9.093-6.873 4.163 4.163 0 00-2.081-.622 3.426 3.426 0 00-1.804.622c-.94.623-17.123 10.244-29.363 31.654 0 0-.762 1.118-.19 2.165.322.639.959 1.035 1.648 1.025l5.103.622c.508-.01.933.404.96.937a213.682 213.682 0 001.61 27.952s.219 1.56 1.685 1.634c.594.031 2.794-.106 8.659-.243a.411.411 0 00.33-.134.455.455 0 00.116-.352c-.564-6.082-.741-11.343-.754-11.648a.568.568 0 00-.341-.49c-2.163-1.3-3.506-3.707-3.527-6.321-.164-12.041.535-21.287.535-21.287s.072-1.28 1.146-1.179c1.075.102 1.007 1.37 1.007 1.37-.387 5.185-.535 14.536-.535 14.536s0 1.767 1.627 1.767c1.626 0 1.622-1.767 1.622-1.767-.05-7.315.539-14.67.539-14.67-.01-.325.106-.641.322-.876.216-.235.513-.368.824-.369 1.04 0 1.003 1.392 1.003 1.392-.485 6.352-.535 14.515-.535 14.515s0 1.766 1.626 1.766 1.618-1.921 1.618-1.921c-.025-6.065.548-14.577.548-14.577a1.15 1.15 0 01.277-.808 1.046 1.046 0 01.848-.362c.965 0 1.02 1.17 1.02 1.17-.527 6.582-.536 16.693-.51 21.066.075 2.6-1.184 5.045-3.3 6.405a.68.68 0 00-.273.623c.134 4.002.455 8.445.729 11.626a.433.433 0 00.375.406h5.346c3.135 0 5.73 0 8.035.058.257 0 .38-.2.4-.478.595-5.742.805-9.934.843-10.296.038-.362-.45-.49-.45-.49-.843-.049-2.402-.314-3.835-.557-1.432-.243-1.483-1.957-1.483-1.957-1.21-17.973 7.837-29.153 7.837-29.153s.889-1.215 2.149-.756c.742.295 1.235 1.037 1.243 1.869 1.264 14.965 0 34.26-.78 41.407a.501.501 0 00.058.364.46.46 0 00.288.214h.076c3.859.12 5.667.235 6.164.177.88-.097 1.589-.801 1.727-1.718 1.926-13.923 1.63-27.89 1.63-27.89.044-.497.42-.89.894-.933l5.204-.583a1.77 1.77 0 001.567-1.007 2.349 2.349 0 00-.093-2.107"></path></svg>
                Skip the dishes
              </a></li>
              <li class="justify-content-center justify-content-md-start"><i class="bx bx-chevron-right"></i> <a target="_blank" href="https://www.doordash.com/en-CA/store/alexandros-toronto-37536" class="d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#EB1700" d="M23.071 8.409a6.09 6.09 0 0 0-5.396-3.228H.584A.589.589 0 0 0 .17 6.184L3.894 9.93a1.752 1.752 0 0 0 1.242.516h12.049a1.554 1.554 0 1 1 .031 3.108H8.91a.589.589 0 0 0-.415 1.003l3.725 3.747a1.75 1.75 0 0 0 1.242.516h3.757c4.887 0 8.584-5.225 5.852-10.413"/></svg>  
                Doordash
              </a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4 class="text-center text-md-start">Our Services</h4>
            <ul>
              <li class="justify-content-center justify-content-md-start"><i class="bx bx-chevron-right"></i> <a>Catering</a></li>
              <li class="justify-content-center justify-content-md-start"><i class="bx bx-chevron-right"></i> <a>Pickup</a></li>
              <li class="justify-content-center justify-content-md-start"><i class="bx bx-chevron-right"></i> <a>Dine-in</a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4 ">

      <div class="me-md-auto text-center text-md-start text-white-primary">
        <div class="copyright">
          &copy; Copyright <strong><span>ALEXANDROS</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          Designed by <a href="https://bootstrapmade.com/">GR Sagor</a>
        </div>
      </div>
      <div class="social-links justify-content-center text-center text-md-right pt-3 pt-md-0 d-flex">
        <a target="_blank" href="{{ Helper::getSettings('facebook_link') }}" class="d-flex flex-column justify-content-center align-items-center facebook"><i class="fa-brands fa-facebook"></i></a>
        <a target="_blank" href="{{ Helper::getSettings('instagram_link') }}" class="d-flex flex-column justify-content-center align-items-center instagram"><i class="fa-brands fa-square-instagram instagram-icon"></i></a>
      </div>
    </div>
  </footer>

  {{-- https://icon-sets.iconify.design/simple-icons/doordash/ --}}