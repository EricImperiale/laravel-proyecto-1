<?php

namespace App\Livewire;

use App\Models\Movie;
use Livewire\Attributes\Url;
use Livewire\Component;
use App\Repositories\Interfaces\MovieRepository;
use Livewire\WithPagination;

class SearchBar extends Component
{
    use WithPagination;

    #[Url(as: 's', history: true)]
    public string|null $searchParams = '';

    public function searchMovies()
    {}

    public function placeholder()
    {
        return view('placeholders.movie-placeholder');
    }

    public function render()
    {
        $movies = $this->withRelations(['country', 'classification', 'genres'], $this->searchParams);

        return view('livewire.search-bar', [
            'movies' => $movies,
            'searchParams' => $this->searchParams,
        ]);
    }

    protected function withRelations(array $relations, string|null $searchParams)
    {
        $searchParams = htmlentities($searchParams);

        $query = Movie::with($relations);

        if(isset($searchParams)) {
            $query->where('title', 'LIKE', '%' . $searchParams . '%');
        }

        return $query->paginate(3);
    }
}
