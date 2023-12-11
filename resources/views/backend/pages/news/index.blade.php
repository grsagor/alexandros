@extends('backend.layout.app')
@section('title', 'News | ' . Helper::getSettings('application_name') ?? 'Machine Tool Solution')
@section('content')
    <div class="container-fluid px-4">
        <h4 class="mt-2">News Management</h4>

        <div class="card my-2">
            <div class="card-body pb-0">
                <form method="" id="filter_form">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" name="title" id="title"
                                    placeholder="News Title">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="date" class="form-control" name="date" id="date"
                                    placeholder="Publish Date">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select name="status" class="form-control" id="status">
                                    <option value="">Select Status</option>
                                    <option value="1">Visible</option>
                                    <option value="2">Hidden</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group text-end mt-2">
                                <button type="submit" id="filterBtn" name="submit" class="btn btn-primary"><i
                                        class="feather icon-file mr-2"></i> Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card my-2">
            <div class="card-header">
                <div class="row ">
                    <div class="col-12 d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <h5 class="m-0">News List</h5>
                        </div>
                        @if (Helper::hasRight('news.create'))
                            <button type="button" class="btn btn-primary btn-create-user create_form_btn"
                                data-bs-toggle="modal" data-bs-target="#createModal"><i class="fa-solid fa-plus"></i>
                                Add</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>News Title</th>
                            <th>Publish Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('backend.pages.news.modal')
    @push('footer')
        <script type="text/javascript">
            function getnews(date = null, title = null, status = null) {
                var table = jQuery('#dataTable').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ url('admin/news/get/list') }}",
                        type: 'GET',
                        data: {
                            'date': date,
                            'title': title,
                            'status': status
                        },
                    },
                    aLengthMenu: [
                        [25, 50, 100, 500, 5000, -1],
                        [25, 50, 100, 500, 5000, "All"]
                    ],
                    iDisplayLength: 25,
                    "order": [
                        [2, 'asc']
                    ],
                    columns: [

                        {
                            data: 'title',
                            name: 'title'
                        },
                        {
                            data: 'publish_date',
                            name: 'publish_date'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            "className": "text-center"
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            "className": "text-center w-10"
                        },
                    ]
                });
            }
            getnews();


            $(document).on('click', '#filterBtn', function(e) {
                e.preventDefault();
                let date = $('#filter_form #date').val();
                let title = $('#filter_form #title').val();
                let status = $('#filter_form #status').val();

                $('#dataTable').DataTable().destroy();
                getnews(date, title, status);
            })

            $(document).on('click', '.edit_btn', function(e) {
                e.preventDefault();
                let id = $(this).attr('data-id');
                $.ajax({
                    url: "{{ url('/admin/news/edit/') }}/" + id,
                    type: "GET",
                    dataType: "html",
                    success: function(data) {
                        $('#editModal .modal-content').html(data);
                        $('#editModal').modal('show');
                        initSummerNote();
                    }
                })
            });

            $(document).on('click', '#editNewsBtn', function(e) {
                e.preventDefault();
                let go_next_step = true;
                if ($(this).attr('data-check-area') && $(this).attr('data-check-area').trim() !== '') {
                    go_next_step = check_validation_Form('#editModal .' + $(this).attr('data-check-area'));
                }
                if (go_next_step == true) {
                    $('#editNewsBtn').prop('disabled', true);
                    let descriptions = $('#edit_descriptions').summernote('code');
                    let form = document.getElementById('editNewsForm');
                    var formData = new FormData(form);
                    formData.append('descriptions', descriptions);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: $('#editNewsForm').attr('action'),
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            $.toast({
                                heading: 'Success',
                                text: response.message,
                                position: 'top-center',
                                icon: 'success'
                            })
                            $('#dataTable').DataTable().destroy();
                            getnews();
                            $('#editModal').modal('hide');
                        },
                        error: function(xhr) {
                            $('#editNewsBtn').prop('disabled', false);
                            let errorMessage = '';
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                errorMessage += ('' + value + '<br>');
                            });
                            $('#editNewsForm .server_side_error').empty();
                            $('#editNewsForm .server_side_error').html(
                                '<div class="alert alert-danger" role="alert">' + errorMessage +
                                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                            );
                        },
                    })
                }
            })

            $(document).on('click', '.delete_btn', function(e) {
                e.preventDefault();
                let id = $(this).attr('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ url('/admin/news/delete/') }}/" + id,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                if (data.success) {
                                    $.toast({
                                        heading: 'Success',
                                        text: data.success,
                                        position: 'top-center',
                                        icon: 'success'
                                    })
                                } else {
                                    $.toast({
                                        heading: 'Error',
                                        text: data.error,
                                        position: 'top-center',
                                        icon: 'error'
                                    })
                                }
                                $('#dataTable').DataTable().destroy();
                                getnews();
                            }
                        })

                    }
                })
            })

            // next button
            $(document).on('click', '#createModal .next_btn', function(e) {
                e.preventDefault();
                let go_next_step = true;
                if ($(this).attr('data-check-area') && $(this).attr('data-check-area').trim() !== '') {
                    go_next_step = check_validation_Form('#createModal .' + $(this).attr('data-check-area'));
                }
                if (go_next_step == true) {
                    let step = $(this).attr('data-step-open');
                    let step_btn = $(this).attr('data-step-button');

                    $('#createModal .step').removeClass('active show');
                    $('#createModal .step_btn').removeClass('d-block');
                    $('#createModal .step_btn').addClass('d-none');

                    $('#createModal .' + step).addClass('active show');
                    $('#createModal .' + step_btn).removeClass('d-none');
                    $('#createModal .' + step_btn).addClass('d-block');
                }
            })

            $(document).on('click', '#editModal .next_btn', function(e) {
                e.preventDefault();
                let go_next_step = true;
                if ($(this).attr('data-check-area') && $(this).attr('data-check-area').trim() !== '') {
                    go_next_step = check_validation_Form('#editModal .' + $(this).attr('data-check-area'));
                }
                if (go_next_step == true) {
                    let step = $(this).attr('data-step-open');
                    let step_btn = $(this).attr('data-step-button');

                    $('#editModal .step').removeClass('active show');
                    $('#editModal .step_btn').removeClass('d-block');
                    $('#editModal .step_btn').addClass('d-none');

                    $('#editModal .' + step).addClass('active show');
                    $('#editModal .' + step_btn).removeClass('d-none');
                    $('#editModal .' + step_btn).addClass('d-block');
                }
            })
        </script>






        <script type="module">
            // Import the functions you need from the SDKs you need
            import {
                initializeApp
            } from "https://www.gstatic.com/firebasejs/10.7.0/firebase-app.js";
            import {
                getAnalytics
            } from "https://www.gstatic.com/firebasejs/10.7.0/firebase-analytics.js";

            const firebaseConfig = {
                apiKey: "AIzaSyC0EVGPo_KFxoogdjOwJv0s3BBJFpMbti4",
                authDomain: "tamworth24.firebaseapp.com",
                databaseURL: "https://tamworth24-default-rtdb.firebaseio.com",
                projectId: "tamworth24",
                storageBucket: "tamworth24.appspot.com",
                messagingSenderId: "632958243780",
                appId: "1:632958243780:web:68bd2a29b6a7575d810a91",
                measurementId: "G-42R4PHX7YV"
            };
            // Initialize Firebase
            const app = initializeApp(firebaseConfig);
            const analytics = getAnalytics(app);
        </script>

        <script type="module">
            import {
                getDatabase,
                ref,
                push
            } from "https://www.gstatic.com/firebasejs/10.7.0/firebase-database.js";

            const database = getDatabase();

            function saveToFirebase(news) {
                const newsRef = ref(database, 'notifications');

                // Push the data to the database
                push(newsRef, {
                    id: news.id,
                    title: news.title,
                    short_description: news.short_description,
                    description: news.description,
                    media: '{{ config("app.url") }}' + '/uploads/news-images/' + news.media
                }).then((newRef) => {

                }).catch((error) => {

                });
            }

            $(document).on('click', '#createNewsBtn', function(e) {
                e.preventDefault();

                let go_next_step = true;
                if ($(this).attr('data-check-area') && $(this).attr('data-check-area').trim() !== '') {
                    go_next_step = check_validation_Form('#createModal .' + $(this).attr('data-check-area'));
                }
                if (go_next_step == true) {
                    $('#createNewsBtn').prop('disabled', true);
                    let descriptions = $('#descriptions').summernote('code');
                    let form = document.getElementById('createNewsForm');
                    var formData = new FormData(form);
                    formData.append('descriptions', descriptions);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: $('#createNewsForm').attr('action'),
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            $.toast({
                                heading: 'Success',
                                text: response.message,
                                position: 'top-center',
                                icon: 'success'
                            })
                            $('#dataTable').DataTable().destroy();
                            getnews();
                            $('#createModal').modal('hide');
                            $('#createNewsBtn').prop('disabled', false);
                            saveToFirebase(response.news);
                        },
                        error: function(xhr) {
                            $('#createNewsBtn').prop('disabled', false);
                            let errorMessage = '';
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                errorMessage += ('' + value + '<br>');
                            });
                            $('#createNewsForm .server_side_error').empty();
                            $('#createNewsForm .server_side_error').html(
                                '<div class="alert alert-danger" role="alert">' + errorMessage +
                                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                            );
                        },
                    })
                }
            })
        </script>
    @endpush
@endsection
