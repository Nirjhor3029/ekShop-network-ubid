<?php


use App\Http\Controllers\Backend\Auth\ForgotPasswordController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\BusinessListingController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\vendorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/', function () {
//     // return "hello";
//     return view('admin.home');
// })->name('index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/number-format/{id}', [Controller::class, 'numberFormat']);

/**
 * Admin routes
 */
Route::as('admin.')->prefix('admin')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('roles', 'Backend\RolesController')->names('roles');
        Route::resource('users', 'Backend\UsersController')->names('users');
        Route::resource('admins', 'Backend\AdminsController')->names('admins');

        // Login Routes
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login/submit', [LoginController::class, 'login'])->name('login.submit');

        // Logout Routes
        Route::post('/logout/submit', [LoginController::class, 'logout'])->name('logout.submit');

        // Forget Password Routes
        Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('/password/reset/submit', [ForgotPasswordController::class, 'reset'])->name('password.update');

        // Business Listings
        Route::prefix('business-listings')->group(function () {
            Route::get('', [BusinessListingController::class, 'index'])->name('business_listings');
            Route::get('/all', [BusinessListingController::class, 'showAll'])->name('business_listings.all');
            Route::post('/store', [BusinessListingController::class, 'store'])->name('business_listings.store');
            Route::get('/edit/{id}', [BusinessListingController::class, 'edit'])->name('business_listings.edit');
            Route::get('/delete/{id}', [BusinessListingController::class, 'delete'])->name('business_listings.delete');
            Route::post('/update/{id}', [BusinessListingController::class, 'update'])->name('business_listings.update');
            Route::get('/import-data', [BusinessListingController::class, 'import'])->name('business_listings.import');
            Route::get('/get-ekshop-json-data', [BusinessListingController::class, 'json'])->name('business_listings.json');

            // E-cab
            Route::get('/get-ecab-json-data', [BusinessListingController::class, 'ecab_json'])->name('business_listings.ecab_json');
        });
    });























Route::middleware(['web'])->prefix('admin')->as('admin.')->group(function () {

    // Route::get('/', [DashboardController::class,'home'])->name('home');
    // Route::get('/roles', [DashboardController::class,'roles'])->name('roles');

    // Company
    Route::get('/company/company-list', [CompanyController::class, 'index'])->name('company.all');
    Route::get('/company/create-company', [CompanyController::class, 'create'])->name('company.create');

    // Price
    Route::get('/price', [SmsController::class, 'sendSms'])->name('price');

    // PhoneBook
    Route::get('/phonebook', [SmsController::class, 'sendSms'])->name('phonebook');
});