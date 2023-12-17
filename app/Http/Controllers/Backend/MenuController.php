<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MenuController extends Controller
{
    public function index()
    {
        return view('backend.pages.menu.index');
    }

    public function getList()
    {
        $data = Menu::all();

        return DataTables::of($data)

            ->addColumn('action', function ($row) {
                $btn = '';
                if (Helper::hasRight('event.edit')) {
                    $btn = $btn . '<a href="" data-id="' . $row->id . '" class="edit_btn btn btn-sm btn-primary mx-1"><i class="fa-solid fa-pencil"></i></a>';
                }
                if (Helper::hasRight('event.delete')) {
                    $btn = $btn . '<a class="delete_btn btn btn-sm btn-danger " data-id="' . $row->id . '" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>';
                }
                return $btn;
            })
            ->rawColumns(['action'])->make(true);
    }
    public function store(Request $request)
    {
        if (!Helper::hasRight('menu.create')) {
            return response()->json([
                'type' => 'error',
                'message' => "You don't have rights to create menu.",
            ]);
        }
        $requestData = $request->all();
        $rules = [
            'title' => 'required',
        ];
        $validator = $request->validate($rules);

        $menu = new Menu();

        $menu->title = $request->title;
        $menu->speciality = $request->speciality;
        $menu->subtitle = $request->subtitle;
        $menu->price = $request->price;
        $menu->tax = $request->tax;
        $menu->in_ex = $request->in_ex;

        $items = [];
        foreach ($request->items as $index => $value) {
            $items[] = [
                'item' => $value,
                'item_speciality' => $request->item_speciality[$index],
            ];
        }
        $menu->items = json_encode($items);

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $filename = time() . uniqid() . $image->getClientOriginalName();
            $image->move(public_path('uploads/menu-images'), $filename);
            $menu->img = 'uploads/menu-images/' . $filename;
        }

        if ($menu->save()) {
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
        $menu = Menu::find($request->id);
        $menu->items = json_decode($menu->items);

        $data = [
            'menu' => $menu,
        ];

        return view('backend.pages.menu.edit', $data);
    }
    public function update(Request $request)
    {
        if (!Helper::hasRight('menu.edit')) {
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
        $menu = Menu::find($request->id);

        $menu->title = $request->title;
        $menu->speciality = $request->speciality;
        $menu->subtitle = $request->subtitle;
        $menu->price = $request->price;
        $menu->tax = $request->tax;
        $menu->in_ex = $request->in_ex;

        $items = [];
        foreach ($request->items as $index => $value) {
            $items[] = [
                'item' => $value,
                'item_speciality' => $request->item_speciality[$index],
            ];
        }
        $menu->items = json_encode($items);

        if ($request->hasFile('img')) {

            if ($menu->img) {
                unlink(public_path($menu->img));
            }

            $image = $request->file('img');
            $filename = time() . uniqid() . $image->getClientOriginalName();
            $image->move(public_path('uploads/menu-images'), $filename);
            $menu->img = 'uploads/menu-images/' . $filename;
        }

        if ($menu->save()) {
            return response()->json([
                'type' => 'success',
                'message' => 'Menu updated successfully.',
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
        if (!Helper::hasRight('menu.delete')) {
            return response()->json([
                'type' => 'error',
                'message' => "You don't have rights to delete event.",
            ]);
        }

        $menu = Menu::find($request->id);
        if ($menu) {
            if ($menu->img) {
                unlink(public_path($menu->img));
            }

            if ($menu->delete()) {
                return response()->json([
                    'type' => 'success',
                    'message' => 'Menu deleted successfully.',
                ]);
            } else {
                return redirect()->route('admin.menu')->with('error', 'Something went wrong.');
            }
        } else {
            return json_encode(['error' => 'Menu not found.']);
        }
    }
}
