<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Auth;
use Helper;
use App\Models\Company;
use App\Models\User;
use App\Models\Role;
use Hash;

class PartnerController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $this->user = Auth::user();

            if (!$this->user || Helper::hasRight('partner.view') == false) {
                session()->flash('error', 'You can not access! Login first.');
                return redirect()->route('admin');
            }
            return $next($request);
        });
    }

    public function index(){
        return view('backend.pages.partner.index');
    }

    public function getList(Request $request){

        $data = Company::query();
        if (!empty($request->company_name)) {
            $data->where('name','like', "%" .$request->company_name ."%" );
        }

        if (!empty($request->partner_name)) {
            $data->where('contact_name','like', "%" .$request->partner_name ."%" );
        }

        if ($request->type) {
            $data->where('type', $request->type);
        }

        return Datatables::of($data)

        ->editColumn('website_logo', function ($row) {
            return ($row->website_logo) ? '<a href="'.asset('uploads/user-images/'.$row->website_logo).'" target="_blank"><img class="profile-img" src="'.asset('uploads/user-images/'.$row->website_logo).'" alt="website logo image"></a>' : '<img class="profile-img" src="'.asset('assets/img/no-img.jpg').'" alt="website logo image">';
        })

        ->editColumn('status', function ($row) {
            if ($row->status == 1) {
                return '<span class="badge bg-primary w-100">Approved</span>';
            }else if($row->status == 2){
                return '<span class="badge bg-danger w-100">Rejected</span>';
            }else{
                return '<span class="badge bg-warning w-100">Pending</span>';
            }
        })

        ->addColumn('action', function ($row) {
            $btn = '';
            if (Helper::hasRight('partner.view')) {
                $btn = $btn . '<a href="" data-id="'.$row->company_id.'" class="view_btn btn btn-sm btn-info text-light"><i class="fa-solid fa-eye"></i></a>';
            }
            if (Helper::hasRight('partner.edit')) {
                $btn = $btn . '<a href="" data-id="'.$row->company_id.'" class="edit_btn btn btn-sm btn-primary mx-1"><i class="fa-solid fa-pencil"></i></a>';
            }
            if (Helper::hasRight('partner.delete')) {
                $btn = $btn . '<a class="delete_btn btn btn-sm btn-danger " data-id="'.$row->company_id.'" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>';
            }
            return $btn;
        })
        ->rawColumns(['website_logo','status','action'])->make(true);
    }

    public function store(Request $request){
        $validator = $request->validate([
			'first_name' => 'required',
			'last_name' => 'required',
			'name' => 'required',
			'department' => 'required',
			'vat_no' => 'required',
			'email' => 'required|unique:user',
			'password' => 'nullable|min:8|confirmed',
			'password_confirmation' => 'nullable',
			'address' => 'required',
			'post_code' => 'required',
			'city' => 'required',
			'state' => 'required',
			'country' => 'required',
            'image' => 'nullable|image:png,jpg,jpeg,gif,webp,',
		]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone_no;
        $user->role  = ($request->type) ? Role::where('name', $request->type)->first()->id : 0;
        $user->password  = Hash::make($request->password);
        $user->status  = 0;

        if($user->save()){
            $user->refresh();
            
            $company = new Company();
            $company->type = $request->type;
            $company->user_id = $user->id;
            $company->type = $request->type;
            $company->contact_name = $request->first_name.' '.$request->last_name;
            $company->name = $request->name;
            $company->phone_number = $request->phone_no;
            $company->department = $request->department;
            $company->vat_no = $request->vat_no;
            $company->email = $request->email;
            $company->address = $request->address;
            $company->post_code = $request->post_code;
            $company->state = $request->state;
            $company->city = $request->city;
            $company->country = $request->country;
            $company->website_url = $request->website_url;
            $company->discount_type = $request->discount_type;
            $company->discount = $request->discount;
            if($request->hasFile('image')){
                $image = $request->file('image');
                $filename = time().uniqid().$image->getClientOriginalName();
                $image->move(public_path('uploads/user-images'), $filename);
                $company->website_logo = $filename;
            }
            $company->status = 0;
            if($company->save()){
                return response()->json([
                    'type' => 'success',
                    'message' => 'Company created successfully.',
                ]);
            }else{
                return response()->json([
                    'type' => 'error',
                    'message' => 'Something went wrong.',
                ]);
            }
        }else{
            return response()->json([
                'type' => 'error',
                'message' => 'Something went wrong.',
            ]);
        }

    }

    public function edit($id){
        $partner = Company::find($id);
        return view('backend.pages.partner.edit', compact('partner'));
    }

    public function update(Request $request, $id){
        $validator = $request->validate([
			'first_name' => 'required',
			'last_name' => 'required',
			'name' => 'required',
			'department' => 'nullable',
			'vat_no' => 'required',
			'password' => 'nullable|min:8|confirmed',
			'password_confirmation' => 'nullable',
			'address' => 'required',
			'post_code' => 'required',
			'city' => 'required',
			'state' => 'required',
			'country' => 'required',
            'image' => 'nullable|image:png,jpg,jpeg,gif,webp,',
		]);

        
        $company = Company::find($id);
        $company->type = $request->type;
        $company->type = $request->type;
        $company->contact_name = $request->first_name.' '.$request->last_name;
        $company->name = $request->name;
        $company->phone_number = $request->phone_no;
        $company->department = $request->department;
        $company->vat_no = $request->vat_no;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->post_code = $request->post_code;
        $company->state = $request->state;
        $company->city = $request->city;
        $company->country = $request->country;
        $company->website_url = $request->website_url;
        $company->discount_type = $request->discount_type;
        $company->discount = $request->discount;
        if($request->hasFile('image')){
            if ($company->image != null && file_exists(public_path('uploads/user-images/'.$partner->image))) {
                unlink(public_path('uploads/user-images/'.$partner->image));
            }
            $image = $request->file('image');
            $filename = time().uniqid().$image->getClientOriginalName();
            $image->move(public_path('uploads/user-images'), $filename);
            $company->website_logo = $filename;
        }
        $company->status = $request->status;
        if($company->save()){
            $user = User::find($company->user_id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->phone = $request->phone_no;
            $user->role  = ($request->type) ? Role::where('name', $request->type)->first()->id : 0;
            $user->password  = Hash::make($request->password);
            $user->status  = $request->status;
            if($user->save()){
                return response()->json([
                    'type' => 'success',
                    'message' => 'Company updated successfully.',
                ]);
            }else{
                return response()->json([
                    'type' => 'error',
                    'message' => 'Something went wrong.',
                ]);
            }
        }else{
            return response()->json([
                'type' => 'error',
                'message' => 'Something went wrong.',
            ]);
        }
    }

    public function delete($id){
        $partner = Company::find($id);
        if($partner){
            if ($partner->image != null && file_exists(public_path('uploads/user-images/'.$partner->image))) {
                unlink(public_path('uploads/user-images/'.$partner->image));
            }
            if ( $partner->delete()) {
                $user = User::find($partner->user_id);
                $user->delete();
            }
            return json_encode(['success' => 'Company deleted successfully.']);
        }else{
            return json_encode(['error' => 'Company not found.']);
        }
    }

    public function view($id){
        $partner = Company::find($id);
        if($partner){
            return view('backend.pages.partner.view', compact('partner'));
        }else{
            return json_encode(['error' => 'Company not found.']);
        }
    }

    public function status($id, $status){
        $partner = Company::find($id);
        if($partner){
            $partner->status = $status;
            if ($partner->save()) {
                $user = User::find($partner->user_id);
                $user->status = $status;
                $user->save();
            }
            return redirect()->route('admin.partner')->with('success', 'Company request updated successfully.');
        }else{
            return redirect()->route('admin.partner')->with('error', 'Something went wrong.');
        }
    }
}
