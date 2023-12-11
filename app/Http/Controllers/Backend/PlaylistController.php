<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use Helper;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PlaylistController extends Controller
{
    public function index(){
        return view('backend.pages.playlist.index');
    }

    public function getList(Request $request){

        $data = Playlist::all();

        return DataTables::of($data)

        ->editColumn('profile_image', function ($row) {
            return ($row->icon) ? '<a href="'.asset('uploads/user-images/'.$row->icon).'" target="_blank"><img class="" width="50px" height="50px" src="'.asset('uploads/playlist-images/'.$row->icon).'" alt="profile image"></a>' : '<img class="profile-img" src="'.asset('assets/img/no-img.jpg').'" alt="website logo image">';
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
            // if (Helper::hasRight('playlist.view')) {
            //     $btn = $btn . '<a href="" data-id="'.$row->id.'" class="view_btn btn btn-sm btn-info text-light"><i class="fa-solid fa-eye"></i></a>';
            // }
            if (Helper::hasRight('playlist.edit')) {
                $btn = $btn . '<a href="" data-id="'.$row->id.'" class="edit_btn btn btn-sm btn-primary mx-1"><i class="fa-solid fa-pencil"></i></a>';
            }
            if (Helper::hasRight('playlist.delete')) {
                $btn = $btn . '<a class="delete_btn btn btn-sm btn-danger " data-id="'.$row->id.'" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>';
            }
            return $btn;
        })
        ->rawColumns(['status','profile_image','action'])->make(true);
    }

    public function store(Request $request) {
        if (!Helper::hasRight('gallery.create')) {
            return response()->json([
                'type' => 'error',
                'message' => "You don't have rights to create playlist.",
            ]);
        }

        $validator = $request->validate([
			'title' => 'required',
			'url' => 'required',
            'image' => 'nullable|image:png,jpg,jpeg,gif,webp,',
		]);

        $playlist = new Playlist();

        $playlist->title = $request->title;
        $playlist->url = $request->url;
        $playlist->status = ($request->status) ? 1 : 0;

        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().uniqid().$image->getClientOriginalName();
            $image->move(public_path('uploads/playlist-images'), $filename);
            $playlist->icon = $filename;
        }

        if($playlist->save()){
            return response()->json([
                'type' => 'success',
                'message' => 'Playlist created successfully.',
            ]);
        }else{
            return response()->json([
                'type' => 'error',
                'message' => 'Something went wrong.',
            ]);
        }
    }

    public function edit(Request $request){
        $playlist = Playlist::find($request->id);
        return view('backend.pages.playlist.edit', compact('playlist'));
    }

    public function update(Request $request) {
        if (!Helper::hasRight('gallery.edit')) {
            return response()->json([
                'type' => 'error',
                'message' => "You don't have rights to update playlist.",
            ]);
        }

        $validator = $request->validate([
			'title' => 'required',
			'url' => 'required',
            'image' => 'nullable|image:png,jpg,jpeg,gif,webp,',
		]);

        $playlist = Playlist::find($request->id);

        $playlist->title = $request->title;
        $playlist->url = $request->url;
        $playlist->status = ($request->status) ? 1 : 0;

        if($request->hasFile('image')){
            if ($playlist->icon != Null && file_exists(public_path('uploads/playlist-images/'.$playlist->icon))) {
                unlink(public_path('uploads/playlist-images/'.$playlist->icon));
            }
            $image = $request->file('image');
            $filename = time().uniqid().$image->getClientOriginalName();
            $image->move(public_path('uploads/playlist-images'), $filename);
            $playlist->icon = $filename;
        }

        if($playlist->save()){
            return response()->json([
                'type' => 'success',
                'message' => 'Playlist updated successfully.',
            ]);
        }else{
            return response()->json([
                'type' => 'error',
                'message' => 'Something went wrong.',
            ]);
        }
    }

    public function delete(Request $request){
        if (!Helper::hasRight('gallery.delete')) {
            return response()->json([
                'type' => 'error',
                'message' => "You don't have rights to delete playlist.",
            ]);
        }

        $playlist = Playlist::find($request->id);
        if($playlist){
            if ($playlist->icon != Null && file_exists(public_path('uploads/playlist-images/'.$playlist->icon))) {
                unlink(public_path('uploads/playlist-images/'.$playlist->icon));
            }
            if ($playlist->delete()) {
                return json_encode(['success' => 'Playlist deleted successfully.']);
            }else{
                return redirect()->route('admin.playlist')->with('error', 'Something went wrong.');
            }

        }else{
            return json_encode(['error' => 'Playlist not found.']);
        }
    }
}
