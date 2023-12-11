<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Venue;
use Helper;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Intervention\Image\Facades\Image;
use App\Models\Event;
use App\Models\EventArtist;
use App\Models\EventSponsor;
use App\Models\MyFest;

class VenueController extends Controller
{
    public function index(){
        return view('backend.pages.venue.index');
    }

    public function getList(){
        $data = Venue::all();

        return DataTables::of($data)

        ->editColumn('profile_image', function ($row) {
            $images = json_decode($row->images);
            return (count($images)) ? '<a href="'.asset('uploads/venue-images/'.$images[0]).'" target="_blank"><img class="" width="50px" height="50px" src="'.asset('uploads/venue-images/'.$images[0]).'" alt="profile image"></a>' : '<img class="profile-img" src="'.asset('assets/img/no-img.jpg').'" alt="website logo image">';
        })

        ->addColumn('action', function ($row) {
            $btn = '';
            if (Helper::hasRight('venue.edit')) {
                $btn = $btn . '<a href="" data-id="'.$row->id.'" class="edit_btn btn btn-sm btn-primary mx-1"><i class="fa-solid fa-pencil"></i></a>';
            }
            if (Helper::hasRight('venue.delete')) {
                $btn = $btn . '<a class="delete_btn btn btn-sm btn-danger " data-id="'.$row->id.'" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>';
            }
            return $btn;
        })

        ->addColumn('website_link', function ($row) {
            $social_media_links = json_decode($row->social_media_links);
            if (isset($social_media_links->website_link)) {
                return $social_media_links->website_link;
            }
            return "";
        })
        ->rawColumns(['profile_image', 'action', 'website_link'])->make(true);

    }
    public function store(Request $request){
        if (!Helper::hasRight('venue.create')) {
            return response()->json([
                'type' => 'error',
                'message' => "You don't have rights to create venue.",
            ]);
        }

        $validator = $request->validate([
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:png,jpg,jpeg,gif,webp,heic',
		]);

        $address = new Address();

        $address->country = $request->country;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->street_address = $request->street_address;
        $address->zipcode = $request->zipcode;
        $address->latitude = $request->latitude;
        $address->longitude = $request->longitude;

        $address->save();

        $venue = new Venue();

        $venue->name = $request->name;
        $venue->email = $request->email;
        $venue->phone = $request->phone;

        $social_media_links = [
            'facebook_link' => $request->facebook_link,
            'instagram_link' => $request->instagram_link,
            'website_link' => $request->website_link,
        ];

        $venue->social_media_links = json_encode($social_media_links);

        $venue->address = $address->id;

        $imgUrls = [];

        if ($request->hasFile('images')) {
            $images = $request->file('images');

            foreach ($images as $image) {
                // Generate a unique filename
                $filename = time() . uniqid() . $image->getClientOriginalName();

                // Move the original image to the uploads directory
                $image->move(public_path('uploads/venue-images'), $filename);

                // Open the original image using Intervention Image
                $img = Image::make(public_path('uploads/venue-images') . '/' . $filename);

                // Resize the image to a maximum width and height
                $img->resize(800, 600, function ($constraint) {
                    $constraint->aspectRatio();
                });

                // Compress the image to a desired quality
                $img->encode('jpg', 80);

                // Save the resized and compressed image
                $img->save(public_path('uploads/venue-images') . '/' . $filename);
                $imgUrls[] = $filename;
            }
        }
        $venue->images = json_encode($imgUrls);

        if($venue->save()){
            return response()->json([
                'type' => 'success',
                'message' => 'Vanue created successfully.',
            ]);
        }else{
            return response()->json([
                'type' => 'error',
                'message' => 'Something went wrong.',
            ]);
        }
    }
    public function edit(Request $request)
    {
        $venue = Venue::find($request->id);
        $social_media_links = json_decode($venue->social_media_links);
        $venue->images = json_decode($venue->images);
        $address = Address::find($venue->address);
        $data = [
            'venue' => $venue,
            'social_media_links' => $social_media_links,
            'address' => $address,
        ];

        return view('backend.pages.venue.edit', $data);
    }
    public function update(Request $request){
        if (!Helper::hasRight('venue.edit')) {
            return response()->json([
                'type' => 'error',
                'message' => "You don't have rights to update venue.",
            ]);
        }
        $venue = Venue::find($request->id);
        $address = Address::find($venue->address);
        if ($address) {
            $address->delete();
        }

        $address = new Address();
        $address->country = $request->country;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->street_address = $request->street_address;
        $address->zipcode = $request->zipcode;
        $address->latitude = $request->latitude;
        $address->longitude = $request->longitude;

        $address->save();


        $venue->name = $request->name;
        $venue->email = $request->email;
        $venue->phone = $request->phone;

        $social_media_links = [
            'facebook_link' => $request->facebook_link,
            'instagram_link' => $request->instagram_link,
            'website_link' => $request->website_link,
        ];

        $venue->social_media_links = json_encode($social_media_links);

        $venue->address = $address->id;

        if($request->hasFile('images')) {

            $imgUrls = [];
            $venue->images = json_decode($venue->images);
            foreach ($venue->images as $value) {
                if ($value != Null && file_exists(public_path('uploads/venue-images/'.$value))) {
                    unlink(public_path('uploads/venue-images/'.$value));
                }
            }

            $images = $request->file('images');
            foreach ($images as $image) {
                $filename = time().uniqid().$image->getClientOriginalName();
                $image->move(public_path('uploads/venue-images'), $filename);
                $imgUrls[] = $filename;
            }
            $venue->images = json_encode($imgUrls);
        }

        if($venue->save()){
            return response()->json([
                'type' => 'success',
                'message' => 'Vanue updated successfully.',
            ]);
        }else{
            return response()->json([
                'type' => 'error',
                'message' => 'Something went wrong.',
            ]);
        }
    }
    public function delete(Request $request){
        if (!Helper::hasRight('venue.delete')) {
            return response()->json([
                'type' => 'error',
                'message' => "You don't have rights to delete venue.",
            ]);
        }
        $venue = Venue::find($request->id);

        if($venue){
            $events = Event::where('venue_id', $venue->id)->get();
            foreach($events as $event) {
                EventSponsor::where('event_id', $event->id)->delete();
                EventArtist::where('event_id', $event->id)->delete();
                MyFest::where('event_id', $event->id)->delete();
                $event->delete();
            }
            $address = Address::find($venue->address);
            if ($address) {
                $address->delete();
            }
            $venue->images = json_decode($venue->images);
            foreach ($venue->images as $value) {
                if ($value != Null && file_exists(public_path('uploads/venue-images/'.$value))) {
                    unlink(public_path('uploads/venue-images/'.$value));
                }
            }

            if ($venue->delete()) {
                return json_encode(['success' => 'Venue deleted successfully.']);
            }else{
                return redirect()->route('admin.venue')->with('error', 'Something went wrong.');
            }

        }else{
            return json_encode(['error' => 'Venue not found.']);
        }
    }
}
