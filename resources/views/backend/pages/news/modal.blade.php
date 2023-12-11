<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="createNewsForm" action="{{ route('admin.news.store') }}" method="post" enctype="multipart/form-data">
                @csrf 
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add News</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="server_side_error" role="alert">
    
                            </div>
                        </div>
                        <div class="col-sm-12 tab-content" id="v-pills-tabContent">
                            <div class="step step_1 tab-pane fade show active">
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Publish Date<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="date" name="publish_date" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">News Title<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title" class="form-control" placeholder="News Title" required>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Short Description</label>
                                    <div class="col-sm-9">
                                        <textarea name="short_description" class="form-control"  cols="30" rows="8" required></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">URL</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="url" class="form-control" placeholder="News Url" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Visibility</label>
                                    <div class="col-sm-9">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="status" id="flexSwitchCheckDefault">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="step step_2 tab-pane fade" >

                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea id="descriptions" class="tinymceText form-control" ></textarea>
                                    </div>
                                </div>

                                <div class="form-group  row">
                                    <label for="" class="col-sm-3 col-form-label">Image<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" onchange="previewFile('createModal #news_image', 'createModal .preview_image')" name="image" id="news_image" required>
                                        <img src="{{asset('assets/img/no-img.jpg')}}" height="80px" width="100px" class="preview_image mt-1 border" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-block step_btn step_btn_1">
                        <button type="button" data-step-open="step_2" data-step-button="step_btn_2" class="btn btn-primary next_btn" data-check-area="step_1">Next</button>
                    </div>
                    <div class="d-none step_btn step_btn_2">
                        <a type="button" class="btn m-pr-btn modal__btn_space next_btn" data-step-open="step_1" data-step-button="step_btn_1">Previous</a>
                        <button type="submit" id="createNewsBtn" class="btn btn-primary " data-check-area="step_2">Add</button>
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
