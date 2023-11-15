<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Frontend\AboutController as FrontendAboutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\PostController as FrontendPostController;

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

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);


Route::get('/member', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::get('/', [FrontendController::class, 'index']);
    Route::get('/category', [FrontendController::class, 'categories']);
    Route::get('/category/{category_slug}', [FrontendController::class, 'products']);
    Route::get('/product/{product_slug}', [FrontendProductController::class, 'detail']);
    Route::get('/products', [FrontendProductController::class, 'index']);
    Route::get('/about', [FrontendAboutController::class, 'index']);
    Route::get('/contact', [FrontendController::class, 'contact']);
    Route::post('/contact_send', [ContactController::class, 'send']);
    Route::get('/news', [FrontendPostController::class, 'index']);
    Route::get('/news/{slug}', [FrontendPostController::class, 'show']);
});



// Cart
Route::get('add-to-cart/{id}', [FrontendProductController::class, 'addToCart'])->name('add.to.cart');

Route::middleware(['auth'])->group(function () {
    Route::get('cart', [FrontendProductController::class, 'cart'])->name('cart');
    Route::patch('update-cart', [FrontendProductController::class, 'update'])->name('update.cart');
    Route::delete('remove-from-cart', [FrontendProductController::class, 'remove'])->name('remove.from.cart');
    Route::get('checkout', [FrontendProductController::class, 'checkout'])->name('checkout');
});


Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index']);
    // Category Route
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/edit/{category}', 'edit');
        Route::get('/category/show/{category_id}', 'show');
        Route::post('/category/add_translate', 'add_translate');
        Route::put('/category/{category}', 'update');
    });
    Route::controller(PostController::class)->group(function () {
        Route::get('/posts', 'index');
        Route::get('/posts/create', 'create');
        Route::post('/posts', 'store');
        Route::get('/posts/edit/{post}', 'edit');
        Route::get('/posts/show/{post_id}', 'show');
        Route::post('/posts/add_translate', 'add_translate');
        Route::put('/posts/{post}', 'update');
        Route::get('/posts/delete/{post_id}', 'destroy');
    });
    // Brand Route
    Route::controller(BrandController::class)->group(function () {
        Route::get('/brands', 'index');
        Route::get('/brands/create', 'create');
        Route::post('/brands', 'store');
        Route::get('/brands/edit/{brand}', 'edit');
        Route::put('/brands/{brand}', 'update');
    });
    // vehicle Route
    Route::controller(VehicleController::class)->group(function () {
        Route::get('/vehicles', 'index');
        Route::get('/vehicles/create', 'create');
        Route::post('/vehicles', 'store');
        Route::get('/vehicles/edit/{vehicle}', 'edit');
        Route::put('/vehicles/{vehicle_id}', 'update');
        Route::get('/vehicles/delete/{vehicle_id}', 'destroy');
    });
    // Option Route
    Route::controller(OptionController::class)->group(function () {
        Route::get('/options', 'index');
        Route::get('/options/edit/{brand}', 'edit');
        Route::post('/options', 'update');
    });
    // About Route
    Route::controller(AboutController::class)->group(function () {
        Route::get('/abouts', 'index');
        Route::post('/abouts/add_translate/{translate_id}', 'add_translate');
        Route::get('/abouts/edit_translate/{translate_id}', 'edit_translate');
        Route::post('/abouts/update_translate/{translate_id}', 'update_translate');
        Route::post('/abouts', 'update');
    });
    // Menu Route
    Route::controller(MenuController::class)->group(function () {
        Route::get('/menus', 'index');
        Route::get('/menus/create', 'create');
        Route::post('/menus', 'store');
        Route::get('/menus/edit/{menu}', 'edit');
        Route::get('/menus/show/{menu_id}', 'show');
        Route::post('/menus/add_translate', 'add_translate');
        Route::put('/menus/{menu}', 'update');
        Route::get('/menus/delete/{menu_id}', 'destroy');
    });
    Route::controller(ProductionController::class)->group(function () {
        Route::get('/productions', 'index');
        Route::get('/productions/create', 'create');
        Route::post('/productions', 'store');
        Route::get('/productions/edit/{production}', 'edit');
        Route::put('/productions/{production}', 'update');
    });
    // Product Route
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index');
        Route::get('/products/create', 'create');
        Route::post('/products', 'store');
        Route::get('/products/edit/{product}', 'edit');
        Route::put('/products/{product_id}', 'update');
        Route::get('/product-image/delete/{product_image_id}', 'destroyImage');

        Route::get('/products/show/{product_id}', 'show');
        Route::post('/products/add_translate', 'add_translate');
        Route::get('/products/part/{product_id}', 'parts');
        Route::post('/products/add_part', 'add_part');
        Route::get('/products/delete/{product_id}', 'destroy');
    });
    // Sliders Route
    Route::controller(SliderController::class)->group(function () {
        Route::get('/sliders', 'index');
        Route::get('/sliders/create', 'create');
        Route::post('/sliders/create', 'store');
        Route::get('/sliders/edit/{slider}', 'edit');
        Route::put('/sliders/{slider}', 'update');
        Route::get('/sliders/delete/{slider}', 'destroy');
    });
});
