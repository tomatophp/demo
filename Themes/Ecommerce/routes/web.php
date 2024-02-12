<?php


use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'splade'])->name('home.')->group(function() {
    Route::get('/', [\Themes\Ecommerce\App\Http\Controllers\HomeController::class, 'index'])->name('index');
    Route::get('/about', [\Themes\Ecommerce\App\Http\Controllers\HomeController::class, 'about'])->name('about');
    Route::get('/faq', [\Themes\Ecommerce\App\Http\Controllers\HomeController::class, 'faq'])->name('faq');
    Route::get('/contact', [\Themes\Ecommerce\App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
    Route::get('/terms', [\Themes\Ecommerce\App\Http\Controllers\HomeController::class, 'terms'])->name('terms');
    Route::get('/privacy', [\Themes\Ecommerce\App\Http\Controllers\HomeController::class, 'privacy'])->name('privacy');
    Route::get('/returns', [\Themes\Ecommerce\App\Http\Controllers\HomeController::class, 'returns'])->name('returns');
    Route::post('/contact', [\Themes\Ecommerce\App\Http\Controllers\HomeController::class, 'send'])->name('contact');
    Route::post('/contact-form', [\Themes\Ecommerce\App\Http\Controllers\HomeController::class, 'form'])->name('form');
});

Route::middleware(['web', 'splade'])->prefix('shop')->name('shop.')->group(function() {
    Route::get('/', [\Themes\Ecommerce\App\Http\Controllers\ShopController::class, 'index'])->name('index');
    Route::get('/product/{slug}', [\Themes\Ecommerce\App\Http\Controllers\ShopController::class, 'product'])->name('product');
});

Route::middleware(['web', 'splade'])->prefix('blog')->name('blog.')->group(function() {
    Route::get('/', [\Themes\Ecommerce\App\Http\Controllers\BlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [\Themes\Ecommerce\App\Http\Controllers\BlogController::class, 'post'])->name('post');
});


Route::middleware(['web', 'splade', 'auth:accounts'])->name('checkout.')->group(function() {
    Route::get('/checkout', [\Themes\Ecommerce\App\Http\Controllers\CheckoutController::class, 'index'])->name('index');
    Route::post('/checkout', [\Themes\Ecommerce\App\Http\Controllers\CheckoutController::class, 'submit'])->name('submit');
    Route::get('/checkout/select', [\Themes\Ecommerce\App\Http\Controllers\CheckoutController::class, 'select'])->name('select');
    Route::post('/checkout/shipping', [\Themes\Ecommerce\App\Http\Controllers\CheckoutController::class, 'shipping'])->name('shipping');
    Route::post('/checkout/balance', [\Themes\Ecommerce\App\Http\Controllers\CheckoutController::class, 'balance'])->name('balance');
    Route::get('/checkout/done/{order}', [\Themes\Ecommerce\App\Http\Controllers\CheckoutController::class, 'done'])->name('done');
});

Route::middleware(['web', 'splade'])->name('cart.')->group(function() {
    Route::get('/cart', [\Themes\Ecommerce\App\Http\Controllers\CheckoutController::class, 'cart'])->name('cart');
    Route::post('/cart', [\Themes\Ecommerce\App\Http\Controllers\CheckoutController::class, 'store'])->name('store');
    Route::post('/cart/options', [\Themes\Ecommerce\App\Http\Controllers\CheckoutController::class, 'options'])->name('options');
    Route::post('/cart/clear', [\Themes\Ecommerce\App\Http\Controllers\CheckoutController::class, 'clear'])->name('clear');
    Route::post('/cart/{cart}', [\Themes\Ecommerce\App\Http\Controllers\CheckoutController::class, 'update'])->name('update');
    Route::delete('/cart/{cart}', [\Themes\Ecommerce\App\Http\Controllers\CheckoutController::class, 'destroy'])->name('destroy');
});

Route::middleware(['web', 'splade'])->name('accounts.')->group(function() {
    Route::get('/login', [\Themes\Ecommerce\App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/login', [\Themes\Ecommerce\App\Http\Controllers\AuthController::class, 'check'])->name('login.check');
    Route::get('/register', [\Themes\Ecommerce\App\Http\Controllers\AuthController::class, 'register'])->name('register');
    Route::post('/register', [\Themes\Ecommerce\App\Http\Controllers\AuthController::class, 'store'])->name('register.store');
    Route::get('/reset', [\Themes\Ecommerce\App\Http\Controllers\AuthController::class, 'reset'])->name('reset');
    Route::post('/reset', [\Themes\Ecommerce\App\Http\Controllers\AuthController::class, 'password'])->name('reset.submit');
    Route::get('/forget', [\Themes\Ecommerce\App\Http\Controllers\AuthController::class, 'forget'])->name('forget');
    Route::post('/forget', [\Themes\Ecommerce\App\Http\Controllers\AuthController::class, 'email'])->name('forget.email');
    Route::get('/email', [\Themes\Ecommerce\App\Http\Controllers\AuthController::class, 'email'])->name('email');
    Route::get('/otp', [\Themes\Ecommerce\App\Http\Controllers\AuthController::class, 'otp'])->name('otp');
    Route::post('/otp/resend', [\Themes\Ecommerce\App\Http\Controllers\AuthController::class, 'resend'])->name('otp.resend');
    Route::post('/otp', [\Themes\Ecommerce\App\Http\Controllers\AuthController::class, 'otpCheck'])->name('otp.check');
});

Route::middleware(['web', 'splade', 'auth:accounts'])->prefix('profile')->name('profile.')->group(function() {
    Route::get('/', [\Themes\Ecommerce\App\Http\Controllers\ProfileController::class, 'index'])->name('index');
    Route::get('/edit', [\Themes\Ecommerce\App\Http\Controllers\ProfileController::class, 'edit'])->name('edit');
    Route::post('/update', [\Themes\Ecommerce\App\Http\Controllers\ProfileController::class, 'update'])->name('update');
    Route::post('/password', [\Themes\Ecommerce\App\Http\Controllers\ProfileController::class, 'password'])->name('password');
    Route::delete('/close', [\Themes\Ecommerce\App\Http\Controllers\ProfileController::class, 'close'])->name('close');
    Route::get('/logout', [\Themes\Ecommerce\App\Http\Controllers\ProfileController::class, 'logout'])->name('logout');
});

Route::middleware(['web', 'splade', 'auth:accounts'])->prefix('profile/wishlist')->name('profile.wishlist.')->group(function() {
    Route::get('/', [\Themes\Ecommerce\App\Http\Controllers\ProfileWishlistController::class, 'index'])->name('index');
    Route::post('/create', [\Themes\Ecommerce\App\Http\Controllers\ProfileWishlistController::class, 'store'])->name('store');
    Route::delete('/{wishlist}', [\Themes\Ecommerce\App\Http\Controllers\ProfileWishlistController::class, 'destroy'])->name('destroy');
});

Route::middleware(['web', 'splade', 'auth:accounts'])->prefix('profile/notifications')->name('profile.notifications.')->group(function() {
    Route::get('/', [\Themes\Ecommerce\App\Http\Controllers\ProfileNotificationsController::class, 'index'])->name('index');
    Route::post('/read', [\Themes\Ecommerce\App\Http\Controllers\ProfileNotificationsController::class, 'read'])->name('read');
    Route::delete('/clear', [\Themes\Ecommerce\App\Http\Controllers\ProfileNotificationsController::class, 'clearUser'])->name('clear');
    Route::get('/{model}', [\Themes\Ecommerce\App\Http\Controllers\ProfileNotificationsController::class, 'show'])->name('show');
    Route::post('/{model}', [\Themes\Ecommerce\App\Http\Controllers\ProfileNotificationsController::class, 'readSelected'])->name('read.selected');
    Route::delete('/{model}', [\Themes\Ecommerce\App\Http\Controllers\ProfileNotificationsController::class, 'destroy'])->name('destroy');
});

Route::middleware(['web', 'splade', 'auth:accounts'])->prefix('profile/address')->name('profile.address.')->group(function() {
    Route::get('/', [\Themes\Ecommerce\App\Http\Controllers\ProfileAddressController::class, 'index'])->name('index');
    Route::get('/create', [\Themes\Ecommerce\App\Http\Controllers\ProfileAddressController::class, 'create'])->name('create');
    Route::post('/create', [\Themes\Ecommerce\App\Http\Controllers\ProfileAddressController::class, 'store'])->name('store');
    Route::post('/{address}/select', [\Themes\Ecommerce\App\Http\Controllers\ProfileAddressController::class, 'select'])->name('select');
    Route::get('/{address}/show', [\Themes\Ecommerce\App\Http\Controllers\ProfileAddressController::class, 'show'])->name('show');
    Route::get('/{address}/edit', [\Themes\Ecommerce\App\Http\Controllers\ProfileAddressController::class, 'edit'])->name('edit');
    Route::post('/{address}', [\Themes\Ecommerce\App\Http\Controllers\ProfileAddressController::class, 'update'])->name('update');
    Route::delete('/{address}', [\Themes\Ecommerce\App\Http\Controllers\ProfileAddressController::class, 'destroy'])->name('destroy');
});

Route::middleware(['web', 'splade', 'auth:accounts'])->prefix('profile/orders')->name('profile.orders.')->group(function() {
    Route::get('/', [\Themes\Ecommerce\App\Http\Controllers\ProfileOrdersController::class, 'index'])->name('index');
    Route::get('/{order}/show', [\Themes\Ecommerce\App\Http\Controllers\ProfileOrdersController::class, 'show'])->name('show');
    Route::get('/{order}/print', [\Themes\Ecommerce\App\Http\Controllers\ProfileOrdersController::class, 'print'])->name('print');
    Route::post('/{order}/cancel', [\Themes\Ecommerce\App\Http\Controllers\ProfileOrdersController::class, 'cancel'])->name('cancel');
});


Route::middleware(['web', 'splade', 'auth:accounts'])->prefix('profile/wallet')->name('profile.wallet.')->group(function() {
    Route::get('/', [\Themes\Ecommerce\App\Http\Controllers\ProfileWalletController::class, 'index'])->name('index');
    Route::get('/create', [\Themes\Ecommerce\App\Http\Controllers\ProfileWalletController::class, 'create'])->name('create');
    Route::post('/create', [\Themes\Ecommerce\App\Http\Controllers\ProfileWalletController::class, 'store'])->name('store');
    Route::get('/{wallet}/show', [\Themes\Ecommerce\App\Http\Controllers\ProfileWalletController::class, 'show'])->name('show');
    Route::get('/{wallet}/edit', [\Themes\Ecommerce\App\Http\Controllers\ProfileWalletController::class, 'edit'])->name('edit');
    Route::post('/{wallet}', [\Themes\Ecommerce\App\Http\Controllers\ProfileWalletController::class, 'update'])->name('update');
});


