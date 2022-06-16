<?php

use App\Mail\WelcomeEmail;
use App\Http\Middleware\AgeCheck;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermission;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\displayController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PermissionUserController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserPermissionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//middleware
// Route::get('admin', function () {
//     echo "Hello mohamed";
// })->middleware('age:16');
// Route::prefix('cms')->middleware('age')->group(function () {
//     Route::get('a1', function () {
//         return view('cms.login');
//     });
//     Route::get('a2', function () {
//         // return view('cms.login');
//         // echo "hello mohamed";
//         return view('cms.login');
//     })->withoutMiddleware('age');
// });
Route::get('/h', function () {
    echo "hello mohamed";
})->middleware('age:13');
//مهم
// Route::prefix('cms/admin')->middleware(['guest:admin'])->group(function () {
//     Route::get('login', [AuthController::class, 'showLogin'])->name('login');
//     Route::post('login', [AuthController::class, 'login']);
// });
// Route::prefix('cms/admin')->name('admin.')->middleware('auth:admin')->group(function () {
//     Route::get('/', function () {
//         return view('cms.demo');
//     })->name('home');
//     Route::resource('cities', CityController::class);
//     Route::resource('categories', CategoryController::class);
//     Route::get('logout', [AuthController::class, 'logout'])->name('logout');
//     // Route::resource('admins', AdminController::class);
// });
//copy مهم
$guard = " ";
Route::prefix('cms')->middleware(["guest:admin,user"])->group(function () {
    Route::get('{guard}/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});
Route::prefix('cms/')->name('admin.')->middleware(["auth:admin,user"])->group(function () {
    Route::get('admin', function () {
        return view('cms.demo');
    })->name('home');
    Route::resource('categories', CategoryController::class);
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('change-password', [AuthController::class, 'changePass'])->name('changePass');
    Route::put('change_password', [AuthController::class, 'updatePass']);
    Route::get('edit-profile', [AuthController::class, 'editProfile'])->name('edit-profile');
    Route::put('edit-profile/{id}', [AdminController::class, 'updateProfile']);
    // Route::resource('admins', AdminController::class);
});
Route::prefix('cms/admin')->middleware('auth:admin')->group(function () {
    Route::resource('permission', PermissionController::class);
    Route::resource('cities', CityController::class);
    Route::resource('role', RoleController::class);
    Route::resource('roles.permissions', RolePermission::class)->except(['index']);
    Route::resource('user.prmission', UserPermissionController::class)->except(['index']);
    Route::get('cms/admin/roles/{role}/permissions', [RolePermission::class, 'indexes'])->name('roles.permissions.index');
    Route::get('cms/admin/user/{user}/prmission', [UserPermissionController::class, 'indexes'])->name('user.permission.index');
    // Route::resource('roles.permissions', RolePermissionController::class);
    Route::get('index-user', [UserController::class, 'index'])->name('user');
    Route::get('index-create', [UserController::class, 'create'])->name('createUser');
    Route::post('index-create', [UserController::class, 'store']);
    Route::get('/index', [AdminController::class, 'index'])->name('admin');
    Route::get('/create', [AdminController::class, 'create'])->name('create');
    Route::post('/create', [AdminController::class, 'store'])->name('store');
});
// multi authunticate
// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::middleware(['guest:admin'])->group(function () {
//         Route::view('/login', 'cms.admins.login')->name('login');
//         Route::post('check', [AdminController::class, 'check'])->name('check');
//     });
//     Route::middleware(['auth:admin'])->group(function () {
//         Route::view('/home', 'cms.demo')->name('home');
//         Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
//         Route::resource('cities', CityController::class);
//         Route::resource('categories', CategoryController::class);
//         Route::get('/index', [AdminController::class, 'index']);
//         Route::get('/create', [AdminController::class, 'create'])->name('create');
//     });
// });

Route::get('/demo', function () {
    return view('cms.demo');
});
Route::get('hello', function () {
    echo "hello mohamed badah";
});
// Route::get('testemail', function () {
//     return new WelcomeEmail();
// });
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('index', [displayController::class, 'index']);
Route::get('display', [displayController::class, 'display']);
