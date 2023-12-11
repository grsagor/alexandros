<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Helper;
use Session;
use App\Models\User;
use App\Models\Order;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $this->user = Auth::user();

            if (!$this->user || Helper::hasRight('dashboard.view') !=  true) {
                Auth::logout();
                $request->session()->invalidate();
                session()->flash('error', 'You can not access! Login first.');
                // return redirect()->route('admin.index');
            }
            return $next($request);
        });
    }

    public function index(){   
        return view('backend.pages.dashboard');
    }
}
