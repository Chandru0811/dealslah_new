<?php

use App\Http\Controllers\Api\AddressController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Vendor\ShopController;
use App\Http\Controllers\Api\Admin\CategoryGroupsController;
use App\Http\Controllers\Api\Admin\DealCategoryController;
use App\Http\Controllers\Api\Admin\CategoriesController;
use App\Http\Controllers\Api\Admin\ShopController as AdminShopController;
use App\Http\Controllers\Api\Admin\SliderController;
use App\Http\Controllers\Api\Vendor\ProductController;
use App\Http\Controllers\Api\Admin\ApprovalController;
use App\Http\Controllers\Api\Admin\ReferrerDetailController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\AppController;
use App\Http\Controllers\Api\Vendor\DashboardController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\HomeController;

Route::post('login', [AuthController::class, 'login']);
Route::post('social-login/{socialprovider}', [AuthController::class, 'socialLoginResponse']);
Route::post('register', [AuthController::class, 'register']);
Route::post('forgot-password', [AuthController::class, 'forgetpassword']);
Route::post('reset-password', [AuthController::class, 'resetpassword']);
Route::get('account/verify/{id}', [AuthController::class, 'verifyAccount'])->name('vendor.verify');
Route::post('app/forgotPassword', [AppController::class, 'forgetpassword']);
Route::post('app/resetPassword', [AppController::class, 'resetpassword']);
Route::post('checkotp', [AppController::class, 'checkotp']);

//user
Route::get('appHome', [AppController::class, 'homepage']);
Route::get('get/{id}/categories', [AppController::class, 'categories']);
Route::get('deals/{category_id}', [AppController::class, 'getDeals']);
Route::get('deal/details/{id}', [AppController::class, 'dealDescription']);
Route::get('search', [AppController::class, 'search']);
Route::get('hotpick/{slug}', [AppController::class, 'dealcategorybasedproductsformobile']);
Route::get('categories/{id}', [AppController::class, 'subcategorybasedproductsformobile']);
Route::post('dealbookmark/add/{id}', [AppController::class, 'addBookmark']);
Route::post('dealbookmark/remove/{id}', [AppController::class, 'removeBookmark']);
Route::get('dealbookmarks', [AppController::class, 'getBookmarks']);
Route::get('bookmark/totalitems', [AppController::class, 'totalItems']);
Route::post('deal/clicked', [AppController::class, 'clickcounts']);
Route::post('deal/viewed', [AppController::class, 'viewcounts']);
Route::post('coupon/copied', [AppController::class, 'couponCopied']);
Route::post('deal/shared', [AppController::class, 'dealshare']);
Route::post('deal/enquired', [AppController::class, 'dealenquire']);

//cart
Route::post('addtocart/{slug}', [CartController::class, 'addtoCart']);
Route::get('cart', [CartController::class, 'getCart']);
Route::post('cart/remove', [CartController::class, 'removeItem']);
Route::post('cart/update', [CartController::class, 'updateCart']);
Route::get('cart/totalitems', [CartController::class, 'totalItems']);

