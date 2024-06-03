<?php


use Illuminate\Support\Facades\Route;

Route::middleware(['splade','web'])->name('home.')->group(function() {
    Route::post('/switch', [\TomatoPHP\TomatoAdmin\Http\Controllers\DashboardController::class, 'switchLang'])->name('lang');
    Route::get('/', [\Modules\EcommerceTheme\App\Http\Controllers\HomeController::class, 'index'])->name('index');
    Route::get('/about', [\Modules\EcommerceTheme\App\Http\Controllers\HomeController::class, 'about'])->name('about');
    Route::get('/faq', [\Modules\EcommerceTheme\App\Http\Controllers\HomeController::class, 'faq'])->name('faq');
    Route::get('/contact', [\Modules\EcommerceTheme\App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
    Route::get('/terms', [\Modules\EcommerceTheme\App\Http\Controllers\HomeController::class, 'terms'])->name('terms');
    Route::get('/privacy', [\Modules\EcommerceTheme\App\Http\Controllers\HomeController::class, 'privacy'])->name('privacy');
    Route::get('/returns', [\Modules\EcommerceTheme\App\Http\Controllers\HomeController::class, 'returns'])->name('returns');
    Route::post('/contact', [\Modules\EcommerceTheme\App\Http\Controllers\HomeController::class, 'send'])->name('contact');
    Route::post('/contact-form', [\Modules\EcommerceTheme\App\Http\Controllers\HomeController::class, 'form'])->name('form');
});

Route::middleware(['splade', 'web',])->prefix('shop')->name('shop.')->group(function() {
    Route::get('/', [\Modules\EcommerceTheme\App\Http\Controllers\ShopController::class, 'index'])->name('index');
    Route::get('/product/{slug}', [\Modules\EcommerceTheme\App\Http\Controllers\ShopController::class, 'product'])->name('product');
});

Route::middleware(['splade', 'web',])->prefix('projects')->name('projects.')->group(function() {
    Route::get('/', [\Modules\EcommerceTheme\App\Http\Controllers\ProjectsController::class, 'index'])->name('index');
    Route::get('/{project}',[\Modules\EcommerceTheme\App\Http\Controllers\ProjectsController::class, 'show'])->name('show');
});

Route::middleware(['splade', 'web',])->prefix('services')->name('services.')->group(function() {
    Route::get('/{service}',[\Modules\EcommerceTheme\App\Http\Controllers\ServicesController::class, 'show'])->name('service');
});


Route::middleware(['splade', 'web',])->name('blog.')->group(function() {
    Route::get('/blog', [\Modules\EcommerceTheme\App\Http\Controllers\BlogController::class, 'index'])->name('index');
    Route::get('/blog/{slug}', [\Modules\EcommerceTheme\App\Http\Controllers\BlogController::class, 'post'])->name('post');
    Route::get('/info',[\Modules\EcommerceTheme\App\Http\Controllers\BlogController::class, 'info'])->name('info');
    Route::get('/info/{post}',[\Modules\EcommerceTheme\App\Http\Controllers\BlogController::class, 'showInfo'])->name('show-info');
    Route::get('/open-source',[\Modules\EcommerceTheme\App\Http\Controllers\BlogController::class, 'openSources'])->name('open-source');
    Route::get('/videos',[\Modules\EcommerceTheme\App\Http\Controllers\BlogController::class, 'videos'])->name('videos');
});


Route::middleware(['splade', 'auth:accounts', 'web'])->name('checkout.')->group(function() {
    Route::get('/checkout', [\Modules\EcommerceTheme\App\Http\Controllers\CheckoutController::class, 'index'])->name('index');
    Route::post('/checkout', [\Modules\EcommerceTheme\App\Http\Controllers\CheckoutController::class, 'submit'])->name('submit');
    Route::get('/checkout/select', [\Modules\EcommerceTheme\App\Http\Controllers\CheckoutController::class, 'select'])->name('select');
    Route::post('/checkout/shipping', [\Modules\EcommerceTheme\App\Http\Controllers\CheckoutController::class, 'shipping'])->name('shipping');
    Route::post('/checkout/balance', [\Modules\EcommerceTheme\App\Http\Controllers\CheckoutController::class, 'balance'])->name('balance');
    Route::get('/checkout/done/{order}', [\Modules\EcommerceTheme\App\Http\Controllers\CheckoutController::class, 'done'])->name('done');
});

Route::middleware(['splade', 'web'])->name('cart.')->group(function() {
    Route::get('/cart', [\Modules\EcommerceTheme\App\Http\Controllers\CheckoutController::class, 'cart'])->name('cart');
    Route::post('/cart', [\Modules\EcommerceTheme\App\Http\Controllers\CheckoutController::class, 'store'])->name('store');
    Route::post('/cart/options', [\Modules\EcommerceTheme\App\Http\Controllers\CheckoutController::class, 'options'])->name('options');
    Route::post('/cart/clear', [\Modules\EcommerceTheme\App\Http\Controllers\CheckoutController::class, 'clear'])->name('clear');
    Route::post('/cart/{cart}', [\Modules\EcommerceTheme\App\Http\Controllers\CheckoutController::class, 'update'])->name('update');
    Route::delete('/cart/{cart}', [\Modules\EcommerceTheme\App\Http\Controllers\CheckoutController::class, 'destroy'])->name('destroy');
});

Route::middleware(['splade', 'web',])->name('accounts.')->group(function() {
    Route::get('/login', [\Modules\EcommerceTheme\App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/login', [\Modules\EcommerceTheme\App\Http\Controllers\AuthController::class, 'check'])->name('login.check');
    Route::get('/register', [\Modules\EcommerceTheme\App\Http\Controllers\AuthController::class, 'register'])->name('register');
    Route::post('/register', [\Modules\EcommerceTheme\App\Http\Controllers\AuthController::class, 'store'])->name('register.store');
    Route::get('/reset', [\Modules\EcommerceTheme\App\Http\Controllers\AuthController::class, 'reset'])->name('reset');
    Route::post('/reset', [\Modules\EcommerceTheme\App\Http\Controllers\AuthController::class, 'password'])->name('reset.submit');
    Route::get('/forget', [\Modules\EcommerceTheme\App\Http\Controllers\AuthController::class, 'forget'])->name('forget');
    Route::post('/forget', [\Modules\EcommerceTheme\App\Http\Controllers\AuthController::class, 'email'])->name('forget.email');
    Route::get('/email', [\Modules\EcommerceTheme\App\Http\Controllers\AuthController::class, 'email'])->name('email');
    Route::get('/otp', [\Modules\EcommerceTheme\App\Http\Controllers\AuthController::class, 'otp'])->name('otp');
    Route::post('/otp/resend', [\Modules\EcommerceTheme\App\Http\Controllers\AuthController::class, 'resend'])->name('otp.resend');
    Route::post('/otp', [\Modules\EcommerceTheme\App\Http\Controllers\AuthController::class, 'otpCheck'])->name('otp.check');
});

Route::middleware([ 'splade', 'auth:accounts', 'web'])->prefix('profile')->name('profile.')->group(function() {
    Route::get('/', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileController::class, 'index'])->name('index');
    Route::get('/edit', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileController::class, 'edit'])->name('edit');
    Route::post('/update', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileController::class, 'update'])->name('update');
    Route::post('/password', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileController::class, 'password'])->name('password');
    Route::delete('/close', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileController::class, 'close'])->name('close');
    Route::get('/logout', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileController::class, 'logout'])->name('logout');
});

