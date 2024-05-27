<?php

namespace App\Http\Controllers;


use App\Models\Game;
use App\Models\GameGenre;
use App\Models\GameLink;
use App\Models\License;
use App\Models\MovieLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class LicenseController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        $licenses = License::paginate(10);
//        dd($games[0]->genres);
        return view('admin.licenses.index', compact('licenses'));
    }


    public function create()
    {
        return view('admin.licenses.create');
    }

    public function store(Request $request)
    {

        $validated = $request->all();

        License::query()->create($validated);


        return redirect()->route('admin.license.index')->with('success', 'Created Successfull !');
    }

    public function show(Game $movie)
    {
        // return $movie;
    }

    public function edit(License $license)
    {

        return view('admin.licenses.edit', compact('license'));
    }

    public function update(Request $request, License $license)
    {

        $data = $request->all();
        $license->fill($data);
        $license->save();

        return back()->with('success', 'Updated Successfull !');
    }

    public function destroy(License $license)
    {
        $license->delete();
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
                ->join('games_genres as gg', 'g.genre_id', '=', 'gg.id')
                ->select('g.*', 'gg.name as game_genre')
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
