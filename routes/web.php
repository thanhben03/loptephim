<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\CountryController;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
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
//Route::post('/search', [IndexController::class, 'index'])->name('search');

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

Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function ()
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

Route::get('/test-api', function () {
    return view('test');
});

Route::get('/test', function () {
    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
    ])->post('crow-wondrous-asp.ngrok-free.app/command', [
        'command' => 'scan_qr',
    ]);

    // Kiểm tra phản hồi
    if ($response->successful()) {
        // Xử lý phản hồi thành công
        $data = $response->json();
        return $data;
    } else {
        // Xử lý lỗi nếu yêu cầu không thành công
        return 'Request failed with status: ' . $response->status();
    }
})->name('test.camera');

Route::post('/in-phieu', function (Request $request) {
    $dataRaw = $request->input('scan_qr') ?? "089202017098|352576714|Lê Văn Lương|23052002|Nam|Tổ 10 Ấp An Thái, Hòa Bình, Chợ Mới, An Giang|31122021";
    $arrData = explode("|", $dataRaw);
    $strBirthday = $arrData[3];
    $birthday = substr($strBirthday, 0, 2).'/'. substr($strBirthday, 2,2). '/'. substr($strBirthday, 4);
    return response()->json([
        'stt' => rand(0,1000),
        'bn_name' => $arrData[2],
        'dob' => $birthday,
        'gender' => $arrData[4],
        'birthplace' => $arrData[5],
        'arrival_time' => Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString(),
        'department' => 'Khoa CNTT'
    ]);
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'live.license'])
    ->name('dashboard');

Route::middleware(['auth', 'singleSession'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/active', [\App\Http\Controllers\IndexController::class, 'checkLicense'])->name('api.checkLicense');

Route::middleware('live.license')->group(function () {
    Route::post('/api/movie/', [\App\Http\Controllers\MovieController::class, 'getMovie'])->name('api.getMovie');
    Route::post('/api/game/', [\App\Http\Controllers\GameController::class, 'getGame'])->name('api.getGame');
    Route::post('/search', [\App\Http\Controllers\MovieController::class, 'search'])->name('search');
    Route::post('/live-license', [\App\Http\Controllers\IndexController::class, 'liveLicense'])->name('api.liveLicense');
    Route::get('/main-post', [\App\Http\Controllers\IndexController::class, 'mainPost'])->name('mainPost');
    Route::post('/comment/', [IndexController::class, 'postComment'])->name('postComment');
    Route::post('/get-comment/', [IndexController::class, 'getCommentByIdPost'])->name('getCommentByIdPost');
    Route::post('/like-post', [IndexController::class, 'likePost'])->name('likePost');



});



require __DIR__.'/auth.php';
