<?php

use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use Mews\Captcha\Captcha;

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

Route::get('/', [PagesController::class, 'root'])->name('root');

Auth::routes(['verify' => true]);

// 手动注册邮箱验证相关路由
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/email/verify', [VerificationController::class, 'show'])
        ->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
        ->middleware(['signed'])->name('verification.verify');

    Route::post('/email/resend', [VerificationController::class, 'resend'])
        ->name('verification.resend');
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 用户身份验证相关的路由
// GET|HEAD   login ...................................... login › Auth\LoginController@showLoginForm
// POST       login ...................................................... Auth\LoginController@login
// POST       logout ........................................... logout › Auth\LoginController@logout

// 用户注册相关的路由
// GET|HEAD   register ...................... register › Auth\RegisterController@showRegistrationForm
// POST       register ............................................. Auth\RegisterController@register

// 密码重置相关的路由
// GET|HEAD   password/reset ... password.request › Auth\ForgotPasswordController@showLinkRequestForm
// POST       password/reset ................... password.update › Auth\ResetPasswordController@reset
// GET|HEAD   password/reset/{token} .... password.reset › Auth\ResetPasswordController@showResetForm

// 再次确认密码相关的路由
// GET|HEAD   password/confirm .... password.confirm › Auth\ConfirmPasswordController@showConfirmForm
// POST       password/confirm ............................... Auth\ConfirmPasswordController@confirm

// 邮箱验证相关的路由
// POST       password/email ...... password.email › Auth\ForgotPasswordController@sendResetLinkEmail
