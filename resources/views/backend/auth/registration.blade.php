@extends('frontend.layout.app')
@section('content')


<div class="container-register">
    <div id="register" class="row">
        <div class="img-container">
            <img src="{{ asset('assets/img/login.png') }}" alt="">
            <div class="img-text">
                <h1 class="applicant">{{ Helper::getSettings('application_name') }}</h1>
                <p class="para">Premium Grade work-holding equipment and components, optimizing your machine tools for peak performance.</p>
            </div>
        </div>
        <div class="form-container">
            <form action="{{ route('registration.post') }}" method="POST">
                <!-- Your form content here -->
                @csrf
                <h1>{{ trans('language.register') }}</h1>
                <p>{{ trans('language.register_using_credentials') }}</p>
                <div class="w-100">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                </div>
                <div class="w-100 text-left">
                    <label for="">{{ trans('language.basic_info') }}</label>
                    <hr>
                </div>
                <div class="w-100 d-flex p-3 gap-3">
                    <p>{{ trans('language.partner_type') }}:</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" @if(old('type') == 'Reseller') checked @endif value="Reseller" id="flexRadioDefault1" required>
                        <label class="form-check-label" for="flexRadioDefault1">
                            {{ trans('language.i_want_to_be_Reseller') }}
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="type"  @if(old('type') == 'Distributor') checked @endif value="Distributor" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            {{ trans('language.i_want_to_be_distributor') }}
                        </label>
                      </div>
                </div>
                <div class="d-flex gap-2 mb-1 w-100">
                    <div class="form-floating mb-1 w-100">
                        <input type="text" class="form-control" placeholder="{{ trans('language.label_first_name') }}" name="first_name" value="{{old('first_name')}}" required>
                        <label for="floatingInput">{{ trans('language.label_first_name') }}<span class="text-danger">*</span></label>
                    </div>
                    <div class="form-floating mb-1 w-100">
                        <input type="text" class="form-control" id="floatingInput" placeholder="{{ trans('language.label_last_name') }}" value="{{old('last_name')}}" name="last_name" required>
                        <label for="floatingInput">{{ trans('language.label_last_name') }}<span class="text-danger">*</span></label>
                    </div>
                </div>
                <div class="d-flex gap-1 mb-1 w-100">
                    <div class="form-floating mb-1 w-100">
                        <input type="text" class="form-control" id="floatingInput" placeholder="{{ trans('language.label_company_name') }}" value="{{old('name')}}" name="name" required>
                        <label for="floatingInput">{{ trans('language.label_company_name') }}<span class="text-danger">*</span></label>
                    </div>
                </div>
                <div class="d-flex gap-2 mb-1 w-100">
                    <div class="form-floating mb-1 w-100">
                        <input type="text" class="form-control" id="floatingInput" placeholder="{{ trans('language.label_department') }}" value="{{old('department')}}" name="department">
                        <label for="floatingInput">{{ trans('language.label_department') }}</label>
                    </div>
                    <div class="form-floating mb-1 w-100">
                        <input type="text" class="form-control" id="floatingInput" placeholder="{{ trans('language.vat_reg_no') }}" value="{{old('vat_no')}}" name="vat_no" required>
                        <label for="floatingInput">{{ trans('language.vat_reg_no') }}<span class="text-danger">*</span></label>
                    </div>
                </div>
                <div class="d-flex gap-2 mb-1 w-100">
                    <div class="form-floating mb-1 w-100">
                        <input type="email" class="form-control" id="floatingInput" name="email" value="{{old('email')}}" placeholder="name@example.com" required>
                        <label for="floatingInput">{{ trans('language.label_email') }}<span class="text-danger">*</span></label>
                    </div>
                    <div class="form-floating mb-1 w-100">
                        <input type="text" class="form-control" id="floatingInput" placeholder="{{ trans('language.label_phone') }}" value="{{old('phone_no')}}" name="phone_no" required>
                        <label for="floatingInput">{{ trans('language.label_phone') }}<span class="text-danger">*</span></label>
                    </div>
                </div>
                <div class="d-flex gap-1 mb-1 w-100">
                    <div class="form-floating mb-1 w-100">
                        <input type="text" class="form-control" id="floatingInput" placeholder="{{ trans('language.label_company_website') }}" value="{{old('website_url')}}" name="website_url">
                        <label for="floatingInput">{{ trans('language.label_company_website') }}</label>
                    </div>
                </div>
                <div class="w-100 text-left">
                    <label for="">{{ trans('language.label_password') }}</label>
                    <hr>
                </div>
                <div class="d-flex gap-2 mb-1 w-100">
                    <div class="form-floating mb-1 w-100">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="{{ trans('language.label_new_password') }}" name="password" required>
                        <label for="floatingPassword">{{ trans('language.label_new_password') }}<span class="text-danger">*</span></label>
                    </div>
                    <div class="form-floating mb-1 w-100">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="{{ trans('language.label_confirm_password') }}" name="password_confirmation" required>
                        <label for="floatingPassword">{{ trans('language.label_confirm_password') }}<span class="text-danger">*</span></label>
                    </div>
                </div>
                <div class="w-100 text-left">
                    <label for="">{{ trans('language.label_address') }}</label>
                    <hr>
                </div>
                <div class="d-flex gap-1 mb-1 w-100">
                    <div class="form-floating mb-1 w-100">
                        <input type="text" class="form-control" id="floatingInput" placeholder="{{ trans('language.label_street_address') }}" value="{{old('address')}}" name="address">
                        <label for="floatingInput">{{ trans('language.label_street_address') }}<span class="text-danger">*</span></label>
                    </div>
                </div>
                <div class="d-flex gap-2 mb-1 w-100">
                    <div class="form-floating mb-1 w-100">
                        <input type="text" class="form-control" id="floatingInput" placeholder="{{ trans('language.label_postal_code') }}" value="{{old('post_code')}}" name="post_code" required>
                        <label for="floatingInput">{{ trans('language.label_postal_code') }}<span class="text-danger">*</span></label>
                    </div>
                    <div class="form-floating w-100">
                        <input type="text" class="form-control" id="floatingInput" placeholder="{{ trans('language.label_city') }}" value="{{old('city')}}" name="city" required>
                        <label for="floatingInput">{{ trans('language.label_city') }}<span class="text-danger">*</span></label>
                    </div>
                </div>

                <div class="d-flex w-100 gap-2 mb-1">
                    <div class="form-floating mb-1 w-100">
                        <input type="text" class="form-control" id="floatingInput" placeholder="{{ trans('language.label_state') }}" value="{{old('state')}}" name="state" required>
                        <label for="floatingInput">{{ trans('language.label_state') }}<span class="text-danger">*</span></label>
                    </div>
                    <div class="form-floating w-100">
                        <input type="text" class="form-control" id="floatingInput" placeholder="{{ trans('language.label_country') }}" value="{{old('country')}}" name="country" required>
                        <label for="floatingInput">{{ trans('language.label_country') }}<span class="text-danger">*</span></label>
                    </div>
                </div>
                <button type="submit" class="btn btn__register_submit mb-1">{{ trans('language.btn_submit') }}</button>
                <span class="register-account">{{ trans('language.already_have_account') }}? <a href="{{ url('login') }}">{{ trans('language.login') }}</a></span>
            </form>
        </div>
    </div>
</div>


@endsection