Route::middleware([ 'splade', 'auth:accounts', 'web'])->prefix('profile/wishlist')->name('profile.wishlist.')->group(function() {
    Route::get('/', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileWishlistController::class, 'index'])->name('index');
    Route::post('/create', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileWishlistController::class, 'store'])->name('store');
    Route::delete('/{wishlist}', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileWishlistController::class, 'destroy'])->name('destroy');
});

Route::middleware([ 'splade', 'auth:accounts', 'web'])->prefix('profile/notifications')->name('profile.notifications.')->group(function() {
    Route::get('/', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileNotificationsController::class, 'index'])->name('index');
    Route::post('/read', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileNotificationsController::class, 'read'])->name('read');
    Route::delete('/clear', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileNotificationsController::class, 'clearUser'])->name('clear');
    Route::get('/{model}', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileNotificationsController::class, 'show'])->name('show');
    Route::post('/{model}', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileNotificationsController::class, 'readSelected'])->name('read.selected');
    Route::delete('/{model}', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileNotificationsController::class, 'destroy'])->name('destroy');
});

Route::middleware(['splade', 'auth:accounts', 'web'])->prefix('profile/address')->name('profile.address.')->group(function() {
    Route::get('/', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileAddressController::class, 'index'])->name('index');
    Route::get('/create', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileAddressController::class, 'create'])->name('create');
    Route::post('/create', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileAddressController::class, 'store'])->name('store');
    Route::post('/{address}/select', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileAddressController::class, 'select'])->name('select');
    Route::get('/{address}/show', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileAddressController::class, 'show'])->name('show');
    Route::get('/{address}/edit', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileAddressController::class, 'edit'])->name('edit');
    Route::post('/{address}', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileAddressController::class, 'update'])->name('update');
    Route::delete('/{address}', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileAddressController::class, 'destroy'])->name('destroy');
});

Route::middleware([ 'splade', 'auth:accounts', 'web'])->prefix('profile/orders')->name('profile.orders.')->group(function() {
    Route::get('/', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileOrdersController::class, 'index'])->name('index');
    Route::get('/{order}/show', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileOrdersController::class, 'show'])->name('show');
    Route::get('/{order}/print', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileOrdersController::class, 'print'])->name('print');
    Route::post('/{order}/cancel', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileOrdersController::class, 'cancel'])->name('cancel');
});


Route::middleware([ 'splade', 'auth:accounts', 'web'])->prefix('profile/wallet')->name('profile.wallet.')->group(function() {
    Route::get('/', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileWalletController::class, 'index'])->name('index');
    Route::get('/create', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileWalletController::class, 'create'])->name('create');
    Route::post('/create', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileWalletController::class, 'store'])->name('store');
    Route::get('/{wallet}/show', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileWalletController::class, 'show'])->name('show');
    Route::get('/{wallet}/edit', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileWalletController::class, 'edit'])->name('edit');
    Route::post('/{wallet}', [\Modules\EcommerceTheme\App\Http\Controllers\ProfileWalletController::class, 'update'])->name('update');
});


