<?php

/**
 * Social Rocket
 *
 * @copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Repositories;

use Illuminate\Database\Eloquent\Builder;
use BADDIServices\SocialRocket\Entities\ModelEntity;
use Illuminate\Database\Eloquent\Collection;

class EloquentRepository
{
    /** @var string */
    private $connection;

    /** @var BaseModel */
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

    public function all(): Collection
    {
        return $this->newQuery()
            ->select(ModelEntity::ID_COLUMN)
            ->get();
    }
    
    public function findById(string $id): ?ModelEntity
    {
        return $this->newQuery()
            ->find($id);
    }

    public function first(array $conditions, array $columns = ['*']): ?ModelEntity
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
    
    public function create(array $attributes): ModelEntity
    {
        return $this->newQuery()
            ->create($attributes);
    }
    
    public function update(array $conditions, array $attributes): bool
    {
        return $this->newQuery()
            ->where($conditions)
            ->update($attributes);
    }
    
    public function updateOrCreate(array $conditions, array $attributes): ModelEntity
    {
        return $this->newQuery()
            ->updateOrCreate($conditions, $attributes);
    }
}