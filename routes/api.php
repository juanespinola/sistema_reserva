<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/* Auto-generated users api routes */
Route::group(["middleware"=>['auth:sanctum', 'verified'],'as' => 'api.'], function () {
    Route::post('/users/{user}/assign-role', [\App\Http\Controllers\API\UserController::class,'assignRole'])->name('users.assign-role');
    Route::get('/users/dt', [\App\Http\Controllers\API\UserController::class,'dt'])->name('users.dt');
    Route::apiResource('/users', \App\Http\Controllers\API\UserController::class)->parameters(["users" => "user"]);
});


/* Auto-generated roles api routes */
Route::group(["middleware"=>['auth:sanctum', 'verified'],'as' => 'api.'], function () {
    Route::post('/roles/{role}/assign-permission', [\App\Http\Controllers\API\RoleController::class,'assignPermission'])->name('roles.assign-permission');
    Route::get('/roles/dt', [\App\Http\Controllers\API\RoleController::class,'dt'])->name('roles.dt');
    Route::apiResource('/roles', \App\Http\Controllers\API\RoleController::class)->parameters(["roles" => "role"]);
});


/* Auto-generated permissions api routes */
Route::group(["middleware"=>['auth:sanctum', 'verified'],'as' => 'api.'], function () {
    Route::get('/permissions/dt', [\App\Http\Controllers\API\PermissionController::class,'dt'])->name('permissions.dt');
    Route::apiResource('/permissions', \App\Http\Controllers\API\PermissionController::class)->parameters(["permissions" => "permission"]);
});


/* Auto-generated shelves api routes */
Route::group(["middleware"=>['auth:sanctum', 'verified'],'as' => 'api.'], function () {
    Route::get('/shelves/dt', [\App\Http\Controllers\API\ShelfController::class,'dt'])->name('shelves.dt');
    Route::apiResource('/shelves', \App\Http\Controllers\API\ShelfController::class)->parameters(["shelves" => "shelf"]);
});


/* Auto-generated stocks api routes */
Route::group(["middleware"=>['auth:sanctum', 'verified'],'as' => 'api.'], function () {
    Route::get('/stocks/dt', [\App\Http\Controllers\API\StockController::class,'dt'])->name('stocks.dt');
    Route::apiResource('/stocks', \App\Http\Controllers\API\StockController::class)->parameters(["stocks" => "stock"]);
});


/* Auto-generated plans api routes */
Route::group(["middleware"=>['auth:sanctum', 'verified'],'as' => 'api.'], function () {
    Route::get('/plans/dt', [\App\Http\Controllers\API\PlanController::class,'dt'])->name('plans.dt');
    Route::apiResource('/plans', \App\Http\Controllers\API\PlanController::class)->parameters(["plans" => "plan"]);
});


/* Auto-generated suppliers api routes */
Route::group(["middleware"=>['auth:sanctum', 'verified'],'as' => 'api.'], function () {
    Route::get('/suppliers/dt', [\App\Http\Controllers\API\SupplierController::class,'dt'])->name('suppliers.dt');
    Route::apiResource('/suppliers', \App\Http\Controllers\API\SupplierController::class)->parameters(["suppliers" => "supplier"]);
});


/* Auto-generated bookings api routes */
Route::group(["middleware"=>['auth:sanctum', 'verified'],'as' => 'api.'], function () {
    Route::get('/bookings/dt', [\App\Http\Controllers\API\BookingController::class,'dt'])->name('bookings.dt');
    Route::apiResource('/bookings', \App\Http\Controllers\API\BookingController::class)->parameters(["bookings" => "booking"]);
});


/* Auto-generated comments api routes */
Route::group(["middleware"=>['auth:sanctum', 'verified'],'as' => 'api.'], function () {
    Route::get('/comments/dt', [\App\Http\Controllers\API\CommentController::class,'dt'])->name('comments.dt');
    Route::apiResource('/comments', \App\Http\Controllers\API\CommentController::class)->parameters(["comments" => "comment"]);
});


