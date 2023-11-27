<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MainController::class, 'index'])->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/view/edit', [AdminController::class, 'edit'])->name('admin.edit');
//    ヘッダーロゴ編集
    Route::get('/edit/header_logo', [AdminController::class, 'editHeaderLogo'])->name('admin.edit.header_logo');
    Route::post('/edit/header_logo', [AdminController::class, 'updateHeaderLogo'])->name('admin.update.header_logo');
//    トップ画像編集
    Route::get('/edit/slick', [AdminController::class, 'editSlick'])->name('admin.edit.slick');
    Route::post('/edit/slick', [AdminController::class, 'updateSlick'])->name('admin.update.slick');
//    ウェルカム編集
    Route::get('/edit/welcome', [AdminController::class, 'editWelcome'])->name('admin.edit.welcome');
    Route::post('/edit/welcome', [AdminController::class, 'updateWelcome'])->name('admin.update.welcome');
//    コンセプト編集
    Route::get('/edit/concept', [AdminController::class, 'editConcept'])->name('admin.edit.concept');
    Route::post('/edit/concept/{id}', [AdminController::class, 'updateConcept'])->name('admin.update.concept');
    Route::delete('/edit/concept/{id}', [AdminController::class, 'destroyConcept'])->name('admin.destroy.concept');
//    アドレス編集
    Route::get('/edit/address', [AdminController::class, 'editAddress'])->name('admin.edit.address');
    Route::post('/edit/address', [AdminController::class, 'updateAddress'])->name('admin.update.address');
    Route::post('/edit/address/delete/{id}', [AdminController::class, 'destroyAddress'])->name('admin.destroy.address');
//    プライス編集
    Route::get('/edit/price', [AdminController::class, 'editPrice'])->name('admin.edit.price');
    Route::post('/edit/price', [AdminController::class, 'updatePrice'])->name('admin.update.price');
    Route::post('/edit/price/content', [AdminController::class, 'updatePriceContent'])->name('admin.update.price.content');
    Route::post('/edit/price/delete/{id}', [AdminController::class, 'destroyPrice'])->name('admin.destroy.price');
    Route::post('/edit/price/content/delete/{id}', [AdminController::class, 'destroyPriceContent'])->name('admin.destroy.price.content');
//    セクション編集
    Route::get('/edit/section', [AdminController::class, 'editSection'])->name('admin.edit.section');
    Route::post('/edit/section/part/{id}', [AdminController::class, 'updateSection'])->name('admin.update.section');
    Route::post('/edit/section/item', [AdminController::class, 'updateSectionItem'])->name('admin.update.section.item');
    Route::post('/edit/section/delete/{id}', [AdminController::class, 'destroySection'])->name('admin.destroy.section');
    Route::post('/edit/section/item/delete/{id}', [AdminController::class, 'destroySectionItem'])->name('admin.destroy.section.item');
//    スクール編集
//    Route::get('/edit/school', [AdminController::class, 'editSchool'])->name('admin.edit.school');
//    Route::post('/edit/school', [AdminController::class, 'updateSchool'])->name('admin.update.school');
//    フード編集
    Route::get('/edit/food', [AdminController::class, 'editFood'])->name('admin.edit.food');
    Route::post('/edit/food', [AdminController::class, 'updateFood'])->name('admin.update.food');
    Route::post('/edit/food/delete/{id}', [AdminController::class, 'destroyFood'])->name('admin.destroy.food');
//    フードトラック編集
    Route::get('/edit/food_truck', [AdminController::class, 'editFoodTruck'])->name('admin.edit.food_truck');
    Route::post('/edit/food_truck', [AdminController::class, 'updateFoodTruck'])->name('admin.update.food_truck');
//    コンタクト編集
//    Route::get('/edit/contact', [AdminController::class, 'editContact'])->name('admin.edit.contact');
//    Route::post('/edit/contact', [AdminController::class, 'updateContact'])->name('admin.update.contact');
//    スポンサー編集
    Route::get('/edit/sponsor', [AdminController::class, 'editSponsor'])->name('admin.edit.sponsor');
    Route::post('/edit/sponsor', [AdminController::class, 'updateSponsor'])->name('admin.update.sponsor');
    Route::post('/edit/sponsor/delete/{id}', [AdminController::class, 'destroySponsor'])->name('admin.destroy.sponsor');
});

require __DIR__.'/auth.php';
