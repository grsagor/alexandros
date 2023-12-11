<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="" id="partnerCreateForm" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Sponsor</h5>
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
                                    <input type="text" class="form-control" placeholder="First Name"
                                        name="first_name" value="{{ old('first_name') }}">
                                    <label for="">First Name</label>
                                </div>
                                <div class="form-floating mb-1 w-100">
                                    <input type="text" class="form-control" placeholder="Last Name"
                                        value="{{ old('last_name') }}" name="last_name">
                                    <label for="">Last Name</label>
                                </div>
                            </div>
                            <div class="d-flex gap-2 mb-1 w-100">
                                <div class="form-floating mb-1 w-100">
                                    <input type="email" class="form-control" name="email"
                                        value="{{ old('email') }}" placeholder="name@example.com">
                                    <label for="">Email</label>
                                </div>
                                <div class="form-floating mb-1 w-100">
                                    <input type="text" class="form-control" placeholder="Phone No."
                                        value="{{ old('phone_no') }}" name="phone">
                                    <label for="">Phone No.</label>
                                </div>
                            </div>
                            <div class="d-flex gap-1 mb-1 w-100">
                                <div class="form-floating mb-1 w-100">
                                    <input type="text" class="form-control" placeholder="Company Name"
                                        value="{{ old('address') }}" name="address">
                                    <label for="">Street Address</label>
                                </div>
                            </div>
                            <div class="d-flex w-100 gap-2 mb-1">
                                <div class="form-group mb-1 w-100">
                                    <input type="file" class="form-control"
                                        onchange="previewFile('createModal #profile_image', 'createModal .profile_image')"
                                        name="image" id="profile_image" required>
                                    <img src="{{ asset('assets/img/no-img.jpg') }}" height="80px" width="100px"
                                        class="profile_image mt-1 border" alt="">
                                </div>
                            </div>
                            <div class="row">
                                <label for="" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-3 d-flex align-items-center">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="status"
                                            id="flexSwitchCheckDefault">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-1 mb-1 w-100">
                                <div class="form-floating mb-1 w-100">
                                    <input type="text" class="form-control" name="sponsor_link"
                                        placeholder="Sponsor Link">
                                    <label for="">Sponsor Link</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="addPartnerBtn" data-check-area="step_1"
                        class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- edit modal  --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">

        </div>
    </div>
</div>
