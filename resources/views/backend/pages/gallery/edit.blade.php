<form id="partnerEditForm" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $gallery->id }}">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Gallery</h5>
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
                <div class="d-flex gap-1 mb-1 w-100">
                    <div class="form-floating mb-1 w-100">
                        <input type="text" class="form-control" placeholder="Title" value="{{ $gallery->title }}"
                            name="title" required>
                        <label for="">Title<span class="text-danger">*</span></label>
                    </div>
                </div>
                <div class="d-flex gap-1 mb-1 w-100">
                    <div class="form-floating mb-1 w-100">
                        <input type="text" class="form-control tagsinput" placeholder="" data-role="tagsinput"
                            name="tags" required>
                        <label for="">Tags<span class="text-danger">*</span></label>
                    </div>
                </div>

                <script>
                    var tagsArray = [
                        @foreach ($gallery->tags as $item)
                            '{{ $item }}',
                        @endforeach
                    ];

                    $(document).ready(function() {
                        $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
                        tagsArray.forEach(function(tag) {
                            $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput('add',
                            tag);
                        });
                    });
                </script>

                <div class="d-flex w-100 gap-2 mb-1">
                    <div class="form-group mb-1 w-100">
                        <input type="file" class="form-control"
                            onchange="previewFile('partnerEditForm #profile_image', 'partnerEditForm .profile_image')"
                            name="image" id="profile_image" required>
                        <img src="{{ $gallery->image ? asset('uploads/gallery-images/'.$gallery->image) : asset('assets/img/no-img.jpg') }}" height="80px" width="100px"
                            class="profile_image mt-1 border" alt="">
                    </div>
                </div>
                <div class="row">
                    <label for="" class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-3 d-flex align-items-center">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" {{ $gallery->status == 1 ? 'checked' : '' }} name="status" id="flexSwitchCheckDefault">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <div class="step_btn step_btn_2">
            <button type="button" id="editPartnerBtn" data-check-area="step_2" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>
