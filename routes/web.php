<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewCartController;

Route::fallback(function () {
    return redirect()->route('home');
});

// Route::get('/reset', function () {
//     return view('auth/reset-password');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('hotpick/{slug}', [HomeController::class, 'dealcategorybasedproducts'])->name('deals.categorybased');
Route::get('subCategory/{category_slug}/{slug}', [HomeController::class, 'subcategorybasedproducts'])->name('deals.subcategories');
Route::get('categories/{slug}', [HomeController::class, 'subcategorybasedproducts'])->name('deals.subcategorybased');
Route::get('deal/{id}', [HomeController::class, 'productdescription'])->name('deal.description');
Route::get('bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
Route::post('bookmark/{deal_id}/add', [BookmarkController::class, 'add'])->name('bookmarks.add');
Route::delete('bookmark/{deal_id}/remove', [BookmarkController::class, 'remove'])->name('bookmarks.remove');
Route::get('totalbookmark', [BookmarkController::class, 'totalItems'])->name('bookmarks.totalItems');
Route::get('search', [HomeController::class, 'search'])->name('search');
Route::post('deals/count/click', [HomeController::class, 'clickcounts']);
Route::post('deals/count/views', [HomeController::class, 'viewcounts']);
Route::post('deals/coupon/copied', [HomeController::class, 'couponCodeCopied']);
Route::post('deals/count/share', [HomeController::class, 'dealshare']);
Route::post('deals/count/enquire', [HomeController::class, 'dealenquire']);
Route::get('/service/price/{id}', [HomeController::class, 'showSpecialPrice'])->name('service.price');
Route::get('/stock/{id}', [HomeController::class, 'stock'])->name('stock.unit');
Route::middleware('auth')->group(function () {
    Route::get('/checkoutSummary/{product_id}', [CheckoutController::class, 'checkoutsummary'])->name('checkout.summary');
    Route::post('/cartCheckout', [CheckoutController::class, 'cartcheckout'])->name('checkout.cart');
    Route::post('/directCheckout', [CheckoutController::class, 'directcheckout'])->name('checkout.direct');
    Route::get('/cartSummary/{cart_id}', [CartController::class, 'cartSummary'])->name('cart.address');
    Route::post('/checkout', [CheckoutController::class, 'createorder'])->name('checkout.checkout');
    Route::get('/addresses', [AddressController::class, 'index'])->name('address.index');
    Route::get('/getAddress/{id}', [AddressController::class, 'show'])->name('address.view');
    Route::post('/createAddress', [AddressController::class, 'store'])->name('address.create');
    Route::put('/updateAddress', [AddressController::class, 'update'])->name('address.update');
    Route::delete('/address/{id}', [AddressController::class, 'destroy'])->name('address.destroy');
    Route::post('/selectaddress', [AddressController::class, 'changeSelectedId'])->name('address.change');
    Route::get('/orders', [CheckoutController::class, 'getAllOrdersByCustomer'])->name('customer.orders');
    Route::get('/order/{id}/{product_id}', [CheckoutController::class, 'showOrderByCustomerId'])->name('customer.orderById');
    Route::get('/order/invoice/{id}', [CheckoutController::class, 'orderInvoice'])->name('order.invoice');
    Route::put('/updateUser', [HomeController::class, 'updateUser'])->name('user.update');
    Route::post('/review', [HomeController::class, 'createReview'])->name('review.create');
});
Route::get('cart/details', [NewCartController::class, 'cartdetails'])->name('cart.details');
Route::post('addtocart/{slug}', [NewCartController::class, 'addToCart'])->name('cart.add');
Route::get('cart', [NewCartController::class, 'index'])->name('cart.index');

Route::get('get/cartitems', [CartController::class, 'getCartItem'])->name('cartitems.get');
Route::Post('cart/remove', [CartController::class, 'removeItem'])->name('cart.remove');
Route::post('cart/update', [CartController::class, 'updateCart'])->name('cart.update');
// Route::get('cart/dropdown', [CartController::class, 'getCartDropdown'])->name('cart.dropdown');
Route::post('saveforlater/add', [CartController::class, 'saveForLater'])->name('savelater.add');
// Route::post('saveforlater/multiple', [CartController::class, 'multipleMoveToCart'])->name('savelater.multiple');
Route::post('saveforlater/toCart', [CartController::class, 'moveToCart'])->name('movetocart');
Route::post('saveforlater/remove', [CartController::class, 'removeFromSaveLater'])->name('savelater.remove');
Route::get('saveforlater/all', [CartController::class, 'getsaveforlater'])->name('savelater.index');
Route::get('/privacyPolicy', function () {
    return view('privacypolicy');
});
Route::get('/terms_conditions', function () {
    return view('termsandconditions');
});
Route::get('/contactus', function () {
    return view('contactus');
});

//social login
Route::get('auth/{socialprovider}', [AuthController::class, 'socialLogin'])->name('google.login');

Route::get('auth/{socialprovider}/callback', [AuthController::class, 'socailLoginResponse']);

//facebook login
// Route::get('auth/facebook', function () {
//     return Socialite::driver('facebook')->redirect();
// })->name('facebook.login');

// Route::get('social/facebook/callback', function () {
//     try {

//             $user = Socialite::driver('facebook')->user();

//             $findUser = User::where('auth_provider','facebook')->where('auth_provider_id', $user->id)->first();

//             if($findUser){

//                 Auth::login($findUser);

//                 return redirect()->intended('home');

//             }else{
//                 $newUser = User::updateOrCreate(['email' => $user->email],[
//                         'name' => $user->name,
//                         'auth_provider_id'=> $user->id,
//                         'auth_provider' => 'facebook',
//                         'password' => encrypt('12345678')
//                     ]);

//                 Auth::login($newUser);

//                 return redirect()->intended('home');
//             }

//         } catch (Exception $e) {
//             dd($e->getMessage());
//         }
// });


require __DIR__ . '/auth.php';
