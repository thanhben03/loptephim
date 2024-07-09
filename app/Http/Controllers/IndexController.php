<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Game;
use App\Models\Genre;
use App\Models\License;
use App\Models\Movie;
use App\Models\MovieCountry;
use App\Models\MovieGenre;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use PhpParser\Builder;

class IndexController extends Controller
{

    public function __construct()
    {
        $banners = DB::table('movie_banners')
            ->join('movies','movie_banners.movie_id', '=', 'movies.id')
//            ->join('genres','movie_banners.movie_id', '=', 'movies.id')
            ->get();

//        chieu rap nuoc ngoai
        $phimle = DB::table('movies as m')
            ->join('movie_genres as mg', 'mg.movie_id', '=','m.id')
            ->join('genres as g', 'g.id', '=','mg.genre_id')
            ->select('m.*', 'g.name')
            ->where('g.slug', 'chieu-rap-nuoc-ngoai')
            ->orderBy('updated_at', 'desc')
            ->take(20)
            ->get();
        foreach ($phimle as $key => $item) {
            $id = $item->id;
            $countries = DB::table('movies as m')
                ->join('movie_countries as mc', 'mc.movie_id', '=', 'm.id')
                ->join('countries as c', 'c.id', '=', 'mc.country_id')
                ->select('c.name', 'c.id')
                ->where('m.id', $id)->get();
            if (count($countries) <= 0) {
                $phimle[$key]->countries = $item->is_vietsub;

            } else {
                $phimle[$key]->countries = $countries->toArray()[0]->name;

            }
        }

//        chieu rap viet
        $phimviet = DB::table('movies as m')
            ->join('movie_genres as mg', 'mg.movie_id', '=','m.id')
            ->join('genres as g', 'g.id', '=','mg.genre_id')
            ->select('m.*', 'g.name')
            ->where('g.slug', 'chieu-rap-viet')
            ->orderBy('updated_at', 'desc')
            ->take(20)
            ->get();
        foreach ($phimviet as $key => $item) {
            $id = $item->id;
            $countries = DB::table('movies as m')
                ->join('movie_countries as mc', 'mc.movie_id', '=', 'm.id')
                ->join('countries as c', 'c.id', '=', 'mc.country_id')
                ->select('c.name', 'c.id')
                ->where('m.id', $id)->get();
            if (count($countries) <= 0) {
                $phimviet[$key]->countries = $item->is_vietsub;

            } else {
                $phimviet[$key]->countries = $countries->toArray();

            }
        }
//        phim hay khac
        $phimRap = DB::table('movies as m')
            ->join('movie_genres as mg', 'mg.movie_id', '=','m.id')
            ->join('genres as g', 'g.id', '=','mg.genre_id')
            ->select('m.*', 'g.name')
            ->where('g.slug', 'phim-hay-khac')
            ->orderBy('updated_at', 'desc')
            ->take(20)
            ->get();
        foreach ($phimRap as $key => $item) {
            $id = $item->id;
            $countries = DB::table('movies as m')
                ->join('movie_countries as mc', 'mc.movie_id', '=', 'm.id')
                ->join('countries as c', 'c.id', '=', 'mc.country_id')
                ->select('c.name', 'c.id')
                ->where('m.id', $id)->get();
            if (count($countries) <= 0) {
                $phimRap[$key]->countries = $item->is_vietsub;

            } else {
                $phimRap[$key]->countries = $countries->toArray();

            }
        }
        $genres = Genre::get();
        $countries = Country::get();
        view()->share('genres', $genres);
        view()->share('phimviet', $phimviet);
        view()->share('phimRap', $phimRap);
        view()->share('phimle', $phimle);
        view()->share('banners', $banners);
        view()->share('countries', $countries);
    }

    public function index()
    {

        return view('client.index');
    }

