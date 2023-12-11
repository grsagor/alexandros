<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Role;
use App\Models\Company;
use App\Models\Cart;

use Hash;

use Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:user',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if ($user->save()) {
            return redirect()->back()->with('message', 'Your registration successfully complete!');
        } else {
            return redirect()->back()->withErrors(['error' => 'Something went wrong.']);
        }
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->email)->first();

        if ($user && $user->status == 1) {
            if (Auth::attempt($credentials)) {
                if (Session::get('session_id') != null) {
                    $carts = Helper::getCart();
                    if ($carts) {
                        foreach ($carts as $item) {
                            $cart = Cart::find($item->id);
                            $cart->user_id = Auth::user()->id;
                            $cart->session_id = '';
                            $cart->save();
                        }
                        Session::put('user_id', Auth::user()->id);
                        Session::forget('session_id');
                    }
                }
                // Authentication passed...
                $authUser = Auth()->user()->role;

                if ($authUser == 1) {
                    return redirect()->route('admin.index');
                } else {
                    return redirect()->route('home');
                }
            } else {
                return redirect()->back()->withErrors(['error' => 'Invalid credentials.']);
            }
        } else {
            return redirect()->back()->withErrors(['error' => 'Your account is not active yet!.']);
        }

    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('admin');
    }
}
