<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Api\jobController;
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



Route::middleware([logincheck::class])->group(function () {
    Route::get('/dashboard', 'App\Http\Controllers\Admin\AdminController@index')->name('dashboard');
    Route::get('employee', [AdminController::class, 'get_employee']);
    Route::get('employers', [AdminController::class, 'get_employers']);
    Route::get('get_requests', [AdminController::class, 'get_requests']);
    Route::get('get_jobstype', [AdminController::class, 'get_jobstype']);
    Route::post('post_jobstype', [AdminController::class, 'post_jobstype'])->name('post_jobstype');
    Route::get('deletejob/{id}', [AdminController::class, 'deletejob'])->name('deletejob');
});

Route::get('/', [AdminController::class, 'home'])->name('/');
Route::get('search', [AdminController::class, 'search']);
Route::post('employee_post', [AdminController::class, 'employee_post']);
Route::post('Employer', [AdminController::class, 'Employer']);
Route::get('auth/google', [jobController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [jobController::class,  'handleGoogleCallback']);
Route::get('filedownload/{token}',[jobController::class, 'filedownload'])->name('filedownload');
Route::get('searching', function () {
    return redirect('search')->with('success', 'We have sent resume to your mail please check');
});
Route::get('web_privacy_policy', [AdminController::class, 'web_privacy_policy'])->name('web_privacy_policy');
Route::get('app_privacy_policy', [AdminController::class, 'app_privacy_policy'])->name('app_privacy_policy');


  Route::get('/userlogout', function () {
    Auth::logout();
    return redirect('/');
});


// admin login check method
Route::post('/adminauthcheck', 'App\Http\Controllers\Admin\AdminController@adminlogin')->name('adminauthcheck');
// for admin login
Route::get('/Super_user_login', function () {
    if (session()->has('user')) {
        return redirect('dashboard');
    }
    return view('Backend/pages/AdminLogin');
});
//for admin logout
Route::get('/logout', function () {
    if (session()->has('user')) {
        Session::flush();
    }
    return redirect('Super_user_login');
});









