<form id="partnerEditForm" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $menu->id }}">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Menu</h5>
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
                        value="{{ $menu->title }}" required>
                    <label for="">Title<span class="text-danger">*</span></label>
                </div>
                <div class="form-floating mb-1 w-100">
                    <input type="text" class="form-control" placeholder="Email" name="speciality"
                        value="{{ $menu->speciality }}">
                    <label for="">Speciality</label>
                </div>
                <div class="form-floating mb-1 w-100">
                    <input type="text" class="form-control" placeholder="Email" name="subtitle"
                        value="{{ $menu->subtitle }}">
                    <label for="">Subtitle</label>
                </div>
                <div class="form-floating mb-1 w-100">
                    <input type="text" class="form-control" placeholder="Email" name="price"
                        value="{{ $menu->price }}">
                    <label for="">Price</label>
                </div>
                <div class="form-floating mb-1 w-100">
                    <input type="text" class="form-control" placeholder="Email" name="tax"
                        value="{{ $menu->tax }}">
                    <label for="">Tax</label>
                </div>
                <div class="d-flex w-100 gap-2 mb-1">
                    <div class="form-group mb-1 w-100">
                        <input type="file" class="form-control"
                            onchange="previewFile('createModal #profile_image', 'createModal .profile_image')"
                            name="img" id="profile_image">
                        <img src="{{ $menu->img ? asset($menu->img) : asset('assets/img/no-img.jpg') }}" height="80px" width="100px"
                            class="profile_image mt-1 border" alt="">
                    </div>
                </div>
            </div>

            <div class="step step_2 tab-pane">
                <div class="w-100 text-left">
                    <label for="">Menus</label>
                    <hr>
                </div>
                <table class="w-100 add-sponsor">
                    <thead>
                        <tr>
                            <th class="">Item name</th>
                            <th class="">Item speciality</th>
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
                        @foreach ($menu->items as $i => $item)
                            <tr class="itwillbecoppy" data-row-no="{{ $i }}">
                                <td>
                                    <div class="form-floating mb-1">
                                        <input type="text" class="form-control" placeholder="Email" name="items[]"
                                            value="{{ $item->item }}" required>
                                        <label for="">Item name<span class="text-danger">*</span></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-floating mb-1">
                                        <input type="text" class="form-control" placeholder="Email" name="item_speciality[]"
                                            value="{{ $item->item_speciality }}">
                                        <label for="">Item Speciality</label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <button href="#" type="button"
                                        class="btn btn-sm btn-danger remove__btn mb-1"
                                        onclick="removeRow(event); return false;"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
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
                <button type="submit" id="editPartnerBtn" data-check-area="step_5"
                class="btn btn-primary">Update</button>
        </div>
    </div>
</form>
