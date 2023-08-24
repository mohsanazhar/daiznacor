<?php

use Illuminate\Support\Facades\Auth;
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

 
Route::middleware(['guest'])->group(function () {
    Route::get('policyCronJob',[\App\Http\Controllers\ReminderController::class,'policyCronJob'])->name('policyCronJob');
    Route::get('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'view'])->name('forgot-password');
});

Auth::routes();
Route::get('index/{locale}',[App\Http\Controllers\HomeController::class, 'lang']);
Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('home');
Route::match(['get','post'],'/profile', [App\Http\Controllers\ProfileController::class, 'view'])->name('profile');
Route::get('/lockscreen', [App\Http\Controllers\ProfileController::class, 'viewLockscreen'])->name('lockscreen');

Route::prefix('users')->group(function () {
    Route::get('/', [App\Http\Controllers\UserController::class, 'view'])->name('userList');
    Route::get('/create', [App\Http\Controllers\UserController::class, 'createView'])->name('userCreate');
});

Route::prefix('reminder')->group(function () {
    Route::get('/events', [App\Http\Controllers\ReminderController::class, 'viewCustomEvents'])->name('customEvents');
    Route::post('/events', [App\Http\Controllers\ReminderController::class, 'postCustomEvents'])->name('postCustomEvents');
    Route::post('/delete-events', [App\Http\Controllers\ReminderController::class, 'deleteCustomEvent'])->name('deleteCustomEvent');
    Route::get('/setting', [App\Http\Controllers\ReminderController::class, 'viewSetting'])->name('settingReminder');
});

Route::prefix('cars')->group(function () {
    Route::get('/', [App\Http\Controllers\CarController::class, 'viewListCars'])->name('listCar');
    Route::post('/', [App\Http\Controllers\CarController::class, 'createCar'])->name('createCar');
    Route::get('/{id}/glove-box', [App\Http\Controllers\CarController::class, 'gloveBoxView'])->name('listGloveBox');
    Route::post('/{id}/glove-box', [App\Http\Controllers\CarController::class, 'gloveBoxCreate'])->name('createGloveBox');
    Route::patch('/{id}', [App\Http\Controllers\CarController::class, 'update'])->name('editCar');
    Route::delete('/{id}', [App\Http\Controllers\CarController::class, 'delete'])->name('deleteCar');
});

Route::prefix('companies')->group(function () {
    Route::get('/', [App\Http\Controllers\CompanyController::class, 'viewList'])->name('lisCompany');
    Route::get('/{id}/edit', [App\Http\Controllers\CompanyController::class, 'viewEdit'])->name('editViewCompany');
    Route::post('/', [App\Http\Controllers\CompanyController::class, 'create'])->name('createCompany');
    Route::patch('/{id}', [App\Http\Controllers\CompanyController::class, 'update'])->name('editCompany');
    Route::delete('/{id}', [App\Http\Controllers\CompanyController::class, 'destroy'])->name('deleteCompany');
});

Route::prefix('policies')->group(function () {
    Route::get('/', [App\Http\Controllers\PolicyController::class, 'viewList'])->name('listPolicy');
    Route::post('/', [App\Http\Controllers\PolicyController::class, 'create'])->name('createPolicy');
    Route::patch('/{id}', [App\Http\Controllers\PolicyController::class, 'update'])->name('editPolicy');
    Route::delete('/{id}', [App\Http\Controllers\PolicyController::class, 'delete'])->name('deletePolicy');
});
Route::prefix('media')->group(function () {
    Route::get('/', [\App\Http\Controllers\MediaController::class, 'index'])->name('listMedia');
    Route::post('/', [App\Http\Controllers\MediaController::class, 'update'])->name('updateMedia');
    Route::delete('/{id}', [App\Http\Controllers\PolicyController::class, 'delete'])->name('deletePolicy');
});

Route::get('/clear-cache', function() {
    $exitCode = \Illuminate\Support\Facades\Artisan::call('cache:clear');
    $exitCode = \Illuminate\Support\Facades\Artisan::call('config:cache');
    \Illuminate\Support\Facades\Artisan::call('optimize');
    return 'DONE'; //Return anything
});
Route::get('policyCronJob',[\App\Http\Controllers\ReminderController::class,'policyCronJob'])->name('policyCronJob');
Route::get('eventCronJob',[\App\Http\Controllers\ReminderController::class,'eventCronJob'])->name('eventCronJob');
Route::match(['get','post'],'ajaxrequest',[\App\Http\Controllers\AjaxController::class,'index']);
