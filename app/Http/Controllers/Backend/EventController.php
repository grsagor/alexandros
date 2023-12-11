<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventArtist;
use App\Models\EventSponsor;
use App\Models\MyFest;
use App\Models\User;
use App\Models\Venue;
use Helper;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EventController extends Controller
{
    public function index()
    {
        $artists = User::where('role','6')->get();
        $sponsors = User::where('role','7')->get();
        $venues = Venue::all();
        $data = [
            'artists' => $artists,
            'sponsors' => $sponsors,
            'venues' => $venues,
        ];
        return view('backend.pages.event.index', $data);
    }

    public function getList()
    {
        $data = Event::all();

        return DataTables::of($data)

            ->editColumn('profile_image', function ($row) {
                $images = json_decode($row->banner);
                return (count($images)) ? '<a href="'.asset('uploads/event-images/'.$images[0]).'" target="_blank"><img class="" width="50px" height="50px" src="'.asset('uploads/event-images/'.$images[0]).'" alt="profile image"></a>' : '<img class="profile-img" src="'.asset('assets/img/no-img.jpg').'" alt="website logo image">';
            })

            ->editColumn('type_of_event', function($row) {
                $html = '';
                if ($row->type_of_event == 'golder_guiter') {
                    $html = $html . '<span class="text-center badge bg-success">Golden Guitar</span>';
                } else {
                    $html = $html . '<span class="text-center badge bg-warning text-dark">Normal</span>';
                }
                return $html;
            })

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
            ->rawColumns(['type_of_event', 'profile_image', 'action'])->make(true);
    }
    public function store(Request $request)
    {
        if (!Helper::hasRight('event.create')) {
            return response()->json([
                'type' => 'error',
                'message' => "You don't have rights to create event.",
            ]);
        }
        $requestData = $request->all();
        $rules = [
            'sponsor_id' => 'required',
            'description' => 'required',
            'start_datetime' => 'required',
            'end_datetime' => 'required',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:png,jpg,jpeg,gif,webp',
        ];

        if ($requestData['type_of_event'] === 'golder_guiter') {
            $rules['title'] = 'required';
            unset($rules['artist_id']);
        }
        if ($requestData['type_of_event'] === 'regular') {
            $rules['artist_id'] = 'required';
            unset($rules['title']);
        }

        $validator = $request->validate($rules);

        if ($request->type_of_event == 'golder_guiter') {
            Event::where('type_of_event', 'golder_guiter')->update(['type_of_event' => 'regular']);
        }

        $event = new Event();

        $imgUrls = [];
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                $filename = time() . uniqid() . $image->getClientOriginalName();
                $image->move(public_path('uploads/event-images'), $filename);
                $imgUrls[] = $filename;
            }
        }
        $requestData['banner'] = json_encode($imgUrls);

        $requestData['status']  = ($request->status) ? 1 : 0;
        $requestData['is_free']  = ($request->is_free) ? 1 : 0;

        $social_media_links = [
            'facebook_link' => $request->facebook_link,
            'spotify_link' => $request->spotify_link,
            'itunes_link' => $request->itunes_link,
            'youtube_link' => $request->youtube_link,
            'instagram_link' => $request->instagram_link,
            'sponsor_link' => $request->sponsor_link
        ];
        $requestData["social_media_links"] = json_encode($social_media_links);

        $event->fill($requestData)->save();

        if (!empty($request->sponsor_id)) {
            foreach ($request->sponsor_id as $key => $value) {
                $event_sponsor = new EventSponsor();

                $event_sponsor->event_id = $event->id;
                $event_sponsor->sponsor_id = $value;
                $event_sponsor->amount = $request->sponsor_amount[$key];

                $event_sponsor->save();
            }
        }

        if (!empty($request->artist_id)) {
            foreach ($request->artist_id as $key => $value) {
                $event_artist = new EventArtist();

                $event_artist->event_id = $event->id;
                $event_artist->artist_id = $value;

                $event_artist->save();
            }
        }


        if ($event->save()) {
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
        $event = Event::find($request->id);
        $event->banner = json_decode($event->banner);
        $social_media_links = json_decode($event->social_media_links);
        $event_artists = EventArtist::where('event_id', $event->id)->get();
        $event_sponsors = EventSponsor::where('event_id', $event->id)->get();
        $artists = User::where('role','6')->get();
        $sponsors = User::where('role','7')->get();        $venues = Venue::all();
        $data = [
            'artists' => $artists,
            'sponsors' => $sponsors,
            'venues' => $venues,
            'event' => $event,
            'event_artists' => $event_artists,
            'event_sponsors' => $event_sponsors,
            'social_media_links' => $social_media_links,
        ];

        return view('backend.pages.event.edit', $data);
    }
    public function update(Request $request)
    {
        if (!Helper::hasRight('event.edit')) {
            return response()->json([
                'type' => 'error',
                'message' => "You don't have rights to update event.",
            ]);
        }
        $requestData = $request->all();
        $rules = [
            'sponsor_id' => 'required',
            'description' => 'required',
            'start_datetime' => 'required',
            'end_datetime' => 'required',
        ];

        if ($requestData['type_of_event'] === 'golder_guiter') {
            $rules['title'] = 'required';
            unset($rules['artist_id']);
        }
        if ($requestData['type_of_event'] === 'regular') {
            $rules['artist_id'] = 'required';
            unset($rules['title']);
        }

        $validator = $request->validate($rules);
        if ($request->type_of_event == 'golder_guiter') {
            Event::where('type_of_event', 'golder_guiter')->update(['type_of_event' => 'regular']);
        }
        $event = Event::find($request->id);

        $requestData = $request->all();
        $banners = json_decode($event->banner);

        if ($request->hasFile('images')) {
            $imgUrls = [];
            foreach ($banners as $value) {
                if ($value != Null && file_exists(public_path('uploads/event-images/' . $value))) {
                    unlink(public_path('uploads/event-images/' . $value));
                }
            }

            $images = $request->file('images');
            foreach ($images as $image) {
                $filename = time() . uniqid() . $image->getClientOriginalName();
                $image->move(public_path('uploads/event-images'), $filename);
                $imgUrls[] = $filename;
            }
            $requestData['banner'] = json_encode($imgUrls);
        }

        $requestData['status']  = ($request->status) ? 1 : 0;
        $requestData['is_free']  = ($request->is_free) ? 1 : 0;

        $social_media_links = [
            'facebook_link' => $request->facebook_link,
            'spotify_link' => $request->spotify_link,
            'itunes_link' => $request->itunes_link,
            'youtube_link' => $request->youtube_link,
            'instagram_link' => $request->instagram_link,
            'sponsor_link' => $request->sponsor_link
        ];
        $requestData["social_media_links"] = json_encode($social_media_links);

        $event->fill($requestData)->save();

        EventSponsor::where('event_id', $event->id)->delete();
        EventArtist::where('event_id', $event->id)->delete();

        if (!empty($request->sponsor_id)) {
            foreach ($request->sponsor_id as $key => $value) {
                $event_sponsor = new EventSponsor();

                $event_sponsor->event_id = $event->id;
                $event_sponsor->sponsor_id = $value;
                $event_sponsor->amount = $request->sponsor_amount[$key];

                $event_sponsor->save();
            }
        }

        if (!empty($request->artist_id)) {
            foreach ($request->artist_id as $key => $value) {
                $event_artist = new EventArtist();

                $event_artist->event_id = $event->id;
                $event_artist->artist_id = $value;

                $event_artist->save();
            }
        }

        if ($event->save()) {
            return response()->json([
                'type' => 'success',
                'message' => 'Event updated successfully.',
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
        if (!Helper::hasRight('event.delete')) {
            return response()->json([
                'type' => 'error',
                'message' => "You don't have rights to delete event.",
            ]);
        }

        $event = Event::find($request->id);
        if ($event) {
            $banners = json_decode($event->banner);
            foreach ($banners as $value) {
                if ($value != Null && file_exists(public_path('uploads/event-images/' . $value))) {
                    unlink(public_path('uploads/event-images/' . $value));
                }
            }

            EventSponsor::where('event_id', $event->id)->delete();
            EventArtist::where('event_id', $event->id)->delete();
            MyFest::where('event_id', $event->id)->delete();

            if ($event->delete()) {
                return response()->json([
                    'type' => 'success',
                    'message' => 'Event deleted successfully.',
                ]);
            } else {
                return redirect()->route('admin.event')->with('error', 'Something went wrong.');
            }
        } else {
            return json_encode(['error' => 'Event not found.']);
        }
    }
}
