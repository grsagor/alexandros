<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Auth;
use Helper;
use App\Models\User;
use App\Models\Role;
use Hash;
use App\Models\EventArtist;
use App\Models\EventSponsor;
use App\Models\MyFest;

class ArtistController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $this->user = Auth::user();

            if (!$this->user || Helper::hasRight('artist.view') == false) {
                session()->flash('error', 'You can not access! Login first.');
                return redirect()->route('admin');
            }
            return $next($request);
        });
    }

    public function index(){
        $artist_type = User::selectRaw('MAX(id) as id, artist_type')
        ->whereNotNull('artist_type')
        ->groupBy('artist_type')
        ->get();
        return view('backend.pages.artist.index', compact('artist_type'));
    }

    public function getList(Request $request){

        $data = User::query()
            ->select('user.*')
            ->join('role', 'user.role', '=', 'role.id')
            ->where('role.name', 'Artist');
        if (!empty($request->name)) {
            $data->where('first_name','like', "%" .$request->name ."%" );
        }

        if (!empty($request->phone)) {
            $data->where('phone','like', "%" .$request->phone ."%" );
        }

        if ($request->type) {
            $data->where('artist_type', 'like', "%" .$request->type ."%" );
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
            return ($row->profile_image) ? '<a href="'.asset('uploads/user-images/'.$row->profile_image).'" target="_blank"><img class="" width="50px" height="50px" src="'.asset('uploads/user-images/'.$row->profile_image).'" alt="profile image"></a>' : '<img class="profile-img" src="'.asset('assets/img/no-img.jpg').'" alt="website logo image">';
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

        ->editColumn('is_golden_guiter', function ($row) {
            if ($row->is_golden_guiter == 1) {
                return '<span class="badge bg-primary w-40">Yes</span>';
            }else{
                return '-';
            }
        })

        ->addColumn('action', function ($row) {
            $btn = '';
            if (Helper::hasRight('artist.view')) {
                $btn = $btn . '<a href="" data-id="'.$row->id.'" class="view_btn btn btn-sm btn-info text-light"><i class="fa-solid fa-eye"></i></a>';
            }
            if (Helper::hasRight('artist.edit')) {
                $btn = $btn . '<a href="" data-id="'.$row->id.'" class="edit_btn btn btn-sm btn-primary mx-1"><i class="fa-solid fa-pencil"></i></a>';
            }
            if (Helper::hasRight('artist.delete')) {
                $btn = $btn . '<a class="delete_btn btn btn-sm btn-danger " data-id="'.$row->id.'" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>';
            }
            return $btn;
        })
        ->rawColumns(['profile_image','is_golden_guiter','first_name','status','action'])->make(true);
    }

    public function store(Request $request){
        $validator = $request->validate([
			'first_name' => 'required',
			'last_name' => 'required',
            'image' => 'nullable|image:png,jpg,jpeg,gif,webp,',
		]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->artist_type = $request->artist_type;
        $user->address = $request->address;
        $user->description = $request->description;
        $user->role  = 6;
        $user->status  = ($request->status) ? 1 : 0;
        $user->is_golden_guiter  = ($request->is_golden_guiter) ? 1 : 0;
        $user->password  = Hash::make($request->phone);
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
            $image = $request->file('image');
            $filename = time().uniqid().$image->getClientOriginalName();
            $image->move(public_path('uploads/user-images'), $filename);
            $user->profile_image = $filename;
        }

        if($user->save()){
            return response()->json([
                'type' => 'success',
                'message' => 'Artist created successfully.',
            ]);
        }else{
            return response()->json([
                'type' => 'error',
                'message' => 'Something went wrong.',
            ]);
        }

    }

    public function edit($id){
        $artist = User::find($id);
        $social_media_links = json_decode($artist->social_media_links);
        return view('backend.pages.artist.edit', compact('artist','social_media_links'));
    }

    public function update(Request $request, $id){
        $validator = $request->validate([
			'first_name' => 'required',
			'last_name' => 'required',
		]);

        $user = User::find($id);
        if($user){
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->artist_type = $request->artist_type;
            $user->address = $request->address;
            $user->description = $request->description;
            $user->role  = 6;
            $user->status  = ($request->status) ? 1 : 0;
            $user->is_golden_guiter  = ($request->is_golden_guiter) ? 1 : 0;
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
                    'message' => 'Artist updated successfully.',
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
                'message' => 'Artist not found.',
            ]);
        }

    }

    public function delete($id){
        $artist = User::find($id);
        if($artist){
            $event_artists = EventArtist::where('artist_id', $id)->get();
            foreach ($event_artists as $event_artist) {
                $event = Event::find($event_artist->event_id);
                MyFest::where('event_id', $event->id)->delete();
                $event->delete();
            }
            if ($artist->profile_image != Null && file_exists(public_path('uploads/user-images/'.$artist->profile_image))) {
                unlink(public_path('uploads/user-images/'.$artist->profile_image));
            }
            if ($artist->delete()) {
                return json_encode(['success' => 'Artist deleted successfully.']);
            }else{
                return redirect()->route('admin.artist')->with('error', 'Something went wrong.');
            }

        }else{
            return json_encode(['error' => 'Artist not found.']);
        }
    }

    public function view($id){
        $artist = User::find($id);
        $social_media_links = json_decode($artist->social_media_links);
        if($artist){
            return view('backend.pages.artist.view', compact('artist','social_media_links'));
        }else{
            return json_encode(['error' => 'Artist not found.']);
        }
    }

    public function status($id, $status){
        $artist = User::find($id);
        if($artist){
            $artist->status = $status;
            if ($artist->save()) {
                return redirect()->route('admin.artist')->with('success', 'Artist updated successfully.');
            }else{
                return redirect()->route('admin.artist')->with('error', 'Something went wrong.');
            }
        }else{
            return redirect()->route('admin.artist')->with('error', 'Something went wrong.');
        }
    }
}
