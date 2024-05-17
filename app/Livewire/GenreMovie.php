<?php

namespace App\Livewire;
use App\Models\Country;
use App\Models\Genre;
use App\Models\MovieGenre;
use Livewire\Attributes\Url;
use Livewire\Component;

class GenreMovie extends Component
{
//    $g
    #[Url]
    public $slug = '';
    public $title = '3213123';

    public function render()
    {
        $genre = Genre::query()->where('slug', $this->slug)->first();
        $genres = Genre::query()->get();
        $countries = Country::query()->get();
        $movies = MovieGenre::query()
            ->where('genre_id', $genre->id)
            ->get();
        return view('livewire.genre-movie', [
            'genre' => $genre,
            'genres' => $genres,
            'countries' => $countries,
            'movies' => $movies,
            'layout' => 'layouts.master',

        ]);
    }
}
