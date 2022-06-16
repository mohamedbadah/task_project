<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index()
    {
        $user = Admin::withCount('permissions')->get();
        return view('cms.user.index', ['users' => $user]);
    }
    public function create()
    {
        return view('cms.user.create');
    }
    public function store(Request $request)
    {
        $validator = Validator(
            $request->all(),
            [
                'name' => 'required|string',
                'email' => 'required|unique:users,email',
                'password' => 'required|string|min:4|max:30',
                'Cpassword' => 'required|string|min:4|max:30|same:password'
            ],
            [
                'email.unique' => 'استخدم كلمة أقوى للايميل'
            ]
        );
        if (!$validator->fails()) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $isSaved = $user->save();
            return response()->json(['message' => $isSaved ? 'success' : 'faild'], Response::HTTP_OK);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }
}
