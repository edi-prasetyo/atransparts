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
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\MenuAdminController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductBrandController;
use App\Http\Controllers\Admin\ProductionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductNumberController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Frontend\AboutController as FrontendAboutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\PostController as FrontendPostController;
use App\Models\Role;
use Illuminate\Http\Request;

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





Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [
            'web',
            'localeSessionRedirect',
            'localizationRedirect',
        ]
    ],
    function () {
        Auth::routes([
            'register' => false,
            'reset' => false,
            'verify' => false,
        ]);
        Route::get('/customers/autocomplete', [CustomerController::class, 'autocomplete'])->name('customers.autocomplete');
        Route::get('/api/product-numbers/autocomplete', [ProductNumberController::class, 'autocomplete'])
            ->name('product-numbers.autocomplete');

        Route::get('/member', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/', [FrontendController::class, 'index'])->name('frontend');
        Route::get('/category', [FrontendController::class, 'categories'])->name('categories');
        Route::get('/category/{category_slug}', [FrontendController::class, 'products'])->name('category-products');
        Route::get('/product/{product_slug}', [FrontendProductController::class, 'detail'])->name('detail-product');
        Route::get('/products', [FrontendProductController::class, 'index'])->name('product');
        Route::get('/about', [FrontendAboutController::class, 'index'])->name('about');
        Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
        Route::post('/contact_send', [ContactController::class, 'send'])->name('contact-send');
        Route::get('/news', [FrontendPostController::class, 'index'])->name('news');
        Route::get('/news/{slug}', [FrontendPostController::class, 'show'])->name('news-detail');


        Route::prefix('admin')->middleware(['auth', 'isAdmin', 'permission'])->group(function () {

            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
            Route::resource('categories', CategoryController::class);
            Route::resource('posts', PostController::class);
            Route::resource('brands', BrandController::class);
            Route::resource('vehicles', VehicleController::class);
            Route::controller(OptionController::class)->group(function () {
                Route::get('/options', 'index')->name('options.index');
                Route::get('/options/edit/{brand}', 'edit')->name('options.edit');
                Route::post('/options', 'update')->name('options.update');
            });
            // About Route
            Route::resource('abouts', AboutController::class);
            Route::post('abouts/add_translate', [AboutController::class, 'add_translate'])->name('abouts.addTranslate');
            Route::post('abouts/edit_translate', [AboutController::class, 'edit_translate'])->name('abouts.editTranslate');
            Route::post('abouts/update_translate', [AboutController::class, 'update_translate'])->name('abouts.updateTranslate');
            Route::resource('menus', MenuController::class);
            Route::post('menus/add_translate', [MenuController::class, 'add_translate'])->name('menus.addTranslate');
            Route::post('menus/edit_translate', [MenuController::class, 'edit_translate'])->name('menus.editTranslate');
            Route::post('menus/update_translate', [MenuController::class, 'update_translate'])->name('menus.updateTranslate');
            Route::resource('productions', ProductionController::class);
            Route::resource('product-brands', ProductBrandController::class);
            Route::resource('products', ProductController::class);
            Route::get('/products/part/{product_id}', [ProductController::class, 'parts'])->name('products.parts');
            Route::post('/products/add_part', [ProductController::class, 'add_part'])->name('products.addParts');
            Route::post('/products/add_translate', [ProductController::class, 'add_translate'])->name('products.addTranslate');
            Route::resource('shops', ShopController::class);
            Route::resource('customers', CustomerController::class);
            Route::resource('cities', ProvinceController::class);
            Route::resource('provinces', ProvinceController::class);
            Route::post('/provinces/{province}/cities', [ProvinceController::class, 'storeCity'])->name('provinces.cities.store');
            Route::put('/provinces/{province}/cities/{city}', [ProvinceController::class, 'updateCity'])->name('provinces.cities.update');
            Route::delete('/provinces/{province}/cities/{city}', [ProvinceController::class, 'destroyCity'])->name('provinces.cities.destroy');
            Route::get('/provinces/get-cities/{province}', [ProvinceController::class, 'getCities'])->name('provinces.cities.getCities');

            Route::resource('users', UserController::class);
            Route::resource('orders', OrderController::class);
            Route::resource('permissions', PermissionController::class);
            Route::resource('menu_admins', MenuAdminController::class);
            Route::post('menu_admins/{menuAdmin}/assign-permission', [MenuAdminController::class, 'assignPermission'])->name('menu_admins.assign_permission');
            Route::resource('roles', RoleController::class);
            Route::get('roles/{role}/menus', [RoleController::class, 'editMenus'])->name('roles.menus.edit');
            Route::post('roles/{role}/menus', [RoleController::class, 'updateMenus'])->name('roles.menus.update');

            Route::get('roles/{role}/permissions', [RoleController::class, 'editPermissions'])->name('roles.permissions.edit');
            Route::put('roles/{role}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.permissions.update');
            Route::resource('sliders', SliderController::class);
            Route::resource('stocks', StockController::class);
            Route::get('/check-stock', [StockController::class, 'check'])->name('stock.check');

            Route::get('stocks/create/{id}', [StockController::class, 'create'])->name('stocks.add_stock');
            Route::post('stocks/create/{id}', [StockController::class, 'store'])->name('stocks.store_stock');
            Route::get('stocks/shop/index', [StockController::class, 'index_shop'])->name('stocks.index_shop');

            Route::get('reports/stock', [ReportController::class, 'reportStock'])->name('reports.stock');
            Route::get('reports/order', [ReportController::class, 'reportOrder'])->name('reports.order');
            Route::get('reports/order/{id}/items', [ReportController::class, 'getOrderItems'])->name('reports.order.items');

            // Export
            Route::get('/reports/orders/export-excel', [ReportController::class, 'exportOrderExcel'])->name('reports.orders.export.excel');
            Route::get('/reports/orders/export-pdf', [ReportController::class, 'exportOrderPdf'])->name('reports.orders.export.pdf');
            Route::get('/reports/orders/export-word', [ReportController::class, 'exportOrderWord'])->name('reports.orders.export.word');
        });
    }
);


// Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

// });



// Cart
// Route::get('add-to-cart/{id}', [FrontendProductController::class, 'addToCart'])->name('add.to.cart');

// Route::middleware(['auth'])->group(function () {
//     Route::get('cart', [FrontendProductController::class, 'cart'])->name('cart');
//     Route::patch('update-cart', [FrontendProductController::class, 'update'])->name('update.cart');
//     Route::delete('remove-from-cart', [FrontendProductController::class, 'remove'])->name('remove.from.cart');
//     Route::get('checkout', [FrontendProductController::class, 'checkout'])->name('checkout');
// });
