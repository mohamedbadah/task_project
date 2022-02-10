<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function showLogin($guard)
    {
        return view('cms/login', ['guard' => $guard]);
    }
    // public function login(Request $request)
    // {
    //     $validator = Validator($request->all(), [
    //         'email' => 'required|email|exists:admins',
    //         'password' => 'required|string|max:30|min:3'
    //     ]);
    //     if (!$validator->fails()) {
    //         $creds = ['email' => $request->email, 'password' => $request->password];
    //         if (Auth::guard('admin')->attempt($creds, $request->remember)) {
    //             return response()->json(['message' => 'the login is successful'], Response::HTTP_OK);
    //         } else {
    //             return response()->json(['message' => 'faild'], Response::HTTP_BAD_REQUEST);
    //         }
    //     } else {
    //         return response()->json(['message' => $validator->getMessageBag()], Response::HTTP_BAD_REQUEST);
    //     }
    // }
    //  copy login
    public function login(Request $request)
    {
        $validator = Validator(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required|string|max:30|min:3',
                'guard' => 'required|string|in:admin,user'
            ],
            [
                'guard.in' => "البريد الالكتروني غير صيحيح أو كلمة السر غير صحيحة"
            ]
        );
        if (!$validator->fails()) {
            $creds = ['email' => $request->email, 'password' => $request->password];
            if (Auth::guard($request->guard)->attempt($creds, $request->remember)) {
                return response()->json(['message' => 'the login is successful'], Response::HTTP_OK);
            } else {
                return response()->json(['message' => 'faild'], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()], Response::HTTP_BAD_REQUEST);
        }
    }
    public function logout(Request $request)
    {
        // auth('admin')->logout();
        // $request->session()->invalidate();
        // return redirect()->route('login');
        $guard = auth('admin')->check() ? 'admin' : 'user';
        auth($guard)->logout();
        return redirect()->route('login', $guard);
    }
    public function changePass()
    {
        return view('cms.auth.edit');
    }
    public function updatePass(Request $request)
    {
        $guard = auth('admin')->check() ? 'admin' : 'user';
        $validator = Validator(
            $request->all(),
            [
                'current_password' => "required|string|password:$guard",
                'new_password' => 'required|string|min:3|max:30|confirmed',
            ]
        );
        if (!$validator->fails()) {
            $user = auth($guard)->user();
            $user->password = Hash::make($request->new_password);
            $isSaved = $user->save();
            return response()->json(['message' => $isSaved ? 'message successfully' : 'faild'], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }
    public function editProfile()
    {
        $view = auth('admin')->check() ? 'cms.admins.edit' : 'cms.users.edit';
        $guard = auth('admin')->check() ? 'admin' : 'user';
        return view($view, [$guard => auth($guard)->user(), 'redirect' => false]);
    }
}
