<?php

/**
 * Social Rocket
 *
 * @copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Repositories;

use BADDIServices\SocialRocket\Common\Entities\Entity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class EloquentRepository
{
    /** @var string */
    private $connection;

    /** @var string */
    protected $model;

    public function setConnection(string $name): self
    {
        $this->connection = $name;

        return $this;
    }

    public function newQuery(): Builder
    {
        if ($this->connection === null) {
            return call_user_func(sprintf('%s::query', $this->model));
        }

        $modelClassName = get_class($this->model);

        return (new $modelClassName)->setConnection($this->connection)->newQuery();
    }

    public function all(array $columns = [Entity::ID_COLUMN]): Collection
    {
        return $this->newQuery()
            ->select($columns)
            ->get();
    }

    public function findById(string $id): ?Entity
    {
        return $this->newQuery()
            ->find($id);
    }

    public function first(array $conditions, array $columns = ['*']): ?Entity
    {
        return $this->newQuery()
            ->select($columns)
            ->where($conditions)
            ->first();
    }

    public function where(array $conditions, array $columns = ['*']): Collection
    {
        return $this->newQuery()
            ->select($columns)
            ->where($conditions)
            ->get();
    }

    public function exists(array $conditions): bool
    {
        return $this->newQuery()
            ->where($conditions)
            ->exists();
    }

    public function create(array $attributes): Entity
    {
        return $this->newQuery()
            ->create($attributes);
    }

    public function update(array $conditions, array $attributes): bool
    {
        return $this->newQuery()
            ->where($conditions)
            ->update($attributes) > 0;
    }

    public function updateOrCreate(array $conditions, array $attributes): Entity
    {
        return $this->newQuery()
            ->updateOrCreate($conditions, $attributes);
    }

    public function updateAny(array $attributes): bool
    {
        return $this->newQuery()
            ->update($attributes) > 0;
    }
}
