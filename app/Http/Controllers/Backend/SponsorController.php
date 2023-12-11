<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventSponsor;
use App\Models\MyFest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Auth;
use Helper;
use App\Models\User;
use App\Models\Role;
use Hash;

class SponsorController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $this->user = Auth::user();

            if (!$this->user || Helper::hasRight('sponsor.view') == false) {
                session()->flash('error', 'You can not access! Login first.');
                return redirect()->route('admin');
            }
            return $next($request);
        });
    }

    public function index(){
        return view('backend.pages.sponsor.index');
    }

    public function getList(Request $request){

        $data = User::query()
            ->select('user.*')
            ->join('role', 'user.role', '=', 'role.id')
            ->where('role.name', 'Sponsor');
        if (!empty($request->name)) {
            $data->where('first_name','like', "%" .$request->name ."%" );
        }

        if (!empty($request->phone)) {
            $data->where('phone','like', "%" .$request->phone ."%" );
        }

        if ($request->email) {
            $data->where('email', 'like', "%" .$request->email ."%" );
        }

        if (!empty($request->status)) {

            $data->where(function($query) use ($request){
                if ($request->status == 1) {
                    $status = 1;
                }else{
                    $status = 0;
                }
                $query->where('status', $status);
            });
        }

        return Datatables::of($data)

        ->editColumn('profile_image', function ($row) {
           return ($row->profile_image) ? '<img class="profile-img" src="'.asset('uploads/user-images/'.$row->profile_image).'" alt="profile image">' : '<img class="profile-img" src="'.asset('assets/img/no-img.jpg').'" alt="profile image">';
        })

        ->editColumn('first_name', function ($row) {
            return $row->first_name.' '.$row->last_name;
        })

        ->editColumn('status', function ($row) {
            if ($row->status == 1) {
                return '<span class="badge bg-primary w-100">Active</span>';
            }else if($row->status == 2){
                return '<span class="badge bg-danger w-100">Rejected</span>';
            }else{
                return '<span class="badge bg-warning w-100">Inactive</span>';
            }
        })

        ->addColumn('action', function ($row) {
            $btn = '';
            if (Helper::hasRight('sponsor.edit')) {
                $btn = $btn . '<a href="" data-id="'.$row->id.'" class="edit_btn btn btn-sm btn-primary mx-1"><i class="fa-solid fa-pencil"></i></a>';
            }
            if (Helper::hasRight('sponsor.delete')) {
                $btn = $btn . '<a class="delete_btn btn btn-sm btn-danger " data-id="'.$row->id.'" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>';
            }
            return $btn;
        })
        ->rawColumns(['profile_image','first_name','status','action'])->make(true);
    }

    public function store(Request $request){
        $validator = $request->validate([
            'image' => 'nullable|image:png,jpg,jpeg,gif,webp,',
		]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role  = 7;
        $user->status  = ($request->status) ? 1 : 0;
        $user->password  = Hash::make($request->phone);
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().uniqid().$image->getClientOriginalName();
            $image->move(public_path('uploads/user-images'), $filename);
            $user->profile_image = $filename;
        }
        $social_media_links = [
            'facebook_link' => $request->facebook_link,
            'spotify_link' => $request->spotify_link,
            'itunes_link' => $request->itunes_link,
            'youtube_link' => $request->youtube_link,
            'instagram_link' => $request->instagram_link,
            'sponsor_link' => $request->sponsor_link
        ];
        $user->social_media_links = json_encode($social_media_links);

        if($user->save()){
            return response()->json([
                'type' => 'success',
                'message' => 'Sponsor created successfully.',
            ]);
        }else{
            return response()->json([
                'type' => 'error',
                'message' => 'Something went wrong.',
            ]);
        }

    }

    public function edit($id){
        $sponsor = User::find($id);
        $social_media_links = json_decode($sponsor->social_media_links);
        return view('backend.pages.sponsor.edit', compact('sponsor', 'social_media_links'));
    }

    public function update(Request $request, $id){
        $validator = $request->validate([
		]);

        $user = User::find($id);
        if($user){
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->role  = 7;
            $user->status  = ($request->status) ? 1 : 0;

            $social_media_links = [
                'facebook_link' => $request->facebook_link,
                'spotify_link' => $request->spotify_link,
                'itunes_link' => $request->itunes_link,
                'youtube_link' => $request->youtube_link,
                'instagram_link' => $request->instagram_link,
                'sponsor_link' => $request->sponsor_link
            ];
            $user->social_media_links = json_encode($social_media_links);

            if($request->hasFile('image')){
                if ($user->profile_image != Null && file_exists(public_path('uploads/user-images/'.$user->profile_image))) {
                    unlink(public_path('uploads/user-images/'.$user->profile_image));
                }
                $image = $request->file('image');
                $filename = time().uniqid().$image->getClientOriginalName();
                $image->move(public_path('uploads/user-images'), $filename);
                $user->profile_image = $filename;
            }
            if($user->save()){
                return response()->json([
                    'type' => 'success',
                    'message' => 'Sponsor updated successfully.',
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
                'message' => 'Sponsor not found.',
            ]);
        }
    }

    public function delete($id){
        $sponsor = User::find($id);
        if($sponsor){
            EventSponsor::where('sponsor_id', $sponsor->id)->delete();
            if ($sponsor->profile_image != Null && file_exists(public_path('uploads/user-images/'.$sponsor->profile_image))) {
                unlink(public_path('uploads/user-images/'.$sponsor->profile_image));
            }
            if ($sponsor->delete()) {
                return json_encode(['success' => 'Sponsor deleted successfully.']);
            }else{
                return redirect()->route('admin.sponsor')->with('error', 'Something went wrong.');
            }

        }else{
            return json_encode(['error' => 'Sponsor not found.']);
        }
    }

    public function view($id){
        $sponsor = User::find($id);
        $social_media_links = json_decode($sponsor->social_media_links);
        if($sponsor){
            return view('backend.pages.sponsor.view', compact('sponsor','social_media_links'));
        }else{
            return json_encode(['error' => 'Sponsor not found.']);
        }
    }

    public function status($id, $status){
        $sponsor = User::find($id);
        if($sponsor){
            $sponsor->status = $status;
            if ($sponsor->save()) {
                return redirect()->route('admin.sponsor')->with('success', 'Sponsor updated successfully.');
            }else{
                return redirect()->route('admin.sponsor')->with('error', 'Something went wrong.');
            }
        }else{
            return redirect()->route('admin.sponsor')->with('error', 'Something went wrong.');
        }
    }
}
