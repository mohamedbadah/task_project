<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Models\User;
use App\Models\Image;
use App\Models\Oreder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\sub_categories;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/welcome', function () {
    return response()->json([
        'message' => 'hello mohamed'
    ]);
});
Route::get('larvel_8', function () {
    // $data = Product::all();
    // $f = [];
    // foreach ($data as $d) {
    //     $s = $d->name;
    //     array_push($f, $s);
    // }
    // return response()->json([
    //     'data' => $data
    // ]);
    // $data = Product::max('price');
    // $data = Product::min('price');
    // $data = Product::avg('price');
    // $data = Product::sum('price');
    // $data = Product::where('name', 'like', 'b%')->count();
    // $data = Product::all()->take(10);
    // $data = Product::all()->skip(10)->take(20);
    // $data = Product::take(10)->skip(10)->get();
    // $data = Product::skip(10)->take(10)->get();
    // $data = Product::all()->skip(10);
    /*$data = Product::all()->take(10)->skip(10);*/ //error
    /*$data = Product::limit(10)->get();*/ //such as take(10)
    $data = Product::offset(10)->limit(10)->get();
    /*$data = Product::all()->limit(10);*/ //error because limit is sql only doesnt EQ
    return response()->json([
        'data' => $data
    ]);
});
Route::get('/foregin', function () {
    // $data = Category::findOrFail(2);
    $data = Category::with('subCategory')->findOrFail(1);
    // $data = Category::withCount('subCategory')->findOrFail(2);
    // $data = Category::with(['subCategory' => function ($query) {
    //     $query->where('title', 'like', 'a%');
    // }])->get();
    // $data = Category::with(['subCategory' => function ($query) {
    //     $query->where('title', 'like', 'b%');
    // }])->findOrFail(1);
    // $data = Category::withCount(['subCategory' => function ($query) {
    //     $query->where('title', 'like', '%o%');
    // }])->get();
    // $data = Category::with('subCategory.products')->get();
    // $data = Product::all();
    // $data = User::has('orders', '>', 2)->get();
    // $data = User::withCount('orders')->has('orders', '>', '5')->get();
    // $data = User::with('orders')->whereHas('orders', function ($query) {
    //     $query->where('total', '>', 300);
    // }, '>', 3)->get();
    // $data = User::with('orders')->has('orders', '>', 3, 'or', function ($query) {
    //     $query->where('total', '>', 300);
    // })->get();

    // $data = User::with('orders')->findOrFail(3);
    // $data = User::whereHas('orders', function ($query) {
    //     $query->where('total', '>', 300);
    // })->with('orders', function ($query) {
    //     $query->where('total', '>', 300);
    // })->get();
    // $data = User::doesntHave('orders')->get();
    // $data = User::whereDoesntHave('orders', function ($query) {
    //     $query->where('total', '<', 200);
    // })->get();
    // $data = Oreder::with('orderDetails.products')->findOrFail(7);
    // $data = Oreder::findOrFail(7)->orderDetails;
    // $data = Oreder::findOrFail(7)->orderDetails()->with('products')->get();
    // $data = Oreder::findOrFail(17)->products;
    // $data = Product::findOrFail(7)->orders;
    // $data = Product::with('orders')->findOrFail(7);
    $data = Product::where('price', '=', 509)->exists();
    // $data = Product::count();
    // $data = Product::where('price', '=', 509)->count() > 0;
    // $data = Product::where('price', '=', 509)->doesntExist();
    // $data = Product::where('price', '=', 509)->count() === 0;
    // $data = Product::findOrFail(6)->productInformation;
    // $data = Product::with('productInformation')->findOrFail(6);
    // $data = Category::with('subCategory.products')->findOrFail(1);
    // $data = Category::findOrFail(1)->subCategory()->with('products')->get();
    // $data = Category::findOrFail(1)->products;
    //اثبات
    // $data = sub_categories::findOrFail(3)->products;
    // $data = User::with('images')->findOrFail(1);
    // $product = Product::all();
    // // $data = Image::findOrFail(1);
    // $datas = Category::findOrFail(1);
    // $data = $datas->products;
    return response()->json([
        'data' => $data
    ]);
});
Route::prefix('auth')->group(function () {
    Route::post('login', [ApiAuthController::class, 'login']);
    Route::post('forget_password', [ApiAuthController::class, 'forgetPasword']);
    Route::post('reset_password', [ApiAuthController::class, 'reset_password']);
});
Route::prefix('auth')->middleware('auth:api')->group(function () {
    Route::get('logout', [ApiAuthController::class, 'logout']);
});
Route::middleware('auth:api')->group(function () {
    Route::apiResource('category', CategoryController::class);
});
