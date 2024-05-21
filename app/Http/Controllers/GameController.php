<?php

namespace App\Http\Controllers;


use App\Models\Game;
use App\Models\GameGenre;
use App\Models\GameLink;
use App\Models\MovieLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{

    public function __construct()
    {
        $genres = GameGenre::query()->get();
//        dd($genres[0]->)
        view()->share('genres', $genres);
    }

    public function index()
    {
        $games = Game::paginate(10);
//        dd($games[0]->genres);
        return view('admin.games.index', compact('games'));
    }


    public function create()
    {
        $genres = GameGenre::query()->get();
        return view('admin.games.create', compact('genres'));
    }

    public function store(Request $request)
    {

        $validated = $request->all();
        unset($validated['link']);
//        dd($request->link);
        DB::transaction(function () use ($validated,$request){

            $game = Game::query()->create($validated);
            $inserts = [];
            foreach ($request->link as $key => $value) {
                $inserts[] = [
                    'game_id' => $game->id,
                    'link' => $value
                ];
            }

            GameLink::query()->insert($inserts);
        });


        return redirect()->route('admin.game.index')->with('success', 'Created Successfull !');
    }

    public function show(Game $movie)
    {
        // return $movie;
    }

    public function edit(Game $game)
    {
        $links = DB::table('games_links')
                ->join('games', 'games.id', '=', 'games_links.game_id')
                ->where('games.id', $game->id)
                ->get();
        return view('admin.games.edit', compact('game', 'links'));
    }

    public function update(Request $request, Game $game)
    {

        $data = $request->all();


        unset($data['link']);

        DB::transaction(function () use ($data,$request, $game){

            $game->fill($data);
            $inserts = [];
            GameLink::query()->where('game_id', $game->id)->delete();
            foreach ($request->link as $key => $value) {
                $inserts[] = [
                    'game_id' => $game->id,
                    'link' => $value
                ];
            }

            GameLink::query()->insert($inserts);
        });

        $game->save();

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
            $query->where('title', 'like', '%' . $request->input('movie_name') . '%');
        }

//        // Tìm kiếm theo thể loại
//        if ($request->has('genres')) {
//            // dd(0);
//            $query->join('movie_genres', 'movie_genres.movie_id', '=', 'movies.id')
//                ->join('genres', 'movie_genres.genre_id', '=', 'genres.id')
//                ->whereIn('genres.id', $request->genres);
//        }
//
//        // Tìm kiếm theo năm
//        if ($request->fromYear != 'no-data' && $request->toYear != 'no-data') {
//            $query->whereBetween(DB::raw('YEAR(release_date)'), [$request->fromYear, $request->toYear]);
//        }

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
            ->join('movie_countries as mc', 'm.id', '=', 'mc.movie_id')
            ->join('genres as g', 'mg.genre_id', '=', 'g.id')
            ->join('countries as c', 'mc.country_id', '=', 'c.id')
                ->select('m.*', 'g.name as genre_name', 'c.name as country_name')
                ->where('m.id', $id)
                ->first();
        $links = MovieLink::query()->where('movie_id', $id)->get();

        return response()->json([
            'movie' => $movie,
            'links' => $links
        ]);
    }
}
