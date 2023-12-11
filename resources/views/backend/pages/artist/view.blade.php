
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Artist Details</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-5 d-flex gap-3">
                <div class="profile-area text-center">
                    <img src="{{ ($artist->profile_image) ? asset('uploads/user-images/'.$artist->profile_image) :  asset('assets/img/no-img.jpg')}}" height="200px" width="100%" class="profile_image mt-1 border" alt="">
                    <h5 class="mb-0"><b>{{ $artist->first_name }} {{ $artist->last_name }}</b> <span class="text-warning"></span></h5>
                    <span class="badge bg-primary">{{ $artist->artist_type }} <i class="text-warning fa-solid fa-guitar"></i></span>
                    <ul class="nav justify-content-center">
                        <li class="p-1"><a href="{{$social_media_links->facebook_link ?? '#' }}"><p><i class="fa-brands fa-facebook text-primary"></i></p></a></li>
                        <li class="p-1"><a href="{{$social_media_links->spotify_link ?? '#' }}"><p><i class="fa-brands fa-spotify text-success"></i></p></a></li>
                        <li class="p-1"><a href="{{$social_media_links->itunes_link ?? '#' }}"><p><i class="fa-brands fa-itunes-note"></i> </p></a></li>
                        <li class="p-1"><a href="{{$social_media_links->youtube_link ?? '#' }}"><p><i class="fa-brands fa-youtube text-danger"></i> </p></a></li>
                        <li class="p-1"><a href="{{$social_media_links->instagram_link ?? '#' }}"><p><i class="fa-brands fa-instagram text-danger"></i></p></a></li>
                    </ul>
                </div>
                <div class="vr mx-1" ></div>
            </div>
            <div class="col-lg-7">
                <p class="m-0"><b>Phone:</b> {{ $artist->phone }}</p>
                <p class="m-0"><b>Email:</b> {{ $artist->email }}</p>
                <p class="m-0"><b>Address:</b> {{ $artist->address }}</p>
                
            </div>
        </div>
    </div>
    @if($artist->status == 0)
        <div class="modal-footer">
            <a href="{{ route('admin.artist.status', ['id' => $artist->id, 'status' => 0])}}" class="modal__btn_space" >Inactive</a>
            <a href="{{ route('admin.artist.status', ['id' => $artist->id, 'status' => 1])}}" class="btn btn-primary">Active</a>
        </div>
    @endif