<form id="partnerEditForm" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $venue->id }}">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Venue</h5>
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
                        <input type="text" class="form-control" placeholder="Name" value="{{ $venue->name }}" name="name" required>
                        <label for="">Name<span class="text-danger">*</span></label>
                    </div>
                </div>
                <div class="d-flex gap-2 mb-1 w-100">
                    <div class="form-floating mb-1 w-100">
                        <input type="text" class="form-control" name="website_link" placeholder="Website Link" value="{{ isset($social_media_links->website_link) ? $social_media_links->website_link : '' }}">
                        <label for="">Website Link</label>
                    </div>
                    <div class="form-floating mb-1 w-100">
                        <input type="text" class="form-control"  placeholder="Phone" value="{{ $venue->phone }}" name="phone" required>
                        <label for="">Phone<span class="text-danger">*</span></label>
                    </div>
                </div>
                <div class="d-flex w-100 gap-2 mb-1">
                    <div class="form-group mb-1 w-100">
                        <input type="file" class="form-control" onchange="previewFile('editModal #profile_image', 'editModal .profile_image')" name="images[]" id="profile_image" multiple>
                        <img src="{{ $venue->images && $venue->images[0] ? asset('uploads/venue-images/'.$venue->images[0]) : asset('assets/img/no-img.jpg') }}" height="80px" width="100px" class="profile_image mt-1 border" alt="">
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
                        <input type="text" class="form-control" name="facebook_link" placeholder="Facebook Link" value="{{ $social_media_links->facebook_link }}">
                        <label for="">Facebook Link</label>
                    </div>
                </div>
                <div class="d-flex gap-1 mb-1 w-100">
                    <div class="form-floating mb-1 w-100">
                        <input type="text" class="form-control" name="instagram_link" placeholder="Instagram Link" value="{{ $social_media_links->instagram_link }}">
                        <label for="">Instagram Link</label>
                    </div>
                </div>
            </div>
            <div class="step step_3 tab-pane fade" >
                <div class="w-100 text-left">
                    <label for="">Address</label>
                    <hr>
                </div>

                <div class="d-flex gap-1 mb-1 w-100">
                    <div class="form-floating mb-1 w-100">
                        <input type="text" class="form-control" name="street_address" placeholder="Street Address" value="{{ $address->street_address }}">
                        <label for="">Street Address</label>
                    </div>
                </div>
                <div class="d-flex gap-1 mb-1 w-100">
                    <div class="form-floating mb-1 w-100">
                        <input type="text" class="form-control" name="city" placeholder="City" value="{{ $address->city }}">
                        <label for="">City</label>
                    </div>
                </div>
                <div class="d-flex gap-1 mb-1 w-100">
                    <div class="form-floating mb-1 w-100">
                        <input type="text" class="form-control" name="state" placeholder="State" value="{{ $address->state }}">
                        <label for="">State</label>
                    </div>
                </div>
                <div class="d-flex gap-1 mb-1 w-100">
                    <div class="form-floating mb-1 w-100">
                        <input type="text" class="form-control" name="country" placeholder="Country" value="{{ $address->country }}">
                        <label for="">Country</label>
                    </div>
                </div>
                <div class="d-flex gap-1 mb-1 w-100">
                    <div class="form-floating mb-1 w-100">
                        <input type="text" class="form-control" name="zipcode" placeholder="Zip code" value="{{ $address->zipcode }}">
                        <label for="">Zip code</label>
                    </div>
                </div>
                <div class="d-flex gap-1 mb-1 w-100">
                    <div class="form-floating mb-1 w-100">
                        <input type="text" class="form-control locationInput" placeholder="Location">
                        <label for="">Location</label>
                    </div>
                </div>
                <input type="hidden" name="latitude" value="{{ $address->latitude }}">
                <input type="hidden" name="longitude" value="{{ $address->longitude }}">
                {{-- <div class="d-flex gap-1 mb-1 w-100">
                    <div class="form-floating mb-1 w-100">
                        <input type="text" class="form-control" name="latitude" placeholder="Lattitude" value="{{ $address->latitude }}">
                        <label for="">Lattitude</label>
                    </div>
                </div>
                <div class="d-flex gap-1 mb-1 w-100">
                    <div class="form-floating mb-1 w-100">
                        <input type="text" class="form-control" name="longitude" placeholder="Longitude" value="{{ $address->longitude }}">
                        <label for="">Longitude</label>
                    </div>
                </div> --}}
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
            <a type="button" class="btn m-pr-btn modal__btn_space next_btn" data-step-open="step_2"
                data-step-button="step_btn_2">Previous</a>
            <button type="submit" id="editPartnerBtn" data-check-area="step_3"
                class="btn btn-primary">Update</button>
        </div>
    </div>
</form>
<script>
    function initAutocomplete() {
        var addInput = $('#partnerCreateForm .locationInput')[0];
        var addAutocomplete = new google.maps.places.Autocomplete(addInput);

        addAutocomplete.addListener('place_changed', function() {
            var place = addAutocomplete.getPlace();

            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();

            $('#partnerCreateForm input[name="latitude"]').val(latitude)
            $('#partnerCreateForm input[name="longitude"]').val(longitude)
        });

        var editInput = $('#partnerEditForm .locationInput')[0];
        var editAutocomplete = new google.maps.places.Autocomplete(editInput);

        editAutocomplete.addListener('place_changed', function() {
            var place = editAutocomplete.getPlace();

            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();

            $('#partnerEditForm input[name="latitude"]').val(latitude)
            $('#partnerEditForm input[name="longitude"]').val(longitude)
        });
    }

    $(document).ready(function() {
        function loadGoogleMapsScript() {
            var script = document.createElement('script');
            script.src =
                'https://maps.googleapis.com/maps/api/js?key=AIzaSyBJlwnaNMA01U2K7bUthv4BTs3lygMSyRg&libraries=places&callback=initAutocomplete';
            document.body.appendChild(script);
        }

        loadGoogleMapsScript();
    });
</script>
