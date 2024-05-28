<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\CountryController;
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

Route::get('/', [IndexController::class, 'index'])->name('home');
Route::post('/search', [IndexController::class, 'index'])->name('search');

//Movie
Route::get('/the-loai/{slug}', [IndexController::class, 'theloai'])->name('client.theloai');
Route::get('/quoc-gia/{slug}', [IndexController::class, 'quocgia'])->name('client.quocgia');

//Game - app
Route::get('/game-mod', [IndexController::class, 'gamemod'])->name('client.gamemod');
Route::get('/app-mod', [IndexController::class, 'appmod'])->name('client.appmod');

Route::get('/get-device', function () {
    $userAgent = $_SERVER['HTTP_USER_AGENT']; // change this to the useragent you want to parse
    $clientHints = \DeviceDetector\ClientHints::factory($_SERVER); // client hints are optional

    $dd = new \DeviceDetector\DeviceDetector($userAgent);
    $dd->parse();
    $osInfo = $dd->getOs();
    $device = $dd->getDeviceName();
    $brand = $dd->getBrandName();
    $model = $dd->getModel();

    dd($osInfo, $device, $brand, $model);
})->name('test');

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function ()
{
    Route::get('/',[\App\Http\Controllers\AdminController::class,'index'])->name('index');
   Route::resource('/genre',GenreController::class);
   Route::resource('/country',CountryController::class);
//    Route::resource('/celebrity',CelebrityController::class);
    Route::resource('/movie',\App\Http\Controllers\MovieController::class);
    Route::resource('/game',\App\Http\Controllers\GameController::class);
    Route::resource('/genre_game',\App\Http\Controllers\GenreGameController::class);
    Route::resource('/license',\App\Http\Controllers\LicenseController::class);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'singleSession'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/api/movie/', [\App\Http\Controllers\MovieController::class, 'getMovie'])->name('api.getMovie');
Route::post('/api/game/', [\App\Http\Controllers\GameController::class, 'getGame'])->name('api.getGame');
Route::post('/search', [\App\Http\Controllers\MovieController::class, 'search'])->name('search');
Route::post('/active', [\App\Http\Controllers\IndexController::class, 'checkLicense'])->name('api.checkLicense');



require __DIR__.'/auth.php';
