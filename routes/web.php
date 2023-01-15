<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Models\Listing;
use App\Models\Category;
use GuzzleHttp\Middleware;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    $listing = Listing::all();
    // $categories = Category::all();
    $data = compact('listing');
    view()->share('categories');
    return view('home')->with($data);
})->name('home');

Route::get('contact', function(){
   return view('contact');
});

Route::get('login', [AuthController::class, 'login'])->name('login')->middleware('guard');
Route::post('login', [AuthController::class, 'login_validate']);
Route::get('register', [AuthController::class, 'register'])->name('register')->middleware('guard');
Route::post('register', [AuthController::class, 'register_validate']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout')->middleware('dashboard_auth');

Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('dashboard_auth');

Route::get('properties', [ListingController::class, 'FrontPageListing']);
Route::post('properties', [ListingController::class, 'FrontPageListing'] );
Route::get('properties/{purpose}', [ListingController::class, 'FrontPageListing'] );
Route::get('properties/category/{category_id}', [ListingController::class, 'FrontPageListing'] );

Route::get('mylisting', [ListingController::class, 'myListing'])->middleware('dashboard_auth');
Route::post('mylisting', [ListingController::class, 'AddMyListing'])->middleware('dashboard_auth');
Route::get('mylisting/delete/{id}', [ListingController::class, 'DeleteMyListing'])->middleware('dashboard_auth');
Route::get('mylisting/edit/{id}', [ListingController::class, 'EditMyListing'])->middleware('dashboard_auth');
Route::post('mylisting/update/{id}', [ListingController::class, 'UpdateMyListing'])->middleware('dashboard_auth');

Route::get('profile', [AuthController::class, 'profile']);
Route::post('profile', [AuthController::class, 'updateProfile']);

Route::get('displayProperty/{id}', [ListingController::class, 'displayProperty']);

// Route::get('admin', [])

Route::group(['prefix' => 'admin'], function(){
    Route::get('/', [AdminAuthController::class, 'index'])->name('admin')->middleware('admin_auth');
    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::get('category', [CategoryController::class, 'index'])->name('admin.category')->middleware('admin_auth');
    Route::get('category/delete/{id}', [CategoryController::class, 'delete'])->middleware('admin_auth');
    Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->middleware('admin_auth');
    Route::post('category/update', [CategoryController::class, 'update'])->middleware('admin_auth');
    Route::post('category', [CategoryController::class, 'store']);

    Route::get('listing', [ListingController::class, 'index'])->name('admin.listing')->middleware('admin_auth');
    Route::get('listing/delete/{id}', [ListingController::class, 'delete'])->middleware('admin_auth');
    Route::get('listing/edit/{id}', [ListingController::class, 'edit'])->middleware('admin_auth');


    // Route::post('admin/listing/edit/validate', function(){
    //     echo "Working";
    //     die;
    // });


    Route::post('listing/update/', [ListingController::class, 'update'])->middleware('admin_auth');
    Route::post('listing', [ListingController::class, 'store']);

    Route::get('users', [UserController::class, 'index'])->name('admin.users')->middleware('admin_auth');
    Route::post('users', [UserController::class, 'store'])->name('admin.users')->middleware('admin_auth');
    Route::get('users/delete/{id}', [UserController::class, 'delete'])->middleware('admin_auth');
    Route::get('users/edit/{id}', [UserController::class, 'edit'])->middleware('admin_auth');
    Route::post('users/update', [UserController::class, 'update'])->middleware('admin_auth');

});




Route::post('admin/listing/edit/validate', [ListingController::class, 'editValidate'])->name('edit.validate');


Route::get('sessions', function(){
    echo '<pre>';
    print_r(session()->all());
});




// function userName($user_id){
//     $user = User::find($user_id);
//     return $user->name;
// }
// function categoryName($cate_id){
//     $category = Category::find($cate_id);
//     return $category->category_name;
// }

