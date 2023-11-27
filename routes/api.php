<?php

use App\Http\Controllers\AdminController;
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
Route::post('top_img/sort', [AdminController::class, 'sortSlick'])->name('top_img.sort');
Route::delete('top_img/{id}', [AdminController::class, 'destroySlick'])->name('top_img.destroy');
Route::post('section/publish', [AdminController::class, 'publishSection'])->name('section.publish');
Route::post('sponsor/publish', [AdminController::class, 'publishSponsor'])->name('sponsor.publish');