//saveforlater
Route::post('saveforlater', [CartController::class, 'saveForLater']);
Route::get('saveforlater/all', [CartController::class, 'getsaveforlater']);
Route::post('saveforlater/toCart', [CartController::class, 'moveToCart']);
Route::post('saveforlater/remove', [CartController::class, 'removeFromSaveLater']);

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('logout', [AuthController::class, 'logout']);

    //Admin
    Route::middleware('role:1')->prefix('admin')->group(function () {
        // Category Groups
        Route::get('categoryGroup', [CategoryGroupsController::class, 'index']);
        Route::post('categoryGroup', [CategoryGroupsController::class, 'store']);
        Route::get('categoryGroup/{id}', [CategoryGroupsController::class, 'show']);
        Route::put('categoryGroup/update/{id}', [CategoryGroupsController::class, 'update']);
        Route::delete('categoryGroup/{id}', [CategoryGroupsController::class, 'delete']);
        Route::post('categoryGroup/restore/{id}', [CategoryGroupsController::class, 'restore']);

        // Categories
        Route::get('categories', [CategoriesController::class, 'index']);
        Route::post('categories', [CategoriesController::class, 'store']);
        Route::get('categories/{id}', [CategoriesController::class, 'show']);
        Route::put('categories/update/{id}', [CategoriesController::class, 'update']);
        Route::delete('categories/{id}', [CategoriesController::class, 'destroy']);
        Route::post('categories/restore/{id}', [CategoriesController::class, 'restore']);
        Route::post('category/{id}/approve', [ApprovalController::class, 'approveCategory']);

        //Shops
        Route::get('shops', [AdminShopController::class, 'index']);
        Route::get('shop/{id}/details', [AdminShopController::class, 'getshopbasics']);
        Route::get('shop/{id}/location', [AdminShopController::class, 'getshoplocation']);
        Route::get('shop/{id}/payment', [AdminShopController::class, 'getshoppayment']);
        Route::get('shop/{id}/logindetails', [AdminShopController::class, 'getlogindetails']);
        Route::get('shop/{id}/policy', [AdminShopController::class, 'getshoppolicy']);
        Route::get('shop/{id}/hours', [AdminShopController::class, 'getshophours']);
        Route::get('shop/{id}/products', [AdminShopController::class, 'getshopproducts']);
        Route::post('shop/{id}/activate', [AdminShopController::class, 'activateshop']);
        Route::post('shop/{id}/deactivate', [AdminShopController::class, 'deactivateshop']);

        // Sliders
        Route::get('sliders', [SliderController::class, 'index']);
        Route::post('slider', [SliderController::class, 'store']);
        Route::get('slider/{id}', [SliderController::class, 'show']);
        Route::put('slider/update/{id}', [SliderController::class, 'update']);
        Route::delete('slider/delete/{id}', [SliderController::class, 'destroy']);

        // Deal Category
        Route::get('dealCategory', [DealCategoryController::class, 'index']);
        Route::post('dealCategory', [DealCategoryController::class, 'store']);
        Route::get('dealCategory/{id}', [DealCategoryController::class, 'show']);
        Route::put('dealCategory/update/{id}', [DealCategoryController::class, 'update']);
        Route::delete('dealCategory/remove/{id}', [DealCategoryController::class, 'delete']);
        Route::post('dealCategory/restore/{id}', [DealCategoryController::class, 'restore']);

        // Product
        Route::get('products', [AdminShopController::class, 'indexproduct']);
        Route::get('product/{id}', [AdminShopController::class, 'showproduct']);
        Route::post('deal/{id}/approve', [ApprovalController::class, 'approveProduct']);
        Route::post('deal/{id}/disapprove', [ApprovalController::class, 'disapproveProduct']);

        // User
        Route::get('users', [UserController::class, 'getAllUser']);
        Route::get('user/{id}', [UserController::class, 'userShow']);

        // Order
        Route::get('orders', [UserController::class, 'getAllOrders']);
        Route::get('order/{order_id}/{product_id}', [UserController::class, 'getOrderById']);

        // Refferer list
        Route::get('referrers-and-vendors', [UserController::class, 'getAllReferrersAndReferrerVendors']);
        Route::get('referrals/{userId}', [UserController::class, 'getReferralsByUserId']);

        // Referrer Detail
        Route::get('referrer', [ReferrerDetailController::class, 'index']);
        Route::post('referrer', [ReferrerDetailController::class, 'store']);
        Route::get('referrer/{id}', [ReferrerDetailController::class, 'show']);
        Route::put('referrer/update/{id}', [ReferrerDetailController::class, 'update']);
        Route::delete('referrer/{id}', [ReferrerDetailController::class, 'delete']);
        Route::get('getAllReferrer', [ReferrerDetailController::class, 'getAllReferrersAndReferrerVendors']);

        //Product
        Route::get('getAllProductList', [UserController::class, 'getAllProductWithIds']);
        Route::post('update-product-order', [UserController::class, 'updateProductOrder']);
        Route::get('getOrderedProducts', [UserController::class, 'getOrderedProducts']);
    });

    //Vendor
    Route::middleware('role:2')->prefix('vendor')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index']);
        Route::post('dashboard', [DashboardController::class, 'graphdata']);

        // Shops
        Route::post('shopregistration', [AuthController::class, 'shopregistration']);
        Route::get('shop/details/{id}', [ShopController::class, 'showshopdetails']);
        Route::get('shop/location/{id}', [ShopController::class, 'showshoplocation']);
        Route::get('shop/payment/{id}', [ShopController::class, 'showshoppayment']);
        Route::put('shop/{id}/update/details', [ShopController::class, 'updateshopdetails']);
        Route::put('shop/{id}/update/location', [ShopController::class, 'updateshoplocation']);
        Route::put('shop/{id}/update/payment', [ShopController::class, 'updateshoppayment']);
        Route::get('shop/hour/{shop_id}', [ShopController::class, 'showhour']);
        Route::get('shop/policy/{shop_id}', [ShopController::class, 'showpolicy']);
        Route::post('shop/policy/update', [ShopController::class, 'updateorcreatepolicy']);
        Route::post('shop/hour/update', [ShopController::class, 'updateorcreatehour']);
        Route::get('shop/status/{id}', [ShopController::class, 'status']);

        //Product
        Route::get('product/{shop_id}', [ProductController::class, 'index']);
        Route::post('product', [ProductController::class, 'store']);
        Route::post('product/restore/{id}', [ProductController::class, 'restore']);
        Route::get('product/{id}/get', [ProductController::class, 'show']);
        Route::put('product/{id}/update', [ProductController::class, 'update']);
        Route::delete('product/{id}/delete', [ProductController::class, 'destroy']);
        Route::delete('product/media/{id}/delete', [ProductController::class, 'destroyProductMedia']);

        // Category Group and Categories
        Route::get('categorygroups', [ProductController::class, 'getAllCategoryGroups']);
        Route::get('categories/categorygroups/{id}', [ProductController::class, 'getAllCategoriesByCategoryGroupId']);
        Route::post('categories/create', [ProductController::class, 'categoriesCreate']);

        // Order
        Route::get('orders/{shop_id}', [ShopController::class, 'getAllOrdersByShop']);
        Route::get('order/{order_id}/{product_id}', [ShopController::class, 'showOrderById']);

        // All Referral Vendor
        Route::get('referrals/{userId}', [ShopController::class, 'getReferralsByUserId']);
        Route::get('referrerDashboard', [DashboardController::class, 'referrerDashboard']);
        Route::get('referrer/commission', [DashboardController::class, 'getAllVendorCommission']);
    });

    //Customer
    Route::middleware('role:3')->prefix('customer')->group(function () {
        Route::get('/cartSummary/{cart_id}', [CartController::class, 'cartSummary']);
        Route::get('/checkout/{cart_id}', [CheckoutController::class, 'cartcheckout']);
        Route::get('/checkoutSummary/{product_id}', [CheckoutController::class, 'checkoutsummary']);
        Route::get('/directCheckout', [CheckoutController::class, 'directCheckout']);
        Route::post('/checkout', [CheckoutController::class, 'createorder']);
        Route::get('/orders', [CheckoutController::class, 'getAllOrdersByCustomer']);
        Route::get('/order/{id}/{product_id}', [CheckoutController::class, 'showOrderByCustomerId']);
        Route::put('/updateUser', [AppController::class, 'updateUser']);
        Route::get('/getUser', [AppController::class, 'getUser']);
        Route::delete('/deleteUser', [AppController::class, 'softDeleteUser']);

        Route::get('/address', [AddressController::class, 'index']);
        Route::post('/address', [AddressController::class, 'store']);
        Route::get('/address/{id}', [AddressController::class, 'show']);
        Route::put('/address/update/{id}', [AddressController::class, 'update']);
        Route::delete('/address/{id}', [AddressController::class, 'destroy']);
        Route::post('/review', [AppController::class, 'createReview']);
    });
});

// //Announcements
// Route::get('announcements', [AnnouncementController::class, 'index']);
// Route::post('announcements', [AnnouncementController::class, 'store']);
// Route::get('announcements/{id}', [AnnouncementController::class, 'show']);
// Route::put('announcements/{id}', [AnnouncementController::class, 'update']);
// Route::delete('announcements/{id}', [AnnouncementController::class, 'destroy']);
