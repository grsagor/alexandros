<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="" id="partnerCreateForm" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Menu</h5>
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

                        <div class="step step_1 tab-pane fade create-artist">
                            <div class="form-floating mb-1 w-100">
                                <input type="text" class="form-control" placeholder="Email" name="title"
                                    value="{{ old('title') }}" required>
                                <label for="">Title<span class="text-danger">*</span></label>
                            </div>
                            <div class="form-floating mb-1 w-100">
                                <input type="text" class="form-control" placeholder="Email" name="speciality"
                                    value="{{ old('speciality') }}" required>
                                <label for="">Speciality<span class="text-danger">*</span></label>
                            </div>
                            <div class="form-floating mb-1 w-100">
                                <input type="text" class="form-control" placeholder="Email" name="subtitle"
                                    value="{{ old('subtitle') }}" required>
                                <label for="">Subtitle<span class="text-danger">*</span></label>
                            </div>
                            <div class="form-floating mb-1 w-100">
                                <input type="text" class="form-control" placeholder="Email" name="price"
                                    value="{{ old('price') }}" required>
                                <label for="">Price<span class="text-danger">*</span></label>
                            </div>
                            <div class="form-floating mb-1 w-100">
                                <input type="text" class="form-control" placeholder="Email" name="tax"
                                    value="{{ old('tax') }}" required>
                                <label for="">Tax<span class="text-danger">*</span></label>
                            </div>
                            <div class="form-group mb-2">
                                <select name="type_of_event" class="form-control type_of_event" id="type_of_event"
                                    required>
                                    <option value="">-- Include/Exclude --</option>
                                    <option value="include">Include</option>
                                    <option value="Exclude">Exclude</option>
                                </select>
                            </div>
                            <div class="d-flex w-100 gap-2 mb-1">
                                <div class="form-group mb-1 w-100">
                                    <input type="file" class="form-control"
                                        onchange="previewFile('createModal #profile_image', 'createModal .profile_image')"
                                        name="img" id="profile_image" multiple required>
                                    <img src="{{ asset('assets/img/no-img.jpg') }}" height="80px" width="100px"
                                        class="profile_image mt-1 border" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="step step_2 tab-pane fade show active">
                            <div class="w-100 text-left">
                                <label for="">Menus</label>
                                <hr>
                            </div>
                            <table class="w-100 add-sponsor">
                                <thead>
                                    <tr>
                                        <th class="w-25">Item name</th>
                                        <th class="w-5 text-center">
                                            <button href="#" type="button"
                                                onclick="incrementRow('add-sponsor', 'itwillbecoppy'); return false;"
                                                class="btn btn-sm btn-primary">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="itwillbecoppy" data-row-no="1">
                                        <td>
                                            <div class="form-floating mb-1 w-100">
                                                <input type="text" class="form-control" placeholder="Email" name="items[]"
                                                    value="{{ old('items') }}" required>
                                                <label for="">Item<span class="text-danger">*</span></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <button href="#" type="button"
                                                class="btn btn-sm btn-danger remove__btn"
                                                onclick="removeRow(event); return false;"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-block step_btn step_btn_1">
                        <button type="button" data-step-open="step_2" data-step-button="step_btn_2"
                            data-check-area="step_1" class="btn btn-primary next_btn">Next</button>
                    </div>
                    <div class="d-none step_btn step_btn_2">
                        <button type="button" data-step-open="step_1" data-step-button="step_btn_1"
                            class="btn m-pr-btn modal__btn_space next_btn">Previous</button>
                        <button type="button" data-step-open="step_3" data-step-button="step_btn_3"
                            data-check-area="step_2" class="btn btn-primary next_btn">Next</button>
                    </div>
                    <div class="d-none step_btn step_btn_3">
                        <button type="button" data-step-open="step_2" data-step-button="step_btn_2"
                            class="btn m-pr-btn modal__btn_space next_btn">Previous</button>
                        <button type="button" data-step-open="step_4" data-step-button="step_btn_4"
                            data-check-area="step_3" class="btn btn-primary next_btn">Next</button>
                    </div>
                    <div class="d-none step_btn step_btn_4">
                        <button type="button" data-step-open="step_3" data-step-button="step_btn_3"
                            class="btn m-pr-btn modal__btn_space next_btn">Previous</button>
                        <button type="button" data-step-open="step_5" data-step-button="step_btn_5"
                            data-check-area="step_4" class="btn btn-primary next_btn">Next</button>
                    </div>
                    <div class="d-none step_btn step_btn_5">
                        <a type="button" class="btn m-pr-btn modal__btn_space next_btn" data-step-open="step_4"
                            data-step-button="step_btn_4">Previous</a>
                        <button type="submit" id="addPartnerBtn" data-check-area="step_5"
                            class="btn btn-primary">Add</button>
                    </div>
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

{{-- edit modal  --}}
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">

        </div>
    </div>
</div>
