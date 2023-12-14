<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="" id="partnerCreateForm" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Event</h5>
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
                            <div class="form-group mb-2">
                                <select name="type_of_event" class="form-control type_of_event" id="type_of_event" required>
                                    <option value="">Type of event</option>
                                    <option value="golder_guiter">Golden Guiter</option>
                                    <option value="regular">Regular</option>
                                </select>
                            </div>
                            <div class="d-flex gap-1 mb-1 w-100 d-none title-container" id="title-container">
                                <div class="form-floating mb-1 w-100">
                                    <input type="text" class="form-control" placeholder="Title"
                                        value="{{ old('title') }}" name="title">
                                    <label for="">Title<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="form-group mb-1 add-artist d-none artist-container" id="artist-container">
                                <select name="artist_id[]" class="form-control" id="artist_id">
                                    <option value="">Select Artist</option>
                                    @foreach($artists as $row)
                                        <option value="{{ $row->id}}">{{ $row->first_name}} {{ $row->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="step step_2 tab-pane fade show active">
                            <div class="form-group mb-2">
                                <select name="venue_id" class="form-control mb-1" id="sponsor_id">
                                    <option value="">Select Venue</option>
                                    {{-- @foreach($venues as $row)
                                        <option value="{{ $row->id}}">{{ $row->name}}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                            <div class="d-flex gap-2 mb-1 w-100">
                                <div class="form-floating mb-1 w-100">
                                    <input type="number" class="form-control" placeholder="Email"
                                        name="max_participent" value="{{ old('max_participent') }}">
                                    <label for="">Max Participant</label>
                                </div>
                                <div class="form-floating mb-1 w-100">
                                    <input type="number" class="form-control" placeholder="Amount"
                                        value="{{ old('amount') }}" name="amount" required>
                                    <label for="">Price<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="d-flex w-100 gap-2 mb-1">
                                <div class="form-group mb-1 w-100">
                                    <input type="file" class="form-control"
                                        onchange="previewFile('createModal #profile_image', 'createModal .profile_image')"
                                        name="images[]" id="profile_image" multiple required>
                                    <img src="{{ asset('assets/img/no-img.jpg') }}" height="80px" width="100px"
                                        class="profile_image mt-1 border" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="step step_3 tab-pane fade">
                            <div class="w-100 text-left">
                                <label for="">Details</label>
                                <hr>
                            </div>

                            <div class="form-floating mb-1 w-100">
                                <input type="text" class="form-control" placeholder="Email"
                                    name="booking_url" value="{{ old('booking_url') }}" required>
                                <label for="">Booking url<span class="text-danger">*</span></label>
                            </div>
                            <div class="d-flex gap-1 mb-1 w-100">
                                <div class="form-floating mb-1 w-100">
                                    <textarea type="text" class="form-control h-auto" name="description" placeholder="Description" rows="5" required></textarea>
                                    <label for="">Description<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="d-flex gap-1 mb-1 w-100">
                                <div class="form-floating mb-1 w-100">
                                    <input type="date" class="form-control" placeholder="Title"
                                        value="{{ old('publish_date') }}" name="publish_date">
                                    <label for="">Publish date</label>
                                </div>
                            </div>

                            <div class="d-flex gap-2 mb-1 w-100">
                                <div class="form-floating mb-1 w-100">
                                    <input type="number" class="form-control" placeholder="Email"
                                        name="sponsour_min_value" value="{{ old('sponsour_min_value') }}">
                                    <label for="">Sponsor minimum value</label>
                                </div>
                                <div class="form-floating mb-1 w-100">
                                    <input type="number" class="form-control" placeholder="Amount"
                                        value="{{ old('sponsour_max_value') }}" name="sponsour_max_value">
                                    <label for="">Sponsor maximum value</label>
                                </div>
                            </div>
                            <div class="d-flex gap-2 mb-1 w-100">
                                <div class="form-floating mb-1 w-100">
                                    <input type="datetime-local" class="form-control" placeholder="Email"
                                        name="start_datetime" value="{{ old('start_datetime') }}" required>
                                    <label for="">Start time<span class="text-danger">*</span></label>
                                </div>
                                <div class="form-floating mb-1 w-100">
                                    <input type="datetime-local" class="form-control" placeholder="Amount"
                                        value="{{ old('end_datetime') }}" name="end_datetime" required>
                                    <label for="">End time<span class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="d-flex gap-2 mb-1 w-100">
                                <div class="form-group mb-1 w-100">
                                    <select name="discount_type" class="form-control" id="discount_type">
                                        <option value="">Select discount type</option>
                                        <option value="percentage">Percentage</option>
                                        <option value="fixed">Fixed</option>
                                    </select>
                                </div>

                                <div class="form-floating mb-1 w-100">
                                    <input type="number" class="form-control" placeholder="Amount"
                                        value="{{ old('discount_value') }}" name="discount_value">
                                    <label for="">Discount value</label>
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
                                <label for="" class="col-sm-3 col-form-label">Free?</label>
                                <div class="col-sm-3 d-flex align-items-center">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_free"
                                            id="flexSwitchCheckDefault">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="step step_4 tab-pane fade create">
                            <div class="w-100 text-left">
                                <label for="">Sponsor details</label>
                                <hr>
                            </div>
                            <table class="w-100 add-sponsor">
                                <thead>
                                    <tr>
                                        <th class="w-25">Sponsor</th>
                                        <th class="w-25">Amount</th>
                                        <th class="w-5 text-center">
                                            <button href="#" type="button"
                                                onclick="incrementRow('add-sponsor', 'itwillbecoppy'); return false;"
                                                class="btn btn-sm btn-primary">
                                                <svg class="svg-inline--fa fa-plus" aria-hidden="true"
                                                    focusable="false" data-prefix="fas" data-icon="plus"
                                                    role="img" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 448 512" data-fa-i2svg="">
                                                    <path fill="currentColor"
                                                        d="M240 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H176V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H240V80z">
                                                    </path>
                                                </svg><!-- <i class="fa-solid fa-plus"></i> Font Awesome fontawesome.com -->
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="itwillbecoppy" data-row-no="1">
                                        <td>
                                            <div class="form-group mb-1">
                                                <select name="sponsor_id[]" class="form-control" id="sponsor_id" required>
                                                    <option value="">Select Sponsor</option>
                                                    @foreach($sponsors as $row)
                                                        <option value="{{ $row->id}}">{{ $row->first_name}} {{ $row->last_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-floating mb-1 w-100">
                                                <input type="text" class="form-control" placeholder="Amount"
                                                    name="sponsor_amount[]">
                                                <label for="">Amount</label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <button href="#" type="button" class="btn btn-sm btn-danger remove__btn"
                                                onclick="removeRow(event); return false;"><svg
                                                    class="svg-inline--fa fa-trash" aria-hidden="true"
                                                    focusable="false" data-prefix="fas" data-icon="trash"
                                                    role="img" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 448 512" data-fa-i2svg="">
                                                    <path fill="currentColor"
                                                        d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z">
                                                    </path>
                                                </svg><!-- <i class="fa fa-trash"></i> Font Awesome fontawesome.com --></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="step step_5 tab-pane fade create">
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
