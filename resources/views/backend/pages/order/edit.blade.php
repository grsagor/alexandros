<form id="editOrderForm" action="{{ route('admin.order.update', $order->id)}}" method="post" enctype="multipart/form-data">
    @csrf 
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Order</h5>
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
                <div class="step step_1 tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>Partner</label>
                            <select name="user_id" class="form-control user_id">
                                <option value="">Select</option>
                                @foreach ($partners as $partner)
                                    <option @if($partner->user_id == $order->user_id) selected @endif value="{{ $partner->user_id}}">{{ $partner->contact_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label for="">Status</label>
                            <select name="status" id="" class="form-control">
                                <option @if($order->status == 0) selected @endif value="0">New</option>
                                <option @if($order->status == 1) selected @endif value="1">Shipping</option>
                                <option @if($order->status ==2) selected @endif value="2">Delivered</option>
                                <option @if($order->status == 3) selected @endif value="3">Rejected</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label for="">Company<span class="text-danger">*</span></label>
                            <input type="text" name="company" value="{{$billing->company ?? '' }}" class="form-control" placeholder="Company" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="">Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{$billing->name ?? ''}}" class="form-control" placeholder="Name" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label for="">Phone No.<span class="text-danger">*</span></label>
                            <input type="text" name="phone" value="{{$billing->phone ?? ''}}" class="form-control" placeholder="Phone No." required>
                        </div>
                        <div class="col-lg-6">
                            <label for="">Email<span class="text-danger">*</span></label>
                            <input type="text" name="email" value="{{$billing->email ?? ''}}" class="form-control" placeholder="Email" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-8">
                            <label for="">Address<span class="text-danger">*</span></label>
                            <input type="text" name="address" value="{{$billing->address ?? ''}}" class="form-control" placeholder="Address" required>
                        </div>
                        
                        <div class="col-lg-4">
                            <label for="">Post Code<span class="text-danger">*</span></label>
                            <input type="text" name="post_code" value="{{$billing->post_code ?? ''}}" class="form-control" placeholder="Post Code" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        
                        <div class="col-lg-4">
                            <label for="">City<span class="text-danger">*</span></label>
                            <input type="text" name="city" value="{{$billing->city ?? ''}}" class="form-control" placeholder="City" required>
                        </div>
                        <div class="col-lg-4">
                            <label for="">State<span class="text-danger">*</span></label>
                            <input type="text" name="state" value="{{$billing->state ?? ''}}" class="form-control" placeholder="State" required>
                        </div>
                        <div class="col-lg-4">
                            <label for="">Country<span class="text-danger">*</span></label>
                            <input type="text" name="country" value="{{$billing->country ?? ''}}" class="form-control" placeholder="State" required>
                        </div>
                    </div>

                </div>
                <div class="step step_2 tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    
                    <div class="form-group products_area">
                        <table class="w-100">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Discount Type</th>
                                    <th>Discount</th>
                                    <th>Subtotal</th>
                                    <th><a href="" type="button" id="addProduct" class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i></a></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->details as $row)
                                    <tr class="product{{$loop->iteration}}" data-row="{{$loop->iteration}}">
                                        <td>
                                            <select name="product[]" class="form-control product_select product_select{{$loop->iteration}}" data-row="{{$loop->iteration}}" required>
                                                <option value="">Product Select </option>
                                                @foreach ($products as $product)
                                                    <option @if($row->product_id == $product->id) selected @endif value="{{ $product->id}}">{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" value="{{$row->unit_price}}" class="form-control price price{{$loop->iteration}}" name="price[]" placeholder="Price" readonly>
                                        </td>
                                        <td>
                                            <input type="number" value="{{$row->quantity}}" class="form-control qty qty{{$loop->iteration}}" min="0" value="0" name="qty[]" placeholder="Quantity">
                                        </td>
                                        <td>
                                            <select name="discount_type[]" class="form-control discount_type discount_type{{$loop->iteration}}">
                                                <option value="null">Discount Type</option>
                                                <option @if($row->discount_type == 'percent') selected @endif value="percent">Percent</option>
                                                <option @if($row->discount_type == 'amount') selected @endif value="amount">Amount</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" value="{{$row->discount}}" class="form-control discount discount{{$loop->iteration}}" name="discount[]" placeholder="Discount">
                                        </td>
                                        <td>
                                            <input type="text" value="{{$row->subtotal}}" class="form-control subtotal subtotal{{$loop->iteration}}" name="subtotal[]" placeholder="Subtotal" readonly>
                                        </td>
                                        <td><a href="" type="button" data-row="{{$loop->iteration}}" class="btn btn-sm btn-danger remove_product" id="product{{$loop->iteration}}"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="form-group row mt-5">
                        <div class="col-lg-12">
                            <p class="mb-1">Payment Information</p>
                            <hr class="mt-0 mb-1">
                        </div>
                        <div class="col-lg-4">
                            <label for="">Payment Method</label>
                            <select name="payment_method" id="" class="form-control">
                                <option value="">Select</option>
                                <option @if($order->payment_method == 'Credit Card') selected @endif value="Credit Card">Credit Card</option>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="">Payment Status</label>
                            <select name="payment_status" id="" class="form-control">
                                <option @if($order->payment_status == '0') selected @endif value="0">Pending</option>
                                <option @if($order->payment_status == '1') selected @endif value="1">Paid</option>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="">Total Price</label>
                            <input type="text" class="form-control total_price" name="total_price" value="{{$order->total_price}}" readonly>
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
            <button type="submit" id="editOrderBtn" class="btn btn-primary" data-check-area="step_2">Update</button>
        </div>
    </div>
</form>