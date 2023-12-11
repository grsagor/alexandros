<form id="partnerEditForm" action="{{ route('admin.sponsor.update', $sponsor->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Sponsor</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
        </button>
    </div>
    <div class="modal-body">
        <div class="col-sm-12">
            <div class="server_side_error" role="alert">

            </div>
        </div>
        <div class="col-sm-12 tab-content" id="v-pills-tabContent">
            <div class="step step_1 tab-pane fade show active">
                <div class="d-flex gap-2 mb-1 w-100">
                    <div class="form-floating mb-1 w-100">
                        <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{$sponsor->first_name}}">
                        <label >First Name</label>
                    </div>
                    <div class="form-floating mb-1 w-100">
                        <input type="text" class="form-control"  placeholder="Last Name" value="{{$sponsor->last_name}}" name="last_name">
                        <label >Last Name</label>
                    </div>
                </div>
                <div class="d-flex gap-2 mb-1 w-100">
                    <div class="form-floating mb-1 w-100">
                        <input type="email" class="form-control"  name="email" value="{{$sponsor->email}}" placeholder="name@example.com">
                        <label >Email Address</label>
                    </div>
                    <div class="form-floating mb-1 w-100">
                        <input type="text" class="form-control"  placeholder="Phone No." value="{{$sponsor->phone}}" name="phone">
                        <label >Phone No.</label>
                    </div>
                </div>
                <div class="d-flex gap-1 mb-1 w-100">
                    <div class="form-floating mb-1 w-100">
                        <input type="text" class="form-control"  placeholder="Company Name" value="{{$sponsor->address}}" name="address">
                        <label for="">Street Address</label>
                    </div>
                </div>
                <div class="d-flex w-100 gap-2 mb-1">
                    <div class="form-group mb-1 w-100">
                        <input type="file" class="form-control" onchange="previewFile('editModal #profile_image', 'editModal .profile_image')" name="image" id="profile_image">
                        <img src="{{ ($sponsor->profile_image) ? asset('uploads/user-images/'.$sponsor->profile_image) :  asset('assets/img/no-img.jpg')}}" height="80px" width="100px" class="profile_image mt-1 border" alt="">
                    </div>
                </div>

                <div class="row">
                    <label for="" class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-3 d-flex align-items-center">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" @if($sponsor->status == 1) checked @endif id="flexSwitchCheckDefault">
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-1 mb-1 w-100">
                    <div class="form-floating mb-1 w-100">
                        <input type="text" class="form-control" name="sponsor_link" value="{{$social_media_links->sponsor_link ?? ''}}" placeholder="Sponsor Link">
                        <label for="">Sponsor Link</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
            <button type="submit" id="editPartnerBtn" data-check-area="step_1" class="btn btn-primary">Update</button>
    </div>
</form>
