<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/sales-settlement', fn ()=>settleSales());
Route::get('/get-product/{id}', fn($id)=> response()->json(
    Product::join('stocks','stocks.product_id','=','products.id')
        ->join('manufacturers','manufacturers.id','=','products.manufacturer_id')
        ->join('users','users.id','=','manufacturers.user_id')
        ->join('agents','agents.id','=','stocks.pharmacy_id')
        ->join('users as pharmacy','pharmacy.id','=','agents.user_id')
        ->where('stocks.id',$id)
        ->select([
            'products.product_name',
            'products.product_photo',
            'products.serial',
            'products.expiry_date',
            'products.manufactured_date',
            'users.name',
            'pharmacy.name as pharmacy_name'
        ])->first()));

Route::group(['namespace' => 'App\Http\Controllers', 'middleware' => 'auth'], function () {
    Route::controller(UsersController::class)->group(function () {
        Route::get('/users', 'index')->name('users');
    });

    Route::controller(AgentsController::class)->group(function () {
        Route::get('/pharmacies', 'index')->name('agents');
        Route::get('/pharmacies/create', 'create')->name('agents.create');
        Route::get('/pharmacies/{id}/edit', 'edit')->name('agents.edit');
        Route::get('/pharmacies/{id}/delete', 'destroy')->name('agents.delete');
        Route::post('/pharmacies', 'store')->name('agents.store');
        Route::post('/pharmacies/{id}/update', 'update')->name('agents.update');
    });

    Route::controller(ManufacturersController::class)->group(function () {
        Route::get('/manufacturers', 'index')->name('manufacturers');
        Route::get('/manufacturers/create', 'create')->name('manufacturers.create');
        Route::get('/manufacturers/{id}/edit', 'edit')->name('manufacturers.edit');
        Route::get('/manufacturers/{id}/delete', 'destroy')->name('manufacturers.delete');
        Route::post('/manufacturers', 'store')->name('manufacturers.store');
        Route::post('/manufacturers/{id}/update', 'update')->name('manufacturers.update');
    });

    Route::controller(NotificationsController::class)->group(function () {
        Route::get('/notifications', 'index')->name('notifications');
        Route::get('/notifications/create', 'create')->name('notifications.create');
        Route::get('/notifications/{id}/edit', 'edit')->name('notifications.edit');
        Route::get('/notifications/{id}/delete', 'destroy')->name('notifications.delete');
        Route::post('/notifications', 'store')->name('notifications.store');
        Route::post('/notifications/{id}/update', 'update')->name('notifications.update');
        Route::get('/notifications/{id}/publish', 'publish')->name('notifications.publish');
        Route::get('/notifications/{id}/unpublish', 'unpublish')->name('notifications.unpublish');
    });

    Route::controller(CategoriesController::class)->group(function () {
        Route::get('/categories', 'index')->name('categories');
        Route::get('/categories/create', 'create')->name('categories.create');
        Route::post('/categories', 'store')->name('categories.store');
        Route::post('/categories/{id}', 'update')->name('categories.update');
        Route::get('/categories/{id}', 'destroy')->name('categories.delete');

    });
    Route::controller(AgentTypesController::class)->group(function () {
        Route::get('/types', 'index')->name('types');
        Route::get('/types/create', 'create')->name('types.create');
        Route::post('/types', 'store')->name('types.store');
        Route::get('/types/{id}', 'destroy')->name('types.delete');
        Route::get('/types/{id}/edit', 'edit')->name('types.edit');
        Route::post('/types/{id}', 'update')->name('types.update');
    });
    Route::controller(BranchesController::class)->group(function () {
        Route::get('/branches', 'index')->name('branches');
        Route::get('/branches/create', 'create')->name('branches.create');
        Route::get('/branches/{id}/edit', 'edit')->name('branches.edit');
        Route::post('/branches', 'store')->name('branches.store');
        Route::post('/branches/{id}/update', 'update')->name('branches.update');
        Route::get('/branches/{id}/delete', 'destroy')->name('branches.delete');
    });
    Route::controller(ProductsController::class)->group(function () {
        Route::get('/products', 'index')->name('products');
        Route::get('/products/create', 'create')->name('products.create');
        Route::post('/products', 'store')->name('products.store');
        Route::post('/products/{id}/update', 'update')->name('products.update');
        Route::get('/products/{id}/publish', 'publish')->name('products.publish');
        Route::get('/products/{id}/delete', 'destroy')->name('products.delete');
        Route::get('/products/{id}/unpublish', 'unpublish')->name('products.unpublish');
//        Route::get('/products/{id}/verify', 'verificationRequest')->name('products.verify');
    });
    Route::get('/get-serial/{serial}',function ($serial){
      $prod=Product::where('serial',$serial)->first();
     return response()->json(['exists'=>isset($prod),'product'=>$prod]);
    });
    Route::controller(StocksController::class)->group(function () {
        Route::get('/stocks', 'index')->name('stocks');
        Route::get('/stocks/create', 'create')->name('stocks.create');
        Route::post('/stocks', 'store')->name('stocks.store');
        Route::post('/stocks/{id}/update', 'update')->name('stocks.update');
        Route::get('/stocks/{id}/publish', 'publish')->name('stocks.publish');
        Route::get('/stocks/{id}/delete', 'destroy')->name('stocks.delete');
        Route::get('/stocks/{id}/unpublish', 'unpublish')->name('stocks.unpublish');
//        Route::get('/products/{id}/verify', 'verificationRequest')->name('products.verify');
    });

    Route::controller(VerificationRequestController::class)->group(function () {
        Route::get('/products/verification-requests', 'index')->name('products.verificationRequests');
//        Route::get('/products/create', 'create')->name('products.create');
//        Route::post('/products', 'store')->name('products.store');
//        Route::post('/products/{id}/update', 'update')->name('products.update');
//        Route::get('/products/{id}/publish', 'publish')->name('products.publish');
        Route::get('/store-token/{id}', 'storeToken')->name('products.unpublish');
        Route::post('/verifications/{id}/reject', 'reject')->name('verifications.reject');
        Route::post('/verifications/{id}/approve', 'approve')->name('verifications.approve');
        Route::get('/products/{id}/verify', 'store')->name('stocks.verify');
    });

    Route::controller(ClientProfileController::class)->group(function () {
        Route::get('/profiles', 'index')->name('profiles');
        Route::get('/profiles/edit', 'edit')->name('profiles.edit');
        Route::get('/profiles/create', 'create')->name('profiles.create');
        Route::post('/profiles', 'store')->name('profiles.store');
        Route::post('/profiles/{id}/update', 'update')->name('profiles.update');
    });
    Route::controller(CartsController::class)->group(function () {
        Route::get('/carts', 'index')->name('carts');
        Route::get('/carts/create', 'create')->name('carts.create');
        Route::post('/carts/{id}', 'store')->name('carts.store');
        Route::get('/carts/{id}/checkout/{price}', 'checkout')->name('carts.checkout');
        Route::post('/carts/{id}/update', 'update')->name('carts.update');
        Route::get('/carts/{id}/remove', 'remove')->name('carts.remove');
    });
    Route::controller(OrdersController::class)->group(function () {
        Route::get('/orders', 'index')->name('orders');
        Route::get('/orders/create', 'create')->name('orders.create');
        Route::post('/orders/{id}', 'store')->name('orders.store');
        Route::get('/orders/{id}', 'show')->name('orders.show');
        Route::get('/orders/{id}/checkout/{price}', 'checkout')->name('orders.checkout');
        Route::post('/orders/{id}/update', 'update')->name('orders.update');
    });
});

Route::group(['namespace' => 'App\Http\Controllers'], function () {

    Route::controller(FrontendController::class)->group(function () {
        // Route::post('/families/search', 'search')->name('families.search');

        Route::get('/check-verification', 'check');
        Route::get('/', 'index');
        Route::get('/pharmacy/{id}', 'agent')->name('agent');
        Route::get('/category/{id}', 'branch')->name('category');
        Route::get('/cart', 'cart')->name('cart');
        Route::get('/search', 'search')->name('search');
        Route::get('/agentsFilter/{id}', 'agentsFilter')->name('agents.types');
    });

    Route::controller(SocialiteController::class)->group(function () {
        Route::get('/login-g', 'redirectToProvider');
        Route::get('/auth/google/callback', 'handleCallback');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
