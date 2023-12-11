<form id="statusOrderForm" action="{{ route('admin.order.update.status', $order->id)}}" method="post" enctype="multipart/form-data">
    @csrf 
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Order Status</h5>
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
            <div class="form-group col-lg-12">
                <label for="">Status</label>
                <select name="status" id="" class="form-control">
                    <option @if($order->status == 0) selected @endif value="0">New</option>
                    <option @if($order->status == 1) selected @endif value="1">Shipment</option>
                    <option @if($order->status ==2) selected @endif value="2">Delivered</option>
                    <option @if($order->status == 3) selected @endif value="3">Rejected</option>
                </select>
            </div>
            <div class="form-group col-lg-12">
                <label for="">Message</label>
                <textarea name="message" id="" cols="30" rows="5" class="form-control" placeholder="Write message"></textarea>
            </div>
            <div class="form-group col-lg-6">
                <label for="">Mail to client</label><br>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="send_email" >
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a type="button" class="modal__btn_space" data-bs-dismiss="modal">Close</a>
        <button type="submit" id="statusOrderBtn" class="btn btn-primary" >Update</button>
    </div>
</form>