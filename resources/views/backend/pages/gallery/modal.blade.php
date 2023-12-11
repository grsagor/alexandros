<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="partnerCreateForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Gallery</h5>
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
                                    <input type="text" class="form-control" placeholder="Title" value="{{old('title')}}" name="title" required>
                                    <label for="">Title<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="d-flex gap-1 mb-1 w-100">
                                <div class="form-floating mb-1 w-100">
                                    <input type="text" class="form-control tagsinput" placeholder="" data-role="tagsinput" name="tags" required>
                                    <label for="">Tags<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="d-flex w-100 gap-2 mb-1">
                                <div class="form-group mb-1 w-100">
                                    <input type="file" class="form-control" onchange="previewFile('createModal #profile_image', 'createModal .profile_image')" name="image" id="profile_image" required>
                                    <img src="{{asset('assets/img/no-img.jpg')}}" height="80px" width="100px" class="profile_image mt-1 border" alt="">
                                </div>
                            </div>
                            <div class="row">
                                <label for="" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-3 d-flex align-items-center">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="status" id="flexSwitchCheckDefault">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                        <button type="button" id="addPartnerBtn" data-check-area="step_2" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- edit modal  --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">

        </div>
    </div>
</div>

{{-- edit modal  --}}
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">

        </div>
    </div>
</div>
