<?php

use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Cms\CmsController;
use App\Http\Controllers\Admin\SiteSetting\SiteInfoController;
use App\Http\Controllers\Admin\SiteSetting\SitesettingController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Video\VideoCotroller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Contests\ContestController;
use App\Http\Controllers\IndexController;

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
Route::get('/route:clear', function () {

    Artisan::call('route:clear');
        //dd($data);
    return 'route:clear';
});
Route::get('/config-clear', function () {

    Artisan::call('config:clear');
        //dd($data);
    return 'confi-cleard';
});

Route::get('/cache:clear', function () {

    Artisan::call('cache:clear');
        //dd($data);
    return 'cache:clear';
});

Route::get('/optimize', function () {

    Artisan::call('optimize');
        //dd($data);
    return 'optimize';
});
Route::get('/link', function () {

    Artisan::call('storage:link');
        //dd($data);
    return 'linked';
});

Route::fallback(function () {
    return redirect()->route("index");
});

// Route::get('/', function () {
//     return view('User.commingSoon');
// });

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/register-for-video/{contest_id}', [IndexController::class, 'registerForVideo'])->name('registerForVideo');
Route::post('/user-upload-video', [IndexController::class, 'userUploadVideo'])->name('userUploadVideo');
Route::get('/upload-video', [IndexController::class, 'uploadVideo'])->name('uploadVideo');
Route::post('/upload-video-post', [IndexController::class, 'uploadVideopost'])->name('uploadVideopost');
Route::get('/get-winners', [IndexController::class, 'getWinners'])->name('getWinners');
Route::get('/about-us', [IndexController::class, 'aboutUs'])->name('aboutUs');
Route::get('/contact-us', [IndexController::class, 'contactUs'])->name('contactUs');
Route::post('/contact-form', [IndexController::class, 'contactForm'])->name('contactForm');
Route::get('/terms&conditions', [IndexController::class, 'terms'])->name('terms');
Route::get('/privacy-policy', [IndexController::class, 'privacyPolicy'])->name('privacyPolicy');



//admin
Route::get('admin', [AuthController::class, 'showLogin']);
Route::post('admin', [AuthController::class, 'login'])->name('admin.login');
Route::group(['prefix'=>'admin', 'middleware'=>'CheckAdmimAuth'],function(){
    Route::get('/dashboard', [AuthController::class, 'dashboard']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::get('/change-password', [AuthController::class, 'password']);
    Route::post('/change-password', [AuthController::class, 'updatePassword'])->name('adminpassword.update');
    //site-setting
    Route::get('/site-setting', [SitesettingController::class, 'show']);
    Route::post('/site-setting', [SitesettingController::class, 'update'])->name('site.update');
    //user
    Route::get('/users', [UserController::class, 'show']);
    Route::get('/add-user', [UserController::class, 'create']);
    Route::post('/add-user', [UserController::class, 'store'])->name('user.store');
    Route::get('/edit-user/{slug}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/edit-user/{slug}', [UserController::class, 'update'])->name('user.update');
    Route::get('/view-user/{slug}', [UserController::class, 'userInformation'])->name('user.info');
    Route::get('/changeProductS',[UserController::class,'changeProductS']);
    Route::delete('/delete-user/{slug}', [UserController::class, 'deleteUser'])->name('deleteUser');
    Route::get('/changeS',[UserController::class,'changeS']);
    //Terms&cond
    Route::get('/terms-Conditions',[SiteInfoController::class,'terms']);
    Route::post('/terms-Conditions',[SiteInfoController::class,'termsUpdate'])->name('terms.Update');
    //Privacy Policy
    Route::get('/privacy-policy',[SiteInfoController::class,'privacy']);
    Route::post('/privacy-policy',[SiteInfoController::class,'privacyUpdate'])->name('privacy.Update');
    //about-us
    Route::get('/about-us-update',[SiteInfoController::class,'about']);
    Route::post('/about-us-text',[SiteInfoController::class,'aboutUpdate'])->name('about.Update');
    //videos
    Route::get('/videos/{slug?}',[VideoCotroller::class,'videos']);
    Route::get('/add-videos',[VideoCotroller::class,'create']);
    Route::post('/add-videos',[VideoCotroller::class,'store'])->name('video.store');
    Route::get('/edit-videos/{slug}', [VideoCotroller::class, 'edit']);
    Route::post('/edit-videos/{slug}', [VideoCotroller::class, 'update'])->name('video.update');
    Route::get('/view-video/{slug}', [VideoCotroller::class, 'view']);
    Route::get('/changeVS',[VideoCotroller::class,'changeS']);
    Route::get('/changeWS',[VideoCotroller::class,'changeWS']);
    Route::delete('/delete-video/{slug}', [VideoCotroller::class, 'deletevideo'])->name('deletevideo');
    Route::get('videos/show_video/{id}',[VideoCotroller::class,'show_video']);

    //Contest
    Route::get('/contests',[ContestController::class,'contests']);
    Route::get('/add-contests',[ContestController::class,'create']);
    Route::post('/add-contests',[ContestController::class,'store'])->name('contests.store');
    Route::get('/edit-contests/{slug}',[ContestController::class,'edit']);
    Route::post('/edit-contests/{slug}',[ContestController::class,'update'])->name('contests.update');
    Route::get('/changeCS',[ContestController::class,'changeS']);
    Route::delete('/delete-contests/{slug}', [ContestController::class, 'deletecontest'])->name('deletecontest');
    Route::get('/view-contest/{slug}', [ContestController::class, 'view']);
    //winner
    Route::get('/winners',[ContestController::class,'winners']);
    Route::get('/add-winner',[ContestController::class,'createWinner']);
    Route::post('/getVideos',[ContestController::class,'getVideos']);
    Route::post('/getUser',[ContestController::class,'getUser']);
    Route::post('/uplode-winner',[ContestController::class,'uploadWinner']);
    //cms
    Route::resource('cms', CmsController::class);


    

Route::get('/log-out', [AuthController::class, 'logOut'])->name('logOut');

});