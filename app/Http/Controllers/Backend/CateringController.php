<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Catering;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CateringController extends Controller
{
    public function index()
    {
        return view('backend.pages.catering.index');
    }

    public function getList()
    {
        $data = Catering::all();

        return DataTables::of($data)

        ->editColumn('image', function ($row) {
            return $row->image ? '<a href="'.asset($row->image).'" target="_blank"><img class="" width="50px" height="50px" src="'.asset($row->image).'" alt="profile image"></a>' : '<img class="profile-img" src="'.asset('assets/img/no-img.jpg').'" alt="website logo image">';
        })

            ->addColumn('action', function ($row) {
                $btn = '';
                if (Helper::hasRight('catering.edit')) {
                    $btn = $btn . '<a href="" data-id="' . $row->id . '" class="edit_btn btn btn-sm btn-primary mx-1"><i class="fa-solid fa-pencil"></i></a>';
                }
                if (Helper::hasRight('catering.delete')) {
                    $btn = $btn . '<a class="delete_btn btn btn-sm btn-danger " data-id="' . $row->id . '" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>';
                }
                return $btn;
            })
            ->rawColumns(['image', 'action'])->make(true);
    }
    public function store(Request $request)
    {
        if (!Helper::hasRight('catering.create')) {
            return response()->json([
                'type' => 'error',
                'message' => "You don't have rights to create catering.",
            ]);
        }
        $requestData = $request->all();
        $rules = [
            'title' => 'required',
        ];
        $validator = $request->validate($rules);

        $catering = new Catering();

        $catering->title = $request->title;
        $catering->price = $request->price;
        $catering->status = ($request->status) ? 1 : 0;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . uniqid() . $image->getClientOriginalName();
            $image->move(public_path('uploads/catering-images'), $filename);
            $catering->image = 'uploads/catering-images/' . $filename;
        }

        if ($catering->save()) {
            return response()->json([
                'type' => 'success',
                'message' => 'Event created successfully.',
            ]);
        } else {
            return response()->json([
                'type' => 'error',
                'message' => 'Something went wrong.',
            ]);
        }
    }
    public function edit(Request $request)
    {
        $catering = Catering::find($request->id);
        $data = [
            'catering' => $catering,
        ];

        return view('backend.pages.catering.edit', $data);
    }
    public function update(Request $request)
    {
        if (!Helper::hasRight('catering.edit')) {
            return response()->json([
                'type' => 'error',
                'message' => "You don't have rights to update event.",
            ]);
        }
        $requestData = $request->all();
        $rules = [
            'title' => 'required',
        ];

        $validator = $request->validate($rules);
        $catering = Catering::find($request->id);

        $catering->title = $request->title;
        $catering->price = $request->price;
        $catering->status = ($request->status) ? 1 : 0;

        if ($request->hasFile('image')) {

            if ($catering->image) {
                unlink(public_path($catering->image));
            }

            $image = $request->file('image');
            $filename = time() . uniqid() . $image->getClientOriginalName();
            $image->move(public_path('uploads/catering-images'), $filename);
            $catering->image = 'uploads/catering-images/' . $filename;
        }

        if ($catering->save()) {
            return response()->json([
                'type' => 'success',
                'message' => 'catering updated successfully.',
            ]);
        } else {
            return response()->json([
                'type' => 'error',
                'message' => 'Something went wrong.',
            ]);
        }
    }
    public function delete(Request $request)
    {
        if (!Helper::hasRight('catering.delete')) {
            return response()->json([
                'type' => 'error',
                'message' => "You don't have rights to delete event.",
            ]);
        }

        $catering = Catering::find($request->id);
        if ($catering) {
            if ($catering->image) {
                unlink(public_path($catering->image));
            }

            if ($catering->delete()) {
                return response()->json([
                    'type' => 'success',
                    'message' => 'Catering deleted successfully.',
                ]);
            } else {
                return redirect()->route('admin.catering')->with('error', 'Something went wrong.');
            }
        } else {
            return json_encode(['error' => 'catering not found.']);
        }
    }
}
