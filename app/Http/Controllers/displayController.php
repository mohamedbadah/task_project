<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class displayController extends Controller
{
    public function index()
    {

        // return response()->json(['categories' => $categories]);
        return view('cms.display');
    }
    public function display()
    {
        $categories = Category::all();
        return response()->json(['categories' => $categories], Response::HTTP_OK);
        // return view('cms.display', compact('categories'));
    }
}
