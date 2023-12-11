<form id="editUserForm" action="{{ route('admin.user.update', $user->id)}}" method="post">
    @csrf 
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
        </button>
    </div>
    <div class="modal-body">
        <div class="col-sm-12">
            <div class="server_side_error" role="alert">

            </div>
        </div>
        <div class="form-group  row">
            <label for="" class="col-sm-2 col-form-label">First Name</label>
            <div class="col-sm-10">
                <input type="text" name="first_name" class="form-control" placeholder="First name" value="{{ $user->first_name }}" required>
            </div>
        </div>
        <div class="form-group  row">
            <label for="" class="col-sm-2 col-form-label">Last Name</label>
            <div class="col-sm-10">
                <input type="text" name="last_name" class="form-control" placeholder="Last name" value="{{$user->last_name}}" required>
            </div>
        </div>
        <div class="form-group  row">
            <label for="" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}" readonly>
            </div>
        </div>
        <div class="form-group  row">
            <label for="" class="col-sm-2 col-form-label">Phone No.</label>
            <div class="col-sm-10">
                <input type="text" name="phone" class="form-control" placeholder="Phone No." value="{{ $user->phone }}" required>
            </div>
        </div>
        <div class="form-group  row">
            <label for="" class="col-sm-2 col-form-label">User Type</label>
            <div class="col-sm-10">
                <select name="role" class="form-control" required>
                    <option value="">Select</option>
                    @foreach (App\Models\Role::all() as $item)
                        <option @if ($user->role == $item->id) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group  row">
            <label for="" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-3 d-flex align-items-center">
                <div class="form-check form-switch">
                    <input class="form-check-input" @if($user->status == 1) checked @endif type="checkbox" name="status" id="flexSwitchCheckDefault">
                </div>
            </div>
        </div>

        <div class="form-group  row">
            <label for="" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control" placeholder="Password" >
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a type="button" class="modal__btn_space" data-bs-dismiss="modal">Close</a>
        <button type="submit" id="editUserBtn" class="btn btn-primary" data-check-area="modal-body">Update</button>
    </div>
</form>