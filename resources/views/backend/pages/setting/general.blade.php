@extends('backend.layout.app')
@section('title', 'Settings | '.Helper::getSettings('application_name') ?? 'Machine Tool Solution' )
@section('content')
    <div class="container-fluid px-4">
        <h4 class="mt-2">Settings</h4>

        <div class="card my-2">
            <div class="card-header">
                <div class="row ">
                    <div class="col-12 d-flex justify-content-between">
                        <div class="d-flex align-items-center"><h5 class="m-0">General Setting</h5></div>
                    </div>
                </div>
            </div>
            <div class="card-body pb-0">
                <form action="{{ route('admin.setting.update') }}" id="settingForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Application Name:</label>
                        <div class="col-sm-9">
                            <input type="text" name="application_name" value="{{ Helper::getSettings('application_name') }}" class="form-control" placeholder="Application Name" >
                        </div>
                    </div>
                    <div class="form-group  row">
                        <label for="" class="col-sm-3 col-form-label">Site Logo:</label>
                        <div class="col-sm-9" >
                            <input type="file" class="form-control" onchange="previewFile('settingForm #site_logo', 'settingForm .site_logo_image')" name="site_logo" id="site_logo">
                            <img src="{{ Helper::getSettings('site_logo') ? asset('uploads/settings/'.Helper::getSettings('site_logo')) : asset('assets/img/no-img.jpg')}}" height="80px" width="100px" class="site_logo_image mt-1 border" alt="">
                        </div>
                    </div>
                    <div class="form-group  row">
                        <label for="" class="col-sm-3 col-form-label">Site Favicon:</label>
                        <div class="col-sm-9" >
                            <input type="file" class="form-control" onchange="previewFile('settingForm #site_favicon', 'settingForm .site_favicon_image')" name="site_favicon" id="site_favicon">
                            <img src="{{ Helper::getSettings('site_favicon') ? asset('uploads/settings/'.Helper::getSettings('site_favicon')) : asset('assets/img/no-img.jpg')}}" height="80px" width="80px" class="site_favicon_image mt-1 border" alt="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Phone:</label>
                        <div class="col-sm-9">
                            <input type="text" name="application_phone" value="{{ Helper::getSettings('application_phone') }}" class="form-control" placeholder="Phone" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Email:</label>
                        <div class="col-sm-9">
                            <input type="text" name="application_email" value="{{ Helper::getSettings('application_email') }}" class="form-control" placeholder="Email" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Toll-Free:</label>
                        <div class="col-sm-9">
                            <input type="text" name="application_toll_free" value="{{ Helper::getSettings('application_toll_free') }}" class="form-control" placeholder="Toll-Free" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Fax:</label>
                        <div class="col-sm-9">
                            <input type="text" name="application_fax" value="{{ Helper::getSettings('application_fax') }}" class="form-control" placeholder="Fax" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Address:</label>
                        <div class="col-sm-9">
                            <input type="text" name="application_address" value="{{ Helper::getSettings('application_address') }}" class="form-control" placeholder="Address" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Facebook (Link):</label>
                        <div class="col-sm-9">
                            <input type="text" name="facebook_link" value="{{ Helper::getSettings('facebook_link') }}" class="form-control" placeholder="Facebook link" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Twitter (Link):</label>
                        <div class="col-sm-9">
                            <input type="text" name="twitter_link" value="{{ Helper::getSettings('twitter_link') }}" class="form-control" placeholder="Twitter link" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Instagram (Link):</label>
                        <div class="col-sm-9">
                            <input type="text" name="instagram_link" value="{{ Helper::getSettings('instagram_link') }}" class="form-control" placeholder="Instagram link" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Linkedin (Link):</label>
                        <div class="col-sm-9">
                            <input type="text" name="linkedin_link" value="{{ Helper::getSettings('linkedin_link') }}" class="form-control" placeholder="Linkedin link" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Youtube (Link):</label>
                        <div class="col-sm-9">
                            <input type="text" name="youtube_link" value="{{ Helper::getSettings('youtube_link') }}" class="form-control" placeholder="Youtube link" >
                        </div>
                    </div>

                    <div class="form-group text-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('footer')
        <script type="text/javascript">
            
        </script>
    @endpush
@endsection