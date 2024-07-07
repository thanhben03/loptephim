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

    public function index(Request $request)
    {
        $query = Game::query();
        if ($request->q) {
            $query->where('name', 'like', '%'.$request->q.'%')
                ->orderBy('updated_at', 'desc')
            ;
        }
        $games = $query->paginate(10);
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
        $game->fill($data);
        $game->touch();
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

    public function getGame(Request $request)
    {
        $id = $request->id;
        $game = DB::table('games as g')
//                ->join('games_genres as gg', 'g.genre_id', '=', 'gg.id')
//                ->select('g.*', 'gg.name as game_genre')
                ->where('g.id', $id)
                ->first();
        $gameView = Game::query()->where('id', $id)->firstOrFail();
        $gameView->view += 1;
        $gameView->save();
        $links = GameLink::query()->where('game_id', $id)->get();

        return response()->json([
            'game' => $game,
            'links' => $links
        ]);
    }
}