    public function theloai(Request $request, $slug)
    {
        $genre = Genre::query()->where('slug', $slug)->first();
        $movies = Movie::query()
            ->whereHas('movie_genres', function (\Illuminate\Database\Eloquent\Builder $query) use($genre){
                $query->where('genre_id', $genre->id);
            })
            ->orderBy('updated_at', 'desc')
//            ->where('genre_id', $genre->id)
            ->paginate(12);
        if ($request->ajax()) {
            $view = view('client.genre_load', [
                'movies' => $movies
            ])->render();
            return Response::json(['view' => $view, 'nextPageUrl' => $movies->nextPageUrl()] );
        }
//        dd($movies[0]->movie);
        return view('client.genre', [
            'movies' => $movies,
            'genre' => $genre
        ]);

    }

    public function quocgia(Request $request, $slug)
    {
        $country = Country::query()->where('slug', $slug)->first();
        $movies = MovieCountry::query()
            ->where('country_id', $country->id)
//            ->with('movie')
            ->paginate(4);

        if ($request->ajax()) {
            $view = view('client.country_load', [
                'movies' => $movies
            ])->render();
            return Response::json(['view' => $view, 'nextPageUrl' => $movies->nextPageUrl()] );
        }
//        dd($movies[0]->movie);
        return view('client.country', [
            'movies' => $movies,
            'country' => $country
        ]);

    }

    public function gamemod(Request $request)
    {
        $games = Game::query()
            ->where('type', '=', 0)
            ->orderBy('updated_at', 'desc')


            //            ->with('movie')
            ->paginate(6);

        if ($request->ajax()) {
            $view = view('client.game_load', [
                'games' => $games
            ])->render();
            return Response::json(['view' => $view, 'nextPageUrl' => $games->nextPageUrl()] );
        }
//        dd($movies[0]->movie);
        return view('client.game', [
            'games' => $games,
        ]);

    }

    public function appmod(Request $request)
    {
        $games = Game::query()
            ->where('type', '=', 1)
            ->orderBy('id', 'desc')

//            ->with('movie')
            ->paginate(4);

        if ($request->ajax()) {
            $view = view('client.app_load', [
                'games' => $games
            ])->render();
            return Response::json(['view' => $view, 'nextPageUrl' => $games->nextPageUrl()] );
        }
//        dd($movies[0]->movie);
        return view('client.app', [
            'games' => $games,
        ]);

    }

    public function checkLicense(Request $request)
    {

        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $clientHints = \DeviceDetector\ClientHints::factory($_SERVER);

        $dd = new \DeviceDetector\DeviceDetector($userAgent);
        $dd->parse();


        if ($dd->isSmartphone()) {
            $osInfo = $dd->getOs();
            $device = $dd->getDeviceName();
            $brand = $dd->getBrandName();
            $model = $dd->getModel();
        } else {
            $desktop = $_SERVER['HTTP_USER_AGENT'];
        }


        $currentTime = date('Y-m-d H:i:s');

        $license = $request->license;
        $timeSession = 0;
        $res_number_day = 0; // tra ve client de luu so ngay ton tai cua cookie
        try {
            $check = License::query()
                ->where('name', '=', $license)
                ->firstOrFail();
            if ($check->expired != null) {
                if ($check->expired <= $currentTime) {
                    throw new \Exception('Key hết hạn !');
                }
                $last_session_id = \request()->cookie('session_id');
                if ($check->session_id != $last_session_id) {
                    throw new \Exception('Key chỉ được kích hoạt trên một thiết bị');
                }
            } else {
                $numberDay = '+ '.$check->number_day.' days';
                $check->expired = date('Y-m-d', strtotime($currentTime.$numberDay));
                $ss_id = session()->getId();
                $timeSession = intval($check->number_day) * 24 * 60;
                $check->session_id = $ss_id;
                $check->save();

            }
            return \response()->json([
                'msg' => 'Kích hoạt thành công',
                'license' => $check
            ], 200)->withCookie(cookie('session_id', $check->session_id, $timeSession));

        } catch (\Throwable $e) {
            return \response()->json([
                'msg' => $e->getMessage()
            ], 400);
        }


    }
}
