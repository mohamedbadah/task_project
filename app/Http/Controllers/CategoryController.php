<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::all();
        return view('cms.categories.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:30',
            'active' => 'required|boolean',
            'image' => 'required|image|max:2048|mimes:png,jpg'
        ]);
        if (!$validator->fails()) {
            $category = new Category();
            $category->name = $request->name;
            $category->active = $request->active;
            // $image = $request->file('image');
            // $imageName = rand(1000, 1000000000) . '_category' . '.' . $image->getClientOriginalExtension();
            // $image->move(public_path('images'), $imageName);
            // // $image->storeAs('image', $imageName, ['disk' => 'public']);
            // $category->image = $imageName;
            $ex = $request->file('image')->getClientOriginalExtension();
            $new_name = 'category_' . time() . '_' . $ex;
            $request->file('image')->move(public_path('upload'), $new_name);
            $category->image = $new_name;
            $isSaved = $category->save();
            return response()->json([
                'message' => $isSaved ? "saved success" : "Faild"
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('cms.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:30',
            'image' => 'required|image|max:2048|mimes:png,jpg',
            'active' => 'required|boolean'
        ]);
        if (!$validator->fails()) {
            $category->name = $request->name;
            $category->active = $request->active;
            $image = $request->file('image');
            $imageName = rand(1000, 1000000000) . '_category' . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            // $image->storeAs('image', $imageName, ['disk' => 'public']);
            $category->image = $imageName;
            $isUpdate = $category->save();
            return response()->json([
                'message' => $isUpdate ? "update is succfully" : "faild is update"
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // $category = new Category();
        $isDeleted = $category->delete();
        if ($isDeleted) {
            return response()->json([
                'icon' => 'success', 'title' => 'deleted', 'text' => 'successfully deleted'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'icon' => 'error', 'title' => 'faild', 'text' => 'faild deleted'
            ], Response::HTTP_BAD_REQUEST);
        }
        // $category = Category::findOrFail($id);
        // $isDeleted = $category->delete();
        // echo $isDeleted ? "success" : "fail";
    }
}
