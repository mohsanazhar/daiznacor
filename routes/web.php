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
    Route::get('/list-cars', [App\Http\Controllers\CarController::class, 'viewListCars'])->name('listCar');
    Route::get('/create-car', [App\Http\Controllers\CarController::class, 'create'])->name('listCar.create');
    Route::post('/', [App\Http\Controllers\CarController::class, 'createCar'])->name('createCar');
    Route::get('/{id}/glove-box', [App\Http\Controllers\CarController::class, 'gloveBoxView'])->name('listGloveBox');
    Route::post('/{id}/glove-box', [App\Http\Controllers\CarController::class, 'gloveBoxCreate'])->name('createGloveBox');
    Route::patch('/{id}', [App\Http\Controllers\CarController::class, 'update'])->name('editCar');
    Route::delete('/{id}', [App\Http\Controllers\CarController::class, 'delete'])->name('deleteCar');
    Route::post('/get-card-detail', [App\Http\Controllers\CarController::class, 'get_car_details'])->name('get_company_details');
});

Route::prefix('companies')->group(function () {
    Route::get('/list-company', [App\Http\Controllers\CompanyController::class, 'viewList'])->name('lisCompany');
    Route::get('/create-company', [App\Http\Controllers\CompanyController::class, 'createNew'])->name('lisCompany.create');
    Route::get('/{id}/edit', [App\Http\Controllers\CompanyController::class, 'viewEdit'])->name('editViewCompany');
    Route::post('/', [App\Http\Controllers\CompanyController::class, 'create'])->name('createCompany');
    Route::patch('/{id}', [App\Http\Controllers\CompanyController::class, 'update'])->name('editCompany');
    Route::delete('/{id}', [App\Http\Controllers\CompanyController::class, 'destroy'])->name('deleteCompany');
    Route::post('/get-company-detail', [App\Http\Controllers\CompanyController::class, 'get_company_details'])->name('get_company_details');
});

Route::prefix('policies')->group(function () {
    Route::get('/list-policies', [App\Http\Controllers\PolicyController::class, 'viewList'])->name('listPolicy');
    Route::get('/create-policy', [App\Http\Controllers\PolicyController::class, 'createPolicy'])->name('policy.create');
    Route::post('/', [App\Http\Controllers\PolicyController::class, 'create'])->name('createPolicy');
    Route::patch('/{id}', [App\Http\Controllers\PolicyController::class, 'update'])->name('editPolicy');
    Route::delete('/{id}', [App\Http\Controllers\PolicyController::class, 'delete'])->name('deletePolicy');
    Route::post('/get-policy-detail', [App\Http\Controllers\PolicyController::class, 'get_policy_details'])->name('get_policy_details');
});
Route::prefix('media')->group(function () {
    Route::get('/', [\App\Http\Controllers\MediaController::class, 'index'])->name('listMedia');
    Route::post('/', [App\Http\Controllers\MediaController::class, 'update'])->name('updateMedia');
    Route::delete('/{id}', [App\Http\Controllers\PolicyController::class, 'delete'])->name('deletePolicy');
});

Route::prefix('settings')->group(function () {
    Route::get('/list-province', [\App\Http\Controllers\settingsController::class, 'provinceViewList'])->name('list-province');
    Route::get('/get-province/{id}', [\App\Http\Controllers\settingsController::class, 'getProvinceDetail'])->name('get-province');
    Route::post('/', [App\Http\Controllers\settingsController::class, 'createProvince'])->name('createProvince');
    Route::patch('editProvince/{id}', [App\Http\Controllers\settingsController::class, 'updateProvince'])->name('editProvince');
    Route::get('/deleteProvince', [App\Http\Controllers\settingsController::class, 'deleteProvince'])->name('deleteProvince');

    Route::get('/list-district', [\App\Http\Controllers\settingsController::class, 'districtViewList'])->name('list-district');
    Route::post('/createDistrict', [App\Http\Controllers\settingsController::class, 'createDistrict'])->name('createDistrict');
    Route::get('/deleteDistrict', [App\Http\Controllers\settingsController::class, 'deleteDistrict'])->name('deleteDistrict');
    Route::get('/get-district/{id}', [\App\Http\Controllers\settingsController::class, 'getDistrictDetail'])->name('get-district');
    Route::patch('editDistrict/{id}', [App\Http\Controllers\settingsController::class, 'updateDistrict'])->name('editDistrict');
});
//Route::get('/list-province', [\App\Http\Controllers\settingsController::class, 'provinceViewList'])->name('list-province');
Route::get('/clear-cache', function() {
    $exitCode = \Illuminate\Support\Facades\Artisan::call('cache:clear');
    $exitCode = \Illuminate\Support\Facades\Artisan::call('config:cache');
    \Illuminate\Support\Facades\Artisan::call('optimize');
    return 'DONE'; //Return anything
});

Route::get('policyCronJob',[\App\Http\Controllers\ReminderController::class,'policyCronJob'])->name('policyCronJob');
Route::get('eventCronJob',[\App\Http\Controllers\ReminderController::class,'eventCronJob'])->name('eventCronJob');
Route::get('plateCronJob',[\App\Http\Controllers\ReminderController::class,'plateCronJob'])->name('plateCronJob');
Route::match(['get','post'],'ajaxrequest',[\App\Http\Controllers\AjaxController::class,'index']);

Route::get('policy/export/', [App\Http\Controllers\PolicyController::class, 'export']);
Route::post('policy/import/', [App\Http\Controllers\PolicyController::class, 'import'])->name('policy/import');

Route::get('car/export/', [App\Http\Controllers\CarController::class, 'export']);
Route::post('car/import/', [App\Http\Controllers\CarController::class, 'import'])->name('car/import');
