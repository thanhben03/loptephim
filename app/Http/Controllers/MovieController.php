<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\MovieCountry;
use App\Models\MovieGenre;
use App\Models\MovieLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{

    public function __construct()
    {
        $genres = Genre::query()->get();
        $countries = Country::query()->get();

        view()->share('genres', $genres);
        view()->share('countries', $countries);
    }

    public function index()
    {
        $movies = Movie::paginate(10);
        return view('admin.movies.index', compact('movies'));
    }


    public function create()
    {

        return view('admin.movies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:100',
            'slug' => 'required',
            'thumbnail' => 'required',
            'country' => 'required',
            'release_date' => 'required',
            'is_vietsub' => 'required',
            'link' => 'required',
            'trailer' => 'required',
//            'genre_id' => 'required',
//            'country_id' => 'required',
        ]);
        unset($validated['link']);

        DB::transaction(function () use ($validated,$request){

            $movie = Movie::create($validated);
            $inserts = [];
            $insertsGenre = [];
            foreach ($request->link as $key => $value) {
                $inserts[] = [
                    'movie_id' => $movie->id,
                    'link' => $value
                ];
            }
            foreach ($request->genre_id as $key => $value) {
                $insertsGenre[] = [
                    'movie_id' => $movie->id,
                    'genre_id' => $value
                ];
            }
//            MovieCountry::query()->create([
//                'movie_id' => $movie->id,
//                'country_id' => $request['country_id']
//            ]);
//            MovieGenre::query()->create([
//                'movie_id' => $movie->id,
//                'genre_id' => $request['genre_id']
//            ]);
            MovieGenre::insert($insertsGenre);
            MovieLink::insert($inserts);
        });


        return redirect()->route('admin.movie.index')->with('success', 'Created Successfull !');
    }

    public function show(Movie $movie)
    {
        // return $movie;
    }

    public function edit(Movie $movie)
    {
        $genreIds = DB::table('movie_genres as mg')
                    ->join('movies as m', 'm.id', '=', 'mg.movie_id')
                    ->where('m.id', $movie->id)
                    ->pluck('mg.genre_id')
                    ->all();
        $links = DB::table('movie_links')
                ->join('movies', 'movies.id', '=', 'movie_links.movie_id')
                ->where('movies.id', $movie->id)
                ->get();
        return view('admin.movies.edit', compact('movie', 'links', 'genreIds'));
    }

    public function update(Request $request, Movie $movie)
    {

        $data = $request->all();
        unset($data['link']);
        unset($data['genre_id']);
        unset($data['country_id']);
        DB::transaction(function () use ($data,$request, $movie){

            $movie->fill($data);
            $inserts = [];
            MovieLink::query()->where('movie_id', $movie->id)->delete();
            foreach ($request->link as $key => $value) {
                $inserts[] = [
                    'movie_id' => $movie->id,
                    'link' => $value
                ];
            }
//            MovieCountry::query()->updateOrCreate([
//                'movie_id' => $movie->id
//            ], ['country_id' => $request['country_id']]);
            MovieGenre::query()->where('movie_id', $movie->id)->delete();

            foreach ($request->genre_id as $item) {
                MovieGenre::query()->create([
                    'movie_id' => $movie->id,
                    'genre_id' => $item
                ]);
            }

            MovieLink::insert($inserts);
        });

        $movie->save();

        return back()->with('success', 'Updated Successfull !');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return back()->with('success', 'Deleted Successfull !');
    }

    public function search(Request $request)
    {
//        dd($request->all());
        $query = Movie::query();

        // Tìm kiếm theo tên phim
        if ($request->movie_name != null) {
            $query->where('title', 'like', '%' . $request->input('movie_name') . '%')
            ->orWhere('id', $request->input('movie_name'));
        }

        $movies = $query->paginate(4);
        if ($request->ajax()) {
            $view = view('client.search_load', [
                'movies' => $movies
            ])->render();
            return Response::json(['view' => $view, 'nextPageUrl' => $movies->nextPageUrl()] );
        }
//        dd($movies[0]->movie);
        return view('client.search', [
            'movies' => $movies
        ]);
    }

    public function getMovie(Request $request)
    {
        $id = $request->id;
        $movie = DB::table('movies as m')
            ->join('movie_genres as mg', 'm.id', '=', 'mg.movie_id')
            ->join('genres as g', 'mg.genre_id', '=', 'g.id')
                ->select('m.*', 'g.name as genre_name', 'g.id as genre_id')
                ->where('m.id', $id)
                ->get();
        $genres = [];
        $results = [];
        if (count($movie) > 1) {
            foreach ($movie as $item) {
                $genres[] = [
                    'id' => $item->genre_id,
                    'text' => $item->genre_name,
                ];
            }
            $response = $movie->toArray()[0];
            $response->genre_name = $genres;

            $movie[0] = $response;
        }
        $movieView = Movie::query()->where('id', $id)->firstOrFail();
        $movieView->view = $movieView->view + 1;
        $movieView->save();
        $links = MovieLink::query()->where('movie_id', $id)->get();

        return response()->json([
            'movie' => $movie[0],
            'links' => $links
        ]);
    }
}
