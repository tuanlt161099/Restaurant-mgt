<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TableController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



//Public Route
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('list-table', [TableController::class, 'index']); //get list table

//Prodtect Route
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);



        //only admin can access
        Route::middleware(['admin'])->group(function () {
            Route::post('create-a-table',[TableController::class,'store']);//create a new table
            Route::post('delete-table-{table}',[TableController::class,'destroy']);
        });
    });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
