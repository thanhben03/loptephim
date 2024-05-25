<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Game;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\MovieCountry;
use App\Models\MovieGenre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class IndexController extends Controller
{

    public function __construct()
    {
        $banners = DB::table('movie_banners')
            ->join('movies','movie_banners.movie_id', '=', 'movies.id')
//            ->join('genres','movie_banners.movie_id', '=', 'movies.id')
            ->get();

        $phimle = DB::table('movies as m')
            ->join('movie_genres as mg', 'mg.movie_id', '=','m.id')
            ->join('genres as g', 'g.id', '=','mg.genre_id')
            ->select('m.*', 'g.name')
            ->where('g.slug', 'phim-le')
            ->take(16)
            ->get();
        $phimviet = DB::table('movies as m')
            ->join('movie_genres as mg', 'mg.movie_id', '=','m.id')
            ->join('genres as g', 'g.id', '=','mg.genre_id')
            ->select('m.*', 'g.name')
            ->where('g.slug', 'phim-viet')
            ->take(16)
            ->get();
        $phimRap = DB::table('movies as m')
            ->join('movie_genres as mg', 'mg.movie_id', '=','m.id')
            ->join('genres as g', 'g.id', '=','mg.genre_id')
            ->select('m.*', 'g.name')
            ->where('g.slug', 'phim-chieu-rap')
            ->take(16)
            ->get();
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
        $movies = MovieGenre::query()
            ->where('genre_id', $genre->id)
//            ->with('movie')
            ->paginate(4);

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
//            ->with('movie')
            ->paginate(4);

        if ($request->ajax()) {
            $view = view('client.game_load', [
                'games' => $games
            ])->render();
            return Response::json(['view' => $view, 'nextPageUrl' => $games->nextPageUrl()] );
        }
//        dd($movies[0]->movie);
        return view('client.game', [
            'games' => $games
        ]);

    }

    public function appmod(Request $request)
    {
        $games = Game::query()
            ->where('type', '=', 1)
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
            'games' => $games
        ]);

    }
}
