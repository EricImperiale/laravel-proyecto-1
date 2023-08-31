<?php

namespace App\Repositories\Interfaces;

use App\Models\Movie;

interface MovieRepository
{
    public function all();

    public function withRelations(array $relations, ?string $searchParams);

    public function findOrFail(int $id);

    public function create(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);
}
