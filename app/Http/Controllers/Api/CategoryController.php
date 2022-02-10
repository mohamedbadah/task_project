<?php

namespace App\Http\Controllers\Api;

use App\Models\Oreder;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $order = Oreder::where('users_id', auth('api')->user()->id)->get();
        $order = auth('api')->user()->orders;
        return response()->json(['message' => 'sucess', 'data' => $order]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validator = Validator($request->all(), [
        //     'payment_txp' => 'in:bar,foo',
        //     'status' => 'in:active,disable',
        //     'total_couble' => 'required'
        // ]);
        // if (!$validator->fails()) {
        //     $order = new Oreder();
        //     $order->payment_txp     = $request->get('payment_txp');
        //     $order->status = $request->get('status');
        //     $order->total_couble = $request->get('total_couble');
        //     $order->total = '142';
        //     $order->users_id = auth('api')->user()->id;
        //     $isSaved = $order->save();
        //     return response()->json(
        //         ['message' => $isSaved ? 'sucess is login' : 'faild login'],
        //         $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
        //     );
        // } else {
        //     return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        // }
        return $this->createOrupdate($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $validator = Validator($request->all(), [
        //     'payment_txp' => 'in:bar,foo',
        //     'status' => 'in:active,disable',
        //     'total_couble' => 'required',
        //     'total' => 'required'
        // ]);
        // if (!$validator->fails()) {
        //     $order = Oreder::findOrFail($id);
        //     $order->payment_txp     = $request->get('payment_txp');
        //     $order->status = $request->get('status');
        //     $order->total_couble = $request->get('total_couble');
        //     $order->total = $request->total;
        //     $order->users_id = auth('api')->user()->id;
        //     $isSaved = $order->save();
        //     return response()->json(
        //         ['message' => $isSaved ? 'sucess is update' : 'faild update'],
        //         $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
        //     );
        // } else {
        //     return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        // }
        return $this->createOrupdate($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Oreder::find($id);
        $delete = $order->delete();
        if ($delete) {
            return response()->json(['message' => 'sucess delete'], Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'faild delete'], Response::HTTP_BAD_REQUEST);
        }
    }
    private function createOrupdate(Request $request, $id = null)
    {
        $validator = Validator($request->all(), [
            'payment_txp' => 'in:bar,foo',
            'status' => 'in:active,disable',
            'total_couble' => 'required'
        ]);
        if (!$validator->fails()) {
            $order = $id == null ? new Oreder() : Oreder::findOrFail($id);
            $isSuccess = $id == null ? Response::HTTP_CREATED : Response::HTTP_OK;
            $order->payment_txp     = $request->get('payment_txp');
            $order->status = $request->get('status');
            $order->total_couble = $request->get('total_couble');
            $order->total = '142';
            $order->users_id = auth('api')->user()->id;
            $isSaved = $order->save();
            return response()->json(
                ['message' => $isSaved ? 'sucess is login' : 'faild login'],
                $isSaved ? $isSuccess : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }
}
