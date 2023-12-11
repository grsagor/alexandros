<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Helper;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class GalleryController extends Controller
{
    public function index(){
        $galleries = Gallery::all();
        return view('backend.pages.gallery.index');
    }

    public function getList(Request $request){

        $data = Gallery::all();

        return DataTables::of($data)

        ->editColumn('profile_image', function ($row) {
            return ($row->image) ? '<a href="'.asset('uploads/user-images/'.$row->image).'" target="_blank"><img class="" width="50px" height="50px" src="'.asset('uploads/gallery-images/'.$row->image).'" alt="profile image"></a>' : '<img class="profile-img" src="'.asset('assets/img/no-img.jpg').'" alt="website logo image">';
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

        ->editColumn('tags', function ($row) {
            return implode(', ', json_decode($row->tags));
        })

        ->addColumn('action', function ($row) {
            $btn = '';
            if (Helper::hasRight('gallery.edit')) {
                $btn = $btn . '<a href="" data-id="'.$row->id.'" class="edit_btn btn btn-sm btn-primary mx-1"><i class="fa-solid fa-pencil"></i></a>';
            }
            if (Helper::hasRight('gallery.delete')) {
                $btn = $btn . '<a class="delete_btn btn btn-sm btn-danger " data-id="'.$row->id.'" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>';
            }
            return $btn;
        })
        ->rawColumns(['status','profile_image', 'tags', 'action'])->make(true);
    }

    public function store(Request $request) {
        if (!Helper::hasRight('gallery.create')) {
            return response()->json([
                'type' => 'error',
                'message' => "You don't have rights to create gallery.",
            ]);
        }

        $tags = explode(',', $request->tags);

        $validator = $request->validate([
			'title' => 'required',
            'image' => 'nullable|image:png,jpg,jpeg,gif,webp,',
		]);

        $gallery = new Gallery();

        $gallery->title = $request->title;
        $gallery->tags = json_encode($tags);
        $gallery->status = ($request->status) ? 1 : 0;

        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().uniqid().$image->getClientOriginalName();
            $image->move(public_path('uploads/gallery-images'), $filename);
            $gallery->image = $filename;
        }

        if($gallery->save()){
            return response()->json([
                'type' => 'success',
                'message' => 'Gallery created successfully.',
            ]);
        }else{
            return response()->json([
                'type' => 'error',
                'message' => 'Something went wrong.',
            ]);
        }
    }

    public function edit(Request $request){
        $gallery = Gallery::find($request->id);
        $gallery->tags = json_decode($gallery->tags);
        return view('backend.pages.gallery.edit', compact('gallery'));
    }

    public function update(Request $request) {
        if (!Helper::hasRight('gallery.edit')) {
            return response()->json([
                'type' => 'error',
                'message' => "You don't have rights to update gallery.",
            ]);
        }

        $tags = explode(',', $request->tags);

        $validator = $request->validate([
			'title' => 'required',
            'image' => 'nullable|image:png,jpg,jpeg,gif,webp,',
		]);

        $gallery = Gallery::find($request->id);

        $gallery->title = $request->title;
        $gallery->tags = json_encode($tags);
        $gallery->status = ($request->status) ? 1 : 0;

        if($request->hasFile('image')){
            if ($gallery->image != Null && file_exists(public_path('uploads/gallery-images/'.$gallery->image))) {
                unlink(public_path('uploads/gallery-images/'.$gallery->image));
            }
            $image = $request->file('image');
            $filename = time().uniqid().$image->getClientOriginalName();
            $image->move(public_path('uploads/gallery-images'), $filename);
            $gallery->image = $filename;
        }

        if($gallery->save()){
            return response()->json([
                'type' => 'success',
                'message' => 'Gallery updated successfully.',
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
                'message' => "You don't have rights to delete gallery.",
            ]);
        }

        $gallery = Gallery::find($request->id);
        if($gallery){
            if ($gallery->image != Null && file_exists(public_path('uploads/user-images/'.$gallery->image))) {
                unlink(public_path('uploads/gallery-images/'.$gallery->image));
            }
            if ($gallery->delete()) {
                return json_encode(['success' => 'Gallery deleted successfully.']);
            }else{
                return redirect()->route('admin.gallery')->with('error', 'Something went wrong.');
            }

        }else{
            return json_encode(['error' => 'Gallery not found.']);
        }
    }
}