/* Auto-generated customers api routes */
Route::group(["middleware"=>['auth:sanctum', 'verified'],'as' => 'api.'], function () {
    Route::get('/customers/dt', [\App\Http\Controllers\API\CustomerController::class,'dt'])->name('customers.dt');
    Route::apiResource('/customers', \App\Http\Controllers\API\CustomerController::class)->parameters(["customers" => "customer"]);
});


/* Auto-generated inventories api routes */
Route::group(["middleware"=>['auth:sanctum', 'verified'],'as' => 'api.'], function () {
    Route::get('/inventories/dt', [\App\Http\Controllers\API\InventoryController::class,'dt'])->name('inventories.dt');
    Route::apiResource('/inventories', \App\Http\Controllers\API\InventoryController::class)->parameters(["inventories" => "inventory"]);
});


/* Auto-generated products api routes */
Route::group(["middleware"=>['auth:sanctum', 'verified'],'as' => 'api.'], function () {
    Route::get('/products/dt', [\App\Http\Controllers\API\ProductController::class,'dt'])->name('products.dt');
    Route::apiResource('/products', \App\Http\Controllers\API\ProductController::class)->parameters(["products" => "product"]);
});


/* Auto-generated purchases-details api routes */
Route::group(["middleware"=>['auth:sanctum', 'verified'],'as' => 'api.'], function () {
    Route::get('/purchases-details/dt', [\App\Http\Controllers\API\PurchasesDetailController::class,'dt'])->name('purchases-details.dt');
    Route::apiResource('/purchases-details', \App\Http\Controllers\API\PurchasesDetailController::class)->parameters(["purchases-details" => "purchasesDetail"]);
});


/* Auto-generated purchases api routes */
Route::group(["middleware"=>['auth:sanctum', 'verified'],'as' => 'api.'], function () {
    Route::get('/purchases/dt', [\App\Http\Controllers\API\PurchaseController::class,'dt'])->name('purchases.dt');
    Route::apiResource('/purchases', \App\Http\Controllers\API\PurchaseController::class)->parameters(["purchases" => "purchase"]);
});


/* Auto-generated ratings api routes */
Route::group(["middleware"=>['auth:sanctum', 'verified'],'as' => 'api.'], function () {
    Route::get('/ratings/dt', [\App\Http\Controllers\API\RatingController::class,'dt'])->name('ratings.dt');
    Route::apiResource('/ratings', \App\Http\Controllers\API\RatingController::class)->parameters(["ratings" => "rating"]);
});


/* Auto-generated reservation-places api routes */
Route::group(["middleware"=>['auth:sanctum', 'verified'],'as' => 'api.'], function () {
    Route::get('/reservation-places/dt', [\App\Http\Controllers\API\ReservationPlaceController::class,'dt'])->name('reservation-places.dt');
    Route::apiResource('/reservation-places', \App\Http\Controllers\API\ReservationPlaceController::class)->parameters(["reservation-places" => "reservationPlace"]);
});


/* Auto-generated sales-details api routes */
Route::group(["middleware"=>['auth:sanctum', 'verified'],'as' => 'api.'], function () {
    Route::get('/sales-details/dt', [\App\Http\Controllers\API\SalesDetailController::class,'dt'])->name('sales-details.dt');
    Route::apiResource('/sales-details', \App\Http\Controllers\API\SalesDetailController::class)->parameters(["sales-details" => "salesDetail"]);
});


/* Auto-generated sales api routes */
Route::group(["middleware"=>['auth:sanctum', 'verified'],'as' => 'api.'], function () {
    Route::get('/sales/dt', [\App\Http\Controllers\API\SaleController::class,'dt'])->name('sales.dt');
    Route::apiResource('/sales', \App\Http\Controllers\API\SaleController::class)->parameters(["sales" => "sale"]);
});


/* Auto-generated transactions api routes */
Route::group(["middleware"=>['auth:sanctum', 'verified'],'as' => 'api.'], function () {
    Route::get('/transactions/dt', [\App\Http\Controllers\API\TransactionController::class,'dt'])->name('transactions.dt');
    Route::apiResource('/transactions', \App\Http\Controllers\API\TransactionController::class)->parameters(["transactions" => "transaction"]);
});
