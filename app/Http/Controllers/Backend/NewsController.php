<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DeviceToken;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Auth;
use Helper;
use App\Models\News;
use Illuminate\Support\Str;
use Session;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $this->user = Auth::user();

            if (!$this->user || Helper::hasRight('news.view') == false) {
                session()->flash('error', 'You can not access! Login first.');
                return redirect()->route('admin');
            }
            return $next($request);
        });
    }

    public function index(){
        $newss = News::all();
        return view('backend.pages.news.index', compact('newss'));
    }

    public function getList(Request $request){

        $data = News::query();

        if ($request->date) {
            $data->whereDate('publish_date', $request->date);
        }

        if (!empty($request->title)) {
            $data->where('title','like', "%" .$request->title ."%" );
        }

        if ($request->status) {
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

        ->editColumn('short_description', function ($row) {
            return Str::limit($row->short_description, 90, '...');
        })

        ->editColumn('status', function ($row) {
            if ($row->status == 1) {
                return '<span class="badge bg-primary w-100">Visible</span>';
            }else{
                return '<span class="badge bg-danger w-100">Hidden</span>';
            }
        })

        ->addColumn('action', function ($row) {
            $btn = '';
            if (Helper::hasRight('news.edit')) {
                $btn = $btn . '<a href="" data-id="'.$row->id.'" class="edit_btn btn btn-sm btn-primary "><i class="fa-solid fa-pencil"></i></a>';
            }
            if (Helper::hasRight('news.delete')) {
                $btn = $btn . '<a class="delete_btn btn btn-sm btn-danger mx-1" data-id="'.$row->id.'" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>';
            }
            return $btn;
        })
        ->rawColumns(['short_description','status','action'])->make(true);
    }

    public function store(Request $request){
        $validator = $request->validate([
			'title' => 'required',
			'publish_date' => 'required',
            'image' => 'nullable|image:png,jpg,jpeg,gif,webp,',
		]);

        $news = new News();
        $news->publish_date = $request->publish_date;
        $news->title = $request->title;
        $news->short_description = $request->short_description;
        $news->status = ($request->status) ? 1 : 0;
        $news->description = $request->descriptions;
        $news->url = $request->url;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().uniqid().$image->getClientOriginalName();
            $image->move(public_path('uploads/news-images'), $filename);
            $news->media = $filename;
        }
        if ($news->save()) {
            $title = $request->title;
            $body = $request->short_description;
            $tokens = DeviceToken::all();
            foreach ($tokens as $token) {
                Helper::sendPushNotification($token->token, $title, $body, $news->id, $news->media);
            }

            // language
            Helper::insertLanguage(News::class, $news->id, 'en', 'title', $news->title);
            Helper::insertLanguage(News::class, $news->id, 'en', 'short_description', $news->short_description);
            Helper::insertLanguage(News::class, $news->id, 'en', 'description', $news->description);

            return response()->json([
                'type' => 'success',
                'message' => 'News created successfully.',
                'news' => $news
            ]);
        }
    }

    public function edit($id){
        $news = News::find($id);
        return view('backend.pages.news.edit', compact('news'));
    }

    public function update(Request $request, $id){
        $validator = $request->validate([
			'title' => 'required',
			'publish_date' => 'required',
            'image' => 'nullable|image:png,jpg,jpeg,gif,webp,',
		]);

        $news = News::find($id);
        $news->publish_date = $request->publish_date;
        $news->title = $request->title;
        $news->short_description = $request->short_description;
        $news->description = $request->descriptions;
        $news->status = ($request->status) ? 1 : 0;
        $news->url = $request->url;
        if($request->hasFile('image')){
            if (file_exists(public_path('uploads/news-images/'.$news->media))) {
                unlink(public_path('uploads/news-images/'.$news->media));
            }
            $image = $request->file('image');
            $filename = time().uniqid().$image->getClientOriginalName();
            $image->move(public_path('uploads/news-images'), $filename);
            $news->media = $filename;
        }
        if ($news->save()) {

            // language
            Helper::insertLanguage(News::class, $news->id, Session::get('admin_language') ?? 'en', 'title', $request->title);
            Helper::insertLanguage(News::class, $news->id, Session::get('admin_language') ?? 'en', 'short_description', $request->short_description);
            Helper::insertLanguage(News::class, $news->id, Session::get('admin_language') ?? 'en', 'description', $request->descriptions);

            return response()->json([
                'type' => 'success',
                'message' => 'News updated successfully.',
            ]);
        }else{
            return response()->json([
                'type' => 'success',
                'message' => 'Something went wrong.',
            ]);
        }
    }

    public function delete($id){
        $news = News::find($id);
        if($news){
            if ($news->media != null && file_exists(public_path('uploads/news-images/'.$news->media))) {
                unlink(public_path('uploads/news-images/'.$news->media));
            }
            $news->delete();
            return json_encode(['success' => 'News deleted successfully.']);
        }else{
            return json_encode(['error' => 'News not found.']);
        }
    }
}
