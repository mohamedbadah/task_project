<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    public function index()
    {
        $data = Admin::where('id', '!=', auth('admin')->id())->get();
        return view('cms.admins.index', compact('data'));
    }
    public function create()
    {
        return view('cms.admins.create');
    }
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'phone' => 'required',
            'password' => 'required'
        ], [
            'required.name' => 'الاسم فارغ'
        ]);
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->password = Hash::make($request->password);
        Mail::to($admin->email)->send(new WelcomeEmail($admin));
        $saved = $admin->save();
        if ($saved) {
            return response()->json(['message' => 'the sucesss'], Response::HTTP_OK);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }
    // public function check(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email|exists:admins,email',
    //         'password' => 'required|min:5|max:30'
    //     ], [
    //         'email.exists' => 'the email is not found table '
    //     ]);
    //     $creds = $request->only('email', 'password');
    //     if (Auth::guard('admin')->attempt($creds)) {
    //         return redirect()->route('admin.home');
    //     } else {
    //         return redirect()->route('admin.login')->with('fail', 'the data incorrect creadtional');
    //     }
    // }
    // public function logout()
    // {
    //     Auth::guard('admin')->logout();
    //     return redirect('/cms/admin/login');
    // }
    public function updateProfile(Request $request, $id)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:30',
            'email' => 'required|email'
        ]);
        $admin = Admin::find($id);
        if (!$validator->fails()) {
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->phone = $request->phone;
            // $admin->password = auth('admin')->user()->password;
            $isUpdate = $admin->save();
            return response()->json(['message' => $isUpdate ? 'sucess' : 'failed'], Response::HTTP_OK);
        } else {
            return response()->json(['message' => $validator->getMessageBag()], Response::HTTP_BAD_REQUEST);
        }
    }
}
