<?php

use App\Http\Controllers\GradeController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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


Route::middleware('guest')->group(function(){
    Route::get('/', function () {
        return view('auth.login');
    });

});



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::get('/', function () {
            return view('dashboard');
        });

            Route::get('/grades', [GradeController::class,'index'])->name('grades.index');
            Route::post('/grades', [GradeController::class,'store'])->name('grades.store');
            Route::put('/grades/{grade}', [GradeController::class,'update'])->name('grades.update');
            Route::delete('/grades/{grade}', [GradeController::class,'destroy'])->name('grades.delete');
    }
);


Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

    Route::get('test', function () {
        return view('test');
    });
});




require __DIR__ . '/auth.php';
