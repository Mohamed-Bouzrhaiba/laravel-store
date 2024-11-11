<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddresseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderPlacementController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\UserOrderController;

Route::get('/',[HomeController::class,'index'])->name("home");
Route::get("/product/{product}",[HomeController::class,"productShow"])->name("product.show");
Route::prefix('admin')->middleware(['auth','admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class,'index'])->name("admin.dashboard");
    Route::resource("products",ProductController::class);
    Route::resource("categories",CategoryController::class);
    Route::resource("brands",BrandController::class);
    Route::resource("orders",OrderController::class);
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    //Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::delete('/cart/{cartItem}', [CartController::class, 'clearCart'])->name('cart.clear.item');
    Route::get("/cart",[CartController::class,"index"])->name("cart.view");
   //checkout // order
  // Route::post('/order/cash', [OrderPlacementController::class, 'placeOrderCash'])->name('order.cash');
//Route::post('/paypal/create', [CartController::class, 'createPayment'])->name('paypal.create');

   Route::get('/checkout', [OrderPlacementController::class, 'showCheckout'])->name('checkout');
   Route::post('/order', [OrderPlacementController::class, 'processOrder'])->name('processOrder');
   //

   Route::post("/cart",[AddresseController::class,"add"])->name("addresse.add");
    // ppl checkout routes
   // Route::post('/process-order', [CheckoutController::class, 'processOrder'])->name('processOrder');
   // Route::get('/payment-success', [CheckoutController::class, 'paymentSuccess'])->name('payment.success');
    //PAYPAL

    Route::post("/paypal",[PaypalController::class,'paypal'])->name('paypal');
    Route::get("/success",[PaypalController::class,'success'])->name('success');
    Route::post("/cancel",[PaypalController::class,'cancel'])->name('cancel');

    //USER ORDERs
    route::get("/your-orders",[UserOrderController::class   ,"index"])->name("orders");
    Route::get("show-order-details/{orderid}",[UserOrderController::class ,"showOrder"])->name("showOrderDetails");
    Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');

});



require __DIR__.'/auth.php';
