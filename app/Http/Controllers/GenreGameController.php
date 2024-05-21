<?php

namespace App\Http\Controllers;

use App\Models\GameGenre;
use App\Models\GenreGame;
use Illuminate\Http\Request;

class GenreGameController extends Controller
{
    public function index()
    {
        $genres = GenreGame::all();
        return view('admin.genres_games.index',compact('genres'));
    }

    public function create()
    {
        return view('admin.genres_games.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
            'slug' => 'required'
        ]);
        // dd($validated);
        $genre = new GenreGame();
        $genre->create($validated);

        return redirect()->route('admin.genres_games.index')->with('success','Created Successfull !');
    }

    public function edit($genre)
    {
        $genre = GameGenre::query()->findOrFail($genre);
        return view('admin.genres_games.edit', compact('genre'));
    }

    public function update(Request $request, $genre)
    {
        $genre = GameGenre::query()->findOrFail($genre);
        $genre->fill($request->all());
        $genre->save();

        return back()->with('success', 'Update Successfull !');
    }


    public function destroy($genre)
    {
        $genre = GameGenre::query()->findOrFail($genre);
        $genre->delete();

        return back()->with('success', 'Deleted Successfull !');
    }
}
