<?php

use App\Http\Controllers\API\DataController;
use App\Http\Controllers\API\AuthController;
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

Route::get('/', function(){
    return response()->json([
        'message' => 'Akses ditolak, anda harus memasukkan token terlebih dahulu'
    ], 401);
})->name('login');

Route::post('daftar', [AuthController::class,'daftar']);
Route::post('login', [AuthController::class,'login']);

Route::get('index', [DataController::class,'index'])->middleware('auth:sanctum');
Route::get('data/{id}/detail', [DataController::class,'show'])->middleware('auth:sanctum');
Route::post('data/tambah', [DataController::class,'store'])->middleware('auth:sanctum');
Route::put('data/{id}/update', [DataController::class, 'update'])->middleware('auth:sanctum');
Route::delete('data/{id}/delete', [DataController::class, 'destroy'])->middleware('auth:sanctum');
