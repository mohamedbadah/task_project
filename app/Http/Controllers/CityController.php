<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = City::all();
        return view('cms.cities.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:30'
        ], [
            'name.required' => 'the name is city is error'
        ]);
        $city = new City();
        $city->name = $request->name;
        $isSaved = $city->save();
        if ($isSaved) {
            session()->flash('message', 'city created at succuffky');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return "Hello mohamed";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = City::find($id);
        return view('cms.cities.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $request->validate(
            [
                'name' => "required|string|min:3|max:30"
            ],
            ['name.required' => 'the name is city is error']
        );
        $city->name = $request->name;
        $isSaved = $city->save();
        if ($isSaved) {
            session()->flash('massege', 'the city is update succufful');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        // $isDelete = $city->delete();
        // return redirect()->back();
        $isDelete = $city->delete();
        if ($isDelete) {
            return response()->json([
                'title' => 'success',
                'text' => 'city deleted successfull',
                'icon' => 'success'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'title' => 'Faild',
                'text' => 'city is not deleted',
                'icon' => 'error'
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
