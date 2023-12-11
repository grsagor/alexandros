<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Auth;
use Helper;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductAttribute;
use App\Models\Company;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $this->user = Auth::user();

            if (!$this->user || Helper::hasRight('order.view') == false) {
                session()->flash('error', 'You can not access! Login first.');
                return redirect()->route('admin');
            }
            return $next($request);
        });
    }

    public function index(){
        $category = Category::all();
        $brands = Brand::all();
        $partners = Company::all();
        $products = Product::all();
        return view('backend.pages.order.index', compact('category','brands','partners', 'products'));
    }

    public function getList(Request $request){

        $data = Order::query();


        if ($this->user->role == 2 || $this->user->role == 4 || $this->user->role == 5) {
            $data->where('user_id', $this->user->id);
        }

        if (!empty($request->date)) {
            $data->where('date', $request->date);
        }

        if ($request->user_id) {
            $data->where('user_id', $request->user_id);
        }

        if (!empty($request->status)) {

            $data->where(function($query) use ($request){
                if ($request->status == 1) {
                    $status = 1;
                }else if($request->status == 2){
                    $status = 2;
                }else if($request->status == 3){
                    $status = 3;
                }else{
                    $status = 0;
                }
                $query->where('status', $status);
            });
        }

        return Datatables::of($data)

        ->editColumn('user_id', function ($row) {
            return optional($row->company)->first_name ?? '-' .' '. optional($row->company)->last_name ?? '-';
        })


        ->editColumn('status', function ($row) {
            if ($row->status == 0) {
                return '<span class="badge bg-warning w-80">New</span>';
            }elseif ($row->status == 1) {
                return '<span class="badge bg-info w-80">Shipping</span>';
            }elseif ($row->status == 2) {
                return '<span class="badge bg-success w-80">Delivered</span>';
            }else{
                return '<span class="badge bg-danger w-80">Rejected</span>';
            }
        })
     ->addColumn('action', function ($row) {

        if ($this->user->role === 4 || $this->user->role === 5) {
            return ''; // Return empty string for users with roles 4 and 5
        }
            $btn = '';
            if (Helper::hasRight('order.edit')) {
                $btn = $btn . '<a href="" data-id="'.$row->id.'" class="status_change_btn btn btn-sm btn-info text-light"><i class="fa-solid fa-truck"></i></a>';
            }
            if (Helper::hasRight('order.edit')) {
                $btn = $btn . '<a href="" data-id="'.$row->id.'" class="edit_btn btn btn-sm btn-primary mx-1"><i class="fa-solid fa-pencil"></i></a>';
            }
            if (Helper::hasRight('order.delete')) {
                $btn = $btn . '<a class="delete_btn btn btn-sm btn-danger " data-id="'.$row->id.'" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>';
            }
            return $btn;
        })
        ->rawColumns(['user_id','status','action'])->make(true);
    }

    public function row($number){
        $products = Product::all();
        $number++;
        return view('backend.pages.order.row', compact('products','number'));
    }

    public function getCompany($user_id){
        $company = Company::where('user_id', $user_id)->first();
        return json_encode($company);
    }

    public function getProduct(Request $request){
        $product = Product::find($request->product_id);
        $product->price = ($product->discount) ? Helper::priceFaterOffer($product->id) : $product->price;
        return json_encode($product);
    }

    public function store(Request $request){

        $validator = $request->validate([
			'user_id' => 'required',
			'company' => 'required',
			'name' => 'required',
			'phone' => 'required',
			'email' => 'required',
			'address' => 'required',
			'post_code' => 'required',
			'city' => 'required',
			'state' => 'required',
			'country' => 'required',
			'product' => 'required',
		]);

        $order = new Order();
        $order->user_id = $request->user_id;
        $order->date = date('Y-m-d');
        $order->total_price = $request->total_price;
        $order->payment_status = $request->payment_status;
        $order->payment_method = $request->payment_method;

        $billing_information = [
            'company' => $request->company,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'post_code' => $request->post_code,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country
        ];

        $order->billing_information = json_encode($billing_information);

        if ($order->save()) {
            $order->refresh();

            for ($i=0; $i < count($request->product); $i++) {
                if(!empty($request->product[$i])){
                    $order_detail = new OrderDetail();
                    $order_detail->order_id  = $order->id;
                    $order_detail->product_id = $request->product[$i];
                    $order_detail->quantity = $request->qty[$i];
                    $order_detail->unit_price = $request->price[$i];
                    $order_detail->discount_type = $request->discount_type[$i];
                    $order_detail->discount = $request->discount[$i];
                    $order_detail->subtotal = $request->subtotal[$i];
                    $order_detail->save();
                }
            }

            return response()->json([
                'type' => 'success',
                'message' => 'Order created successfully.',
            ]);
        }else{
            return response()->json([
                'type' => 'error',
                'message' => 'Something went wrong.',
            ]);
        }
    }

    public function edit($order_id){
        $order = Order::find($order_id);
        $products = Product::where('status', 1)->get();
        $partners = Company::all();
        $billing = json_decode($order->billing_information);
        return view('backend.pages.order.edit', compact('order','products','partners','billing'));
    }

    public function update(Request $request, $id){
        $validator = $request->validate([
			'user_id' => 'required',
			'company' => 'required',
			'name' => 'required',
			'phone' => 'required',
			'email' => 'required',
			'address' => 'required',
			'post_code' => 'required',
			'city' => 'required',
			'state' => 'required',
			'country' => 'required',
			'product' => 'required',
		]);

        $order = Order::find($id);
        $order->user_id = $request->user_id;
        $order->date = date('Y-m-d');
        $order->total_price = $request->total_price;
        $order->payment_status = $request->payment_status;
        $order->payment_method = $request->payment_method;
        $order->status = $request->status;

        $billing_information = [
            'company' => $request->company,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'post_code' => $request->post_code,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country
        ];

        $order->billing_information = json_encode($billing_information);

        if ($order->save()) {
            OrderDetail::where('order_id', $id)->delete();

            for ($i=0; $i < count($request->product); $i++) {
                if(!empty($request->product[$i])){
                    $order_detail = new OrderDetail();
                    $order_detail->order_id  = $order->id;
                    $order_detail->product_id = $request->product[$i];
                    $order_detail->quantity = $request->qty[$i];
                    $order_detail->unit_price = $request->price[$i];
                    $order_detail->discount_type = $request->discount_type[$i];
                    $order_detail->discount = $request->discount[$i];
                    $order_detail->subtotal = $request->subtotal[$i];
                    $order_detail->save();
                }
            }

            return response()->json([
                'type' => 'success',
                'message' => 'Order updated successfully.',
            ]);
        }else{
            return response()->json([
                'type' => 'error',
                'message' => 'Something went wrong.',
            ]);
        }
    }

    public function delete($id){
        $order = Order::find($id);
        if($order->delete()){
            $details = OrderDetail::where('order_id', $id)->delete();
            if ($details) {
                $details->delete();
            }
            return json_encode(['success' => 'Order deleted successfully.']);
        }else{
            return json_encode(['error' => 'Order not found.']);
        }
    }

    public function editStaus($order_id){
        $order = Order::find($order_id);
        $products = Product::where('status', 1)->get();
        $partners = Company::all();
        $billing = json_decode($order->billing_information);
        return view('backend.pages.order.status', compact('order','products','partners','billing'));
    }

    public function updateStatus(Request $request, $id){
        $order = Order::find($id);
        $order->status = $request->status;
        if ($order->save()) {
            if ($request->send_email) {
                // send email
                $user = User::where('id', $order->user_id)->first();
                $email = $user->email;
                $subject = 'Order - Status changes';
                $data['user'] = $user;
                $data['order'] = $order;
                $data['order_details'] = OrderDetail::where('order_id', $order->id)->with('product', 'part')->get();
                $data['billing'] = json_decode($order->billing_information);
                $data['comments'] = $request->message ?? '';
                // return view('mails.orderinvoice', compact($data));
                if ($request->send_email && $email) {
                    Helper::sendEmail($email, $subject, $data, 'orderinvoice');
                }
            }
            return response()->json([
                'type' => 'success',
                'message' => 'Order status changed successfully.',
            ]);
        }else{
            return response()->json([
                'type' => 'error',
                'message' => 'Something went wrong.',
            ]);
        }

    }
}
