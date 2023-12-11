<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="" id="partnerCreateForm" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Artist</h5>
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
                                <div class="form-group mb-1 w-100">
                                    <select name="artist_type" class="form-control" id="artist_type">
                                        <option value="">-- Select Artist Type --</option>
                                        <option value="Singer">Singer</option>
                                        <option value="Guitarist">Guitarist</option>
                                        <option value="Bassist">Bassist</option>
                                        <option value="Keyboardist">Keyboardist</option>
                                        <option value="Drummer">Drummer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex gap-2 mb-1 w-100">
                                <div class="form-floating mb-1 w-100">
                                    <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{old('first_name')}}" required>
                                    <label for="">First Name<span class="text-danger">*</span></label>
                                </div>
                                <div class="form-floating mb-1 w-100">
                                    <input type="text" class="form-control"  placeholder="Last Name" value="{{old('last_name')}}" name="last_name" required>
                                    <label for="">Last Name<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="d-flex gap-2 mb-1 w-100">
                                <div class="form-floating mb-1 w-100">
                                    <input type="email" class="form-control"  name="email" value="{{old('email')}}" placeholder="name@example.com">
                                    <label for="">Email</label>
                                </div>
                                <div class="form-floating mb-1 w-100">
                                    <input type="text" class="form-control"  placeholder="Phone No." value="{{old('phone_no')}}" name="phone">
                                    <label for="">Phone No.</label>
                                </div>
                            </div>
                            <div class="d-flex gap-1 mb-1 w-100">
                                <div class="form-floating mb-1 w-100">
                                    <input type="text" class="form-control"  placeholder="Company Name" value="{{old('address')}}" name="address">
                                    <label for="">Street Address</label>
                                </div>
                            </div>
                            <div class="d-flex w-100 gap-2 mb-1">
                                <div class="form-group mb-1 w-100">
                                    <input type="file" class="form-control" onchange="previewFile('createModal #profile_image', 'createModal .profile_image')" name="image" id="profile_image" required>
                                    <img src="{{asset('assets/img/no-img.jpg')}}" height="80px" width="100px" class="profile_image mt-1 border" alt="">
                                </div>
                            </div>
                            <div class="d-flex gap-1 mb-1 w-100">
                                <div class="form-floating mb-1 w-100">
                                    <textarea type="text" class="form-control" name="description" placeholder="Facebook Link" style="height: 100px;"></textarea>
                                    <label for="">Description</label>
                                </div>
                            </div>
                        </div>

                        <div class="step step_2 tab-pane fade" >
                            <div class="w-100 text-left">
                                <label for="">Social Media Links</label>
                                <hr>
                            </div>

                            <div class="d-flex gap-1 mb-1 w-100">
                                <div class="form-floating mb-1 w-100">
                                    <input type="text" class="form-control" name="facebook_link" placeholder="Facebook Link">
                                    <label for="">Facebook Link</label>
                                </div>
                            </div>
                            <div class="d-flex gap-1 mb-1 w-100">
                                <div class="form-floating mb-1 w-100">
                                    <input type="text" class="form-control" name="spotify_link" placeholder="Spotify Link">
                                    <label for="">Spotify Link</label>
                                </div>
                            </div>
                            <div class="d-flex gap-1 mb-1 w-100">
                                <div class="form-floating mb-1 w-100">
                                    <input type="text" class="form-control" name="itunes_link" placeholder="iTunes Link">
                                    <label for="">iTunes Link</label>
                                </div>
                            </div>
                            <div class="d-flex gap-1 mb-1 w-100">
                                <div class="form-floating mb-1 w-100">
                                    <input type="text" class="form-control" name="youtube_link" placeholder="Youtube Link">
                                    <label for="">Youtube Link</label>
                                </div>
                            </div>
                            <div class="d-flex gap-1 mb-1 w-100">
                                <div class="form-floating mb-1 w-100">
                                    <input type="text" class="form-control" name="instagram_link" placeholder="Instagram Link">
                                    <label for="">Instagram Link</label>
                                </div>
                            </div>

                            <div class="row">
                                <label for="" class="col-sm-3 col-form-label">Is Golden Guiter</label>
                                <div class="col-sm-3 d-flex align-items-center">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_golden_guiter" id="flexSwitchCheckDefault">
                                    </div>
                                </div>
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
                    <div class="d-block step_btn step_btn_1">
                        <button type="button" data-step-open="step_2" data-step-button="step_btn_2" data-check-area="step_1" class="btn btn-primary next_btn">Next</button>
                    </div>
                    <div class="d-none step_btn step_btn_2">
                        <a type="button" class="btn m-pr-btn modal__btn_space next_btn" data-step-open="step_1" data-step-button="step_btn_1">Previous</a>
                        <button type="submit" id="addPartnerBtn" data-check-area="step_2" class="btn btn-primary">Add</button>
                    </div>
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
