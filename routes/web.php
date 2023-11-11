<?php

use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\AdminProfile;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\Google2FAController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\EmailVirefyController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserManagement;
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
//gest 
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'guest'], function () {

    // login
    Route::get('/login', [AdminAuthController::class, 'LoginView'])->name('Login.view');
    Route::post('/loginRequest', [AdminAuthController::class, 'LoginPost'])->name('Login.post');
    // register
    Route::get('/registration', [AdminAuthController::class, 'RegisterView'])->name('register.view');
    Route::post('/registrationRequest', [AdminAuthController::class, 'RegisterPost'])->name('register.post');
});

//auth
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'IsPasswordCreated', 'EmailVerify', 'otp']], function () {
    Route::get('/index', [AdminDashboard::class, 'index'])->name('Dashboard.index');
    Route::post('/logout', [AdminAuthController::class, 'Logout'])->name('Admin.Logout.post');


    Route::get('/profile', [AdminProfile::class, 'ProfileShow'])->name('Admin.profile');
    Route::post('/removeImage', [AdminProfile::class, 'RemoveImage'])->name('Admin.RemoveImage');
    Route::post('/updateProfile', [AdminProfile::class, 'UpdateProfile'])->name('Admin.UpdateProfile.post');

    Route::group(['namespace' => 'Users', 'prefix' => 'users'], function () {
        route::get('/list', [UserManagement::class, 'list'])->name('Admin.Users.list');
        route::get('/show/{id}', [UserManagement::class, 'show'])->name('Admin.User.show');

        route::post('/deactive', [UserManagement::class, 'Deactivate'])->name('Admin.Deactivate.post');

        route::post('/active', [UserManagement::class, 'active'])->name('Admin.active.post');

        route::delete('/delete', [UserManagement::class, 'delete'])->name('Admin.delete.post');

        route::get('/edite/{id}', [UserManagement::class, 'edite'])->name('Admin.edite.show');

        route::put('/edite/{id}', [UserManagement::class, 'update'])->name('Admin.update.put');
        route::post('/clear2fa', [UserManagement::class, 'clear2fa'])->name('Admin.clear2fa.post');
    });
    // Route::resource('/roles', RoleController::class);
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/show/{id}', [RoleController::class, 'show'])->name('roles.show');
    Route::get('/roles/edite/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::delete('/roles/destroy/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::put('/roles/update/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store');
});

//gnrate new password for social login
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/newPassword', [SocialAuthController::class, 'newpassword'])->name('new_password.view');
    Route::post('/newPassword', [SocialAuthController::class, 'newpasswordpost'])->name('new_password.post');
    Route::get("/souldVerify", [EmailVirefyController::class, 'SouldVerify'])->name('Admin.SouldVerify.view');
    Route::post('/resendVerify', [EmailVirefyController::class, 'resendVerify'])->name('resendVerify.post');


    Route::get('/2fa', [Google2FAController::class, 'enableTwoFactor'])->name('2far');
    Route::post('/2fa', [Google2FAController::class, 'twofaEnable'])->name('2far.post');

    Route::get('login/otp',  [Google2FAController::class, 'showotp'])->name('otp.show');
    Route::post('login/otp', [Google2FAController::class, 'checkotp'])->name('otp.post');
});

//social login handel
Route::get('auth/google', [SocialAuthController::class, 'redirectToGoogel'])->name('login.google');
Route::get('auth/google/callback', [SocialAuthController::class, 'handelGoogleCallback']);
Route::post("/verifiy", [EmailVirefyController::class, 'EmailVerify'])->name('Admin.EmailVerify.post');

Route::fallback(function () {
    return redirect()->route('Dashboard.index');
});
