<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Auth;
use Helper;
use Hash;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $this->user = Auth::user();

            if (!$this->user || Helper::hasRight('user.view') == false) {
                session()->flash('error', 'You can not access! Login first.');
                return redirect()->route('admin');
            }
            return $next($request);
        });
    }

    public function index(){
        return view('backend.pages.user.index');
    }

    public function getList(Request $request){

        $data = User::query();
        if ($request->name) {
            $data->where(function($query) use ($request){
                $query->where('first_name','like', "%" .$request->name ."%" )
                ->orWhere('last_name','like', "%" .$request->name ."%");
            });
        }

        if ($request->email) {
            $data->where(function($query) use ($request){
                $query->where('email','like', "%" .$request->email ."%" );
            });
        }

        if ($request->phone) {
            $data->where(function($query) use ($request){
                $query->where('phone','like', "%" .$request->phone ."%" );
            });
        }
        
       
        return Datatables::of($data)

        ->editColumn('profile_image', function ($row) {
            return ($row->profile_image) ? '<img class="profile-img" src="'.asset('uploads/user-images/'.$row->profile_image).'" alt="profile image">' : '<img class="profile-img" src="'.asset('assets/img/no-img.jpg').'" alt="profile image">';
        })

        ->editColumn('first_name', function ($row) {
            return $row->first_name .' '.$row->last_name;
        })

        ->editColumn('role', function ($row) {
            return optional($row->roles)->name;
        })

        ->editColumn('status', function ($row) {
            if ($row->status == 1) {
                return '<span class="badge bg-primary w-80">Active</span>';
            }else{
                return '<span class="badge bg-danger w-80">Inactive</span>';
            }
        })

        ->addColumn('action', function ($row) {
            $btn = '';
            if (Helper::hasRight('user.edit')) {
                $btn = $btn . '<a href="" data-id="'.$row->id.'" class="edit_btn btn btn-sm btn-primary "><i class="fa-solid fa-pencil"></i></a>';
            }
            if (Helper::hasRight('user.edit')) {
                $btn = $btn . '<a class="change_password btn btn-sm btn-warning text-light mx-1 " data-id="'.$row->id.'" href="" title="Change Password"><i class="fa-solid fa-key"></i></a>';
            }
            if (Helper::hasRight('user.delete')) {
                $btn = $btn . '<a class="delete_btn btn btn-sm btn-danger " data-id="'.$row->id.'" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>';
            }
            return $btn;
        })
        ->rawColumns(['profile_image','first_name','role','status','action'])->make(true);
    }

    public function store(Request $request){
        $validator = $request->validate([
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email|unique:user',
			'phone' => 'required|unique:user',
			'role' => 'required',
		]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role  = $request->role;
        $user->password  = Hash::make($request->password ?? $request->phone);
        if ($user->save()) {
            return response()->json([
                'type' => 'success',
                'message' => 'User created successfully.',
            ]);
        }
    }

    public function edit($id){
        $user = User::find($id);
        return view('backend.pages.user.edit', compact('user'));
    }

    public function update(Request $request, $id){
        $validator = $request->validate([
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email',
			'phone' => 'required',
			'role' => 'required',
		]);

        $user = User::find($id);
        $user->first_name = $request->first_name ?? $user->first_name;
        $user->last_name = $request->last_name ?? $user->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone ?? $user->phone;
        $user->role  = $request->role ?? $user->role;
        $user->status  = ($request->status) ? 1 : 0;
        $user->password  = (!empty($request->password)) ? Hash::make($request->password) : $user->password;
        if ($user->save()) {
            return response()->json([
                'type' => 'success',
                'message' => 'User updated successfully.',
            ]);
        }else{
            return response()->json([
                'type' => 'success',
                'message' => 'Something went wrong.',
            ]);
        }
    }

    public function delete($id){
        $user = User::find($id);
        if($user){
            $user->delete();
            return json_encode(['success' => 'User deleted successfully.']);
        }else{
            return json_encode(['error' => 'User not found.']);
        }
    }

    public function changePassword(Request $request){
        $validator = $request->validate([
			'password' => 'required|min:8|confirmed',
			'password_confirmation' => 'required'
		]);

        $user = User::find($request->user_id);
        if($user){
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json([
                'type' => 'success',
                'message' => 'User password changed successfully.',
            ]);
        }else{
            return response()->json([
                'type' => 'error',
                'message' => 'User not found.',
            ]);
        }
    }
}
