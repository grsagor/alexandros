<form id="partnerEditForm" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $catering->id }}">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Catering</h5>
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
            <div class="step step_1 tab-pane fade show active create-artist">
                <div class="form-floating mb-1 w-100">
                    <input type="text" class="form-control" placeholder="Email" name="title"
                        value="{{ $catering->title }}" required>
                    <label for="">Title<span class="text-danger">*</span></label>
                </div>
                <div class="form-floating mb-1 w-100">
                    <input type="text" class="form-control" placeholder="Email" name="price"
                        value="{{ $catering->price }}">
                    <label for="">Price</label>
                </div>
                <div class="d-flex w-100 gap-2 mb-1">
                    <div class="form-group mb-1 w-100">
                        <input type="file" class="form-control"
                            onchange="previewFile('editModal #profile_image', 'editModal .profile_image')"
                            name="image" id="profile_image">
                        <img src="{{ $catering->image ? asset($catering->image) : asset('assets/img/no-img.jpg') }}" height="80px" width="100px"
                            class="profile_image mt-1 border" alt="">
                    </div>
                </div>
                <div class="form-group row mb-1 w-100">
                    <label for="" class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-3 d-flex align-items-center">
                        <div class="form-check form-switch">
                            <input {{ $catering->status == 1 ? 'checked' : '' }} class="form-check-input" type="checkbox" name="status"
                                id="flexSwitchCheckDefault">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <div class="d-block step_btn step_btn_1">
            <button type="submit" id="editPartnerBtn" data-check-area="step_5"
            class="btn btn-primary">Update</button>
        </div>
        <div class="d-none step_btn step_btn_2">
            <button type="button" data-step-open="step_1" data-step-button="step_btn_1"
                class="btn m-pr-btn modal__btn_space next_btn">Previous</button>
                <button type="submit" id="editPartnerBtn" data-check-area="step_5"
                class="btn btn-primary">Update</button>
        </div>
    </div>
</form>
