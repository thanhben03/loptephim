<?php

namespace App\Http\Controllers;

use App\Models\Country;
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
        $phimbo = DB::table('movie_genres')
            ->join('movies', 'movie_genres.movie_id', '=', 'movies.id')
            ->where('movie_genres.genre_id', 1)
            ->take(16)->get();
        $phimle = DB::table('movie_genres')
            ->join('movies', 'movie_genres.movie_id', '=', 'movies.id')
            ->where('movie_genres.genre_id', 4)
            ->take(16)
            ->get();
        $genres = Genre::get();
        $countries = Country::get();

        view()->share('genres', $genres);
        view()->share('phimbo', $phimbo);
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
}
