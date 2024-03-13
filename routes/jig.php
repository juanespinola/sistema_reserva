<?php
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth:sanctum', 'verified'])->get('/admin', function () {
    return Inertia::render('AdminDashboard');
})->name('admin.dashboard');


/* Auto-generated users admin routes */
Route::group(["prefix" => "admin","as" => "admin.","middleware"=>['auth:sanctum', 'verified']], function () {
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->parameters(["users" => "user"]);
});


/* Auto-generated roles admin routes */
Route::group(["prefix" => "admin","as" => "admin.","middleware"=>['auth:sanctum', 'verified']], function () {
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class)->parameters(["roles" => "role"]);
});


/* Auto-generated permissions admin routes */
Route::group(["prefix" => "admin","as" => "admin.","middleware"=>['auth:sanctum', 'verified']], function () {
    Route::resource('permissions', \App\Http\Controllers\Admin\PermissionController::class)->parameters(["permissions" => "permission"]);
});


/* Auto-generated shelves admin routes */
Route::group(["prefix" => "admin","as" => "admin.","middleware"=>['auth:sanctum', 'verified']], function () {
    Route::resource('shelves', \App\Http\Controllers\Admin\ShelfController::class)->parameters(["shelves" => "shelf"]);
});


/* Auto-generated stocks admin routes */
Route::group(["prefix" => "admin","as" => "admin.","middleware"=>['auth:sanctum', 'verified']], function () {
    Route::resource('stocks', \App\Http\Controllers\Admin\StockController::class)->parameters(["stocks" => "stock"]);
});


/* Auto-generated plans admin routes */
Route::group(["prefix" => "admin","as" => "admin.","middleware"=>['auth:sanctum', 'verified']], function () {
    Route::resource('plans', \App\Http\Controllers\Admin\PlanController::class)->parameters(["plans" => "plan"]);
});


/* Auto-generated suppliers admin routes */
Route::group(["prefix" => "admin","as" => "admin.","middleware"=>['auth:sanctum', 'verified']], function () {
    Route::resource('suppliers', \App\Http\Controllers\Admin\SupplierController::class)->parameters(["suppliers" => "supplier"]);
});


/* Auto-generated bookings admin routes */
Route::group(["prefix" => "admin","as" => "admin.","middleware"=>['auth:sanctum', 'verified']], function () {
    Route::resource('bookings', \App\Http\Controllers\Admin\BookingController::class)->parameters(["bookings" => "booking"]);
});


/* Auto-generated comments admin routes */
Route::group(["prefix" => "admin","as" => "admin.","middleware"=>['auth:sanctum', 'verified']], function () {
    Route::resource('comments', \App\Http\Controllers\Admin\CommentController::class)->parameters(["comments" => "comment"]);
});


/* Auto-generated customers admin routes */
Route::group(["prefix" => "admin","as" => "admin.","middleware"=>['auth:sanctum', 'verified']], function () {
    Route::resource('customers', \App\Http\Controllers\Admin\CustomerController::class)->parameters(["customers" => "customer"]);
});


/* Auto-generated inventories admin routes */
Route::group(["prefix" => "admin","as" => "admin.","middleware"=>['auth:sanctum', 'verified']], function () {
    Route::resource('inventories', \App\Http\Controllers\Admin\InventoryController::class)->parameters(["inventories" => "inventory"]);
});


/* Auto-generated products admin routes */
Route::group(["prefix" => "admin","as" => "admin.","middleware"=>['auth:sanctum', 'verified']], function () {
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->parameters(["products" => "product"]);
});


/* Auto-generated purchases-details admin routes */
Route::group(["prefix" => "admin","as" => "admin.","middleware"=>['auth:sanctum', 'verified']], function () {
    Route::resource('purchases-details', \App\Http\Controllers\Admin\PurchasesDetailController::class)->parameters(["purchases-details" => "purchasesDetail"]);
});


/* Auto-generated purchases admin routes */
Route::group(["prefix" => "admin","as" => "admin.","middleware"=>['auth:sanctum', 'verified']], function () {
    Route::resource('purchases', \App\Http\Controllers\Admin\PurchaseController::class)->parameters(["purchases" => "purchase"]);
});


/* Auto-generated ratings admin routes */
Route::group(["prefix" => "admin","as" => "admin.","middleware"=>['auth:sanctum', 'verified']], function () {
    Route::resource('ratings', \App\Http\Controllers\Admin\RatingController::class)->parameters(["ratings" => "rating"]);
});


/* Auto-generated reservation-places admin routes */
Route::group(["prefix" => "admin","as" => "admin.","middleware"=>['auth:sanctum', 'verified']], function () {
    Route::resource('reservation-places', \App\Http\Controllers\Admin\ReservationPlaceController::class)->parameters(["reservation-places" => "reservationPlace"]);
});


/* Auto-generated sales-details admin routes */
Route::group(["prefix" => "admin","as" => "admin.","middleware"=>['auth:sanctum', 'verified']], function () {
    Route::resource('sales-details', \App\Http\Controllers\Admin\SalesDetailController::class)->parameters(["sales-details" => "salesDetail"]);
});


/* Auto-generated sales admin routes */
Route::group(["prefix" => "admin","as" => "admin.","middleware"=>['auth:sanctum', 'verified']], function () {
    Route::resource('sales', \App\Http\Controllers\Admin\SaleController::class)->parameters(["sales" => "sale"]);
});


/* Auto-generated transactions admin routes */
Route::group(["prefix" => "admin","as" => "admin.","middleware"=>['auth:sanctum', 'verified']], function () {
    Route::resource('transactions', \App\Http\Controllers\Admin\TransactionController::class)->parameters(["transactions" => "transaction"]);
});
