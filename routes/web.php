<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;
// Admin controller
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChildrenController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginGoogleController;
use App\Http\Controllers\ManController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WomenController;
use App\http\Controllers\CollectionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Đăng nhập
// Route::get('/', [IndexController::class, 'login'])->name('loginpage');
// Trang chính
Route::get('/trangchu', [IndexController::class, 'home'])->name('homepage');
Route::post('/trangchu', [IndexController::class, 'home'])->name('homepage');
// Trang category
Route::get('/danhmuc/{slug}', [IndexController::class, 'category'])->name('category');
// Trang bộ sưu tập
Route::get('/bst/{slug}', [IndexController::class, 'collection'])->name('collection');
Route::get('/allbst', [IndexController::class, 'allcollection'])->name('allcollection'); 
// Trang brand
Route::get('/donam/{slug}', [IndexController::class, 'man'])->name('man');
Route::get('/allman', [IndexController::class, 'allman'])->name('allman');
Route::get('/donu/{slug}', [IndexController::class, 'women'])->name('women');
Route::get('/allwomen', [IndexController::class, 'allwomen'])->name('allwomen');
Route::get('/treem/{slug}', [IndexController::class, 'children'])->name('children');
Route::get('/allChild', [IndexController::class, 'allChild'])->name('allChild');
// Trang product
Route::get('/sanpham/{slug}', [IndexController::class, 'product'])->name('product');
// Trang cart
Route::get('/giohang', [IndexController::class, 'cart'])->name('cart');
Route::get('/add_cart', [IndexController::class, 'cart_add'])->name('cart_add');
Route::get('/delete_cart/{id}', [IndexController::class, 'cart_delete'])->name('cart_delete');
Route::post('/update_cart', [IndexController::class, 'cart_update'])->name('cart_update');
// Trang buy
Route::post('/muahang', [IndexController::class, 'order'])->name('order');
// Trang searrch
Route::get('/tim-kiem', [IndexController::class, 'timkiem'])->name('tim-kiem');
// Trang đánh giá
Route::post('/add-rating', [IndexController::class, 'add_rating'])->name('add-rating');



//Gửi email


Auth::routes();



//đăng nhập gg
// Route::get('auth/google', [LoginGoogleController::class, 'redirectToGoogle'])->name('login-by-google');
// Route::get('auth/google/callback', [LoginGoogleController::class, 'handleGoogleCallback']);
// Route::get('logout-home', [LoginGoogleController::class, 'logout_home'])->name('logout-home');

// route admin
// Route::group(['middleware' => ['auth']], function () {
    
    
// });

Route::resource('category', CategoryController::class);
    Route::post('resorting', [CategoryController::class, 'resorting'])->name('resorting');
    Route::resource('collection', CollectionController::class);
    Route::resource('children', ChildrenController::class);
    Route::resource('man', ManController::class);
    Route::resource('women', WomenController::class);
    Route::resource('product', ProductController::class);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/impersonate/user/{id}', [UserController::class, 'impersonate']);


// Route::group(['middleware' => ['auth','role:admin']], function () {
   
    

// });
    Route::get('/thong-ke', [IndexController::class, 'thong_ke'])->name('thong-ke');
    Route::post('/filter-by-date', [IndexController::class, 'filter_by_date']);
    Route::post('/dashboard-filter', [IndexController::class, 'dashboard_filter']);
    Route::post('/days-order', [IndexController::class, 'days_order']);

    //Đơn hàng
    Route::resource('order', OrderController::class);
    Route::get('/admin/order/{order_detail}', [OrderController::class, 'order_detail'])->name('order_detail');
    Route::get('/accept-order/{order}/{token}/{order_detail}', [IndexController::class, 'accept_order'])->name('accept');

    // Authentication roles
    // Route::get('/register-auth', [AuthController::class, 'register_auth']);

    Route::resource('/user', UserController::class);
    Route::get('/phan-vaitro/{id}', [UserController::class, 'phanvaitro']);
    Route::get('/phan-quyen/{id}', [UserController::class, 'phanquyen']);
    Route::post('/insert_roles/{id}', [UserController::class, 'insert_roles']);
    Route::post('/insert_permission/{id}', [UserController::class, 'insert_permission']);




